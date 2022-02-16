<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group_roles".
 *
 * @property int $id
 * @property int $group_id
 * @property string $controller
 * @property int|null $create
 * @property int|null $read
 * @property int|null $update
 * @property int|null $delete
 *
 * @property Group $group
 */
class GroupRoles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group_roles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_id', 'controller'], 'required'],
            [['group_id', 'create', 'read', 'update', 'delete'], 'integer'],
            [['controller'], 'string', 'max' => 64],            
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'groupTitle' => 'Group',
            'controller' => 'Controller',
            'create' => 'Create',
            'read' => 'Read',
            'update' => 'Update',
            'delete' => 'Delete',
        ];
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

    /*public function getGroupTitle(){
        return $this->group->title;
    }*/
}
