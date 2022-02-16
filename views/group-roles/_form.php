<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GroupRoles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="group-roles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'group_id')->dropdownlist($groupList) ?>  

    <?= $form->field($model, 'controller')->dropdownlist($controllerList) ?>

    <?= $form->field($model, 'create')->checkbox() ?>

    <?= $form->field($model, 'read')->checkbox() ?>

    <?= $form->field($model, 'update')->checkbox() ?>

    <?= $form->field($model, 'delete')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
