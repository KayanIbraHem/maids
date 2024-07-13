<?php

namespace App\Http\Resources\Dashboard\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
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
            'email' => $this->email ?? "",
            'image' => $this->imageLink ?? "",
            'type' => intval($this->type ?? 0),
            'api_token' => $this->api_token ?? "",
        ];
    }
}
