<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TimeSheetType extends Enum
{
    const X = 0;
    const X2 = 1;
    const P = 2;
    const KP = 3;
    const PL = 4;
    const LL = 5;
}

