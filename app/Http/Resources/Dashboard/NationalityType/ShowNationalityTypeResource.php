<?php

namespace App\Http\Resources\Dashboard\NationalityType;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dashboard\Nationality\ShowNationalityResource;
use App\Http\Resources\Dashboard\ServiceType\ShowServiceTypeResource;

class ShowNationalityTypeResource extends JsonResource
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
            'nationality' => new  ShowNationalityResource($this->nationality ?? []) ?? [],
            'service_type' => new  ShowServiceTypeResource($this->serviceType ?? []) ?? [],
            'price' => $this->price ?? 0
        ];
    }
}
