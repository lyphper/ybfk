<?php
/**
 * Created by PhpStorm.
 * User: ly
 * Date: 16-6-21
 * Time: 上午10:11
 */
namespace backend\models;
class GatherRules extends \common\models\GatherRules{
    public static function getInfoById($id){
        return self::findOne($id);
    }
}