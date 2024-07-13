<?php

namespace App\Http\Services\ServiceType;

use App\Models\ServiceType\ServiceType;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ServiceTypeService
{
    public function getServiceTypes()
    {
        return ServiceType::paginate(5);
    }
    public function showServiceType(int $serviceType): ServiceType
    {
        return  $this->findServiceTypeById($serviceType);
    }
    public function storeServiceType(object $dataRequest): ServiceType
    {
        $data = $this->prepareServiceTypeData($dataRequest);
        return ServiceType::create($data);
    }
    public function updateServiceType(object $dataRequest, int $id): ServiceType
    {
        $serviceType =  $this->findServiceTypeById($id);
        $data = $this->prepareServiceTypeData($dataRequest);
        $serviceType->update($data);
        return $serviceType;
    }
    public function deleteServiceType($id): bool
    {
        $serviceType =  ServiceType::whereId($id)->first();
        if (!$serviceType) {
            throw new \Exception('not_found');
        }
        return $serviceType->delete();
    }
    private function findServiceTypeById(int $row)
    {
        $serviceType = ServiceType::whereId($row)->first();
        if (!$serviceType) {
            throw new \Exception('not_found.');
        }
        return $serviceType;
    }
    private function prepareServiceTypeData(object $dataRequest): array
    {
        $data = [];
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = [
                'title' => $dataRequest->{'title_' . $localeCode},
            ];
        }
        return $data;
    }
}
