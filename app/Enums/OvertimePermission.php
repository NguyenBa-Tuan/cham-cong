<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class OvertimePermission extends Enum
{
    const VIEW =   0;
    const EDIT =   1;
}
