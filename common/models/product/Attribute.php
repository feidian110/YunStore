<?php

namespace addons\YunStore\common\models\product;

use Yii;

/**
 * This is the model class for table "yun_net_addon_yun_store_product_attribute".
 *
 * @property int $id
 * @property int $merchant_id 商户id
 * @property int $product_id 商品编码
 * @property int $system_attribute_id 属性编码
 * @property string $name 规格名称
 * @property int $sort 排序
 * @property int $show_type 展示方式 1 文字 2 颜色 3 图片
 * @property int $is_visible 是否可视
 */
class Attribute extends \common\models\base\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_yun_store_product_attribute}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['merchant_id', 'product_id', 'system_attribute_id', 'sort', 'show_type', 'is_visible'], 'integer'],
            [['product_id'], 'required'],
            [['name'], 'string', 'max' => 125],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'merchant_id' => 'Merchant ID',
            'product_id' => 'Product ID',
            'system_attribute_id' => 'System Attribute ID',
            'name' => 'Name',
            'sort' => 'Sort',
            'show_type' => 'Show Type',
            'is_visible' => 'Is Visible',
        ];
    }
}
