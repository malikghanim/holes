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

class LocationController extends MainController
{

    protected $user;
    public $credentials;
    private $app;

    public $modelClass = 'common\models\City';

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'authenticator' => [
                'class' => CompositeAuth::className(),
                'authMethods' => [
                    ['class' => HttpBearerAuth::className()],
                ],
                'except' => ['all-countries', 'country', 'all-cities', 'city']
            ],
            'exceptionFilter' => [
                'class' => ErrorToExceptionFilter::className()
            ],
            'rateLimiter' => [
                'enableRateLimitHeaders' => true
            ]
        ]);
    }

    public function actionAllCountries()
    {
        $countries = Country::find()->all();
        if (empty($countries)) {
            $this->status = 204;
            return [
                'message' => 'No countries found!'
            ];
        }

        $this->status = 200;
        return $countries;
        

    }

    public function actionCountry($country_id)
    {
        $country = Country::findOne($country_id);
        if (empty($country)) {
            $this->status = 404;
            return [
                'message' => 'Country not found!',
            ];
        }

        $this->status = 200;
        return $country;
    }

    public function actionAllCities()
    {
        $cities = City::find()->all();
        if (empty($cities)) {
            $this->status = 204;
            return [
                'message' => 'No cities found!',
            ];
        }

        $this->status = 200;
        return $cities;
    }

    public function actionCity($country_id)
    {
        $city = City::find()->where(['CountryCode' => $country_id])->all();
        if (empty($city)) {
            $this->status = 204;
            return [
                'message' => 'City not found!'
            ];
            
        }

        $this->status = 200;
        return $city;
    }
}