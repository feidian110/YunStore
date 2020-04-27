<?php

namespace addons\YunStore\common\models\product;

use Yii;

/**
 * This is the model class for table "yun_net_addon_yun_store_product_attribute_option".
 *
 * @property int $id
 * @property int $sku_id sku编码
 * @property int $product_id 商品编码
 * @property int $system_attribute_id 属性编码
 * @property int $system_option_id 属性选项编码
 * @property string $title 属性标题
 * @property string $value 属性值例如颜色
 * @property int $sort 排序
 */
class AttributeOption extends \common\models\base\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_yun_store_product_attribute_option}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sku_id', 'product_id', 'system_attribute_id', 'system_option_id', 'sort'], 'integer'],
            [['product_id', 'system_attribute_id'], 'required'],
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
            'sku_id' => 'Sku ID',
            'product_id' => 'Product ID',
            'system_attribute_id' => 'System Attribute ID',
            'system_option_id' => 'System Option ID',
            'title' => 'Title',
            'value' => 'Value',
            'sort' => 'Sort',
        ];
    }
}
