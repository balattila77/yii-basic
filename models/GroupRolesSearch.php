<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GroupRoles;

/**
 * GroupRolesSearch represents the model behind the search form of `app\models\GroupRoles`.
 */
class GroupRolesSearch extends GroupRoles
{
    public $groupTitle;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'group_id', 'create', 'read', 'update', 'delete'], 'integer'],
            [['controller','groupTitle'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = GroupRoles::find()->innerJoinWith('group', true);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            //'group_id' => $this->group_id,
           // 'group.title' => $this->groupTitle,
            'create' => $this->create,
            'read' => $this->read,
            'update' => $this->update,
            'delete' => $this->delete,
            /*'group.title' => [
                'asc' => ['group.title' =>SORT_ASC],
                'desc' => ['group.title' => SORT_DESC],
                'label' => 'Group'
            ]*/
        ]);

        $query->andFilterWhere(['like', 'controller', $this->controller]);
        //->andFilterWhere(['like', 'groupTitle', $this->groupTitle]);
        //$query->andFilterWhere(['like', 'group.title', $this->groupTitle]);

        /*if (!($this->load($params) && $this->validate())) {
            
            $query->joinWith(['group']);
            return $dataProvider;
        }
        $this->addCondition($query, 'groupTitle');*/
        $query->joinWith(['group' => function ($q) {
            $q->where('group.title LIKE "%' . $this->groupTitle . '%"');
        }]);

        return $dataProvider;
    }
}
