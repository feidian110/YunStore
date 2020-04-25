<?php


namespace addons\YunStore\merchant\modules\pick\controllers;


use addons\YunStore\merchant\controllers\BaseController;

class PersonnelController extends BaseController
{

    public function actionIndex()
    {
        return $this->render( $this->Action->id );
    }
}