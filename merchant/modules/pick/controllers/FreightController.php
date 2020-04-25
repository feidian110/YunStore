<?php


namespace addons\YunStore\merchant\modules\pick\controllers;


use addons\YunStore\merchant\controllers\BaseController;

class FreightController extends BaseController
{

    public function actionIndex()
    {
        return $this->render( $this->action->id );
    }

}