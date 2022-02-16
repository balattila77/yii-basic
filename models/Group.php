<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group".
 *
 * @property int $id
 * @property string $title
 *
 * @property GroupRoles[] $groupRoles
 * @property UserGroups[] $userGroups
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 30],
            [['title'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Group',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[GroupRoles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroupRoles()
    {
        return $this->hasMany(GroupRoles::className(), ['group_id' => 'id']);
    }

    /**
     * Gets query for [[UserGroups]].
     *
     * @return \yii\db\ActiveQuery
     */
    /*public function getUserGroups()
    {
        return $this->hasMany(UserGroups::className(), ['group_id' => 'id']);
    }*/

    public function getUser() {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('user_groups', ['group_id' => 'id']);
    }
}
