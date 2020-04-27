<?php
namespace addons\YunStore\common\services\store;

use addons\YunStore\common\models\Store;
use common\components\Service;
use common\enums\StatusEnum;
use common\helpers\ArrayHelper;

class StoreService extends Service
{
    public function getDropDown()
    {
        $list = $this->getAllData();
        return ArrayHelper::map($list,'id','title');
    }

    public function getAllData()
    {
        $store = Store::find()->select('id,title')
            ->where(['merchant_id'=>$this->getMerchantId()])
            ->andWhere(['=','status',StatusEnum::ENABLED])
            ->orderBy(['is_main'=>SORT_DESC,'id'=>SORT_ASC])->with('shop')
            ->asArray()->all();
        return $store;
    }
}