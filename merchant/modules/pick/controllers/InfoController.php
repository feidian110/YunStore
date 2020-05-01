<?php
namespace addons\YunStore\merchant\modules\pick\controllers;

use addons\YunStore\common\models\Pick;
use addons\YunStore\merchant\controllers\BaseController;
use common\enums\StatusEnum;
use common\models\base\SearchModel;
use common\traits\MerchantCurd;
use Yii;

class InfoController extends BaseController
{

    use MerchantCurd;

    public $modelClass = Pick::class;

    public function actionIndex()
    {
        $searchModel = new SearchModel([
            'model' => $this->modelClass,
            'scenario' => 'default',
            'partialMatchAttributes' => ['id', 'mobile'], // 模糊查询
            'defaultOrder' => [
                'id' => SORT_DESC
            ],
            'pageSize' => $this->pageSize
        ]);

        $dataProvider = $searchModel
            ->search(Yii::$app->request->queryParams);
        $dataProvider->query
            ->andWhere(['>=', 'status', StatusEnum::DISABLED])
            ->andFilterWhere(['merchant_id' => $this->getMerchantId()]);

        return $this->render($this->action->id, [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionEdit()
    {
        $id = (int)Yii::$app->request->get('id');
        $model = $this->findModel($id);
        if( Yii::$app->request->isPost ){
            $post = Yii::$app->request->post();
            $model->api_address = implode(',',$post['Pick']['api_address']);
            if( $model->load($post) && $model->save() ){
                return $this->message('自提点添加成功！',$this->redirect(['index']),'success');
            }
            return $this->message($this->getError($model),$this->redirect(['index']),'error');
        }

        return $this->render( $this->action->id,[
            'model' =>$model,
            'store' => Yii::$app->yunStoreService->store->getDropDown()
        ] );
    }
}