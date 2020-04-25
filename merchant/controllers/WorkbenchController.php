<?php


namespace addons\YunStore\merchant\controllers;


class WorkbenchController extends BaseController
{
    public function actionIndex()
    {
        return $this->render( $this->action->id );
    }
}