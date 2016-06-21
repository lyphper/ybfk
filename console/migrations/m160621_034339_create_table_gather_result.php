<?php

use yii\db\Migration;
use yii\db\Schema;

class m160621_034339_create_table_gather_result extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB COMMENT=\'采集结果表\'';
        }
        $this->createTable('{{%gather_result}}', [
            'id' => Schema::TYPE_PK . ' AUTO_INCREMENT COMMENT \'自增id\'' ,
            'rule_id' => Schema::TYPE_INTEGER . '(20) DEFAULT NULL COMMENT \'采集规则id\'',
            'gather_title' => Schema::TYPE_STRING . '(100) DEFAULT NULL COMMENT \'采集标题\'',
            'gather_content' => Schema::TYPE_TEXT . ' DEFAULT NULL COMMENT \'采集内容\'',
            'created_at' => Schema::TYPE_INTEGER . '(11) DEFAULT NULL COMMENT \'创建时间\'',
            'updated_at' => Schema::TYPE_INTEGER . '(11) DEFAULT NULL COMMENT \'修改时间\'',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%gather_result}}');
    }
}
