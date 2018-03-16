<?php
namespace backend\controllers;

use common\models\hexin\Employee;
use common\models\hexin\EmployeeUser;
use common\models\hexin\Login;
use common\models\Zujuan\Paper\PaperQuestions;
use common\models\Zujuan\Test\Question;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
//    public function actions()
//    {
//        return [
//            'error' => [
//                'class' => 'yii\web\ErrorAction',
//            ],
//        ];
//    }
//
//    public function actionIndex()
//    {
//        $pid = \Yii::$app->request->get('pid');
//        $uid = \Yii::$app->request->get('uid');
//        if($uid){
//            $uid = '&uid='.$uid;
//        }else{
//            $uid = '';
//        }
//        $url = \Yii::$app->request->hostInfo.'/test/#/index?pid='.$pid.$uid;
//        header("Location: ".$url);
//    }
//
//
//
//
//
//    public function actionLogin()
//    {
//        if (!\Yii::$app->user->isGuest) {
//            return $this->goHome();
//        }
//
//        $model = new LoginForm();
//        if ($model->load(Yii::$app->request->post()) && $model->login()) {
//            return $this->goBack();
//        } else {
//            return $this->render('login', [
//                'model' => $model,
//            ]);
//        }
//    }
//
//    public function actionLogout()
//    {
//        Yii::$app->user->logout();
//
//        return $this->goHome();
//    }
//
//    public function actionTest()
//    {
//
////
////        //$ret =  Employee::find()->where(['Job_Number' => 'jr'])->asArray()->one();
////      //  $ret = EmployeeUser::find()->where(['User_Name' => 'jr'])->asArray()->one();
////        $login = new Login();
////        $sessionId = $login->byPwd('7800', 'liuhan7800');
////
//    }
//
//


}
