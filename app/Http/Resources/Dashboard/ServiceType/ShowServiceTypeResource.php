<?php

namespace App\Http\Resources\Dashboard\ServiceType;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowServiceTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $titles = [];
        foreach ($this?->translations as $translation) {
            $titles[] = [
                'locale' => $translation?->locale ?? "",
                'title' => $translation?->title ?? "",
            ];
        }
        return [
            'id' => $this->id ?? 0,
            'title' => $titles ?? []
        ];
    }
}
