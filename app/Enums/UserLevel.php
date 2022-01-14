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
    /*phan chuc vu cua nhan vien trong cong ty*/
    const Director = 0;
    const Dev = 1;
    const Tester = 2;
    const Comtor = 3;
}
