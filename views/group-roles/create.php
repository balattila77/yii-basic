<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GroupRoles */

$this->title = 'Create Group Roles';
$this->params['breadcrumbs'][] = ['label' => 'Group Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-roles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'groupList' => $groupList,
        'controllerList' => $controllerList
    ]) ?>

</div>
