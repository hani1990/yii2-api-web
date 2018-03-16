<?php
/**
 * Created by PhpStorm.
 * User: liuhan
 * Date: 2018/1/27
 * Time: 上午11:34
 */
error_reporting(0);
$pid = $_GET['pid'];
$uid = $_GET['uid'];
$uri = $_SERVER["REQUEST_URI"];
//$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"];
$args = explode('/', $uri);

$preg_ret  = preg_match('/pid\/(\d+)/i', $uri, $ret);
if($preg_ret){
    $pid = $ret[1];
}else{
    $pid = 0;
}

$url = 'http://'.$_SERVER['HTTP_HOST']. '/test/#/index?pid='.$pid.'&uid='.$uid;

header("Location: ".$url);
