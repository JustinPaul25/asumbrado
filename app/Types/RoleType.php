<?php

namespace App\Types;

final class RoleType
{
    const ADMINISTRATOR = 'Administrator';
    const MID = 'Mid';
    const VIEWONLY = 'Viewonly';

    public static function toArray(): array
    {
        return [
            self::ADMINISTRATOR,
            self::MID,
            self::VIEWONLY
        ];
    }
}