<?php

namespace App\Http\Resources\Dashboard\Nationality;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowNationalityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $titles = getTranslationAndLocale($this?->translations, 'title');
        return [
            'id' => $this->id ?? 0,
            'titles' => $titles ?? [],
            'code ' => $this->code ?? "",
            'flag' => $this->flagLink
        ];
    }
}
