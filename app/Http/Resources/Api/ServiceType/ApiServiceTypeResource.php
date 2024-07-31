<?php

namespace App\Http\Resources\Api\ServiceType;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiServiceTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // if ($this->resource != null) {
        // if ($this?->translations != null) {
        // }
        // }
        $translation = $this?->translations?->where('locale', $request->header('Accept-Language'))?->first();
        $title = $translation ? $translation?->title : "";
        return [
            'id' => $this->id ?? 0,
            'title' => $title ?? ""
        ];
    }
}
