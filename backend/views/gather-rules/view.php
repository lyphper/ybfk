<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var backend\models\GatherRules $model
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Gather Rules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gather-rules-view">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>


    <?= DetailView::widget([
            'model' => $model,
            'condensed'=>false,
            'hover'=>true,
            'mode'=>Yii::$app->request->get('edit')=='t' ? DetailView::MODE_EDIT : DetailView::MODE_VIEW,
            'panel'=>[
            'heading'=>$this->title,
            'type'=>DetailView::TYPE_INFO,
        ],
        'attributes' => [
            'id',
            'name',
            'gather_url:url',
            'gather_title',
            'gather_rule:ntext',
            'gather_range',
            'output_encoding',
            'input_encoding',
            'remove_head',
            'image_local',
            'poll_time:datetime',
            'enable',
            'created_at',
            'updated_at',
        ],
        'deleteOptions'=>[
            'url'=>['delete', 'id' => $model->id],
            'data'=>[
                'confirm'=>Yii::t('app', 'Are you sure you want to delete this item?'),
                'method'=>'post',
            ],
        ],
        'enableEditMode'=>true,
    ]) ?>

</div>
