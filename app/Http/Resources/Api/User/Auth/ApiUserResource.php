<?php

namespace App\Http\Resources\Api\User\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id ?? 0,
            'name' => (string) $this->name ?? "",
            'email' => (string) $this->email ?? "",
            'phone' => (string) $this->phone ?? "",
            'country_code' => (string)  $this->country_code ?? "",
            'image' => (string)  $this->imageLink ?? "",
            'token' => (string)$this->token ?? "",
            'is_phone_verified' => (int) $this->is_phone_verified ?? 0,
        ];
    }
}
