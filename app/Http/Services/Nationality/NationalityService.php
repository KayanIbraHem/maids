<?php

namespace App\Http\Services\Nationality;

use App\Models\Nationality\Nationality;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class NationalityService
{
    public function getNationalities()
    {
        return Nationality::paginate(5);
    }
    public function showNationality(int $nationality): Nationality
    {
        return  $this->findNationalityById($nationality);
    }
    public function storeNationality(object $dataRequest): Nationality
    {
        $data = $this->prepareNationalityData($dataRequest);
        return Nationality::create($data);
    }
    public function updateNationality(object $dataRequest, int $id): Nationality
    {
        $nationality =  $this->findNationalityById($id);
        $data = $this->prepareNationalityData($dataRequest);
        $nationality->update($data);
        return $nationality;
    }
    public function deleteNationality($id): bool
    {
        $nationality =  Nationality::whereId($id)->first();
        if (!$nationality) {
            throw new \Exception('not_found');
        }
        return $nationality->delete();
    }
    private function findNationalityById(int $row)
    {
        $nationality = Nationality::whereId($row)->first();
        if (!$nationality) {
            throw new \Exception('not_found.');
        }
        return $nationality;
    }
    private function prepareNationalityData(object $dataRequest): array
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
