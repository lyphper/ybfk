<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\models\GatherResult $model
 */

$this->title = 'Create Gather Result';
$this->params['breadcrumbs'][] = ['label' => 'Gather Results', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gather-result-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
