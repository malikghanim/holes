<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php if ($model->id != 1): ?>
    <?php $form = ActiveForm::begin(); ?>
        
    <?php if ($operation == 'create'): ?>
        <?= $form->field($model, 'username')->textInput() ?>
        <?= $form->field($model, 'email')->textInput() ?>
        <?= $form->field($model, 'pass')->passwordInput()->label('Password') ?>
        <?= $form->field($model, 'pass_repeat')->passwordInput()->label('Confirm Password') ?>
    <?php endif ?>

    <?= $form->field($model, 'first_name')->textInput() ?>
    <?= $form->field($model, 'last_name')->textInput() ?>
    
    <?=  $form->field($model, 'status')->dropdownList(
        common\models\User::USER_STATUSES
    )->label('Status') ?>

    <?=  $form->field($model, 'role')->dropdownList(
        common\models\User::ROLES
    )->label('Status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php endif ?>

</div>
