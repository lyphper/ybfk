<?php
/**
 * Created by PhpStorm.
 * User: ly
 * Date: 16-6-21
 * Time: 下午2:24
 */
namespace backend\models;
use QL\QueryList;
use yii\helpers\Url;

class GatherResult extends \common\models\GatherResult{

    /**
     * 开始采集
     * @param $rule_id
     * @return bool
     */
    public static function startGather($rule_id){
        //获取采集规则
        $GLOBALS['rule_id']=$rule_id;
        $gather_rule=GatherRules::GetInfoById($rule_id);
        $GLOBALS['gather_rule']=$gather_rule;
        //多线程扩展
        QueryList::run('Multi',[
            'list' => [$gather_rule['gather_url']],
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
                $rule_string=$GLOBALS['gather_rule']['gather_rule'];
                $rule= eval("return $rule_string;");
                $title_string=$GLOBALS['gather_rule']['gather_title'];
                $title= eval("return $title_string;");
                if($GLOBALS['gather_rule']['image_local']){
                    //采集规则
                    $reg = array(
                        //采集文章标题
                        'title' => $title['title'],
                        //采集文章正文内容,利用过滤功能去掉文章中的超链接，但保留超链接的文字，并去掉版权、JS代码等无用信息
                        'content' => array(isset($rule['content'][0])?$rule['content'][0]:'',isset($rule['content'][1])?$rule['content'][1]:'',isset($rule['content'][2])?$rule['content'][2]:'',function($content){
                            //利用回调函数下载文章中的图片并替换图片路径为本地路径
                            //使用本例请确保当前目录下有image文件夹，并有写入权限
                            //由于QueryList是基于phpQuery的，所以可以随时随地使用phpQuery，当然在这里也可以使用正则或者其它方式达到同样的目的
                            $doc = \phpQuery::newDocumentHTML($content);
                            $imgs = pq($doc)->find('img');
                            foreach ($imgs as $img) {
                                $src = pq($img)->attr('src');
                                $localSrc = 'img/'.md5($src).'.jpg';
                                $UrlSrc = Url::home(true).'img/'.md5($src).'.jpg';
                                $stream = file_get_contents($src);
                                file_put_contents($localSrc,$stream);
                                pq($img)->attr('src',$UrlSrc);
                            }
                            return $doc->htmlOuter();
                        })
                    );
                }else{
                    //采集规则
                    $reg = array(
                        //采集文章标题
                        'title' => $title['title'],
                        'content'=>$rule['content'],
                        //采集文章正文内容,利用过滤功能去掉文章中的超链接，但保留超链接的文字，并去掉版权、JS代码等无用信息
                    );
                }
                $rang = $GLOBALS['gather_rule']['gather_range'];
                $ql = QueryList::Query($a['content'],$reg,$rang);
                $data = $ql->getData();
                print_r($data);die;
                //打印结果，实际操作中这里应该做入数据库操作
                $model=new GatherResult();
                $model->rule_id=$GLOBALS['rule_id'];
                $model->gather_title=isset($data[0]['title'])?$data[0]['title']:'';
                $model->gather_content=isset($data[0]['content'])?$data[0]['content']:'';
                return $model->save();
            }
        ]);




//        //获取采集规则
//        $gather_rule=GatherRules::GetInfoById($rule_id);
//        $rule = eval("return $gather_rule->gather_rule;");
////        $rule['content']=array('html','html','',function($content){
////                            //利用回调函数下载文章中的图片并替换图片路径为本地路径
////                            //使用本例请确保当前目录下有image文件夹，并有写入权限
////                            //由于QueryList是基于phpQuery的，所以可以随时随地使用phpQuery，当然在这里也可以使用正则或者其它方式达到同样的目的
////                            $doc = \phpQuery::newDocumentHTML($content);
////                            $imgs = pq($doc)->find('a');
////            var_dump($imgs);die;
////                            foreach ($imgs as $img) {
////
////                                $src = pq($img)->attr('src');
////                                $localSrc = './img/'.md5($src).'.jpg';
////                                $stream = file_get_contents($src);
////                                file_put_contents($localSrc,$stream);
////                                pq($img)->attr('src',$localSrc);
////                            }
////                            return $doc->htmlOuter();
////                        });
//
//        $remove_head = eval("return $gather_rule->remove_head;");
//        $hj = QueryList::Query($gather_rule->gather_url,$rule,$gather_rule->gather_range,$gather_rule->output_encoding,$gather_rule->input_encoding,$remove_head);
//        $hj=$hj->data;
////        var_dump($hj);die;
//        //输出结果：二维关联数组
//        $model=new GatherResult();
//        $model->rule_id=$rule_id;
//        $model->gather_title=isset($hj[0]['title'])?$hj[0]['title']:'';
//        $model->gather_content=$hj[0]['html'];
//        return $model->save();
    }
}