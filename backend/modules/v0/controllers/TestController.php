<?php
/**
 * Created by PhpStorm.
 * User: liuhan
 * Date: 2017/6/6
 * Time: 上午11:03
 */

namespace app\modules\v0\controllers;
class TestController extends Controller
{
    
    /**
     * 参数验证规则
     *
     * @return array
     */
    public function rules()
    {
        return [
            //设置 indexAction()的rule
            'upload' => [
                [['token'],'required'],
            ],
        ];
    }

    /**
     * @desc 下发话题列表
     * @param string $token
     * */
    public function actionTopics()
    {
        $list = [];
        $banner = [];
        return $this->result(['list' => $list, 'banner' => $banner]);
    }
}


?>