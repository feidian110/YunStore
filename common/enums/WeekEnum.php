<?php
namespace addons\YunStore\common\enums;

use common\enums\BaseEnum;

class WeekEnum extends BaseEnum
{
    const MON = '1';
    const TUE = '2';
    const WED = '3';
    const THU = '4';
    const FRI = '5';
    const SAT = '6';
    const SUN = '7';


    /**
     * @return array
     */
    public static function getMap(): array
    {
        return [
            self::MON => '星期一',
            self::TUE => '星期二',
            self::WED => '星期三',
            self::THU => '星期四',
            self::FRI => '星期五',
            self::SAT => '星期六',
            self::SUN => '星期日',

        ];
    }
}