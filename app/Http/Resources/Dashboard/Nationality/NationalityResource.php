<?php

namespace App\Http\Resources\Dashboard\Nationality;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NationalityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $translation = $this?->translations?->where('locale', $request->header('Accept-Language'))?->first();
        $title = $translation ? $translation?->title : "";
        return [
            'id' => $this->id ?? 0,
            'title' => $title ?? ""
        ];
    }
}
