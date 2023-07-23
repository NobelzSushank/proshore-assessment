<?php

namespace App\Enums;

enum SubjectTypeEnum: string
{
    case PHYSICS = 'physics';
    case CHEMISTRY = 'chemistry';

    public static function getAllValues(): array
    {
        return array_column(self::cases(), "value");
    }
}