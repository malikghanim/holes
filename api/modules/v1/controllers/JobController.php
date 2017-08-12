<?php
namespace api\modules\v1\controllers;

use Yii;
use yii\rest\Controller;
use api\controllers\MainController;
//use common\components\exceptions\ApiCommonException;
//use common\models\operations\core\OperationResponse;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use filsh\yii2\oauth2server\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use filsh\yii2\oauth2server\filters\ErrorToExceptionFilter;
use common\models\Country;
use common\models\City;
use common\models\Job;
use common\models\JobSearch;
use yii\filters\Cors;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;


class JobController extends MainController
{

    protected $user;
    public $credentials;
    private $app;

    public $modelClass = 'common\models\Job';

    public function actions()
    {
        $actions = parent::actions();
        //var_dump($actions);die;
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

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'authenticator' => [
                'class' => CompositeAuth::className(),
                'authMethods' => [
                    ['class' => HttpBearerAuth::className()],
                ],
                //'except' => ['index', 'view'],
                //'only' => ['index', 'create', 'update', 'delete']
            ],
            'exceptionFilter' => [
                'class' => ErrorToExceptionFilter::className()
            ],
            'rateLimiter' => [
                'enableRateLimitHeaders' => true
            ]
        ]);
    }

    public function actionUpdate($id)
    {
        //var_dump(Yii::$app->getRequest()->getBodyParams());die;
        $model = Job::findOne($id);
        $params = Yii::$app->request->bodyParams;
        $model->load(['Job' => $params]);
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