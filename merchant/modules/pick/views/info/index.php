<?php
$this->title = "自提点管理";
$this->params['breadcrumbs'][] = ['label' => '商户管理', 'url' => 'javascript:(0);'];
$this->params['breadcrumbs'][] = ['label' => $this->title];

use common\enums\StatusEnum;
use common\enums\WhetherEnum;
use common\helpers\Html;
use yii\grid\GridView;
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $this->title; ?></h3>
                <div class="box-tools">
                    <?= Html::create(['edit'], '创建') ?>
                </div>
            </div>
            <div class="box-body table-responsive">

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    //重新定义分页样式
                    'tableOptions' => [
                        'class' => 'table table-hover rf-table',
                        'fixedNumber' => 2,
                        'fixedRightNumber' => 1,
                    ],
                    'columns' => [

                        [
                            'attribute' => 'id',
                            'headerOptions' => ['class' => 'col-md-1'],
                        ],

                        [
                            'attribute' => 'title',
                            'filter' => false, //不显示搜索框
                            'value' => function( $model ){
                                return $model->merchant['title'].'('.$model->title.')';
                            }
                        ],
                        [
                            'attribute' => 'is_main',
                            'filter' => false, //不显示搜索框
                            'value' => function( $model ){
                                return WhetherEnum::getValue($model->is_main);
                            }
                        ],
                        [
                            'header' => "门店基本信息",
                            'format' => 'raw',
                            'value' => function ( $model ){
                                return Html::a('点击查看', ['view', 'id' => $model->id], [
                                    'class' => 'blue',
                                    'data-toggle' => 'modal',
                                    'data-target' => '#ajaxModal',
                                ]) ;
                            }
                        ],
                        [
                            'header' => "快店资质审核",
                            'format' => 'raw',

                        ],
                        [
                            'attribute' => 'sort',
                            'filter' => false, //不显示搜索框
                            'format' => 'raw',
                            'headerOptions' => ['class' => 'col-md-1'],
                            'value' => function ($model, $key, $index, $column) {
                                return Html::sort($model->sort);
                            }
                        ],
                        [
                            'attribute' => 'status',
                            'filter' => false, //不显示搜索框
                            'value' => function($model){
                                return StatusEnum::getValue($model->status);
                            }
                        ],
                        [
                            'header' => "操作",
                            'contentOptions' => ['class' => 'text-align-center'],
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{ajax-edit} {address} {recharge} {edit} {status} {destroy}',
                            'buttons' => [
                                'edit' => function ($url, $model, $key) {
                                    return Html::a('编辑', ['edit', 'id' => $model->id], [
                                        'class' => 'green'
                                    ]);
                                },
                                'destroy' => function ($url, $model, $key) {
                                    return Html::a('删除', ['destroy', 'id' => $model->id], [
                                        'class' => 'red',
                                    ]) ;
                                },
                            ],
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>