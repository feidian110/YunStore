<?php

namespace addons\YunStore\common\models\product;

use Yii;

/**
 * This is the model class for table "yun_net_addon_yun_store_product_ladder_preferential".
 *
 * @property int $id 主键
 * @property int $product_id 商品关联id
 * @property int $type 优惠类型
 * @property int $quantity 数量
 * @property string $price 优惠价格
 */
class LadderPreferential extends \common\models\base\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_yun_store_product_ladder_preferential}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'type', 'quantity'], 'integer'],
            [['price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'type' => 'Type',
            'quantity' => 'Quantity',
            'price' => 'Price',
        ];
    }
}
