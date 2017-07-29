<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Country */

$this->title = $model->Name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Countries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->Code], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->Code], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'Language_id',
                'value' => function($model) {
                    return $model->language->Name;
                },
            ],
            'Code',
            'Name',
            'Continent',
            'Region',
            'SurfaceArea',
            'IndepYear',
            'Population',
            'LifeExpectancy',
            'GNP',
            'GNPOld',
            'LocalName',
            'GovernmentForm',
            'HeadOfState',
            'Capital',
            'Code2',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
