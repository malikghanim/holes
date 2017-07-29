<?php
namespace api\modules\v1\controllers;

use Yii;
use yii\rest\Controller;
use api\controllers\MainController;
//use common\components\exceptions\ApiCommonException;
//use common\models\operations\core\OperationResponse;
use yii\web\Response;
use common\models\Post;

class OperationController extends MainController
{
    /**
     * @inheritdoc
     */
    public function afterAction($action, $result) {
        Yii::$app->response->format = 'json';
        Yii::$app->response->setStatusCode($result['status']);
        return parent::afterAction($action,$result);
    }

    /**
     * Submits V3 Operations to the queueing system. 
     * @param string $operation_key 
     * @return OperationResponse
     */
    public function actionSubmit()
    {
        return [
            'status' => 400,
            'message' => 'you reach!'
        ];
        //return new OperationResponse(404, "Operation Not Found!");
        /*$request = Yii::$app->request;
        try {
            $operation = V3Operation::GetOperation($operation_key,$this->getApp());
        } catch (\Exception $e) {
            throw new \yii\web\NotFoundHttpException($e->getMessage());
        }

        $operation->load($request->post());

        if (get_class($operation)::CONTROLLER_VALIDATE && !$operation->validate()){
                return new OperationResponse(400, 'Wrong operation submission!', null, $operation->getErrors());
        }

        try {
            $operationResponse = $operation->handle();
            return $operationResponse;
        } catch (ApiCommonException $e) {
            return new OperationResponse($e->getCode(), $e->getMessage());
        }*/

    }

    public function actionIndex($operation_id)
    {
        return new OperationResponse(404, "Operation Not Found!");
    }
}