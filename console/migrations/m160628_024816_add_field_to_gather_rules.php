<?php

use yii\db\Migration;

class m160628_024816_add_field_to_gather_rules extends Migration
{
    const TB_NAME = '{{%gather_rules}}';
    public function safeUp()
    {
        $this->addColumn(self::TB_NAME, 'name', 'varchar(255) DEFAULT NULL COMMENT "名称" AFTER id');
        $this->addColumn(self::TB_NAME, 'gather_title', 'varchar(255) DEFAULT NULL COMMENT "采集标题" AFTER gather_url');
        $this->addColumn(self::TB_NAME, 'image_local', 'smallint(1) DEFAULT \'0\' COMMENT "图片本地化：0否，1是" AFTER remove_head');
        $this->addColumn(self::TB_NAME, 'poll_time', 'int(10) DEFAULT NULL COMMENT "跟新时间间隔" AFTER image_local');
        $this->addColumn(self::TB_NAME, 'enable', 'smallint(1) DEFAULT \'0\' COMMENT "启用：0否，1是" AFTER poll_time');
    }

    public function safeDown()
    {
        $this->dropColumn(self::TB_NAME, 'name');
        $this->dropColumn(self::TB_NAME, 'gather_title');
        $this->dropColumn(self::TB_NAME, 'image_local');
        $this->dropColumn(self::TB_NAME, 'poll_time');
        $this->dropColumn(self::TB_NAME, 'enable');
    }
}
