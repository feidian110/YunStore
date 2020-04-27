<?php


namespace addons\YunStore\common\services\product;



use addons\YunStore\common\models\product\SpecValue;
use common\components\Service;

class SpecValueService extends Service
{

    /**
     * @param $product_id
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getListByProductId($product_id)
    {
        return SpecValue::find()
            ->where(['product_id' => $product_id])
            ->andFilterWhere(['merchant_id' => $this->getMerchantId()])
            ->asArray()
            ->all();
    }

    /**
     * 判断属性是否被使用
     *
     * @param $id
     * @return array|null|\yii\db\ActiveRecord
     */
    public function has($id)
    {
        return SpecValue::find()
            ->select('id')
            ->where(['base_spec_value_id' => $id])
            ->andFilterWhere(['merchant_id' => $this->getMerchantId()])
            ->asArray()
            ->one();
    }

}