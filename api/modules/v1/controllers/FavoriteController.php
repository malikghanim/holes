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

use common\models\Job;
use common\models\Favorite;
use common\models\FavoriteSearch;
use yii\filters\Cors;


class FavoriteController extends MainController
{
    public $modelClass = 'common\models\Favorite';

    public function actions()
    {
        $actions = parent::actions();
        //var_dump($actions);die;
        unset($actions['index']);
        unset($actions['view']);
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
        unset($actions['options']);
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider()
    {
        $searchModel = new FavoriteSearch();    
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
            'except' => ['index','view'],
            'auth' => [$this, 'auth']
        ];
        return $behaviors;
    }

    public function actionCreate()
    {
        $model = new Favorite();
        $model->load(['Favorite' => Yii::$app->request->post()]);
        $sql = 'SELECT * FROM Favorite 
                WHERE job_id=:job_id AND active=1';

        $checkFav = Favorite::findBySql($sql, [
            ':job_id' => $model->job_id,
            // ':package_id' => $model->package_id
        ])->all();

        if (!empty($checkFav))
            return [
                'status' => 400,
                'message' => 'Your Favorite add already submited!'
            ];

        if (!$model->validate() || !$model->save())
            return ['status' => 400, 'errors' => $model->getErrors()];

        return [
            'status' => 200,
            'message' => 'your request submitted successfully!'
        ];
    }

}