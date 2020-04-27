<?php


namespace addons\YunStore\common\enums;


use common\enums\BaseEnum;

class AuditStateEnum extends BaseEnum
{
    const ENABLED = 1;
    const DISABLED = 0;
    const REJECT = 2;
    const DELETE = -1;

    /**
     * @return array
     */
    public static function getMap(): array
    {
        return [
            self::ENABLED => '已审核',
            self::DISABLED => '待审核',
            self::REJECT => '被驳回',
            self::DELETE => '已删除',
        ];
    }
}