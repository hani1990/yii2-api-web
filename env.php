<?php
/**
 * Created by PhpStorm.
 * User: liuhan
 * Date: 2017/12/28
 * Time: 上午10:01
 */
$dotenv = new \Dotenv\Dotenv(__DIR__);
$ret = $dotenv->load();
defined('YII_DEBUG') or define('YII_DEBUG', getenv('YII_DEBUG') == 'true');
defined('YII_ENV') or define('YII_ENV', getenv('YII_ENV') ?: 'prod');