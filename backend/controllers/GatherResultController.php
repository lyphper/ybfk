<?php

namespace backend\controllers;

use QL\QueryList;
use Yii;
use backend\models\GatherResult;
use backend\models\GatherResultSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GatherResultController implements the CRUD actions for GatherResult model.
 */
class GatherResultController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all GatherResult models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GatherResultSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single GatherResult model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('view', ['model' => $model]);
        }
    }

    /**
     * Creates a new GatherResult model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GatherResult;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing GatherResult model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing GatherResult model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GatherResult model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GatherResult the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GatherResult::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * 开始采集
     * @param $rule_id 采集规则id
     * @return bool
     */
    public function actionStartGather($rule_id){
        GatherResult::startGather($rule_id);
        return $this->redirect(['gather-rules/index']);
    }

    public function actionSee($id){
        $a=GatherResult::findOne($id);
        return $this->renderPartial('see',[
            'content'=>$a->gather_content
        ]);
//        print_r($a->gather_content);
    }


    public function actionTest(){
        $urls = array();
        for ($i=1; $i <= 20; $i++) {
            $url = "http://wallpaper.pconline.com.cn/pic/17970_{$i}.html";
            array_push($urls,$url);
        }
        QueryList::run('Multi',array(
            'list' => $urls,
            /*'curl' => array(
                    CURLOPT_ENCODING => 'gzip'
                ),*/
            'success' => function($a,$_this){
                $curl = $_this->curl;
                $reg = array(
                    'img' => array('#J-BigPic>img','src','',function($content){
                        //利用回调函数获取原图
                        return str_replace('_320x480', '', $content);
                    })
                );
                //注意这里，原页面经过了gzip压缩，需要解压缩，可能经常有人误以为是乱码
                $page = @gzdecode($a['content']);
                if(!$page){
                    $page = $a['content'];
                }
                QueryList::Query($page,$reg)->getData(function($item) use($curl){
                    $curl->add(array(
                        'url' => $item['img'],
                        //指定图片下载目录
                        'file' => 'img/'.md5($item['img']).'.jpg'
                    ));
                });

            }
        ));
    }
}
