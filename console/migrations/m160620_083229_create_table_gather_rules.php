<?php

use yii\db\Schema;
use yii\db\Migration;

class m160620_083229_create_table_gather_rules extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB COMMENT=\'采集规则表\'';
        }
        $this->createTable('{{%gather_rules}}', [
            'id' => Schema::TYPE_PK . ' AUTO_INCREMENT COMMENT \'自增id\'' ,
            'gather_url' => Schema::TYPE_STRING . '(255) DEFAULT NULL COMMENT \'采集地址\'',
            'gather_rule' => Schema::TYPE_TEXT . ' DEFAULT NULL COMMENT \'采集规则\'',
            'gather_range' => Schema::TYPE_STRING . '(255) DEFAULT NULL COMMENT \'区域选择器\'',
            'output_encoding' => Schema::TYPE_STRING . '(10) DEFAULT NULL COMMENT \'输出编码\'',
            'input_encoding' => Schema::TYPE_STRING . '(10) DEFAULT NULL COMMENT \'输入编码\'',
            'remove_head' => Schema::TYPE_STRING. '(10) DEFAULT \'false\' COMMENT \'是否移除头部\'',
            'created_at' => Schema::TYPE_INTEGER . '(11) DEFAULT NULL COMMENT \'创建时间\'',
            'updated_at' => Schema::TYPE_INTEGER . '(11) DEFAULT NULL COMMENT \'修改时间\'',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%gather_rules}}');
    }
}
