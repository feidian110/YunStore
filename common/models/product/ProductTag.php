<?php

namespace addons\YunStore\common\models\product;

use Yii;

/**
 * This is the model class for table "yun_net_addon_yun_store_product_tag".
 *
 * @property int $id
 * @property int $merchant_id 商户id
 * @property string $store_id 所属门店
 * @property string $title 标签名称
 * @property int $sort 排列
 * @property int $status 状态
 * @property int $created_at 创建时间
 * @property int $updated_at 修改时间
 */
class ProductTag extends \common\models\base\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_yun_store_product_tag}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['merchant_id', 'store_id', 'sort', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 50],
            [['title'], 'unique'],
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
            'title' => 'Title',
            'sort' => 'Sort',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
