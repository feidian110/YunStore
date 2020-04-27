<?php


namespace addons\YunStore\common\services\product;


use addons\YunStore\common\models\base\Spec;
use addons\YunStore\common\models\product\Product;
use common\components\Service;
use common\enums\WhetherEnum;
use common\helpers\ArrayHelper;
use common\helpers\StringHelper;
use Yii;

class ProductService extends Service
{
    /**
     * 获取属性值、规格属性、规格值
     *
     * @param Product $model
     * @return array
     */
    public function getSpecValueAttribute(Product $model)
    {
        $attributeValue = $specValue = $jsData = [];
        if (!$model->id || $model->is_attribute != WhetherEnum::ENABLED) {
            return [$attributeValue, $specValue, $jsData];
        }

        // 获取基础属性
        $baseAttribute = Yii::$app->yunStoreService->baseAttribute->getDataById($model->base_attribute_id);

        // 获取产品属性值
        $attributeValue = $this->getAttributeValue($model, $baseAttribute);
        // 获取规格(规格值)和js选中规格
        list($specValue, $jsData) = $this->getSpecValue($model, $baseAttribute['spec_ids']);

        unset($baseAttribute, $model);

        return [$attributeValue, $specValue, $jsData];
    }

    /**
     * 获取产品规格
     *
     * @param $model
     * @param $spec_ids
     * @return array
     */
    protected function getSpecValue($model, $spec_ids)
    {
        $tmpSpecValue = [];
        $jsData = [];
        $spec_ids = explode(',', $spec_ids);
        $baseSpecValue = Yii::$app->yunStoreService->baseSpec->getListWithValueByIds($spec_ids);
        /* @var $model Product 获取已选择的规格属性 */
        if (!empty($specValue = $model->getSpecWithSpecValue($model->id)->all())) {
            foreach ($specValue as &$item) {
                $item['id'] = $item['base_spec_id'];
                foreach ($item['value'] as &$value) {
                    $value['id'] = $value['base_spec_value_id'];
                    $jsData[] = [
                        'id' => $value['base_spec_value_id'],
                        'title' => $value['title'],
                        'pid' => $item['base_spec_id'],
                        'ptitle' => $item['title'],
                        'sort' => $value['sort'],
                        'data' => $value['data'],
                    ];

                    // 加入临时规格值数据方便调用
                    $tmpSpecValue[$value['id']] = $value;
                }
            }

            // 判断模型是否被删除如果被删除则直接替换
            empty($baseSpecValue) && $baseSpecValue = $specValue;
        }

        // 重新赋值已有数据并判断颜色是否正常
        foreach ($baseSpecValue as &$item) {
            foreach ($item['value'] as &$value) {
                $value['data'] = $tmpSpecValue[$value['id']]['data'] ?? '';

                if (substr($value['data'], 0, 1) == "#") {
                    $value['data'] = StringHelper::clipping($value['data'], '#', 1);
                } else {
                    $item['show_type'] == Spec::SHOW_TYPE_COLOR && $value['data'] = '';
                }
            }
        }

        unset($tmpSpecValue, $model);

        return [$baseSpecValue, $jsData];
    }

    /**
     * 返回产品编辑的属性
     *
     * @param $model
     * @return array
     */
    protected function getAttributeValue($model, $baseAttribute)
    {
        $attributeValue = [];
        if (empty($baseAttribute['value'])) {
            return $attributeValue;
        }

        // 获取商品类型自带属性
        foreach ($baseAttribute['value'] as $value) {
            // 调整属性显示
            $baseValue = !empty($value['value']) ? explode(',', $value['value']) : [];
            $config = [];
            foreach ($baseValue as $item) {
                $config[$item] = $item;
            }

            $attributeValue[$value['id']] = [
                'id' => $value['id'],
                'title' => $value['title'],
                'type' => $value['type'],
                'value' => '',
                'sort' => $value['sort'],
                'config' => $config,
            ];
        }

        // 获取已有的属性数据
        if (!empty($attributeValueModel = $model->attributeValue)) {
            foreach ($attributeValueModel as $item) {
                if (isset($attributeValue[$item['base_attribute_value_id']])) {
                    $attributeValue[$item['base_attribute_value_id']]['value'] = $item['value'];
                }
            }
        }

        unset($model, $baseAttribute);

        return ArrayHelper::arraySort($attributeValue, 'sort');
    }
}