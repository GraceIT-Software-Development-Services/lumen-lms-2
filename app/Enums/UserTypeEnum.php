<?php

namespace App\Enums;

enum UserTypeEnum: string
{
    case INSTITUTIONAL_USER = "institution";
    case STUDENT_USER = 'student';
    case EMPLOYER_USER = "employer";



    public function label(): string
    {
        return match ($this) {
            self::INSTITUTIONAL_USER => 'Internal User',
            self::STUDENT_USER => 'Student',
            self::EMPLOYER_USER => 'Employer Company User',
      
        };
    }

    /**
     * This method displays definitions of the types of strategy
     *
     * @return string
     */
    public function definition(): string
    {
        return match ($this) {

            self::INSTITUTIONAL_USER => "Internal user working for the institution",
            self::STUDENT_USER => "Student enrolled in courses offered by the institution",
            self::EMPLOYER_USER => "User from an employer company",
        };
    }


    // public function color(): string
    // {

    //     return match ($this) {
    //         self::NOT_STARTED => 'slate-500',
    //         self::ONGOING => 'black',
    //         self::POSTPONED => 'yellow-500',
    //         self::COMPLETED => 'green-600',
    //         self::ABANDONED => 'red-600',
    //         self::COMPLETED_CONFIRMED => 'purple-600'
    //     };
    // }




    public function isInstitutionalUser(): bool
    {
        return $this === self::INSTITUTIONAL_USER;
    }

    public function isStudentUser(): bool
    {
        return $this === self::STUDENT_USER;
    }

    public function isEmployerUser(): bool
    {
        return $this === self::EMPLOYER_USER;
    }
}
