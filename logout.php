<?php
/**
 * Created by PhpStorm.
 * User: Yian.Tung
 * Date: 2018/12/10
 * Time: 下午 07:39
 */
header("Content-Type:text/html; charset=utf-8");
//開啟Session
session_start();
//清除Session
session_destroy();
setcookie("user", $_COOKIE['user'], time()-3600, "/");
setcookie("user_gender", $_COOKIE['user_gender'], time()-3600,"/");
//導到login.php
header("Location:login.php");

?>