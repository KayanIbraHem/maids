<?php

namespace App\Services\Dashboard\Slider;

use App\Bases\CrudOperation\CrudOperationBase;

class SliderService extends CrudOperationBase
{
    protected string $model = 'App\\Models\\Slider\\Slider';
    protected string $imageKey = 'image';
}
