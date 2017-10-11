<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Favorite */
/* @var $form yii\widgets\ActiveForm */
$pkgs = [];
foreach ($packages as $pkg) {
    $pkgs[$pkg->id] = $pkg->title;
}
?>
<div class="favorite-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [                      // the owner name of the model
                'label' => 'Job Title',
                'value' => $model->job->title,
            ],
            [                      // the owner name of the model
                'label' => 'User',
                'value' => $model->user->email,
            ],
            'weight'
        ],
    ]) ?>

</div>
<div class="favorite-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=  $form->field($model, 'package_id')->dropdownList(
        $pkgs
    )->label('Package') ?>

    <?=  $form->field($model, 'active')->dropdownList(
        common\models\Favorite::STATUSES
    )->label('Status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
