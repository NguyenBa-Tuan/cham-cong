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
    const Dev = 0;
    const Tester = 1;
    const Comtor = 2;
}
