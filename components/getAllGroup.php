<?php
namespace app\components;

//use Yii;
use yii\base\Component;
//use yii\base\InvalidConfigException;
use app\models\Group;


class getAllGroup extends Component
{

    function list() {
        $groupList = [];
        $groups = Group::find()->orderBy("id")->all();
        foreach ($groups as $group) {
            $groupList[$group->id] = $group->title;
        }

        return $groupList;
    }

}
