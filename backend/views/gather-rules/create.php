<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\GatherRules */

$this->title = 'Create Gather Rules';
$this->params['breadcrumbs'][] = ['label' => 'Gather Rules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gather-rules-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
