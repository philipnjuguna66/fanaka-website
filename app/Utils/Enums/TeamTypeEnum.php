<?php

namespace App\Utils\Enums;

enum TeamTypeEnum : string
{

    case CEO = 'CEO';

    case MANAGEMENT = 'MANAGEMENT';


    public function getTemplate(): string
    {
        return match ($this) {
            self::CEO => "templates.teams.ceo",
            self::MANAGEMENT => "templates.teams.management",
        };
    }
}
