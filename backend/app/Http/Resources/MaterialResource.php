<?php

namespace App\Http\Resources;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Material entry of GET /courses/{slug} — contract §2 „Kursy (H05)".
 *
 * @mixin Material
 */
class MaterialResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'download_url' => null, // signed, expiring link — H05 phase 3
        ];
    }
}
