<?php

namespace addons\YunStore\common\models\product;

use common\behaviors\MerchantBehavior;
use Yii;

/**
 * This is the model class for table "yun_net_addon_yun_store_product_spec".
 *
 * @property int $id
 * @property int $merchant_id 商户id
 * @property string $store_id 所属门店
 * @property int $product_id 商品编码
 * @property int $base_spec_id 系统规格id
 * @property string $title 规格名称
 * @property string $remark 说明
 * @property int $sort 排序
 * @property int $show_type 展示方式 1 文字 2 颜色 3 图片
 * @property int $status 状态(-1:已删除,0:禁用,1:正常)
 * @property int $created_at 创建时间
 * @property int $updated_at 修改时间
 */
class Spec extends \common\models\base\BaseModel
{

    use MerchantBehavior;

    const SHOW_TYPE_TEXT = 1;
    const SHOW_TYPE_COLOR = 2;
    const SHOW_TYPE_IMAGE = 3;

    /**
     * @var array
     */
    public static $showTypeExplain = [
        self::SHOW_TYPE_TEXT => '文字',
        self::SHOW_TYPE_COLOR => '颜色',
        self::SHOW_TYPE_IMAGE => '图片',
    ];

    public $valueData;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_yun_store_product_spec}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['merchant_id', 'store_id', 'product_id', 'base_spec_id', 'sort', 'show_type', 'status', 'created_at', 'updated_at'], 'integer'],
            [['product_id'], 'required'],
            [['title'], 'string', 'max' => 125],
            [['remark'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'merchant_id' => '所属商户',
            'store_id' => '所属门店',
            'product_id' => 'Product ID',
            'base_spec_id' => 'Base Spec ID',
            'title' => '规格名称',
            'remark' => '规格说明',
            'sort' => '排序',
            'show_type' => '显示类型',
            'status' => '状态',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * 关联规格值
     *
     * @return \yii\db\ActiveQuery
     */
    public function getValue()
    {
        return $this->hasMany(SpecValue::class, ['spec_id' => 'id'])->orderBy('sort asc');
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     * @throws \yii\db\Exception
     */
    public function afterSave($insert, $changedAttributes)
    {
        SpecValue::updateData($this->valueData, $this->value, $this->id, $this->merchant_id);
        parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete()
    {
        SpecValue::deleteAll(['merchant_id' => $this->merchant_id, 'spec_id' => $this->id]);
        parent::afterDelete();
    }
}
