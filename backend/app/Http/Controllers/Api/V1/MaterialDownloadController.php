<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Material;
use App\Models\User;
use App\Queries\CourseCatalogQuery;
use App\Support\CourseAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * H05 · streams one course material behind a temporary signed link.
 *
 * The link is what a plain <a href download> can follow: the SPA keeps its
 * token in localStorage, so a browser-initiated download carries no
 * Authorization header. The signature covers every parameter — including the
 * `u` the link was issued for — so it cannot be re-pointed at another account.
 * Signature validity alone is not access: visibility and the sequential unlock
 * are re-checked here, against the state at download time.
 */
class MaterialDownloadController extends Controller
{
    public function __invoke(Request $request, Material $material): StreamedResponse
    {
        $user = User::query()->find($request->integer('u'));

        if ($user === null) {
            throw $this->notFound();
        }

        $this->assertReadable($user, $material);

        $disk = Storage::disk('local');

        if (! $disk->exists($material->file_path)) {
            throw new ApiException(404, 'not_found', 'Nie znaleziono pliku materiału.');
        }

        return $disk->download($material->file_path, $material->name, [
            'Content-Type' => $material->mime,
        ]);
    }

    private function assertReadable(User $user, Material $material): void
    {
        $courseId = $material->course_id ?? $material->lesson?->course_id;

        if ($courseId === null) {
            throw $this->notFound();
        }

        $course = CourseCatalogQuery::visibleTo($user)->whereKey($courseId)->first();

        // Outside the caller's scope answers exactly like "does not exist"
        // — existence is not revealed (contract §1.1).
        if (! $course instanceof Course) {
            throw $this->notFound();
        }

        if (CourseCatalogQuery::isParticipant($user)
            && CourseAccess::state($user, $course)['status'] === 'locked') {
            throw new ApiException(403, 'course_locked', 'Ten etap jest jeszcze zablokowany.');
        }
    }

    private function notFound(): ApiException
    {
        return new ApiException(404, 'not_found', 'Nie znaleziono materiału.');
    }
}
