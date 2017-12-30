<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Favorite */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Favorites'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="favorite-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php /*Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ])*/ ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [                      // the owner name of the model
                'label' => 'Package',
                'value' => $model->package->title,
            ],
            // 'package_id',
            [                      // the owner name of the model
                'label' => 'Job Title',
                'value' => $model->job->title,
            ],
            [                      // the owner name of the model
                'label' => 'Mobile',
                'value' => $model->job->mobile,
            ],
            // 'job_id',
            [                      // the owner name of the model
                'label' => 'User',
                'value' => $model->user->email,
            ],
            // 'user_id',
            'start_date:datetime',
            'end_date:datetime',
            'weight',
            [
                'label' => $model->getAttributeLabel('active'),
                'value' => common\models\Favorite::STATUSES[$model->active]
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
