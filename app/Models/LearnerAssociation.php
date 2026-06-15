<?php

namespace App\Models;

use App\Traits\AdditionalUuid;
use Illuminate\Database\Eloquent\Model;

class LearnerAssociation extends Model
{
    use AdditionalUuid;

    protected $fillable = [
        'uuid',
        'user_id',
        'association_id'
    ];
}
