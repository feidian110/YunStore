<?php

use common\enums\WhetherEnum;
use yii\widgets\ActiveForm;

$this->title = $model->isNewRecord ? "添加门店" : "编辑门店";
$this->params['breadcrumbs'][] = ['label' => '商户管理'];
$this->params['breadcrumbs'][] = ['label' => '门店管理'];
$this->params['breadcrumbs'][] = ['label' => $this->title];

?>

<div class="row">
    <div class="col-lg-12">
        <?php $form = ActiveForm::begin([
            'options' => ['class'=>'form-horizontal'],
            'fieldConfig' => [
                'labelOptions' => ['class'=>'col-sm-1 control-label text-right'],
                'template' => "{label}<div class='col-sm-5'>{input}{hint}{error}</div>",
            ],
        ]); ?>
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">基本设置</a></li>
                <li><a href="#tab_2" data-toggle="tab">门店描述</a></li>


            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <?= $form->field($model, 'title')->textInput() ?>
                    <?= $form->field($model, 'is_main')->radioList(WhetherEnum::getMap())->hint('必须设置一个店铺为主店铺，前端才会显示商家中心'); ?>
                    <?= $form->field($model, 'store_logo')->hint('店铺LOGO暂时仅用于快店、小程序，建议上传680*480的图片')->widget('common\widgets\webuploader\Files', [
                        'config' => [
                            // 可设置自己的上传地址, 不设置则默认地址
                            // 'server' => '',
                            'pick' => [
                                'multiple' => false,
                            ],
                            'formData' => [
                                // 不配置则不生成缩略图
                                'thumb' => [
                                    [
                                        'width' => 100,
                                        'height' => 100,
                                    ],
                                    [
                                        'width' => 200,
                                        'height' => 200,
                                    ],
                                ],
                                'drive' => 'local',// 默认本地 支持 qiniu/oss/cos 上传
                            ],
                            'chunked' => false,// 开启分片上传
                            'chunkSize' => 512 * 1024,// 分片大小
                            'independentUrl' => false, // 独立上传地址, 如果设置了true则不受全局上传地址控制
                        ],
                    ]);?>
                    <?= $form->field($model, 'phone')->textInput()->hint('多个电话号码以空格分开,做多5个电话号码') ?>
                    <?= $form->field($model, 'service_phone')->textInput()->hint('客服下单电话，商家收入余额短信提醒'); ?>
                    <?= $form->field($model, 'wechat')->textInput() ?>
                    <?= $form->field($model, 'qq')->textInput() ?>
                    <?= $form->field($model, 'per_money')->textInput() ?>
                    <?= $form->field($model, 'feature')->textInput() ?>
                    <?= \common\widgets\provinces\Provinces::widget([
                        'form' => $form,
                        'model' => $model,
                        'provincesName' => 'province_id',// 省字段名
                        'cityName' => 'city_id',// 市字段名
                        'areaName' => 'area_id',// 区字段名
                        //'template' => 'short' //合并为一行显示
                    ]); ?>
                    <?= $form->field($model, 'api_address')->widget(\common\widgets\selectmap\Map::class, [
                        'type' => 'amap', // amap高德;tencent:腾讯;baidu:百度
                    ]); ?>
                    <?= $form->field($model, 'address')->textInput()->hint('地址不能带有上面所在地选择的省/区/商圈信息'); ?>
                </div>
                <div class="tab-pane" id="tab_2">
                    <?= $form->field($model, 'images')->hint('第一张将作为主图片！最多上传10个图片！图片宽度建议为700px，高度建议为420px。')->widget('common\widgets\webuploader\Files', [
                        'config' => [ // 配置同图片上传
                            // 'server' => '',
                            'pick' => [
                                'multiple' => true,
                            ],
                            'formData' => [
                                // 不配置则不生成缩略图
                                // 'thumb' => [
                                //     [
                                //         'width' => 100,
                                //         'height' => 100,
                                //     ],
                                // ]
                            ],
                        ]
                    ]);?>
                    <?= $form->field($model, 'detail')->textarea(['rows'=>10]) ?>
                    <?= $form->field($model, 'remark')->widget(\common\widgets\ueditor\UEditor::class, [
                        'config' => [

                        ],
                        'formData' => [
                            'drive' => 'local', // 默认本地 支持qiniu/oss/cos 上传
                            'poster' => false, // 上传视频时返回视频封面图，开启此选项需要安装 ffmpeg 命令
                            'thumb' => [ // 图片缩略图
                                [
                                    'width' => 100,
                                    'height' => 100,
                                ],
                            ]
                        ],
                    ]) ?>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary" type="submit">保存</button>
                    <span class="btn btn-white" onclick="history.go(-1)">返回</span>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
