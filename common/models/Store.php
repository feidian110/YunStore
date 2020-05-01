<?php

namespace addons\YunStore\common\models;

use addons\YunShop\common\models\Shop;
use common\behaviors\MerchantBehavior;
use common\models\common\Provinces;
use common\models\merchant\Merchant;
use Yii;

/**
 * This is the model class for table "yun_net_addon_yun_store_store".
 *
 * @property string $id 主键
 * @property string $title 门店名称
 * @property int $is_main 是否主门店，[0:否1:是]
 * @property string $store_logo 门店Logo
 * @property string $phone 门店电话
 * @property string $service_phone 客户电话
 * @property string $wechat 联系微信
 * @property string $qq 联系QQ
 * @property string $address 详细地址
 * @property string $api_address 定位经纬度地址
 * @property int $per_money 人均消费
 * @property string $feature 门店特色
 * @property string $merchant_id 所属商户
 * @property int $category_id 分类ID
 * @property string $category_path 分类路径
 * @property int $province_id 所属省份
 * @property int $city_id 所属城市
 * @property int $area_id 所属区域
 * @property string $images 门店图片
 * @property string $detail 门店详情
 * @property string $remark 门店描述
 * @property int $status 门店状态[-1:删除0:待审1:正常2:驳回]
 * @property int $sort 排序
 * @property int $created_at 创建时间
 * @property int $updated_at 最后更新时间
 */
class Store extends \common\models\base\BaseModel
{
    use MerchantBehavior;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_yun_store_store}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'store_logo', 'phone','province_id', 'city_id', 'area_id', 'address','api_address','detail', 'remark'], 'required'],
            [['is_main', 'per_money', 'merchant_id', 'category_id', 'province_id', 'city_id', 'area_id', 'status', 'sort', 'created_at', 'updated_at'], 'integer'],
            [['detail', 'remark'], 'string'],
            [['title', 'feature'], 'string', 'max' => 100],
            [['store_logo', 'address', 'category_path'], 'string', 'max' => 200],
            [['phone'], 'string', 'max' => 60],
            [['service_phone', 'qq'], 'string', 'max' => 20],
            [['wechat'], 'string', 'max' => 64],
            [['images'], 'string', 'max' => 1000],
        ];
    }

    public function getMerchant()
    {
        return $this->hasOne( Merchant::class,['id'=>'merchant_id'] );
    }

    public function getProvince()
    {
        return $this->hasOne( Provinces::class,['id' => 'province_id'] );
    }

    public function getCity()
    {
        return $this->hasOne( Provinces::class,['id' => 'city_id'] );
    }

    public function getArea()
    {
        return $this->hasOne( Provinces::class,['id' => 'area_id'] );
    }

    public function getShop()
    {
        return $this->hasOne( Shop::class,['store_id'=>'id'] );
    }

    public function getPick()
    {
        return $this->hasMany( Pick::class,['store_id'=>'id'] );
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'title' => '门店名称',
            'is_main' => '主门店',
            'store_logo' => '门店Logo',
            'phone' => '联系电话',
            'service_phone' => '服务电话',
            'wechat' => '联系微信',
            'qq' => '联系QQ',
            'address' => '详细地址',
            'api_address' => '门店经纬度',
            'per_money' => '人均消费',
            'feature' => '门店特色',
            'merchant_id' => '所属商户',
            'category_id' => '门店分类',
            'category_path' => 'Category Path',
            'province_id' => '省',
            'city_id' => '市',
            'area_id' => '区',
            'images' => '门店图片',
            'detail' => '门店详情',
            'remark' => '门店描述',
            'status' => '状态',
            'sort' => '排序',
            'created_at' => '创建时间',
            'updated_at' => '最后更新时间',
        ];
    }
}
