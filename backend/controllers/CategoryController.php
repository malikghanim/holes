<?php

namespace backend\controllers;

use Yii;
use yiimodules\categories\models\Categories;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CityController implements the CRUD actions for City model.
 */
class CategoryController extends MainController
{
    public function actionDelete()
    {
        if (!$catId = Yii::$app->request->get('id',false)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }


        $category = Categories::findOne(Yii::$app->request->get('id',false));
        if (!empty($category)) {
            $category->delete();
            return $this->redirect(['/categories']);
        }else
            throw new NotFoundHttpException('The requested page does not exist.');
    }
}