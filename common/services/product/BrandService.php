<?php


namespace addons\YunStore\common\services\product;


use addons\YunStore\common\models\product\Brand;
use common\components\Service;
use common\enums\StatusEnum;
use common\helpers\ArrayHelper;

class BrandService extends Service
{
    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function findByTitle($title)
    {
        return Brand::find()
            ->where(['title' => $title])
            ->andFilterWhere(['merchant_id' => $this->getMerchantId()])
            ->asArray()
            ->one();
    }

    /**
     * @return array
     */
    public function getMapList()
    {
        return ArrayHelper::map($this->getList(), 'id', 'title');
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getList()
    {
        return Brand::find()
            ->where(['status' => StatusEnum::ENABLED])
            ->andFilterWhere(['merchant_id' => $this->getMerchantId()])
            ->orderBy('sort asc, id desc')
            ->asArray()
            ->all();
    }

}