<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GroupRoles */

$this->title = 'Update Group Roles: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Group Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="group-roles-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'groupList' => $groupList,
        'controllerList' => $controllerList
    ]) ?>

</div>
