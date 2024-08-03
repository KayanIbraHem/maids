<?php

namespace App\Http\Resources\Dashboard\Settings;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id ?? 0,
            'name' => $this->name ?? "",
            'phone' => $this->phone ?? "",
            'address' => $this->address ?? "",
            'whatsapp' => $this->whatsapp ?? "",
            'facebook' => $this->facebook ?? '',
            'x' => $this->x ?? '',
            'youtube' => $this->youtube ?? '',
            'instagram' => $this->instagram ?? '',
            'linkedin' => $this->linkedin ?? '',
        ];
    }
}
