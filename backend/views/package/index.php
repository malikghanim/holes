<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\grid\DataColumn;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PackageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Packages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="package-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Package'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => DataColumn::className(), // this line is optional
                'headerOptions' => ['style' => 'width:1%'],
                'attribute' => 'id',
                'format' => 'text',
                'label' => 'ID',
            ],
            'title',
            'description',
            'price',
            'duration',
            // 'duaration_unit',
            [
                'class' => DataColumn::className(), // this line is optional
                'headerOptions' => ['style' => 'width:15%'],
                'attribute' => 'duaration_unit',
                'filter'=> common\models\Package::DURATION_UNITS,
                'format' => 'text',
                'label' => 'Duaration Unit',
                'value' => function($data){
                    return common\models\Package::DURATION_UNITS[$data->duaration_unit];
                }
            ],
            // 'weight',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{view} {update}'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
