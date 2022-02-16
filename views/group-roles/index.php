<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\GroupRoles;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GroupRolesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Group Roles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-roles-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Group Roles', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Group',
                'format' => 'ntext',
                'attribute' => 'groupTitle',
                'value' => 'group.title'
                /*'value' => function($model){
                    foreach($model->group as $group){
                        $groupTitles[] = $group->title;
                    }
                    return implode("\n", $groupTitles);
                }*/
            ],
            [
                'label' => 'Page',
                'attribute' => 'controller'
            ],
            [
                'label' => 'create',
                'attribute' => 'create'
            ],
            [
                'label' => 'read',
                'attribute' => 'read'
            ],
            [
                'label' => 'update',
                'attribute' => 'update'
            ],
            [
                'label' => 'delete',
                'attribute' => 'delete'
            ],
            
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, GroupRoles $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
