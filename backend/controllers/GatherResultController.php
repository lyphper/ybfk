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

    public function actionGather(){
        //多线程扩展
        QueryList::run('Multi',[
            'list' => ['http://www.ruanyifeng.com/blog/2014/06/git_remote.html'],
            'curl' => [
                'opt' => array(
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_AUTOREFERER => true,
                ),
                //设置线程数
                'maxThread' => 100,
                //设置最大尝试数
                'maxTry' => 3
            ],
            'success' => function($a){
                //采集规则
                $reg = array(
                    //采集文章标题
                    'title' => array('h1','text'),
                    //采集文章发布日期,这里用到了QueryList的过滤功能，过滤掉span标签和a标签
//                    'date' => array('.published','text','-span -a',function($content){
//                        //用回调函数进一步过滤出日期
//                        $arr = explode(' ',$content);
//                        return $arr[0];
//                    }),
                    //采集文章正文内容,利用过滤功能去掉文章中的超链接，但保留超链接的文字，并去掉版权、JS代码等无用信息
                    'content' => array('#main-content','html','a -.content_copyright -script',function($content){
                        //利用回调函数下载文章中的图片并替换图片路径为本地路径
                        //使用本例请确保当前目录下有image文件夹，并有写入权限
                        //由于QueryList是基于phpQuery的，所以可以随时随地使用phpQuery，当然在这里也可以使用正则或者其它方式达到同样的目的
                        $doc = \phpQuery::newDocumentHTML($content);
                        $imgs = pq($doc)->find('img');
                        foreach ($imgs as $img) {
                            $src = pq($img)->attr('src');
                            $localSrc = 'img/'.md5($src).'.jpg';
                            $stream = file_get_contents($src);
                            file_put_contents($localSrc,$stream);
                            pq($img)->attr('src',$localSrc);
                        }
                        return $doc->htmlOuter();
                    })
                );
                $rang = '#content';
                $ql = QueryList::Query($a['content'],$reg,$rang);
                $data = $ql->getData();
                //打印结果，实际操作中这里应该做入数据库操作
                print_r($data);
            }
        ]);
    }
}
