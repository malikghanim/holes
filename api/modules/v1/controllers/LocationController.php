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


class LocationController extends MainController
{
    public $modelClass = 'common\models\City';

    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
            'except' => ['all-countries', 'country', 'all-cities', 'city'],
            'auth' => [$this, 'auth']
        ];
        return $behaviors;
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