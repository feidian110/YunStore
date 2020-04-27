<?php


namespace addons\YunStore\common\services\base;


use addons\YunStore\common\models\base\SpecValue;
use common\components\Service;

class SpecValueService extends Service
{
    /**
     * @param array $ids
     * @return array|\yii\db\ActiveRecord[]
     */
    public function findByIds(array $ids)
    {
        return SpecValue::find()
            ->andWhere(['in', 'id', $ids])
            ->andFilterWhere(['merchant_id' => $this->getMerchantId()])
            ->asArray()
            ->all();
    }
}