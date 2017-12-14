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
        if (Yii::$app->request->post('from_ad',false))
            $request = [
                'package_id' => \common\models\Package::findOne(['title' => 'From Add Package'])->id,
                'job_id' => Yii::$app->request->post('job_id')
            ];
        else
            $request = Yii::$app->request->post();

        $model = new Favorite();
        $model->load(['Favorite' => $request]);
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

        $model->weight = $model->package->weight;
        $model->user_id = Yii::$app->user->identity->id;

        if (!$model->validate() || !$model->save())
            return ['status' => 400, 'errors' => $model->getErrors()];

        if (Yii::$app->request->post('from_ad',false)){
            $model->active = 1;
            if ($model->save()) {
                $date = new \DateTime();
                $timeFlag = ($model->package->duaration_unit == 'H')? 'T':'';
                $interval = new \DateInterval("P{$timeFlag}{$model->package->duration}{$model->package->duaration_unit}");
                $date->add($interval);
                
                $model->start_date = date('U');
                $model->weight = $model->package->weight;
                $model->end_date = $date->format('U');
                // Update Job
                $model->job->favorite = 1;
                $model->job->weight = $model->package->weight;
                $model->job->fav_start_date = $model->start_date;
                $model->job->fav_end_date = $model->end_date;
                $model->job->save();
            }
        }


        // var_dump(Yii::$app->user->identity->email);die;
        /*Yii::$app->mailer->setTransport([
            'class' => 'Swift_SmtpTransport',
            'host' => 'smtp.gmail.com',
            'username' => 'malikghanim@gmail.com',
            'password' => 'Vaio1962',
            'port' => '25',
            'encryption' => 'tls'
        ]);

        Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setTo(Yii::$app->params['adminEmail'])
            ->setSubject('Message subject')
            ->setTextBody('Plain text content')
            ->setHtmlBody('<b>HTML content</b>')
            ->send();*/

        return [
            'status' => 200,
            'message' => 'your request submitted successfully!'
        ];
    }

}