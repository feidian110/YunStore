<?php


namespace addons\YunStore\common\services\base;


use addons\YunStore\common\models\base\AttributeValue;
use common\components\Service;
use common\enums\StatusEnum;

class AttributeValueService extends Service
{

    /**
     * 根据id获取数据列表
     *
     * @param $ids
     * @return array|\yii\db\ActiveRecord[]
     */
    public function findByIds(array $ids)
    {
        return AttributeValue::find()
            ->where(['status' => StatusEnum::ENABLED])
            ->andFilterWhere(['merchant_id' => $this->getMerchantId()])
            ->where(['in', 'id', $ids])
            ->select(['id', 'title'])
            ->orderBy('sort asc, id desc')
            ->asArray()
            ->all();
    }
}