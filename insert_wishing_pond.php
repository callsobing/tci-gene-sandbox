<?php
/**
 * Created by PhpStorm.
 * User: Yian.Tung
 * Date: 2018/12/6
 * Time: 下午 09:08
 */

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "tcigene";
$dbname = "tci_gene_dashboard";
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
mysql_query("SET NAMES 'utf8'");
mysql_select_db($dbname);

$title = $_POST['title'];
$wisher = $_POST['wisher'];
$content = $_POST['content'];
$file_path = $_POST['file_path'];
$urgency = $_POST['urgency'];

$sql ="INSERT INTO wishing_pond (title, wisher, content, attached_file_path, urgency)  VALUES ($title, $wisher, $content, $file_path, $urgency)";
$result = mysql_query($sql) or die('MySQL query error');

$url = "wishing_pond.php";
echo "<script type='text/javascript'>";
echo "window.location.href='$url'";
echo "</script>";
?>


