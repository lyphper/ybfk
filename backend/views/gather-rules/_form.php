<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var backend\models\GatherRules $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="gather-rules-form">

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_HORIZONTAL]); echo Form::widget([

        'model' => $model,
        'form' => $form,
        'columns' => 1,
        'attributes' => [

            'gather_rule'=>['type'=> Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'Enter 采集规则...','rows'=> 6]],

            'image_local'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter 图片本地化：0否，1是...']],

            'poll_time'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter 跟新时间间隔...']],

            'enable'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter 启用：0否，1是...']],

            'created_at'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter 创建时间...']],

            'updated_at'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter 修改时间...']],

            'name'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter 名称...', 'maxlength'=>255]],

            'gather_url'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter 采集地址...', 'maxlength'=>255]],

            'gather_title'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter 采集标题...', 'maxlength'=>255]],

            'gather_range'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter 区域选择器...', 'maxlength'=>255]],

            'output_encoding'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter 输出编码...', 'maxlength'=>10]],

            'input_encoding'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter 输入编码...', 'maxlength'=>10]],

            'remove_head'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter 是否移除头部...', 'maxlength'=>10]],

        ]

    ]);

    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end(); ?>

</div>
