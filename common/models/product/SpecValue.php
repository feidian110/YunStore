<?php

namespace addons\YunStore\common\models\product;

use Yii;

/**
 * This is the model class for table "yun_net_addon_yun_store_product_spec_value".
 *
 * @property int $id
 * @property int $merchant_id 商户id
 * @property string $store_id 所属门店
 * @property int $product_id 商品编码
 * @property int $base_spec_id 系统规格id
 * @property int $base_spec_value_id 系统规格值id
 * @property string $title 属性标题
 * @property string $data 属性值例如颜色
 * @property int $sort 排序
 * @property int $status 状态(-1:已删除,0:禁用,1:正常)
 * @property int $created_at 创建时间
 * @property int $updated_at 修改时间
 */
class SpecValue extends \common\models\base\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_yun_store_product_spec_value}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['merchant_id', 'store_id', 'product_id', 'base_spec_id', 'base_spec_value_id', 'sort', 'status', 'created_at', 'updated_at'], 'integer'],
            [['product_id'], 'required'],
            [['title', 'data'], 'string', 'max' => 125],
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
            'store_id' => 'Store ID',
            'product_id' => 'Product ID',
            'base_spec_id' => 'Base Spec ID',
            'base_spec_value_id' => 'Base Spec Value ID',
            'title' => 'Title',
            'data' => 'Data',
            'sort' => 'Sort',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
