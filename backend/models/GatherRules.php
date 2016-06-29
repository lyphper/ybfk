<?php
/**
 * Created by PhpStorm.
 * User: ly
 * Date: 16-6-21
 * Time: 上午10:11
 */
namespace backend\models;
class GatherRules extends \common\models\GatherRules{

    /**
     * 根据id获取规则详情
     * @param $id
     * @return null|static
     */
    public static function getInfoById($id){
        return self::find($id)->where(['id'=>$id])->asArray()->one();
    }
}