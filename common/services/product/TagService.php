<?php


namespace addons\YunStore\common\services\product;


use addons\YunStore\common\models\product\Tag;
use common\components\Service;
use common\enums\StatusEnum;
use common\helpers\ArrayHelper;

class TagService extends Service
{
    /**
     * @param $arr
     * @return array
     */
    public function getMapByList($arr)
    {
        $tag = [];
        foreach ($arr as $item) {
            $tag[$item] = $item;
        }

        return ArrayHelper::merge($tag, $this->getMap());
    }

    public function getMap()
    {
        return ArrayHelper::map($this->findAll(), 'title', 'title');
    }

    public function findAll()
    {
        return Tag::find()
            ->where(['status' => StatusEnum::ENABLED])
            ->andFilterWhere(['merchant_id' => $this->getMerchantId()])
            ->orderBy('sort asc, id desc')
            ->asArray()
            ->all();
    }
}