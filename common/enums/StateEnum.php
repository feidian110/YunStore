<?php
    namespace addons\YunStore\common\enums;
use common\enums\BaseEnum;



class StateEnum extends BaseEnum
{
    const ENABLED = 1;
    const DISABLED = 0;

    /**
     * @return array
     */
    public static function getMap(): array
    {
        return [
            self::ENABLED => '开启',
            self::DISABLED => '关闭',
        ];
    }
}