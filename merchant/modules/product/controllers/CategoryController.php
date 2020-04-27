<?php


namespace addons\YunStore\merchant\modules\product\controllers;


use addons\YunStore\merchant\controllers\BaseController;

class CategoryController extends BaseController
{
    public function actionIndex()
    {
        return $this->render( $this->action->id );
    }
}