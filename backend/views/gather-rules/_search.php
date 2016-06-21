<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GatherRulesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gather-rules-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'gather_url') ?>

    <?= $form->field($model, 'gather_rule') ?>

    <?= $form->field($model, 'output_encoding') ?>

    <?= $form->field($model, 'input_encoding') ?>

    <?php // echo $form->field($model, 'remove_head') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>