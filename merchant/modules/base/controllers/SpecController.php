<?php


namespace addons\YunStore\merchant\modules\base\controllers;


use addons\YunStore\common\models\base\Spec;
use addons\YunStore\merchant\controllers\BaseController;
use common\enums\StatusEnum;
use common\helpers\ResultHelper;
use common\models\base\SearchModel;
use common\traits\MerchantCurd;
use Yii;

class SpecController extends BaseController
{
    use MerchantCurd;

    public $modelClass = Spec::class;

    public function actionIndex()
    {
        $searchModel = new SearchModel([
            'model' => Spec::class,
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
            'showTypeExplain' => Spec::$showTypeExplain,
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
        if ($model->load($request->post()) && $model->save()) {
            return $this->referrer();
        }

        return $this->render($this->action->id, [
            'model' => $model,
            'showTypeExplain' => Spec::$showTypeExplain,
        ]);
    }

    /**
     * @param $id
     * @return array
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDeleteValue($id)
    {
        if (Yii::$app->yunStoreService->productSpecValue->has($id)) {
            return ResultHelper::json(404, '属性已经在使用无法删除');
        }

        return ResultHelper::json(200, '删除成功');
    }

    /**
     * 删除
     *
     * @param $id
     * @return mixed
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        if (Yii::$app->yunStoreService->productSpec->has($id)) {
            return $this->message("规格已经在使用无法删除", $this->redirect(['index']), 'error');
        }

        if ($this->findModel($id)->delete()) {
            return $this->message("删除成功", $this->redirect(['index']));
        }

        return $this->message("删除失败", $this->redirect(['index']), 'error');
    }
}