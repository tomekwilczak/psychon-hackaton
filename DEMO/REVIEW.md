# Review stanu projektu — platforma szkoleniowa Fundacji Niepodzielni

**Stan na:** 2026-08-28, 13:40 · **Gałąź:** `main` @ `6047769`

---

## 1. Skala w liczbach

| Metryka | Wartość |
|---|---|
| Commity razem | **65** (43 zwykłe + 22 merge) |
| Praca po starterze | **248 plików, +21 949 / −104 linii** |
| Scalone PR-y | **18** (#1–#18) |
| Okno czasowe pracy | **10:17 → 13:39** = **3 h 22 min** |
| Tempo | ~**108 linii/min**, commit co ~**4,7 min** |
| Pliki testowe / metody testowe | **37 / 189** |
| Strony frontu / komponenty | **19 / 22** |
| Modele Eloquent | 30 |
| Migracje | 14 — nietknięte, zamrożenie utrzymane ✅ |

Cały projekt powstał w **jeden poranek**. Starter wjechał 20.08, reszta — 28.08 między śniadaniem a obiadem.

---

## 2. Kto co dowiózł

| Osoba | Commity | Linie | Pliki | Pakiety |
|---|---|---|---|---|
| **Błażej Ksycki** | 15 + 17 merge | +6 796 / −78 | 103 | H14, H19 · H15 w toku |
| **Tomek Wilczak** | 9 | +5 993 / −45 | 83 | **H01, H10, H13, H21** |
| **Mikołaj (mixonnn)** | 9 | +5 019 / −28 | 67 | H06, H11 · H12 blocked |
| **Mariusz Jendrzejczak** | 8 | +2 648 / −57 | 57 | H05 |
| **Irek Grycuk** | 3 | +1 632 / −32 | 28 | H02, H16 |

### Ciekawostki o ludziach

**#1 — Tomek to maszyna do pakietów.** 4 zamknięte pakiety w 9 commitach, w tym H13 (certyfikaty + publiczna weryfikacja) w **jednym** commicie. Najlepszy stosunek pakietów do commitów w zespole: **0,44 pakietu na commit**.

**#2 — Irek gra w Moneyball.** 3 commity, 2 zamknięte pakiety (H02 + H16), 1 632 linie. Najwyższa gęstość dowozu: **545 linii na commit** i **0,67 pakietu na commit** — a H02 przejął po porzuceniu przez kogoś innego.

**#3 — Błażej scalił 17 z 18 PR-ów.** De facto integrator / release manager zespołu. Jego drugie konto (`64609904+xycu`) to wyłącznie merge z GitHub UI.

---

## 3. Podział wysiłku — projekt napisany bardziej po polsku niż w PHP

| Warstwa | Linie | Udział |
|---|---|---|
| **Dokumentacja (.md)** | **8 963** | **41 %** |
| Backend (Laravel) | 8 366 | 38 % |
| Frontend (Next.js) | 4 699 | 21 % |

**#4 — dokumentacji jest więcej niż backendu.** Napędzają to dwie osoby: Błażej (4 350 linii docs) i Mikołaj (3 211). Praktycznie cały `openspec/` + mapa zależności + design system.

Profile kontrybucji są wyraźnie różne:

- **Tomek** — 59 % backend, najbardziej „API-first" (3 562 linii BE)
- **Mikołaj** — 64 % dokumentacja, architekt specyfikacji
- **Irek** — jedyny z równowagą 50/50 BE↔FE (652 / 687)
- **Mariusz** — 57 % backend, najbardziej zbalansowany między BE a FE bez docs

---

## 4. Tablica pakietów — 11/21 zamknięte

| Status | Pakiety | Liczba |
|---|---|---|
| **DONE** | H01 · H02 · **H05** · H06 · H10 · H11 · H13 · H14 · H16 · H19 · H21 | **11** |
| **W TOKU** | H15 (Błażej) | 1 |
| **BLOCKED** | H12 | 1 |
| **GOTOWE** (nietknięte) | H03 · H04 · H07 · H08 · H09 · H17 · H18 · H20 | 8 |

**H12 — powód blokady:** kontrakt API nie definiuje pełnych DTO i walidacji superwizji, cyklu życia zapisu/wypisu ani właściciela wspólnego z H18 endpointu przypisania superwizora.

**Fala P0 jest praktycznie domknięta** — z 10 pakietów P0 brakuje tylko **H18** (panel osób) i **wspólnego przejścia ścieżki demo** (punkt 3.11 tablicy). To najbliższa rzecz do zrobienia.

### ✅ Rozjazd na tablicy — naprawiony

Review zastał H05 ze statusem `W TOKU`, mimo że PR #15 był już scalony (`896c5c7`, 8 commitów): board mówił „w robocie", `main` mówił „w środku". Wiersz 3.3 tablicy został poprawiony na `DONE` (PR #15 scalony) — bez tego ktoś mógłby uznać pakiet za wolny albo za niedokończony przy odbiorze P0.

---

## 5. Pokrycie testami — bardzo nierówne

| Pakiet / obszar | Testy | Komentarz |
|---|---|---|
| Courses (H05) | **28** | najlepiej pokryty |
| H10 — testy wiedzy | **28** | + testy współbieżności |
| H14 — dokumenty | **26** | + `ConcurrentDocumentNumberTest` |
| H13 — certyfikaty | 21 | + concurrency |
| Feature (root) | 14 | koperty błędów, seed, smoke |
| H01 · H21 | po 11 | |
| H19 | 10 | |
| Notifications (H16) | 10 | |
| Auth · **H11** | po 8 | H11 najsłabiej pokryty z zamkniętych |
| PermissionMatrix (H02) | 7 | test-kit, zero tras — zgodnie z zamysłem |
| Support (`CourseAccess`) | 6 | |

**#5 — zespół sam z siebie pisał testy współbieżności.** Trzy niezależne pakiety (H10, H13, H14) mają dedykowane `Concurrent*Test` na wyścigi o limity podejść, numery certyfikatów i numery dokumentów. Na hackathonie to rzadkość — zwykle nikt nie testuje race conditions.

---

## 6. Największe pojedyncze artefakty

```
413  frontend/.../kursy/[slug]/test/page.tsx     ← największy plik projektu
409  frontend/.../panel/profil/page.tsx
367  frontend/.../panel/start/page.tsx
365  components/h11/InternshipJournal.tsx
365  docs/hackathon/05-zaleznosci-pakietow.md
321  DESIGN.md
313  DEMO/H05.md                                 ← najbardziej rozbudowany dokument DEMO
296  components/lesson/LessonPlayer.tsx
279  tests/Feature/H11/InternshipTest.php
235  backend/routes/api/h06.php                  ← anomalia, patrz niżej
```

**#6 — `h06.php` ma 250 linii, przy medianie 15.** Wszystkie pozostałe pliki tras mieszczą się w 28–40 liniach. H06 ma logikę odtwarzacza/heartbeatu wpisaną wprost w plik tras zamiast w kontroler — jedyne miejsce w repo, gdzie router robi realną robotę. Do refaktoru po hackathonie, ale działa.

---

## 7. Rytm dnia

```
10:00  ██████              6 commitów   ← rozruch, AGENTS.md, kolejka zadań
11:00  ██████████         10 commitów
12:00  ████████████████   16 commitów   ← szczyt
13:00  ██████████         10 commitów   ← domykanie PR-ów
```

**#7 — dwie kolizje sekundowe.** O **12:46** i **12:54** dwie osoby (Błażej i Mikołaj) commitowały w tej samej minucie. Przy 5 osobach i oknie 202 minut to statystycznie ~2 kolizje — czyli dokładnie tyle, ile wypadło. Zespół pracował równomiernie, bez wąskiego gardła na jednej osobie.

**#8 — najdłuższy komunikat commita to komunikat merge'a.** `0985712` Błażeja to 3-liniowy opis rozwiązania konfliktu na `tasks.md`, wyjaśniający, że status `REVIEW` dla H13 był nieaktualny, zanim PR w ogóle zdążył wylądować. Klasyczne hackathonowe „tablica ściga się z rzeczywistością".

---

## 8. Higiena repo

### Mocne strony

- ✅ **Zamrożenie migracji utrzymane** — 14 migracji ze startera, zero nowych
- ✅ **Zero naruszeń własności tras** — każdy pakiet tylko w swoim `hXX.php`
- ✅ **11 dokumentów DEMO** — komplet, po jednym na każdy z 11 zamkniętych pakietów
- ✅ **OpenSpec żyje** — 11 specyfikacji zdolności + 6 aktywnych zmian + archiwum
- ✅ **Konwencja commitów trzymana** — `feat(HXX):` / `docs(team):` niemal wszędzie

### Drobiazgi

- ⚠️ `Tomek :: First commit test Tomek` — tradycyjny commit-świadek, że setup działa. Został na zawsze w historii `main`.

---

## 9. Podsumowanie

Pięć osób, trzy i pół godziny, ~22 tysiące linii, 18 scalonych PR-ów i **11 z 21 pakietów zamkniętych z testami i dokumentacją DEMO** — przy zerowym naruszeniu zamrożonych migracji i granic własności plików.

**Do posprzątania:**

1. ~~**Status H05 na tablicy** — jest scalony, a wisi jako `W TOKU`.~~ → poprawione na `DONE` (PR #15 scalony).
2. **Odblokowanie H12** — wymaga decyzji strażnika kontraktu w sprawie DTO superwizji i właściciela endpointu `PUT /admin/users/{id}/supervisor`.

**Najbliższy krok do domknięcia fali P0:** pakiet **H18** (panel osób, wciąż bez właściciela) oraz wspólne przejście ścieżki demo (punkt 3.11 tablicy).
