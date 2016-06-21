<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\models\GatherRules $model
 */

$this->title = 'Update Gather Rules: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Gather Rules', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gather-rules-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
