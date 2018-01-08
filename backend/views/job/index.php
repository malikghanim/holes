<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\grid\DataColumn;
/* @var $this yii\web\View */
/* @var $searchModel common\models\JobSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Jobs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Job'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=Html::beginForm(['job/bulk'],'post');?>
    <?=Html::dropDownList('action','',array_merge([''=>'Mark selected as: '],common\models\Job::JOB_STATUS),['class'=>'dropdown',])?>
    <?=Html::submitButton('Save', ['class' => 'btn btn-info',]);?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            ['class' => 'yii\grid\CheckboxColumn'],
            'id',
            'title',
            [
                'class' => DataColumn::className(), // this line is optional
                'headerOptions' => ['style' => 'width:15%'],
                'attribute' => 'status',
                'filter'=> common\models\Job::JOB_STATUS,
                'format' => 'text',
                'label' => 'Status',
                'value' => function($data){
                    return common\models\Job::JOB_STATUS[$data->status];
                }
            ],
            'description',
            'mobile',
            'working_from',
            'working_to',
            // 'category_id',
            // 'CountryCode',
            // 'city_id',
            // 'user_id',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?= Html::endForm();?>

    <?php Pjax::end(); ?>

</div>
