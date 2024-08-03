<?php

namespace App\Http\Resources\Dashboard\Settings;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowSettingsResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        $titles = getTranslationAndLocale($this?->translations, 'title');

        return [
            'id' => $this->id ?? 0,
            'titles' => $titles ?? [],
            'facebook' => $this->facebook ?? '',
            'x' => $this->x ?? '',
            'youtube' => $this->youtube ?? '',
            'instagram' => $this->instagram ?? '',
            'linkedin' => $this->linkedin ?? '',
        ];
    }
}
