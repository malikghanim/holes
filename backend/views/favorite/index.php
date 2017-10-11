<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\grid\DataColumn;
/* @var $this yii\web\View */
/* @var $searchModel common\models\FavoriteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Favorites');
$this->params['breadcrumbs'][] = $this->title;

$pkgs = [];
foreach ($packages as $pkg) {
    $pkgs[$pkg->id] = $pkg->title;
}
?>
<div class="favorite-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Favorite'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            // 'job_id',
            // 'user_id',
            // 'start_date',
            // 'end_date',
            // 'weight',
            // 'active',
            // 'job.title',
            // 'created_at:datetime',
            // 'updated_at',
            [
                'class' => DataColumn::className(), // this line is optional
                'headerOptions' => ['style' => 'width:1%'],
                'attribute' => 'id',
                'format' => 'text',
                'label' => 'ID',
            ],
            'jobTitle',
            [
                'class' => DataColumn::className(), // this line is optional
                'headerOptions' => ['style' => 'width:15%'],
                'attribute' => 'user.email',
                'format' => 'text',
                'label' => 'User',
            ],
            [
                'class' => DataColumn::className(), // this line is optional
                'headerOptions' => ['style' => 'width:15px'],
                'attribute' => 'package_id',
                'filter'=> $pkgs,
                'value' => function($data){
                    return $data->package->title;
                },
                'format' => 'text',
                'label' => 'Package',
            ],
            [
                'class' => DataColumn::className(), // this line is optional
                'headerOptions' => ['style' => 'width:2%'],
                'attribute' => 'active',
                'filter'=> common\models\Favorite::STATUSES,
                'format' => 'text',
                'label' => 'Status',
                'value' => function($data){
                    return common\models\Favorite::STATUSES[$data->active];
                }
            ],
            'start_date:datetime',
            'end_date:datetime',
            'created_at:datetime',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
