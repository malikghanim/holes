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

class CategoryController extends MainController
{

    protected $user;
    public $credentials;
    private $app;

    public $modelClass = 'yiimodules\categories\models\Categories';  

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
        if (empty($cat))
            return [
                'status' => 204,
                'message' => 'No categories found!',
                'data' => null
            ];

        return [
            'status' => 200,
            'message' => 'Categories retrieved successfully!',
            'data' => $cat
        ];
        

    }

    public function actionIndex($category_id)
    {
        $cat = Yii::$app->getModule('categories')->getOne($category_id);
        if (empty($cat))
            return [
                'status' => 404,
                'message' => 'Category not found!',
                'data' => null
            ];

        return [
            'status' => 200,
            'message' => 'Category retrieved successfully!',
            'data' => $cat[0]
        ];
    }
}