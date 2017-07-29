<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Country */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Country',
]) . $model->Name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Countries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Name, 'url' => ['view', 'id' => $model->Code]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="country-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
