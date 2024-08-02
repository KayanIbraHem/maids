<?php

namespace App\Http\Resources\Dashboard\Policy;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PolicyResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        $description = getTranslation('description', $request->header('Accept-Language'), $this);
        return [
            'id' => $this->id ?? 0,
            'description' => $description ?? ""
        ];
    }
}
