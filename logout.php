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
//導到login.php
header("Location:login.php");

?>