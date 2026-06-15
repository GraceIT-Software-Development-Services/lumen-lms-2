<?php

namespace App\Models;

use App\Traits\AdditionalUuid;
use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    use AdditionalUuid;

    protected $fillable = [
        'uuid',
        'name',
        'address',
        'type',
        'description',
    ];
}
