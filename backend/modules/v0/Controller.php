<?php
namespace app\modules\v0;
use common\models\hexin\Model;
use deepziyu\yii\rest\ApiException;
use yii\base\DynamicModel;
use yii\base\InlineAction;
use yii\filters\auth\AuthMethod;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\BadRequestHttpException;

/**
 * Created by PhpStorm.
 * User: liuhan
 * Date: 2017/12/27
 * Time: 下午3:00
 */
class Controller extends BaseController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => AppnAuth::className(),
            'tokenParam' => 'X-token',
            'optional' => $this->authOptional(),

        ];

        return $behaviors;
    }

}