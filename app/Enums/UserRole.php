<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class UserRole extends Enum implements LocalizedEnum
{
    const USER = 1;
    const ADMIN = 0;
    const INACTIVE = 2;

    public static function getDescription($value): string
    {
        return parent::getDescription($value);
    }
}
