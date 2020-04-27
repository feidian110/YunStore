<?php
namespace addons\YunStore\common\services\product;

use addons\YunStore\common\enums\DecimalReservationEnum;
use addons\YunStore\common\models\product\MemberDiscount;
use common\components\Service;
use common\helpers\ArrayHelper;
use Yii;

class MemberDiscountService extends Service
{
    public function getLevelListByProductId($product_id)
    {
        $allLevel = Yii::$app->services->memberLevel->findAllByEdit();
        $memberDiscount = $this->findByProductId($product_id);
        $memberDiscount = ArrayHelper::arrayKey($memberDiscount, 'member_level');

        $data = [];
        foreach ($allLevel as $value) {
            $data[] = [
                'name' => $value['name'],
                'member_level' => $value['level'],
                'product_id' => $product_id,
                'decimal_reservation_number' => $memberDiscount[$value['level']]['decimal_reservation_number'] ?? DecimalReservationEnum::DEFAULT,
                'discount' => $memberDiscount[$value['level']]['discount'] ?? 0,
            ];
        }

        return $data;
    }

    public function findByProductId($product_id)
    {
        return MemberDiscount::find()
            ->where(['product_id' => $product_id])
            ->with('memberLevel')
            ->all();
    }
}