<?php
/**
 * Created by PhpStorm.
 * User: ly
 * Date: 16-6-21
 * Time: 下午2:24
 */
namespace backend\models;
class GatherResult extends \common\models\GatherResult{


    public static function startGather($rule_id){
        //获取采集规则
        $rule=GatherRules::GetInfoById($rule_id);
        var_dump($rule);die;
        //获取采集对象
        $hj = QueryList::Query('http://www.yiifans.com/forum.php?mod=viewthread&tid=41',array('html'=>array('html','html')),'','UTF-8');
        //输出结果：二维关联数组
        print_r($hj->data);
    }
}