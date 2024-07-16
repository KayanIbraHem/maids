<?php

namespace App\Http\Resources\Dashboard\Policy;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowPolicyResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        $descriptions = [];
        foreach ($this?->translations as $translation) {
            $descriptions[] = [
                'locale' => $translation?->locale ?? "",
                'title' => $translation?->description ?? "",
            ];
        }
        return [
            'id' => $this->id ?? 0,
            'descriptions' => $descriptions ?? []
        ];
    }
}
