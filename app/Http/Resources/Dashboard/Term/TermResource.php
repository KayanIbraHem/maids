<?php

namespace App\Http\Resources\Dashboard\Term;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TermResource extends JsonResource
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
        $description = $translation ? $translation?->description : "";
        return [
            'id' => $this->id ?? 0,
            'title' => $title ?? "",
            'description' => $description ?? ""
        ];
    }
}
