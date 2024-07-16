<?php

namespace App\Models\Policy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolicyTranslation extends Model
{
    use HasFactory;
    protected $table = 'policy_translations';
    protected $guarded = [];
}
