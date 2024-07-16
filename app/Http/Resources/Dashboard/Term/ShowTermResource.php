<?php

namespace App\Http\Resources\Dashboard\Term;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowTermResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        $titles = [];
        $descriptions = [];
        foreach ($this?->translations as $translation) {
            $titles[] = [
                'locale' => $translation?->locale ?? "",
                'title' => $translation?->title ?? "",
            ];
            $descriptions[] = [
                'locale' => $translation?->locale ?? "",
                'title' => $translation?->description ?? "",
            ];
        }
        return [
            'id' => $this->id ?? 0,
            'titles' => $titles ?? [],
            'descriptions' => $descriptions ?? []
        ];
    }
}
