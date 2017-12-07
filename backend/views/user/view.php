<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            'email:email',
            'first_name',
            'last_name',
            [                      // the owner name of the model
                'label' => 'Status',
                'value' => common\models\User::USER_STATUSES[$model->status],
            ],
            [                      // the owner name of the model
                'label' => 'Role',
                'value' => common\models\User::ROLES[$model->role],
            ],
            'created_at:datetime',
            'updated_at:datetime',
            [
                'label' => 'Is System Password',
                'value' => ($model->is_system_password == 0)? 'No':'Yes'
            ],
            'ip_address',
        ],
    ]) ?>

</div>
