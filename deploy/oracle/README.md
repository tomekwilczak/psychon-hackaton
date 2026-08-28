# Staging Psychon na Oracle VPS

Konfiguracja uruchamia Psychon jako osobny projekt Docker Compose na prywatnym VPS
Mikołaja. Nie wystawia nowych portów publicznych i nie uruchamia drugiego reverse proxy.
Frontend i API dołączają do istniejącej sieci `n8n_traefik`, a HTTPS obsługuje istniejący
Traefik z resolverem `leresolver`.

## Założenia

- domena: `psychon.mgmurski.pl`;
- rekord `A` wskazuje `130.61.81.230`;
- sieć Docker `n8n_traefik` już istnieje;
- środowisko jest stagingiem z danymi testowymi, Basic Auth i `noindex`;
- prawdziwe sekrety są tylko w `deploy/oracle/.env` na VPS-ie.

## Pierwsze uruchomienie

```bash
git clone https://github.com/tomekwilczak/psychon-hackaton.git ~/psychon
cd ~/psychon
bash deploy/oracle/bootstrap-server.sh
bash deploy/oracle/deploy.sh
```

Skrypt bootstrapujący zapisze dane Basic Auth w chronionym pliku
`deploy/oracle/.access`. Pliku nie wolno commitować ani przesyłać komunikatorem.

## Seedy demo

Pierwsze świadome utworzenie danych demo:

```bash
docker compose --env-file deploy/oracle/.env \
  -f docker-compose.yml -f docker-compose.oracle.yml \
  exec -T app php artisan migrate:fresh --seed --force
```

Ta komenda usuwa dane z bazy Psychon. Nie jest częścią zwykłego deployu.

## Mailpit

Mailpit słucha tylko na `127.0.0.1` VPS-a. Tunel z komputera:

```bash
ssh -L 8025:127.0.0.1:8025 mgmurski
```

Następnie panel jest dostępny lokalnie pod `http://127.0.0.1:8025`.

## Aktualizacja

```bash
cd ~/psychon
git fetch origin main
git switch main
git pull --ff-only origin main
bash deploy/oracle/deploy.sh
```

Zwykła aktualizacja zachowuje bazę i seedy. Reset danych wymaga osobnej, świadomej komendy.

## Kontrola

```bash
docker compose --env-file deploy/oracle/.env \
  -f docker-compose.yml -f docker-compose.oracle.yml ps

curl -I https://psychon.mgmurski.pl
```
