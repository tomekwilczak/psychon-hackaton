<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Courses\CourseIndexRequest;
use App\Http\Resources\CourseDetailResource;
use App\Http\Resources\CourseListResource;
use App\Models\Course;
use App\Queries\CourseCatalogQuery;
use App\Support\CourseAccess;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * H05 · course catalogue and course detail — contract §2 „Kursy (H05)".
 * The unlock rule itself is CourseAccess (frozen); this controller only
 * enforces it on the HTTP boundary.
 */
class CourseController extends Controller
{
    public function index(CourseIndexRequest $request): AnonymousResourceCollection
    {
        $query = CourseCatalogQuery::visibleTo($request->user())->with(['lessons', 'test']);

        if ($request->filled('product_group')) {
            $query->where('product_group', $request->string('product_group')->value());
        }

        $courses = $query
            ->orderByRaw('sequence_order asc nulls last')
            ->orderBy('title')
            ->get();

        return CourseListResource::collection($courses);
    }

    public function show(Request $request, string $slug): CourseDetailResource
    {
        $user = $request->user();

        $course = CourseCatalogQuery::visibleTo($user)
            ->where('slug', $slug)
            ->with(['lessons', 'test'])
            ->first();

        // Out of the caller's scope answers exactly like "does not exist"
        // — existence is not revealed (contract §1.1).
        if ($course === null) {
            throw new ApiException(404, 'not_found', 'Nie znaleziono kursu.');
        }

        if (CourseCatalogQuery::isParticipant($user)) {
            $state = CourseAccess::state($user, $course);

            if ($state['status'] === 'locked') {
                throw $this->locked($state);
            }
        }

        return CourseDetailResource::make($course);
    }

    /**
     * @param  array{status: string, missing: list<string>, required_course_id?: int}  $state
     */
    private function locked(array $state): ApiException
    {
        $required = Course::query()->find($state['required_course_id'] ?? null);

        $message = $required === null
            ? 'Ukończ najpierw poprzedni etap ścieżki.'
            : sprintf('Ukończ najpierw etap %d: %s.', $required->sequence_order, $required->title);

        return new ApiException(403, 'course_locked', $message, reason: [
            'required_course_id' => $state['required_course_id'] ?? null,
            'missing' => $state['missing'],
        ]);
    }
}
