<?php


namespace addons\YunStore\common\services\store;


use addons\YunStore\common\enums\StateEnum;
use addons\YunStore\common\models\Pick;
use common\components\Service;
use common\helpers\ArrayHelper;

class PickService extends Service
{
    public function getPickByStoreId($store_id)
    {
        $pick = Pick::findAll(['store_id'=>$store_id,'status'=>StateEnum::ENABLED]);
        if( $pick == null ){
            return [];
        }
        return ArrayHelper::map($pick,'id','title');
    }

    public function getPickByMerchantId()
    {
        $pick = Pick::findAll(['merchant_id'=>$this->getMerchantId(),'status'=>StateEnum::ENABLED]);
        if( $pick == null ){
            return [];
        }
        return ArrayHelper::map($pick,'id','title');
    }
}