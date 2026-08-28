/**
 * Dane pakietu H05 — katalog kursów i strona kursu.
 * Kształty odpowiadają kontraktowi §2 „Kursy (H05)"; `api<T>()` rozpakowuje
 * kopertę `{ data }`, więc tutaj operujemy już na samej treści.
 */
import { api } from "@/lib/api";

export type CourseStatus = "locked" | "in_progress" | "completed";

export type ProductGroup = "psychon" | "dobrostan" | "both";

export interface CourseListItem {
  id: number;
  slug: string;
  title: string;
  sequence_order: number | null;
  product_group: ProductGroup;
  status: CourseStatus;
  progress_percent: number;
}

export interface LessonSummary {
  id: number;
  title: string;
  sequence_order: number;
  duration_seconds: number | null;
  is_completed: boolean;
}

export interface CourseMaterial {
  id: number;
  name: string;
  /** Podpisany, wygasający link — wypełnia go faza 3 pakietu. */
  download_url: string | null;
}

export interface CourseInstructor {
  id: number;
  name: string;
}

export interface CourseDetail extends CourseListItem {
  instructor: CourseInstructor | null;
  lessons: LessonSummary[];
  materials: CourseMaterial[];
}

/**
 * Status kursu → etykieta i wariant odznaki. Kolor nigdy nie jest jedynym
 * nośnikiem statusu (DESIGN.md — „Nie używaj koloru jako jedynego nośnika").
 */
export const COURSE_STATUS_BADGE: Record<
  CourseStatus,
  { label: string; variant: "success" | "accent" | "neutral" }
> = {
  completed: { label: "Ukończony", variant: "success" },
  in_progress: { label: "W toku", variant: "accent" },
  locked: { label: "Zablokowany", variant: "neutral" },
};

/** „Etap 3" dla kursów ze ścieżki, „Poza ścieżką" dla webinarów i zaproszeń. */
export function stageLabel(sequenceOrder: number | null): string {
  return sequenceOrder === null ? "Poza ścieżką" : `Etap ${sequenceOrder}`;
}

/** Czas trwania lekcji w formie czytelnej dla człowieka. */
export function formatDuration(seconds: number | null): string {
  if (seconds === null || seconds <= 0) return "Czas nieznany";

  const totalMinutes = Math.round(seconds / 60);
  const hours = Math.floor(totalMinutes / 60);
  const minutes = totalMinutes % 60;

  if (hours === 0) return `${minutes} min`;
  if (minutes === 0) return `${hours} godz.`;

  return `${hours} godz. ${minutes} min`;
}

export function fetchCourses(
  productGroup?: ProductGroup,
): Promise<CourseListItem[]> {
  const query = productGroup
    ? `?product_group=${encodeURIComponent(productGroup)}`
    : "";

  return api<CourseListItem[]>(`/courses${query}`);
}

export function fetchCourse(slug: string): Promise<CourseDetail> {
  return api<CourseDetail>(`/courses/${encodeURIComponent(slug)}`);
}
