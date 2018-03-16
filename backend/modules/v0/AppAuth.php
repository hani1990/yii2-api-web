<?php
/**
 * Created by PhpStorm.
 * User: liuhan
 * Date: 2018/1/8
 * Time: 下午4:50
 */

namespace app\modules\v0;


use deepziyu\yii\rest\ApiException;
use yii\filters\auth\AuthMethod;
use yii\web\HttpException;

class AppnAuth extends AuthMethod
{
    /**
     * @var string the parameter name for passing the access token
     */
    public $tokenParam = 'token';
    /**
     * @inheritdoc
     */
    public function authenticate($user, $request, $response)
    {
        $accessToken = $request->getHeaders()['X-Token'];
        if(empty($accessToken)){
            $accessToken = $request->get('X-Token');
        }
        if (is_string($accessToken)) {
            $identity = $user->loginByAccessToken($accessToken, get_class($this));
            if ($identity !== null) {
                return $identity;
            }
        }
        if ($accessToken !== null) {
            $this->handleFailure($response);
        }

        return null;
    }

    public function handleFailure($response)
    {
        throw new ApiException('50008','令牌失效');
    }

}