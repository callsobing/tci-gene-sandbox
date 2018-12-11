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
$target_dir = "uploaded_files/". $uploader ."/";
$file_size = 0;
$file_name = $_FILES["file_path"]["name"];

if(!empty($_FILES["file_path"]["tmp_name"])){
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $target_file = $target_dir.$_FILES["file_path"]["name"];
    $file_size = ($_FILES["file_path"]["size"] / 1024);

    if (move_uploaded_file($_FILES['file_path']['tmp_name'], $target_file)) {
    } else {
        echo "Possible file upload attack!\\\\n";
    }
// End 如果有上傳檔案放到正確的地方
}
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "tcigene";
$dbname = "tci_gene_dashboard";
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');

$memo = $_POST['memo'];
$file_path = $_FILES["file_path"]["name"];

$sql = "INSERT INTO uploaded_files ".
    "(name, size, uploader, memo) ".
    "VALUES ('$file_name', '$file_size', '$uploader', '$memo')";

mysql_query("SET NAMES 'utf8'");
mysql_select_db($dbname);

$result = mysql_query($sql) or die('MySQL query error');

$url = "file_management.php";
echo "<script type='text/javascript'>";
echo "window.location.href='$url'";
echo "</script>";
?>


