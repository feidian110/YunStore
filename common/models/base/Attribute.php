<?php

namespace addons\YunStore\common\models\base;

use common\behaviors\MerchantBehavior;
use Yii;

/**
 * This is the model class for table "yun_net_addon_yun_store_base_attribute".
 *
 * @property int $id 商品属性ID
 * @property int $merchant_id 商户id
 * @property string $title 模型名称
 * @property int $sort 排序
 * @property string $spec_ids 关联规格ids
 * @property int $status 状态(-1:已删除,0:禁用,1:正常)
 * @property int $created_at 创建时间
 * @property int $updated_at 修改时间
 */
class Attribute extends \common\models\base\BaseModel
{
    use MerchantBehavior;

    public $valueData;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_yun_store_base_attribute}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['merchant_id', 'sort', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 50],
            [['spec_ids'], 'string', 'max' => 200],
            ['valueData', 'safe'],
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
            'title' => '标题',
            'sort' => '排序',
            'spec_ids' => 'Spec Ids',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * 关联属性值
     *
     * @return \yii\db\ActiveQuery
     */
    public function getValue()
    {
        return $this->hasMany(AttributeValue::class, ['attribute_id' => 'id']);
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     * @throws \yii\db\Exception
     */
    public function afterSave($insert, $changedAttributes)
    {
        AttributeValue::updateData($this->valueData, $this->value, $this->id, $this->merchant_id);
        parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete()
    {
        AttributeValue::deleteAll(['merchant_id' => $this->merchant_id, 'attribute_id' => $this->id]);
        parent::afterDelete();
    }
}
