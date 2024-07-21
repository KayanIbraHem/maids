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
            'id' => $this->id ?? 0,
            'first_name' => $this->first_name ?? "",
            'last_name' => $this->last_name ?? "",
            'email' => $this->email ?? "",
            'phone' => $this->phone ?? "",
            'image' => $this->imageLink ?? "",
            'api_token' => $this->api_token ?? "",
        ];
    }
}
