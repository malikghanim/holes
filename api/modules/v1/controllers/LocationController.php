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
        if (empty($countries))
            return [
                'status' => 204,
                'message' => 'No countries found!',
                'data' => null
            ];

        return [
            'status' => 200,
            'message' => 'Countries retrieved successfully!',
            'data' => $countries
        ];
        

    }

    public function actionCountry($country_id)
    {
        $country = Country::findOne($country_id);
        if (empty($country))
            return [
                'status' => 404,
                'message' => 'Country not found!',
                'data' => null
            ];

        return [
            'status' => 200,
            'message' => 'Country retrieved successfully!',
            'data' => $country
        ];
    }

    public function actionAllCities()
    {
        $cities = City::find()->all();
        if (empty($cities))
            return [
                'status' => 404,
                'message' => 'No cities found!',
                'data' => null
            ];

        return [
            'status' => 200,
            'message' => 'Cities retrieved successfully!',
            'data' => $cities
        ];
    }

    public function actionCity($country_id)
    {
        $city = City::find()->where(['CountryCode' => $country_id])->all();
        if (empty($city))
            return [
                'status' => 404,
                'message' => 'City not found!',
                'data' => null
            ];

        return [
            'status' => 200,
            'message' => 'City retrieved successfully!',
            'data' => $city
        ];
    }
}