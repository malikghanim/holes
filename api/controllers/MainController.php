<?php
namespace api\controllers;

use Yii;

use yii\rest\ActiveController;
use yii\web\Response;
use common\models\Tokens;
use common\models\User;
use yii\helpers\ArrayHelper;
use filsh\yii2\oauth2server\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use filsh\yii2\oauth2server\filters\ErrorToExceptionFilter;

class MainController extends ActiveController
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

    protected function getApp()
    {
        if (empty($this->app)) {
            $oauthModule = Yii::$app->getModule('oauth2');
            $app_id = $oauthModule->getServer()->getAccessTokenData($oauthModule->getRequest())['client_id'];

            $this->app = (object)[
                '_id' => '58f877dad13f4a398c3b13e6',
                'name' => 'TestMe',
                'description' => 'TestME',
                'user_id' => Yii::$app->user->identity->id,
                'scope' => 'all',
                'redirect_url' => 'https://www.getpostman.com/oauth2/callback',
                'grant_type' => 'client_credentials',
                'contact_email' => 'malik@maqtoo3.com',
                'contact_phone' => '+962787773352',
                'contact_person' => 'malik',
                'website' => 'http://www.maqtoo3.com',
                'status' => '1',
                'client_id' => 'MzO87bfoPdBkyvgtqHrR',
                'client_secret' => 'ZQGo3Cd2sAcztwHqnFrR',
                'app_token' => '',
                'access_token' => '',
                'expiry' => ''
            ];
        }

        return $this->app;
    }
}
