## 1. Uruchomienie kolejki zespołu

- [ ] 1.1 Wpisać pięć loginów GitHub zespołu: `@_____`, `@_____`, `@_____`, `@_____`, `@_____`; zweryfikować, że każda osoba ma dostęp do forka i może wypchnąć własną gałąź.
- [ ] 1.2 Potwierdzić wspólnie regułę jednego aktywnego pakietu na osobę; zweryfikować, że każda osoba potrafi wskazać właściciela i status dowolnego HXX w tym pliku.
- [ ] 1.3 Pobrać pierwszych pięć pakietów z Fali P0, wpisać właścicieli i zmienić ich status na `W TOKU`; zweryfikować, że nie ma dwóch właścicieli tego samego HXX ani dwóch aktywnych HXX u jednej osoby.
- [ ] 1.4 Dla każdego pobranego pakietu utworzyć gałąź `pakiet/HXX-nazwa`; zweryfikować na GitHubie obecność pięciu różnych gałęzi zgodnych z numerami w kolejce.

## 2. Zasady odbioru każdego pakietu

- [ ] 2.1 Przed kodowaniem właściciel czyta zakres HXX w `docs/hackathon/01-pakiety-zadan.md`, odpowiadające endpointy w `02-kontrakt-api.md`, dane w `04-seed-demo.md` i właściwy ekran makiety; weryfikacja: zakres oraz kryteria ★ są zapisane w `DEMO/HXX.md`.
- [ ] 2.2 Właściciel implementuje cały pionowy wycinek HXX: API, autoryzację, walidację, interfejs oraz testy; weryfikacja: kryteria akceptacji pakietu przechodzą lokalnie.
- [ ] 2.3 Właściciel obsługuje happy path, odmowę dostępu oraz wymagane stany pusty/błędu; weryfikacja: testy pakietu i ręczny scenariusz z `DEMO/HXX.md` przechodzą.
- [ ] 2.4 Przed zmianą statusu na `REVIEW` uruchomić testy backendu oraz `npm run lint && npm run build`; weryfikacja: wszystkie komendy kończą się powodzeniem, a wynik jest zapisany w `DEMO/HXX.md`.
- [ ] 2.5 Po scaleniu pakietu oznaczyć go `DONE` i dopiero wtedy pobrać najwyżej położony pakiet `GOTOWE`; weryfikacja: `tasks.md`, gałęzie i stan kodu wskazują tego samego właściciela oraz status.

## 3. Fala P0 i minimum demonstracyjne

- [x] 3.1 H01 — Profil użytkownika i eksport RODO · Właściciel: `Tomek` · Status: `DONE`; weryfikacja: kryteria ★ i testy H01 przechodzą, istnieje `DEMO/H01.md`.
- [ ] 3.2 H02 — Uprawnienia i test-kit matrycy · Właściciel: `Irek` · Status: `REVIEW` (przejęte po `Błażej` — porzucone); weryfikacja: kryteria ★ i testy H02 przechodzą, istnieje `DEMO/H02.md`.
- [ ] 3.3 H05 — Katalog kursów i sekwencyjne odblokowanie · Właściciel: `Mariusz` · Status: `W TOKU`; weryfikacja: kryteria ★ i testy H05 przechodzą, istnieje `DEMO/H05.md`.
- [ ] 3.4 H06 — Lekcja, odtwarzacz i postęp · Właściciel: `Mikołaj` · Status: `BLOCKED` — brak wiążącego DTO lekcji/ukończenia i pola trwałej pozycji w schemacie; weryfikacja: kryteria ★ i testy H06 przechodzą, istnieje `DEMO/H06.md`.
- [ ] 3.5 H10 — Testy wiedzy i warsztat · Właściciel: `@_____` · Status: `GOTOWE`; weryfikacja: kryteria ★ i testy H10 przechodzą, istnieje `DEMO/H10.md`.
- [ ] 3.6 H13★ — Minimum certyfikatu i warunków ukończenia · Właściciel: `@_____` · Status: `GOTOWE`; weryfikacja: kryteria oznaczone ★ w H13 przechodzą, istnieje sekcja minimum w `DEMO/H13.md`.
- [x] 3.7 H16 — Powiadomienia, dzwonek i e-maile symulowane · Właściciel: `Irek` · Status: `DONE`; weryfikacja: kryteria ★ i testy H16 przechodzą, wiadomości trafiają wyłącznie do Mailpit, istnieje `DEMO/H16.md`.
- [ ] 3.8 H18 — Panel osób i karta osoby · Właściciel: `@_____` · Status: `GOTOWE`; weryfikacja: kryteria ★ i testy H18 przechodzą, istnieje `DEMO/H18.md`.
- [ ] 3.9 H19 — Pulpit administracyjny i ustawienia edycji · Właściciel: `Błażej` · Status: `W TOKU`; weryfikacja: kryteria ★ i testy H19 przechodzą, istnieje `DEMO/H19.md`.
- [ ] 3.10 H21 — Onboarding „Zacznij tutaj” · Właściciel: `Tomek` · Status: `W TOKU`; weryfikacja: kryteria ★ i testy H21 przechodzą, istnieje `DEMO/H21.md`.
- [ ] 3.11 Przeprowadzić wspólną ścieżkę P0 na danych demo; weryfikacja: logowanie → kurs → lekcja → test → powiadomienie → warunki certyfikatu → panel administracji działa bez ręcznej zmiany danych.

## 4. Fala P0.5 i P1

- [ ] 4.1 H03 — Rekrutacja i kolejka zgłoszeń · Właściciel: `@_____` · Status: `GOTOWE`; weryfikacja: kryteria akceptacji i testy H03 przechodzą, istnieje `DEMO/H03.md`.
- [ ] 4.2 H04 — Dostęp czasowy · Właściciel: `@_____` · Status: `GOTOWE`; weryfikacja: kryteria akceptacji i testy H04 przechodzą, istnieje `DEMO/H04.md`.
- [ ] 4.3 H07 — Pomiar czasu nauki i rzetelność · Właściciel: `@_____` · Status: `GOTOWE`; weryfikacja: kryteria akceptacji i testy H07 przechodzą, istnieje `DEMO/H07.md`.
- [ ] 4.4 H08 — CMS treści · Właściciel: `@_____` · Status: `GOTOWE`; weryfikacja: uzgodniona część H08a/H08b oraz jej testy przechodzą, istnieje `DEMO/H08.md` z jawnym zakresem.
- [ ] 4.5 H09 — Wizytówki i przypisania prowadzących · Właściciel: `@_____` · Status: `GOTOWE`; weryfikacja: kryteria akceptacji i testy H09 przechodzą, istnieje `DEMO/H09.md`.
- [ ] 4.6 H11 — Dziennik stażu i akceptacje · Właściciel: `Mikołaj` · Status: `W TOKU`; weryfikacja: kryteria akceptacji i testy H11 przechodzą, istnieje `DEMO/H11.md`.
- [ ] 4.7 H12 — Superwizje, zapisy i obecności · Właściciel: `@_____` · Status: `GOTOWE`; weryfikacja: kryteria akceptacji i testy H12 przechodzą, istnieje `DEMO/H12.md`.
- [ ] 4.8 H13 — Pełny zakres certyfikatów i publicznej weryfikacji · Właściciel: `@_____` · Status: `GOTOWE`; weryfikacja: wszystkie kryteria H13 przechodzą, `DEMO/H13.md` opisuje pełny scenariusz.
- [ ] 4.9 Przeprowadzić ścieżkę P1 na danych demo; weryfikacja: rekrutacja, dostęp, nauka, staż, superwizje i certyfikat współpracują bez zmiany kontraktu API.

## 5. Fala P2

- [ ] 5.1 H14 — Dokumenty generowane z profilu · Właściciel: `Błażej` · Status: `W TOKU`; weryfikacja: kryteria akceptacji i testy H14 przechodzą, istnieje `DEMO/H14.md`.
- [ ] 5.2 H15 — Profil psychologa · Właściciel: `@_____` · Status: `GOTOWE`; weryfikacja: kryteria akceptacji i testy H15 przechodzą, istnieje `DEMO/H15.md`.
- [ ] 5.3 H17 — Pytania do prowadzącego · Właściciel: `@_____` · Status: `GOTOWE`; weryfikacja: kryteria akceptacji i testy H17 przechodzą, istnieje `DEMO/H17.md`.
- [ ] 5.4 H20 — Raporty i dziennik działań · Właściciel: `@_____` · Status: `GOTOWE`; weryfikacja: kryteria akceptacji i testy H20 przechodzą, istnieje `DEMO/H20.md`.

## 6. Integracja i przekazanie

- [ ] 6.1 Zweryfikować własność plików współdzielonych i slotów przed scaleniem każdej gałęzi; weryfikacja: żaden pakiet nie modyfikuje cudzych plików tras ani zamrożonych migracji.
- [ ] 6.2 Utrzymywać jeden oficjalny PR zespołu do repozytorium Fundacji; weryfikacja: na upstreamie nie istnieje drugi równoległy PR tego zespołu.
- [ ] 6.3 Przed końcowym przekazaniem uruchomić pełne testy, lint i build oraz przejść scenariusze z `DEMO/`; weryfikacja: wszystkie bramki są zielone, a braki są jawnie wypisane.
- [ ] 6.4 Zaktualizować tę kolejkę do stanu faktycznego i oznaczyć niedokończone pakiety jako `BLOCKED` lub pozostawić `GOTOWE` z opisem; weryfikacja: każdy H01–H21 ma jednoznaczny status i właściciela albo pustego właściciela.
