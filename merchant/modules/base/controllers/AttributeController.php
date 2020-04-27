<?php


namespace addons\YunStore\merchant\modules\base\controllers;


use addons\YunStore\common\models\base\Attribute;
use addons\YunStore\common\models\base\AttributeValue;
use addons\YunStore\merchant\controllers\BaseController;
use common\enums\StatusEnum;
use common\models\base\SearchModel;
use common\traits\MerchantCurd;
use Yii;

class AttributeController extends BaseController
{
    use MerchantCurd;

    public $modelClass = Attribute::class;

    public function actionIndex()
    {
        $searchModel = new SearchModel([
            'model' => Attribute::class,
            'scenario' => 'default',
            'partialMatchAttributes' => ['title'], // 模糊查询
            'defaultOrder' => [
                'sort' => SORT_ASC,
                'id' => SORT_DESC,
            ],
            'pageSize' => $this->pageSize,
        ]);

        $dataProvider = $searchModel
            ->search(Yii::$app->request->queryParams);
        $dataProvider->query
            ->andWhere(['status' => StatusEnum::ENABLED])
            ->andWhere(['merchant_id' => $this->getMerchantId()])
            ->with(['value']);

        return $this->render($this->action->id, [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * 编辑/创建
     *
     * @return mixed
     */
    public function actionEdit()
    {
        $request = Yii::$app->request;
        $id = $request->get('id', null);
        $model = $this->findModel($id);
        $model->spec_ids = explode(',', $model->spec_ids);
        if ($model->load($request->post())) {
            !empty($model->spec_ids) && $model->spec_ids = implode(',', $model->spec_ids);

            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render($this->action->id, [
            'model' => $model,
            'specs' => Yii::$app->yunStoreService->baseSpec->getMapList(),
            'valueType' => AttributeValue::$typeExplain,
        ]);
    }
}