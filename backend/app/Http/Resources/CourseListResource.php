<?php

namespace App\Http\Resources;

use App\Models\Course;
use App\Models\User;
use App\Queries\CourseCatalogQuery;
use App\Support\CourseAccess;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Course list item — contract §2 „Kursy (H05)", GET /courses.
 *
 * @mixin Course
 */
class CourseListResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $user = $request->user();

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'sequence_order' => $this->sequence_order,
            'product_group' => $this->product_group,
            'status' => $this->statusFor($user),
            'progress_percent' => CourseAccess::progressPercent($user, $this->resource),
        ];
    }

    /**
     * CourseAccess::state() was written for learners: instructors and
     * administration have no lesson_progress, so it would report every stage
     * past the first as locked. The sequential gate does not apply to them —
     * the status is reduced to a value that stays inside the course.status
     * dictionary (contract §3.4).
     */
    protected function statusFor(User $user): string
    {
        $status = CourseAccess::state($user, $this->resource)['status'];

        if ($status === 'locked' && ! CourseCatalogQuery::isParticipant($user)) {
            return 'in_progress';
        }

        return $status;
    }
}
