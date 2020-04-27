<?php

namespace addons\YunStore\common\models\base;

use common\behaviors\MerchantBehavior;
use Yii;

/**
 * This is the model class for table "yun_net_addon_yun_store_base_attribute_value".
 *
 * @property int $id 属性值ID
 * @property int $merchant_id 商户id
 * @property int $attribute_id 属性ID
 * @property string $title 属性值名称
 * @property string $value 属性对应相关数据
 * @property int $type 属性对应输入类型1.直接2.单选3.多选
 * @property int $sort 排序号
 * @property int $status 状态(-1:已删除,0:禁用,1:正常)
 * @property int $created_at 创建时间
 * @property int $updated_at 修改时间
 */
class AttributeValue extends \common\models\base\BaseModel
{
    use MerchantBehavior;

    const TYPE_TEXT = 1;
    const TYPE_RADIO = 2;
    const TYPE_CHECK = 3;

    public static $typeExplain = [
        self::TYPE_TEXT => '输入框',
        self::TYPE_RADIO => '单选框',
        self::TYPE_CHECK => '复选框',
    ];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_yun_store_base_attribute_value}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['merchant_id', 'attribute_id', 'type', 'sort', 'status', 'created_at', 'updated_at'], 'integer'],
            [['attribute_id'], 'required'],
            [['title'], 'string', 'max' => 50],
            [['value'], 'string', 'max' => 1000],
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
            'attribute_id' => 'Attribute ID',
            'title' => 'Title',
            'value' => 'Value',
            'type' => 'Type',
            'sort' => 'Sort',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * 更新数据
     *
     * @param array $data 提交的数据
     * @param array $oldValues 规格原先的数据
     * @param int $attribute_id
     * @param int $merchant_id
     * @throws \yii\db\Exception
     */
    public static function updateData($data, $oldValues, $attribute_id, $merchant_id)
    {
        $allIds = [];
        if (isset($data['update'])) {
            foreach ($data['update']['id'] as $key => $datum) {
                if ($model = self::findOne(['id' => $datum, 'attribute_id' => $attribute_id])) {
                    $model->title = $data['update']['title'][$key];
                    $model->type = $data['update']['type'][$key];
                    $model->value = $data['update']['value'][$key];
                    $model->sort = (int)$data['update']['sort'][$key];
                    $model->save();
                    $allIds[] = $model->id;
                }
            }
        }

        // 创建的内容
        if (isset($data['create'])) {
            $rows = [];
            foreach ($data['create']['title'] as $key => $datum) {
                $sort = (int)$data['create']['sort'][$key];
                $value = $data['create']['value'][$key];
                $type = $data['create']['type'][$key];
                $rows[] = [$merchant_id, $attribute_id, $datum, $value, $type, $sort, time(), time()];
            }

            $field = ['merchant_id', 'attribute_id', 'title', 'value', 'type', 'sort', 'created_at', 'updated_at'];
            !empty($rows) && Yii::$app->db->createCommand()->batchInsert(self::tableName(), $field, $rows)->execute();
        }

        // 删除不存在的内容
        $deleteIds = [];
        foreach ($oldValues as $value) {
            !in_array($value['id'], $allIds) && $deleteIds[] = $value['id'];
        }

        !empty($deleteIds) && self::deleteAll(['in', 'id', $deleteIds]);
    }
}
