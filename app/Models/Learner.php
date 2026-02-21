<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Learner extends Model
{
    use HasFactory;

    // The attributes that are mass assignable.
    protected $fillable = [

        'uli',
        'picture_path',

        'school_name',
        'school_address',

        'client_type',

        'address_number_street',
        'address_barangay',
        'address_city',
        'address_district',
        'address_province',
        'address_region',
        'address_zip_code',

        'mother_name',
        'father_name',

        'sex',
        'civil_status',
        'birth_date',
        'birth_place',

        'contact_tel',
        'contact_mobile',
        'contact_email',
        'contact_fax',
        'contact_others',

        'educational_attainment',
        'educational_attainment_others',

        'employment_status',

        'registration_type',

        'work_experiences',
        'trainings',
        'licensure_examination',
        'competency_assessment',
    ];

    // The attributes that should be cast to native types.
    protected $casts = [
        'work_experiences' => 'array',
        'trainings' => 'array',
        'licensure_examination' => 'array',
        'competency_assessment' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
