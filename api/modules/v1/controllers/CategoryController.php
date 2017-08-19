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

class CategoryController extends Controller
{

    protected $user;
    public $credentials;
    private $app;
    public $status = 200;

    public function beforeAction($event){
        $beforeAction = parent::beforeAction($event);
        
        if($this->user = Yii::$app->user->identity)
        {
            $this->credentials = $this->user->email. ":". $this->user->password_hash;
        }
        return $beforeAction;
    }

    /**
     * @inheritdoc
     */
    public function afterAction($action, $result) {
        Yii::$app->response->format = 'json';
        if (is_array($result) && isset($result['status']))
            Yii::$app->response->setStatusCode($result['status']);
        else
            Yii::$app->response->setStatusCode($this->status);

        return parent::afterAction($action,$result);
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['view']);
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
        return $actions;
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'authenticator' => [
                'class' => CompositeAuth::className(),
                'authMethods' => [
                    ['class' => HttpBearerAuth::className()],
                ],
                'except' => ['index', 'all']
            ],
            'exceptionFilter' => [
                'class' => ErrorToExceptionFilter::className()
            ],
            'rateLimiter' => [
                'enableRateLimitHeaders' => true
            ]
        ]);
    }

    public function actionAll()
    {
        $cat = Yii::$app->getModule('categories')->getAll();
        if (empty($cat)) {
            $this->status = 204;
            return [
                'message' => 'No categories found!'
            ];
        }

        $this->status = 200;
        return $cat;

    }

    public function actionIndex($category_id)
    {
        $cat = Yii::$app->getModule('categories')->getOne($category_id);
        if (empty($cat)) {
            $this->status = 404;
            return [
                'message' => 'Category not found!'
            ];
        }

        $this->status = 200;
        return $cat[0];
    }
}