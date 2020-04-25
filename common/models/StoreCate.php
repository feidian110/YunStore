<?php

namespace addons\YunStore\common\models;

use Yii;

/**
 * This is the model class for table "yun_net_addon_yun_store_cate".
 *
 * @property int $id 主键
 * @property string $title 门店分类名称
 * @property int $pid 父级ID
 * @property string $tree 树
 * @property int $level 级别
 * @property int $status 状态[-1:删除,0:禁用,1:启用]
 * @property int $sort 排序
 * @property int $created_at 创建时间
 * @property int $updated_at 最后更新时间
 */
class StoreCate extends \common\models\base\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%_addon_yun_store_store_cate}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pid', 'level', 'status', 'sort', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['tree'], 'string', 'max' => 2000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'pid' => 'Pid',
            'tree' => 'Tree',
            'level' => 'Level',
            'status' => 'Status',
            'sort' => 'Sort',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
