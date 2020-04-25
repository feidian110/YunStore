<?php

use yii\widgets\ActiveForm;
use common\helpers\Url;
$this->title = $model->isNewRecord ? "创建自提点" : "更新自提点";
?>

<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?= $this->title;?></h3>
            </div>
            <?php $form = ActiveForm::begin([
                'id' => $model->formName(),
                'enableAjaxValidation' => true,
                'options' => ['class'=>'form-horizontal'],
                'validationUrl' => Url::to(['ajax-edit', 'id' => $model['id']]),
                'fieldConfig' => [
                    'labelOptions' => [ 'class' => 'col-sm-1 control-label text-right' ],
                    'template' => "{label}<div class='col-sm-7'>{input}\n{hint}\n{error}</div>",
                ]
            ])?>


            <div class="box-body">
                <div class="col-lg-12">
                    <?= $form->field($model,'store_id')->dropDownList([]);?>
                    <?= $form->field($model,'title')->textInput();?>
                    <?= $form->field($model,'contact')->textInput();?>
                    <?= $form->field($model,'contact_mobile')->textInput();?>
                    <?= \common\widgets\provinces\Provinces::widget([
                        'form' => $form,
                        'model' => $model,
                        'provincesName' => 'province_id',// 省字段名
                        'cityName' => 'city_id',// 市字段名
                        'areaName' => 'area_id',// 区字段名
                        // 'template' => 'short' //合并为一行显示
                    ]); ?>
                    <?= $form->field($model, 'api_address')->widget(\common\widgets\selectmap\Map::class, [
                        'type' => 'amap', // amap高德;tencent:腾讯;baidu:百度
                    ]); ?>

                    <?= $form->field($model,'address')->textarea(['rows'=>4]);?>
                </div>
            </div>
            <div class="box-footer text-center">
                <button class="btn btn-primary" type="submit">保存</button>
                <span class="btn btn-white" onclick="history.go(-1)">返回</span>
            </div>
            <?php ActiveForm::end();?>
        </div>
    </div>
</div>