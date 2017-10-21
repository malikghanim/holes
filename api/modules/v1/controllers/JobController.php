<?php
namespace api\modules\v1\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\rest\ActiveController;
use api\controllers\MainController;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\data\ActiveDataProvider;

use common\models\Country;
use common\models\City;
use common\models\Job;
use common\models\JobSearch;
use yii\filters\Cors;


class JobController extends MainController
{
    public $modelClass = 'common\models\Job';

    public function actions()
    {
        $actions = parent::actions();
        // var_dump($actions);die;
        unset($actions['update']);
        unset($actions['delete']);
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider()
    {
        $searchModel = new JobSearch();    
        return $searchModel->search(Yii::$app->request->queryParams);
    }

    public function formName()
    {
        return '';
    }

    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
            'except' => ['index'],
            'auth' => [$this, 'auth']
        ];

        return $behaviors;
    }

    public function actionUpdate($id)
    {
        $model = Job::findOne([
            'id' => $id,
            'user_id' => Yii::$app->user->identity->id
        ]);

        if (empty($model)) {
            $this->status = 404;
            return [
                'message' => 'Job not found!'
            ];
        }

        $params = Yii::$app->request->bodyParams;
        $model->load(['Job' => $params]);
        $model->status = 0;
        if (!$model->validate() || !$model->save()) {
            $errors = [];
            foreach ($model->getErrors() as $key => $value) {
                $errors[] = ['field' => $key, 'message' => $value[0]];
            }

            $this->status = 400;
            return $errors;
        }

        $model->save();
        return $model;
    }

}