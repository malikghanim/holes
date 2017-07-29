<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Country;
use common\models\Languag;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\City */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="city-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        $languages = Languag::find()->orderBy('Name')->asArray()->all(); 
        // create an array of pairs ('Code', 'Name'):
        $languagesList = ArrayHelper::map($languages, 'id', 'Name'); 
        // finally create the drop-down list:
    ?>

    <?= $form->field($model, 'Language_id')->dropDownList($languagesList, [
        'prompt' => '-Choose Language-',
        'onchange' => '
             $.get( "'.Url::toRoute('country/list').'"
                , { id: $(this).val() } )
                .done(function( data )
                {
                    $( "select#city-countrycode" ).html( data );
                }
            );'
    ]) ?>

    <?= $form->field($model, 'Name')->textInput(['maxlength' => true]) ?>

    <?php
        $countries = Country::find()->orderBy('Name')->asArray()->all(); 
        // create an array of pairs ('Code', 'Name'):
        $countriesList = ArrayHelper::map($countries, 'Code', 'Name'); 
        // finally create the drop-down list:
    ?>

    <?= $form->field($model, 'CountryCode')->dropDownList($countriesList, 
        ['prompt' => '-Choose a Country-']
    ) ?>

    <?= $form->field($model, 'District')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Population')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
