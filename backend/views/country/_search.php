<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CountrySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="country-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'Code') ?>

    <?= $form->field($model, 'Name') ?>

    <?= $form->field($model, 'Continent') ?>

    <?= $form->field($model, 'Region') ?>

    <?= $form->field($model, 'SurfaceArea') ?>

    <?php // echo $form->field($model, 'IndepYear') ?>

    <?php // echo $form->field($model, 'Population') ?>

    <?php // echo $form->field($model, 'LifeExpectancy') ?>

    <?php // echo $form->field($model, 'GNP') ?>

    <?php // echo $form->field($model, 'GNPOld') ?>

    <?php // echo $form->field($model, 'LocalName') ?>

    <?php // echo $form->field($model, 'GovernmentForm') ?>

    <?php // echo $form->field($model, 'HeadOfState') ?>

    <?php // echo $form->field($model, 'Capital') ?>

    <?php // echo $form->field($model, 'Code2') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
