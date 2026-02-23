<?php

namespace App\Enums;

enum DocumentTypeEnum: string
{
    case BirthCertificate = 'birth_certificate';
    case Diploma = 'diploma';
    case Transcript = 'transcript';
    case GoodMoral = 'good_moral';
    case MedicalCertificate = 'medical_certificate';
    case Barangay = 'barangay_clearance';
    case PoliceClereance = 'police_clearance';
    case NBI = 'nbi_clearance';
    case ValidId = 'valid_id';
    case PassportPhoto = 'passport_photo';

    public function label(): string
    {
        return match ($this) {
            self::BirthCertificate  => 'Birth Certificate',
            self::Diploma           => 'Diploma',
            self::Transcript        => 'Transcript of Records',
            self::GoodMoral         => 'Good Moral Certificate',
            self::MedicalCertificate => 'Medical Certificate',
            self::Barangay          => 'Barangay Clearance',
            self::PoliceClereance   => 'Police Clearance',
            self::NBI               => 'NBI Clearance',
            self::ValidId           => 'Valid ID',
            self::PassportPhoto     => 'Passport Photo',
        };
    }
}
