<?php


namespace App\Enums;

use Illuminate\Validation\Rules\Enum;

final class STATUS_STATE extends Enum
{
    const ACTIVE = 1;
    const DEACTIVATED = 0;
}

