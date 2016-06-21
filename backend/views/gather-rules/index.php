<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var backend\models\GatherRulesSearch $searchModel
 */

$this->title = 'Gather Rules';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gather-rules-index">
    <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php /* echo Html::a('Create Gather Rules', ['create'], ['class' => 'btn btn-success'])*/  ?>
    </p>

    <?php Pjax::begin(); echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'gather_url:url',
            'gather_rule:ntext',
            'gather_range',
            'output_encoding',
            'input_encoding',
//            'remove_head', 
//            'created_at', 
//            'updated_at', 

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view}{update}{delete}{gather}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Yii::$app->urlManager->createUrl(['gather-rules/view','id' => $model->id]), [
                            'title' => Yii::t('yii', 'Edit'),
                            'style' => 'margin-right:5%;margin-bottom:2%',
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Yii::$app->urlManager->createUrl(['gather-rules/view','id' => $model->id,'edit'=>'t']), [
                            'title' => Yii::t('yii', 'Edit'),
                            'style' => 'margin-right:5%;margin-bottom:2%',
                        ]);
                    },
//                    'delete' => function ($url, $model) {
//                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', Yii::$app->urlManager->createUrl(['gather-rules/delete','id' => $model->id]), [
//                            'title' => Yii::t('yii', 'Edit'),
//                            'style' => 'margin-right:5%;margin-bottom:2%',
//                        ]);
//                    },
                    'gather' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-plus"></span>', Yii::$app->urlManager->createUrl(['gather-result/start-gather','rule_id' => $model->id]), [
                            'title' => Yii::t('yii', 'Edit'),
                            'style' => 'margin-left:5%;margin-bottom:2%',
                        ]);
                    }

                ],
            ],
        ],
        'responsive'=>true,
        'hover'=>true,
        'condensed'=>true,
        'floatHeader'=>true,




        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> '.Html::encode($this->title).' </h3>',
            'type'=>'info',
            'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Add', ['create'], ['class' => 'btn btn-success']),                                                                                                                                                          'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
            'showFooter'=>false
        ],
    ]); Pjax::end(); ?>

</div>
