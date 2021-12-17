<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class UserLevel extends Enum
{
    const Admin = 0;
    const Employee = 1;
    const Intern = 2;
}
