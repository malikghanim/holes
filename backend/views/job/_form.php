<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Job */
/* @var $form yii\widgets\ActiveForm */
$countries = (is_array($countries))? $countries: [$countries];
$cntrys = [];
foreach ($countries as $country) {
    $cntrys[$country->Code] = $country->Name;
}

$cties = [];
foreach ($cities as $city) {
    $cties[$city->id] = $city->Name;
}
?>
<?php if (!empty($model->user_id)): ?>
    <div class="favorite-view">
        <?php $url = Url::to(['user/view', 'id' => $model->user_id]); ?>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                [                      // the owner name of the model
                    'attribute'=>'Job Owner',
                    'format'=>'raw',
                    'value' => Html::a($model->user->email, ['user/view', 'id' => $model->user_id], ['class' => 'profile-link']),
                ],
            ],
        ]) ?>
    </div>
<?php endif ?>

<div class="job-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?=  $form->field($model, 'status')->dropdownList(
        common\models\Job::JOB_STATUS
    )->label('Status') ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'working_from')->textInput() ?>

    <?= $form->field($model, 'working_to')->textInput() ?>

    <?=  $form->field($model, 'category_id')->dropdownList(
        $categories
    )->label('Category') ?>

    <?=  $form->field($model, 'CountryCode')->dropdownList(
        $cntrys
    )->label('Country') ?>

    <?=  $form->field($model, 'city_id')->dropdownList(
        $cties
    )->label('City') ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
