#!/usr/bin/env bash
set -euo pipefail

repo_root="$(cd "$(dirname "${BASH_SOURCE[0]}")/../.." && pwd)"
env_file="$repo_root/deploy/oracle/.env"
access_file="$repo_root/deploy/oracle/.access"

cd "$repo_root"

if ! docker network inspect n8n_traefik >/dev/null 2>&1; then
  echo "Brak wymaganej sieci Docker n8n_traefik. Przerywam bez zmian."
  exit 1
fi

if [[ ! -f "$env_file" ]]; then
  umask 077
  db_password="$(openssl rand -hex 32)"
  app_key="base64:$(openssl rand -base64 32)"
  basic_password="$(openssl rand -base64 18 | tr -d '/+=' | cut -c1-20)"
  basic_hash="$(docker run --rm httpd:2.4-alpine htpasswd -nbBC 12 psychon "$basic_password" | cut -d: -f2-)"

  {
    echo "STAGING_DOMAIN=psychon.mgmurski.pl"
    echo "DB_DATABASE=niepodzielni"
    echo "DB_USERNAME=niepodzielni"
    echo "DB_PASSWORD=$db_password"
    echo "APP_KEY=$app_key"
    echo "BASIC_AUTH_CREDENTIALS=psychon:$basic_hash"
    echo "NP_MAILPIT_PORT=8025"
  } > "$env_file"

  {
    echo "URL=https://psychon.mgmurski.pl"
    echo "LOGIN=psychon"
    echo "PASSWORD=$basic_password"
  } > "$access_file"

  echo "Utworzono chroniony plik deploy/oracle/.env."
  echo "Dane Basic Auth zapisano w deploy/oracle/.access (uprawnienia 600)."
else
  echo "Plik deploy/oracle/.env już istnieje — nie nadpisuję sekretów."
fi

chmod 600 "$env_file"
if [[ -f "$access_file" ]]; then
  chmod 600 "$access_file"
fi

echo "Konfiguracja Compose:"
docker compose \
  --env-file "$env_file" \
  -f docker-compose.yml \
  -f docker-compose.oracle.yml \
  config --quiet

echo "Bootstrap zakończony. Aplikacja nie została jeszcze uruchomiona."
