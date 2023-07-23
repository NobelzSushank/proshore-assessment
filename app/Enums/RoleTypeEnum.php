<?php

namespace App\Enums;

enum RoleTypeEnum: string
{
    case ADMIN = 'admin';
    case STUDENT = 'student';

    public static function getAllValues(): array
    {
        return array_column(self::cases(), "value");
    }
}
