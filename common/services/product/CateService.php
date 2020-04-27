<?php
namespace addons\YunStore\common\services\product;


use addons\YunStore\common\models\product\ProductCate;
use common\components\Service;
use common\enums\StatusEnum;
use common\helpers\ArrayHelper;

class CateService extends Service
{
    public function getMapList()
    {
        $models = ArrayHelper::itemsMerge($this->getList());

        return ArrayHelper::map(ArrayHelper::itemsMergeDropDown($models), 'id', 'title');
    }

    /**
     * @param string $pid
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getList()
    {
        return ProductCate::find()
            ->where(['status' => StatusEnum::ENABLED])
            ->andFilterWhere(['merchant_id' => $this->getMerchantId()])
            ->orderBy('sort asc, id desc')
            ->asArray()
            ->all();
    }

    public function getDropDownForEdit($id = '')
    {
        $list = ProductCate::find()
            ->where(['>=', 'status', StatusEnum::DISABLED])
            ->andFilterWhere(['<>', 'id', $id])
            ->andFilterWhere(['merchant_id' => $this->getMerchantId()])
            ->select(['id', 'title', 'pid', 'level'])
            ->orderBy('sort asc')
            ->asArray()
            ->all();

        $models = ArrayHelper::itemsMerge($list);
        $data = ArrayHelper::map(ArrayHelper::itemsMergeDropDown($models), 'id', 'title');

        return ArrayHelper::merge([0 => '顶级分类'], $data);
    }
}