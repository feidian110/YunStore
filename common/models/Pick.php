<?php

namespace addons\YunStore\common\models;

use common\behaviors\MerchantBehavior;
use common\models\merchant\Merchant;
use Yii;

/**
 * This is the model class for table "yun_net_addon_yun_shop_pick".
 *
 * @property string $id 主键
 * @property string $title 自提点名称
 * @property string $merchant_id 所属商户
 * @property string $store_id 所属门店
 * @property string $address 详细地址
 * @property string $api_address 自提点经纬度
 * @property string $contact 联系人
 * @property string $contact_mobile 联系人电话
 * @property int $sort 排序
 * @property int $status 状态[-1:删除,0:停用,1:正常]
 * @property int $created_at 创建时间
 * @property int $updated_at 最后更新时间
 */
class Pick extends \common\models\base\BaseModel
{
    use MerchantBehavior;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_yun_store_pick}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'store_id', 'address', 'contact', 'province_id', 'city_id', 'area_id', 'contact_mobile'], 'required'],
            [['merchant_id', 'store_id', 'sort', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['address'], 'string', 'max' => 200],
            [['contact'], 'string', 'max' => 30],
            [['contact_mobile'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'title' => '名称',
            'merchant_id' => 'Merchant ID',
            'store_id' => '所属门店',
            'address' => '详细地址',
            'api_address' => '经纬度地址',
            'contact' => '联系人',
            'contact_mobile' => '联系人电话',
            'province_id' => '省份',
            'city_id' => '城市',
            'area_id' => '区域',
            'sort' => 'Sort',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getMerchant()
    {
        return $this->hasOne( Merchant::class,['id'=>'merchant_id'] );
    }

    public function getStore()
    {
        return $this->hasOne( Store::class,['id'=>'store_id'] );
    }
}
