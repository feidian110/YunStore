<?php

namespace addons\YunStore\common\models\product;

use common\behaviors\MerchantBehavior;
use common\traits\Tree;
use Yii;

/**
 * This is the model class for table "yun_net_addon_yun_store_product_cate".
 *
 * @property int $id 主键
 * @property int $merchant_id 商户id
 * @property string $store_id 所属门店
 * @property string $title 标题
 * @property string $sub_title 分类副标题
 * @property int $is_sub_cate 是否附属分类[0:否1:是]
 * @property string $cover 封面图
 * @property int $sort 排序
 * @property int $level 级别
 * @property int $pid 上级id
 * @property string $tree 树
 * @property int $index_block_status 首页块级状态 1=>显示
 * @property string $week_display 周几显示
 * @property double $product_discount 分类下产品折扣
 * @property int $status 状态[-1:删除;0:禁用;1启用]
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 */
class ProductCate extends \common\models\base\BaseModel
{
    use Tree, MerchantBehavior;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_yun_store_product_cate}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['merchant_id', 'store_id', 'is_sub_cate', 'sort', 'level', 'pid', 'index_block_status', 'status', 'created_at', 'updated_at'], 'integer'],
            [['tree'], 'string'],
            [['product_discount'], 'number'],
            [['title'], 'string', 'max' => 50],
            [['sub_title'], 'string', 'max' => 60],
            [['cover'], 'string', 'max' => 255],
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
            'store_id' => '所属门店',
            'title' => '分类标题',
            'sub_title' => '分类副标题',
            'is_sub_cate' => '是否附属分类商品',
            'cover' => '封面',
            'sort' => '排序',
            'level' => 'Level',
            'pid' => '父级',
            'tree' => 'Tree',
            'index_block_status' => '首页显示',
            'week_display' => '周几显示',
            'product_discount' => '分类下产品折扣率',
            'status' => '状态',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getProduct()
    {
        return $this->hasMany( Product::class,['cate_id' => 'id'] );
    }
}
