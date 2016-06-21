<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%gather_rules}}".
 *
 * @property integer $id
 * @property string $gather_url
 * @property string $gather_rule
 * @property string $gather_range
 * @property string $output_encoding
 * @property string $input_encoding
 * @property string $remove_head
 * @property integer $created_at
 * @property integer $updated_at
 */
class GatherRules extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%gather_rules}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gather_rule'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['gather_url', 'gather_range'], 'string', 'max' => 255],
            [['output_encoding', 'input_encoding', 'remove_head'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '自增id',
            'gather_url' => '采集地址',
            'gather_rule' => '采集规则',
            'gather_range' => '区域选择器',
            'output_encoding' => '输出编码',
            'input_encoding' => '输入编码',
            'remove_head' => '是否移除头部',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
        ];
    }

    /**
     * 自动处理创建时间和修改时间
     * @see \yii\base\Component::behaviors()
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
            ],
        ];
    }
}
