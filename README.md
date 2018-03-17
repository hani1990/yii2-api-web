1、env配置，利用这个可以很好的做好不同环境的配置，测试环境与线上环境的配置肯定会不一样，把配置文件不加入版本管理也是一种解决办法，但是配置文件分布在项目的各个目录下的时候就会很头疼，统一写入.env文件，集中管理是一个很不错的办法，这个在我做的项目中屡试不爽。

php 项目.env配置文件



2、api 做后端的经常要开发接口，这里使用 deepziyu/yii-fast-api 包

配置 yii2 的模块功能 ，把接口作为一个模块，v0作为版本号，接口开发上线后，是不能做修改的，只能做升级，为了保证同样的接口命名，只是版本不同，就可以利用 版本号来区分。

把接口作为模块开发


如需增加接口版本，在配置文件里面的 modules 里面增加对应的版本，比如 'v1' => [

'class' => 'app\modules\v1\Module',

]

其他地方模仿 modules/v0 目录下的文件做修改。


3、接口登陆验证，http请求是无状态的，客户端需要把用户的登陆信息传给服务端做验证，一般是在请求中带上token 或者是传cookie

接口有需要判断用户是否登陆，在 AppAuth,php文件里面做了对应的权限，限制需要在http请求的Header里面 加 X-Token  字段的值。这里也可以根据自己的实际情况修改成 GET或者POST 参数传递token



权限
用户验证是在配置文件里面的 user 这个 字段下的配置，找到 common\models\User 这个文件下的loginByAccessToken() 方法。






4、有的接口需要验证token有的不需要。

Controller 控制器里面有 behaviors方法，里面才执行 权限判断

BaseController里面 没有实现 behaviors方法，需要验证登陆的 继承 Controller控制器，不需要的继承 BaseController


5、请求参数验证，直接在控制器中 rules 方法里面写规则。



参数验证
对应的代码在BaseController控制器里面的参数绑定的方法里面实现对get post传入的参数做校验




6、写接口文档从来没有如此简单

 关于 fastapi 详细的介绍可以看这个链接 http://www.yiichina.com/extension/1161

访问项目的这个路径，就可以直接看到接口文档 index.php?r=route/api/index

有了这个功能，只要再代码里面把相应的注释写清楚就可以自动生成一篇可读性很高的接口文档了，既省了后端开发写文档的时间，又方便了前端同学查看。

自动生成接口文档
