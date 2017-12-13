<?php
namespace api\modules\v1\controllers;

use Yii;
use yii\rest\Controller;
use yii\filters\AccessControl;
use yii\rest\ActiveController;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;

class CategoryController extends Controller
{

    protected $user = null;
    public $status = 200;

    public function init() {
        parent::init();
        \Yii::$app->user->enableSession = false;
    }
    
    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
            'except' => ['index', 'all', 'filtered-categories'],
            'auth' => [$this, 'auth']
        ];
        return $behaviors;
    }
    

    public function auth($username, $password)
    {
        $user = new \common\models\User();
        return $user->checkUserCredentials($username, $password);
    }
    

    public function afterAction($action, $result) {
        Yii::$app->response->format = 'json';
        if (is_array($result) && isset($result['status']))
            Yii::$app->response->setStatusCode($result['status']);
        else
            Yii::$app->response->setStatusCode($this->status);

        return parent::afterAction($action,$result);
    }

    //////////////////////////////

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['view']);
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
        return $actions;
    }

    public function actionAll()
    {
        $cat = Yii::$app->getModule('categories')->getAll();
        // var_dump($cat);die;
        if (empty($cat)) {
            $this->status = 204;
            return [
                'message' => 'No categories found!'
            ];
        }

        $this->status = 200;
        return $cat;

    }

    public function actionFilteredCategories()
    {
        $cat = Yii::$app->getModule('categories')->getAll();
        // var_dump($cat);die;
        if (empty($cat)) {
            $this->status = 204;
            return [
                'message' => 'No categories found!'
            ];
        }

        $this->status = 200;
        return $this->handleCat($cat);
    }

    private function handleCat($cat, $path=null){
        $subCat = [];
        foreach ($cat as $ct) {
            if (empty($ct['is_active']))
                continue;

            if ((empty($ct['sub_categories']))) {
                $subCat[] = [
                    'id' => $ct['id'],
                    'name' => ((empty($path))? $ct['name']: $path.'/'.$ct['name'])
                ];
            }else{
                $res = $this->handleCat($ct['sub_categories'], (empty($path))? $ct['name']: $path.'/'.$ct['name']);
                $subCat = array_merge($subCat,$res);
            }

        }

        return $subCat;
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