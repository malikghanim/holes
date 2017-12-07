<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\UserSubscription;
use common\models\UserGroup;
use common\helpers\Stripe;
use common\models\User;

class MainController extends Controller
{

    public function beforeAction($action)
    {
        $user = Yii::$app->user->identity;
        if (empty($user))
            $this->redirect(['site/login']);

        if (!empty($user) && $user->role != 11)
            $this->redirect(['site/login']);

        return parent::beforeAction($action);
    }

}
