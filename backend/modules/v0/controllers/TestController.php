<?php
/**
 * Created by PhpStorm.
 * User: liuhan
 * Date: 2017/6/6
 * Time: 上午11:03
 */

namespace app\modules\v0\controllers;
use app\modules\v0\BaseController;
use app\modules\v0\Controller;

class TestController extends BaseController
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
            'index' => [
              //  [['token'],'required'],
            ],
        ];
    }

    /**
     * @desc test
     * @param string $token
     * */
    public function actionIndex()
    {
        $list = [];
        $banner = [];
        return ['list' => $list, 'banner' => $banner];
    }
}


?>