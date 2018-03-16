<?php
namespace console\controllers;
use common\models\hexin\Employee;
use common\models\hexin\Teacher;
use common\models\StuTest;
use common\models\User\StuUser;
use common\models\VerifyCode;
use common\models\Zujuan\Labels\Qtype;
use common\models\Zujuan\Paper\PaperQuestions;
use common\models\Zujuan\Test\Options;
use common\models\Zujuan\Test\StuPaper;
use yii\helpers\Json;

/**
 * Created by PhpStorm.
 * User: liuhan
 * Date: 2017/12/25
 * Time: 下午5:35
 */
class HelloController extends \yii\console\Controller
{
    public function actionTest()
    {
        $ques = PaperQuestions::find()
            ->select(['paper_questions.question_id', 'question.qtype'])
            ->leftJoin('question', 'question.id = paper_questions.question_id')
            ->where(['paper_questions.paper_id' => 24, 'question.qtype' => Qtype::OPTOIN_TYPE])
            ->asArray()
            ->all();
        var_dump($ques);
        exit();
        $list = PaperQuestions::getTypes(16);
        
        var_dump($list);
        exit();
        StuUser::postUserInfo();
        exit();
        $base64_image_content = 'data:image/png;base64,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';

        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){
        $type = $result[2];
        $file_name =  time(). '.' . $type;
        $new_path = "./backend/web/image/" ;
        $new_file =  $new_path.$file_name;
        if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))){
            echo '新文件保存成功：', $new_file ,'<br/>';
        }
    }

        exit();
        echo Json::encode( ['option_id' => 12, 'option_name' => 'B']);
        exit();

        $ret = StuTest::getInfo(1, 1);
        var_dump($ret);exit();

        $ret = StuPaper::testResult(1, 1);
        var_dump($ret);exit();

        $ret  = StuPaper::answer(1, 1, 1, ['option_id' => 12, 'option_name' => 'B']);
        var_dump($ret);
        exit();
        $list = StuPaper::getDetail(1, 1);
        var_dump($list);

        exit();
        $qid = 1;
        $radio_option = 'A';
        $option_id = Options::find()->where(['question_id' => $qid, 'option_name' => $radio_option])->one()->id;
        var_dump($option_id);
//        $option_list = '[{"option_name":"A","option_content":"dfdfd"},{"option_name":"B","option_content":"dfdfddd"}]';
//        $option_arr = Json::decode($option_list);
//        $options = [];
//        foreach($option_arr as $option) {
//            array_push($options, $option);
//        }
//        var_dump($options);

//        $api = \common\models\hexin\Api::getInstance();
//
//        var_dump(cache()->get('Hexin_Api_Cur_Session_ID'));
//        Teacher::findOne("Type = 0");
//
//        $one = Employee::find()->where(['Job_Number' => '7800'])->one();
//        var_dump($one);
    }

    public function actionSms()
    {
        $code = VerifyCode::genCode();
        $phone = '18507178873';
        $verify = new VerifyCode();
        $verify->code = $code;
        $verify->phone = $phone;

        //$verify->save();

        $ret = VerifyCode::SendSms($phone, $code);
        var_dump($ret);

        $ret = VerifyCode::getCode($phone);
        var_dump($ret);
    }

}