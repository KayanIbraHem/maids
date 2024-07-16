<?php

namespace App\Http\Resources\Dashboard\Policy;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PolicyResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        $translation = $this?->translations?->where('locale', $request->header('Accept-Language'))?->first();
        $description = $translation ? $translation?->description : "";
        return [
            'id' => $this->id ?? 0,
            'description' => $description ?? ""
        ];
    }
}
