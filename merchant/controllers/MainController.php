<?php


namespace addons\YunStore\merchant\controllers;


use addons\YunStore\common\models\BusinessHours;
use addons\YunStore\common\models\Store;
use common\enums\StatusEnum;
use common\models\base\SearchModel;
use common\traits\MerchantCurd;
use Yii;

class MainController extends BaseController
{

    use MerchantCurd;

    public $modelClass = Store::class;

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
        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);
        $hours = BusinessHours::findOne(['store_id'=>$id]);
        if( $hours == null ){
            $hours = new BusinessHours();
        }
        if( Yii::$app->request->isPost ){
            // ajax 校验
            $this->activeFormValidate($model);
            $data = Yii::$app->request->post();
            $data['Store']['api_address'] = implode(',',$data['Store']['api_address']);

            if( $model->load($data) && $model->save() ){
                if($hours->load($data) && $hours->save()){
                    $hours->store_id = $model->id;
                    return $this->message('门店创建成功！', $this->redirect(['index']), 'success');
                }
                return $this->message($this->getError($hours), $this->redirect(['index']), 'error');
            }
            return $this->message($this->getError($model), $this->redirect(['index']), 'error');
        }
        return $this->render( $this->action->id,[
            'model' => $model,
            'hours' =>$hours
        ] );
    }

    public function actionView()
    {
        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);
        return $this->renderAjax( $this->action->id,[
            'model' =>$model
        ] );
    }
}