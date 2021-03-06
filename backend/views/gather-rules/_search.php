<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var backend\models\GatherRulesSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="gather-rules-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'gather_url') ?>

    <?= $form->field($model, 'gather_title') ?>

    <?= $form->field($model, 'gather_rule') ?>

    <?php // echo $form->field($model, 'gather_range') ?>

    <?php // echo $form->field($model, 'output_encoding') ?>

    <?php // echo $form->field($model, 'input_encoding') ?>

    <?php // echo $form->field($model, 'remove_head') ?>

    <?php // echo $form->field($model, 'image_local') ?>

    <?php // echo $form->field($model, 'poll_time') ?>

    <?php // echo $form->field($model, 'enable') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
