/**
 * Rejestr menu — panel administracji (/admin).
 *
 * Jak dodać swój wpis (pakiet HXX):
 * 1. Utwórz plik `hXX-nazwa.ts` obok tego pliku (wzór: h19-pulpit.ts).
 * 2. Dodaj swój wpis jedną linią do importów i jedną do listy poniżej.
 */
import h16Emails from "./h16-emails";
import h19Pulpit from "./h19-pulpit";
import h19Ustawienia from "./h19-ustawienia";
// import hXXNazwa from "./hXX-nazwa"; // ← dodaj swój wpis jedną linią

import { sortMenu, type MenuEntry } from "../types";

export const adminMenu: MenuEntry[] = sortMenu([
  h19Pulpit,
  h19Ustawienia,
  h16Emails,
  // hXXNazwa, // ← i drugą tutaj
]);
