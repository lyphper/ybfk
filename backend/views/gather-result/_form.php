<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var backend\models\GatherResult $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="gather-result-form">

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_HORIZONTAL]); echo Form::widget([

        'model' => $model,
        'form' => $form,
        'columns' => 1,
        'attributes' => [

            'rule_id'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter 采集规则id...']],

            'created_at'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter 创建时间...']],

            'updated_at'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter 修改时间...']],

//            'gather_content'=>['type'=> Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'Enter 采集内容...','rows'=> 6]],

            'gather_title'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter 采集标题...', 'maxlength'=>100]],

        ]

    ]);
    echo $form->field($model, 'gather_content[]')->label('banner图')->widget(\kartik\file\FileInput::classname(), [
        'options' => ['multiple' => true],
        'pluginOptions' => [
            // 需要预览的文件格式
            'previewFileType' => 'image',
            // 预览的文件
            'initialPreview' => ['图片1', '图片2', '图片3'],
            // 需要展示的图片设置，比如图片的宽度等
            'initialPreviewConfig' => ['width' => '120px'],
            // 是否展示预览图
            'initialPreviewAsData' => true,
            // 异步上传的接口地址设置
            'uploadUrl' => \yii\helpers\Url::toRoute(['/goods/async-image']),
            // 异步上传需要携带的其他参数，比如商品id等
            'uploadExtraData' => [
                'goods_id' => 1,
            ],
            'uploadAsync' => true,
            // 最少上传的文件个数限制
            'minFileCount' => 1,
            // 最多上传的文件个数限制
            'maxFileCount' => 10,
            // 是否显示移除按钮，指input上面的移除按钮，非具体图片上的移除按钮
            'showRemove' => true,
            // 是否显示上传按钮，指input上面的上传按钮，非具体图片上的上传按钮
            'showUpload' => true,
            //是否显示[选择]按钮,指input上面的[选择]按钮,非具体图片上的上传按钮
            'showBrowse' => true,
            // 展示图片区域是否可点击选择多文件
            'browseOnZoneClick' => true,
            // 如果要设置具体图片上的移除、上传和展示按钮，需要设置该选项
            'fileActionSettings' => [
                // 设置具体图片的查看属性为false,默认为true
                'showZoom' => false,
                // 设置具体图片的上传属性为true,默认为true
                'showUpload' => true,
                // 设置具体图片的移除属性为true,默认为true
                'showRemove' => true,
            ],
        ],
        // 一些事件行为
        'pluginEvents' => [
            // 上传成功后的回调方法，需要的可查看data后再做具体操作，一般不需要设置
            "fileuploaded" => "function (event, data, id, index) {
            console.log(data);
        }",
        ],
    ]);

    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end(); ?>

</div>
