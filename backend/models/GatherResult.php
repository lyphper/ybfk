<?php
/**
 * Created by PhpStorm.
 * User: ly
 * Date: 16-6-21
 * Time: 下午2:24
 */
namespace backend\models;
use QL\QueryList;

class GatherResult extends \common\models\GatherResult{

    /**
     * 开始采集
     * @param $rule_id
     * @return bool
     */
    public static function startGather($rule_id){
        //获取采集规则
        $gather_rule=GatherRules::GetInfoById($rule_id);
        $rule = eval("return $gather_rule->gather_rule;");
        $remove_head = eval("return $gather_rule->remove_head;");
        $hj = QueryList::Query($gather_rule->gather_url,$rule,$gather_rule->gather_range,$gather_rule->output_encoding,$gather_rule->input_encoding,$remove_head);
        $hj=$hj->data;
//        var_dump($hj);die;
        //输出结果：二维关联数组
        $model=new GatherResult();
        $model->rule_id=$rule_id;
        $model->gather_title=isset($hj[0]['title'])?$hj[0]['title']:'';
        $model->gather_content=$hj[0]['html'];
        return $model->save();
    }
}