<?php

namespace addons\YunStore\common\models;

use common\behaviors\MerchantBehavior;
use Yii;

/**
 * This is the model class for table "yun_net_addon_yun_store_store_business_hours".
 *
 * @property string $id 主键
 * @property string $merchant_id 所属商家
 * @property string $store_id 所属门店
 * @property int $open_week 开启周营业时间
 * @property string $open_time_one 时段1开始时间
 * @property string $close_time_one 时段1结束时间
 * @property string $open_time_two 时段2开始时间
 * @property string $close_time_two 时段2结束时间
 * @property string $open_time_three 时段3开始时间
 * @property string $close_time_three 时段3结束时间
 * @property string $mon 周一营业时间
 * @property string $tue 周二营业时间
 * @property string $wed 周三营业时间
 * @property string $thu 周四营业时间
 * @property string $fri 周五营业时间
 * @property string $sat 周六营业时间
 * @property string $sun 周日营业时间
 * @property int $created_at 创建时间
 * @property int $updated_at 最后更新时间
 */
class BusinessHours extends \common\models\base\BaseModel
{
    use MerchantBehavior;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_yun_store_store_business_hours}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['merchant_id', 'store_id', 'open_week', 'created_at', 'updated_at'], 'integer'],
            [['open_time_one', 'close_time_one', 'open_time_two', 'close_time_two', 'open_time_three', 'close_time_three'], 'required'],
            [['open_time_one', 'close_time_one', 'open_time_two', 'close_time_two', 'open_time_three', 'close_time_three'], 'safe'],
            [['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'], 'string'],
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
            'open_week' => '周营业时间',
            'open_time_one' => '时段1',
            'close_time_one' => '至',
            'open_time_two' => '时段2',
            'close_time_two' => '至',
            'open_time_three' => '时段3',
            'close_time_three' => '至',
            'mon' => 'Mon',
            'tue' => 'Tue',
            'wed' => 'Wed',
            'thu' => 'Thu',
            'fri' => 'Fri',
            'sat' => 'Sat',
            'sun' => 'Sun',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
