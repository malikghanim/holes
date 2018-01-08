<?php

namespace backend\controllers;

use Yii;
use common\models\Job;
use common\models\JobSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JobController implements the CRUD actions for Job model.
 */
class JobController extends MainController
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
     * Lists all Job models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JobSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Job model.
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
     * Creates a new Job model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Job();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'categories' => $this->getFilteredCategories(),
                'countries' => \common\models\Country::findOne(['JOR']),
                'cities' => \common\models\City::find()->where(['CountryCode' => 'JOR'])->all()
            ]);
        }
    }

    /**
     * Updates an existing Job model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // var_dump(Yii::$app->request->post());die;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'categories' => $this->getFilteredCategories(),
                'countries' => \common\models\Country::findOne(['JOR']),
                'cities' => \common\models\City::find()->where(['CountryCode' => 'JOR'])->all()
            ]);
        }
    }

    private function getFilteredCategories()
    {
        $cat = Yii::$app->getModule('categories')->getAll();
        // var_dump($cat);die;
        if (empty($cat)) {
            return [];
        }

        return $this->handleCat($cat);
    }

    private function handleCat($cat, $path=null){
        $subCat = [];
        foreach ($cat as $ct) {
            if (empty($ct['is_active']))
                continue;

            if ((empty($ct['sub_categories']))) {
                $subCat[$ct['id']] = ((empty($path))? $ct['name']: $path.'/'.$ct['name']);
            }else{
                $res = $this->handleCat($ct['sub_categories'], (empty($path))? $ct['name']: $path.'/'.$ct['name']);
                $subCat += $res;
            }

        }

        return $subCat;
    }

    /**
     * Deletes an existing Job model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionBulk()
    {
        $action = Yii::$app->request->post('action');
        $selection = (array)Yii::$app->request->post('selection');//typecasting
        if (!empty($selection) && !empty($action))
            foreach($selection as $id){
                $e = Job::findOne((int)$id);//make a typecasting
                $e->status = $action;
                if ($e->save())
                    Yii::$app->session->setFlash('success', "Records saved successfully!");
                else
                    Yii::$app->session->setFlash('error', "Records not saved!".json_encode($e->errors));
            }

        return $this->redirect(['/job']);
    }

    /**
     * Finds the Job model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Job the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Job::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
