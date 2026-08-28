#!/usr/bin/env bash
set -euo pipefail

repo_root="$(cd "$(dirname "${BASH_SOURCE[0]}")/../.." && pwd)"
env_file="$repo_root/deploy/oracle/.env"
compose=(docker compose --env-file "$env_file" -f docker-compose.yml -f docker-compose.oracle.yml)

cd "$repo_root"

if [[ ! -f "$env_file" ]]; then
  echo "Brak deploy/oracle/.env. Najpierw uruchom deploy/oracle/bootstrap-server.sh."
  exit 1
fi

"${compose[@]}" config --quiet

echo "Instaluję zależności backendu..."
"${compose[@]}" run --rm --no-deps app \
  composer install --no-interaction --no-dev --prefer-dist --no-progress --optimize-autoloader

echo "Uruchamiam usługi Psychon..."
"${compose[@]}" up -d pgsql redis mailpit
"${compose[@]}" up -d app queue scheduler frontend

echo "Uruchamiam migracje i cache konfiguracji..."
"${compose[@]}" exec -T app php artisan migrate --force
"${compose[@]}" exec -T app php artisan storage:link --force
"${compose[@]}" exec -T app php artisan optimize

echo "Status usług:"
"${compose[@]}" ps

echo "Wdrożenie zakończone. Nie resetowano istniejącej bazy ani seedów."
