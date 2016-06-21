<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var backend\models\GatherRules $model
 */

$this->title = 'Create Gather Rules';
$this->params['breadcrumbs'][] = ['label' => 'Gather Rules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gather-rules-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
