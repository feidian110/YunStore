<?php

namespace addons\YunStore\common\models\product;

use Yii;

/**
 * This is the model class for table "yun_net_addon_yun_store_product_attribute_value".
 *
 * @property int $id
 * @property int $merchant_id 商户id
 * @property int $product_id 商品编码
 * @property int $base_attribute_value_id 属性编码
 * @property string $title 参数名称
 * @property string $value 参数值
 * @property int $sort 排序
 * @property int $status 状态(-1:已删除,0:禁用,1:正常)
 * @property int $created_at 创建时间
 * @property int $updated_at 修改时间
 */
class AttributeValue extends \common\models\base\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_yun_store_product_attribute_value}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['merchant_id', 'product_id', 'base_attribute_value_id', 'sort', 'status', 'created_at', 'updated_at'], 'integer'],
            [['product_id'], 'required'],
            [['title', 'value'], 'string', 'max' => 125],
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
            'base_attribute_value_id' => 'Base Attribute Value ID',
            'title' => 'Title',
            'value' => 'Value',
            'sort' => 'Sort',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
