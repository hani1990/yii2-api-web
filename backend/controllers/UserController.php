<?php
/**
 * Created by PhpStorm.
 * User: liuhan
 * Date: 2018/1/4
 * Time: 下午2:12
 */

namespace backend\controllers;


use common\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;

class UserController extends Controller
{
    public $enableCsrfValidation = false;

     public function request(){
        return \Yii::$app->request;
    }

    public function beforeAction($action){
        if (parent::beforeAction($action)) {
            $r = \Yii::$app->response;
            $r->format = \yii\web\Response::FORMAT_JSON;
            $r->on("beforeSend",function($event){
                $response = $event->sender;
                if ($response->data !== null) {
                    $response->data = [
                        "code" => 200,
                        "data" => $response->data,
                    ];
                    $response->statusCode = 200;
                }
            });
            return true;
        }

        return false;
    }


    public function actionLogin()
    {
        $request = \Yii::$app->request;
        $username = $request->post('username');
        $password = $request->post('password');
        return ['token' => 'admin'];
    }


    public function actionInfo()
    {
        $token = \Yii::$app->request->get('token');
        $user = User::find()->where(['auth_key' => $token])->asArray()->one();
        $data = [
            'role' => [$user['role']],
            'name' => $user['username'],
            'avatar' => 'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif'
        ];
        return $data;
    }
}