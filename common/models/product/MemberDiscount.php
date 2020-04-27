<?php

namespace addons\YunStore\common\models\product;

use Yii;

/**
 * This is the model class for table "yun_net_addon_yun_store_product_member_discount".
 *
 * @property int $id 折扣id
 * @property int $member_level 会员级别
 * @property int $product_id 商品id
 * @property int $discount 折扣
 * @property int $decimal_reservation_number 价格保留方式 0 去掉角和分，1去掉分，2 保留角和分
 */
class MemberDiscount extends \common\models\base\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_yun_store_product_member_discount}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['member_level', 'product_id', 'discount', 'decimal_reservation_number'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'member_level' => 'Member Level',
            'product_id' => 'Product ID',
            'discount' => 'Discount',
            'decimal_reservation_number' => 'Decimal Reservation Number',
        ];
    }
}
