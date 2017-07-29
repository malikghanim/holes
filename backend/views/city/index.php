<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use common\models\Languag;
use common\models\Country;
/* @var $this yii\web\View */
/* @var $searchModel common\models\CitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cities');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create City'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    $getParams = Yii::$app->request->get();
    $countryQuery = ['Language_id' => 1];
    if (!empty($getParams['CitySearch']['Language_id']))
        $countryQuery = ['Language_id' => $getParams['CitySearch']['Language_id']];
    
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'Name',
            [
                'format' => 'ntext',
                'attribute'=>'CountryCode',
                'value' => function($model) {
                    return $model->country->Name;
                },
                'filter' => ArrayHelper::map(Country::find()->where($countryQuery)->orderBy('Name')->asArray()->all(), 'Code', 'Name'),
            ],
            'District',
            'Population',
            [
                'format' => 'ntext',
                'attribute'=>'Language_id',
                'value' => function($model) {
                    return $model->language->Name;
                },
                'filter' => ArrayHelper::map(Languag::find()->asArray()->all(), 'id', 'Name'),
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
