<?php

namespace addons\YunStore\common\models\product;

use common\behaviors\MerchantBehavior;
use Yii;

/**
 * This is the model class for table "yun_net_addon_yun_store_product_sku".
 *
 * @property int $id
 * @property int $merchant_id 商户id
 * @property int $product_id 商品编码
 * @property string $name sku名称
 * @property string $picture 主图
 * @property string $price 价格
 * @property string $market_price 市场价格
 * @property string $cost_price 成本价
 * @property string $wholesale_price 拼团价格
 * @property int $stock 库存
 * @property string $code 商品编码
 * @property string $barcode 商品条形码
 * @property string $product_weight 商品重量
 * @property string $product_volume 商品体积
 * @property int $sort 排序
 * @property string $data sku串
 * @property int $status 状态[-1:删除;0:禁用;1启用]
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 */
class Sku extends \common\models\base\BaseModel
{
    use MerchantBehavior;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_yun_store_product_sku}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['merchant_id', 'product_id', 'stock', 'sort', 'status', 'created_at', 'updated_at'], 'integer'],
            [['price', 'market_price', 'cost_price', 'wholesale_price', 'product_weight', 'product_volume'], 'number'],
            [['name'], 'string', 'max' => 600],
            [['picture'], 'string', 'max' => 200],
            [['code', 'barcode'], 'string', 'max' => 100],
            [['data'], 'string', 'max' => 300],
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
            'name' => 'Name',
            'picture' => 'Picture',
            'price' => 'Price',
            'market_price' => 'Market Price',
            'cost_price' => 'Cost Price',
            'wholesale_price' => 'Wholesale Price',
            'stock' => 'Stock',
            'code' => 'Code',
            'barcode' => 'Barcode',
            'product_weight' => 'Product Weight',
            'product_volume' => 'Product Volume',
            'sort' => 'Sort',
            'data' => 'Data',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
