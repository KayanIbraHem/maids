<?php

namespace App\Services\Policy;

use App\Services\BaseCrudService;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PolicyService extends BaseCrudService
{
    protected string $model = 'App\\Models\\Policy\\Policy';
    protected function prepareData(array $dataRequest): array
    {
        $data = [];
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = [
                'description' => $dataRequest['description_' . $localeCode],
            ];
        }
        return $data;
    }
}
