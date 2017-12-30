<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Job */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Jobs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
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
            'id',
            'title',
            // 'status',
            [                      // the owner name of the model
                'label' => $model->getAttributeLabel('status'),
                'value' => common\models\Job::JOB_STATUS[$model->status],
            ],
            'description',
            'mobile',
            'working_from',
            'working_to',
            'category_id',
            'CountryCode',
            'city_id',
            [
                'attribute'=>'Owner',
                'format'=>'raw',
                'value' => Html::a($model->user->email, ['user/view', 'id' => $model->user_id], ['class' => 'profile-link']),
            ],
            'address'
            // 'user_id',
        ],
    ]) ?>

</div>
