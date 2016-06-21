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

            'gather_content'=>['type'=> Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'Enter 采集内容...','rows'=> 6]],

            'gather_title'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter 采集标题...', 'maxlength'=>100]],

        ]

    ]);

    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end(); ?>

</div>
