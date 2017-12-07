<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use common\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class SecurityController extends MainController
{

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = User::findOne(Yii::$app->user->identity->id);

        if ($model->load(Yii::$app->request->post())) {
            $model->pass = Yii::$app->request->post('User')['pass'];
            $model->pass_repeat = Yii::$app->request->post('User')['pass_repeat'];

            if (empty(trim($model->pass))) {
                return $this->redirect(['index']);
            }
            if ($model->pass != $model->pass_repeat) {
                return $this->redirect(['index']);
            }
            
            $model->setPassword($model->pass);
            if ($model->validate() && $model->save()) {
                return $this->redirect(['user/view', 'id' => $model->id]);
            }
        }

        return $this->render('index', [
            'model' => $model
        ]);
    }

    
}
