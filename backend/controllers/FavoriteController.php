<?php

namespace backend\controllers;

use Yii;
use common\models\Favorite;
use common\models\FavoriteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Job;
use common\models\Package;

/**
 * FavoriteController implements the CRUD actions for Favorite model.
 */
class FavoriteController extends MainController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Favorite models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FavoriteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $packages = Package::find()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'packages' => $packages
        ]);
    }

    /**
     * Displays a single Favorite model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Favorite model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Favorite();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = $model->job->user->id;
            if ($model->active == 1) {
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

            if ($model->job->favorite == 1 &&
                $model->active != 1
            ) {
                $model->job->favorite = 0;
                $model->job->weight = 0;
                $model->job->fav_start_date = $model->start_date;
                $model->job->fav_end_date = $model->end_date;
                $model->job->save();
            }

            if ($model->save())
                return $this->redirect(['view', 'id' => $model->id]);
            else{
                foreach ($model->errors as $key => $value) {
                    Yii::$app->session->setFlash('error', "{$key}: {$value[0]}");
                }
                return $this->redirect(['create', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'packages' => Package::find()->all(),
                'jobs' => Job::find()->where(['status' => 1])->all()
            ]);
        }
    }

    /**
     * Updates an existing Favorite model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = $model->job->user->id;
            if ($model->active == 1) {
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

            if ($model->job->favorite == 1 &&
                $model->active != 1
            ) {
                $model->job->favorite = 0;
                $model->job->weight = 0;
                $model->job->fav_start_date = $model->start_date;
                $model->job->fav_end_date = $model->end_date;
                $model->job->save();
            }

            if ($model->save())
                return $this->redirect(['view', 'id' => $model->id]);
            else{
                foreach ($model->errors as $key => $value) {
                    Yii::$app->session->setFlash('error', "{$key}: {$value[0]}");
                }
                return $this->redirect(['update', 'id' => $model->id]);
            }
        } else {
            $packages = \common\models\Package::find()->all();
            return $this->render('update', [
                'model' => $model,
                'packages' => $packages
            ]);
        }
    }

    /**
     * Deletes an existing Favorite model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Favorite model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Favorite the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Favorite::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
