/**
 * Rejestr menu — panel administracji (/admin).
 *
 * Jak dodać swój wpis (pakiet HXX):
 * 1. Utwórz plik `hXX-nazwa.ts` obok tego pliku (wzór: h19-pulpit.ts).
 * 2. Dodaj swój wpis jedną linią do importów i jedną do listy poniżej.
 */
import h11Staz from "./h11-staz";
import h16Emails from "./h16-emails";
import h18Uczestniczki from "./h18-uczestniczki";
import h19Pulpit from "./h19-pulpit";
import h19Ustawienia from "./h19-ustawienia";
import h15Profil from "./h15-profil";
// import hXXNazwa from "./hXX-nazwa"; // ← dodaj swój wpis jedną linią

import { sortMenu, type MenuEntry } from "../types";

export const adminMenu: MenuEntry[] = sortMenu([
  h19Pulpit,
  h19Ustawienia,
  h18Uczestniczki,
  h11Staz,
  h15Profil,
  h16Emails,
  // hXXNazwa, // ← i drugą tutaj
]);
