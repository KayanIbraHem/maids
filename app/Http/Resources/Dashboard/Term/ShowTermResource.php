<?php

namespace App\Http\Resources\Dashboard\Term;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowTermResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        $titles = getTranslationAndLocale($this?->translations, 'title');
        $descriptions = getTranslationAndLocale($this?->translations, 'description');

        return [
            'id' => $this->id ?? 0,
            'titles' => $titles ?? [],
            'descriptions' => $descriptions ?? []
        ];
    }
}
