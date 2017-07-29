<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Languag;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Country */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="country-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        $languages = Languag::find()->orderBy('Name')->asArray()->all(); 
        // create an array of pairs ('Code', 'Name'):
        $languagesList = ArrayHelper::map($languages, 'id', 'Name'); 
        // finally create the drop-down list:
    ?>

    <?= $form->field($model, 'Language_id')->dropDownList($languagesList, [
        'prompt' => '-Choose Language-'
    ]) ?>

    <?= $form->field($model, 'Code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Continent')->dropDownList([ 'Asia' => 'Asia', 'Europe' => 'Europe', 'North America' => 'North America', 'Africa' => 'Africa', 'Oceania' => 'Oceania', 'Antarctica' => 'Antarctica', 'South America' => 'South America', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'Region')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SurfaceArea')->textInput() ?>

    <?= $form->field($model, 'IndepYear')->textInput() ?>

    <?= $form->field($model, 'Population')->textInput() ?>

    <?= $form->field($model, 'LifeExpectancy')->textInput() ?>

    <?= $form->field($model, 'GNP')->textInput() ?>

    <?= $form->field($model, 'GNPOld')->textInput() ?>

    <?= $form->field($model, 'LocalName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'GovernmentForm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HeadOfState')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Capital')->textInput() ?>

    <?= $form->field($model, 'Code2')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
