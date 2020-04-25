<?php

use common\helpers\ImageHelper;
use common\enums\WhetherEnum;
use yii\widgets\DetailView;

$this->title = "基本信息";
?>

<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title"><?= $this->title;?></h4>
    </div>
    <div class="modal-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [


                [
                    'attribute' => 'title',
                    'value' => function( $model ){
                        return $model->merchant['title'].'【'.$model->title.'】';
                    }
                ],
                [
                    'attribute' => 'is_main',
                    'value' => function( $model ){
                        return WhetherEnum::getValue($model->is_main);
                    }
                ],
                [
                    'attribute' => 'store_logo',
                    'format' => 'raw',
                    'value' => function( $model ){
                        return '<img src='.ImageHelper::default($model['store_logo']).' width="200px">';
                    }
                ],
                'phone',
                'wechat',
                'qq',
                [
                    'attribute' => 'address',
                    'value' => function( $model ){
                        return $model['province']['title'].'-'.$model['city']['title'].'-'.$model['area']['title'].'-'.$model['address'];
                    }
                ],
                'per_money',
                'feature',

            ],
        ]) ?>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
    </div>
</div>
