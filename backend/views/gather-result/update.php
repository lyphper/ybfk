<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\models\GatherResult $model
 */

$this->title = 'Update Gather Result: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Gather Results', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gather-result-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
