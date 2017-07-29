<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Languag;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel common\models\CountrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Countries');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Country'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Code',
            'Name',
            'Continent',
            'Region',
            // 'SurfaceArea',
            // 'IndepYear',
            // 'Population',
            // 'LifeExpectancy',
            // 'GNP',
            // 'GNPOld',
            'LocalName',
            // 'GovernmentForm',
            // 'HeadOfState',
            // 'Capital',
            // 'Code2',
            // 'created_at',
            // 'updated_at',
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
