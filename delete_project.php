<?php
/**
 * Created by PhpStorm.
 * User: Yian.Tung
 * Date: 2018/12/6
 * Time: 下午 09:08
 */

// Start 如果有上傳檔案放到正確的地方
session_start();
$uploader = $_COOKIE['user'];
$uuid = $_GET["uuid"];

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "tcigene";
$dbname = "tci_gene_dashboard";
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');

$memo = $_POST['memo'];
$file_path = $_FILES["file_path"]["name"];

$sql = "DELETE FROM projects WHERE uuid='$uuid';";

mysql_query("SET NAMES 'utf8'");
mysql_select_db($dbname);

$result = mysql_query($sql) or die('MySQL query error');

$url = "new_project.php";
echo "<script type='text/javascript'>";
echo "window.location.href='$url?deleted=$uuid'";
echo "</script>";

?>


