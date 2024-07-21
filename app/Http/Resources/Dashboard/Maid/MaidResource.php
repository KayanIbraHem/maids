<?php

namespace App\Http\Resources\Dashboard\Maid;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dashboard\Nationality\NationalityResource;
use App\Http\Resources\Dashboard\ServiceType\ServiceTypeResource;

class MaidResource extends JsonResource
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
            'age' => $this->age ?? "",
            'image' => $this->imageLink ?? "",
            'cv' => $this->cvLink ?? "",
            'nationality' => new NationalityResource($this->nationality ?? []) ?? "",
            'service_type' => new ServiceTypeResource($this->serviceType ?? []) ?? ""
        ];
    }
}
