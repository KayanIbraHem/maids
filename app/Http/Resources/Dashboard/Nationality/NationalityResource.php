<?php

namespace App\Http\Resources\Dashboard\Nationality;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NationalityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $title =  getTranslation('title', $request->header('Accept-Language'), $this);
        return [
            'id' => $this->id ?? 0,
            'title' => $title ?? "",
            'code' => $this->code ?? "",
            'flag' => $this->flagLink
        ];
    }
}
