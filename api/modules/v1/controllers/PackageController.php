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
use common\models\Package;
use common\models\PackageSearch;
use yii\filters\Cors;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;


class PackageController extends MainController
{

    protected $user;
    public $credentials;
    private $app;

    public $modelClass = 'common\models\Package';

    public function actions()
    {
        $actions = parent::actions();
        //var_dump($actions);die;
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider()
    {
        $searchModel = new PackageSearch();
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
                'only' => ['index', 'view'],
                //'only' => ['create', 'update', 'delete']
            ],
            'exceptionFilter' => [
                'class' => ErrorToExceptionFilter::className()
            ],
            'rateLimiter' => [
                'enableRateLimitHeaders' => true
            ]
        ]);
    }

}