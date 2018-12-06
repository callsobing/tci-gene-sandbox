<?php
/**
 * Created by PhpStorm.
 * User: Yian.Tung
 * Date: 2018/12/6
 * Time: 下午 09:08
 */

// Start 如果有上傳檔案放到正確的地方
$target_dir = "uploaded_files/wishing_pond/";
if($target_dir.$_FILES["file_path"]){
    $target_file = $target_dir.$_FILES["file_path"]["name"];
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

$title = $_POST['title'];
$wisher = $_POST['wisher'];
$content = $_POST['content'];
$file_path = $_POST['file_path'];
$urgency = $_POST['urgency'];

$sql = "INSERT INTO wishing_pond ".
    "(title, wisher, content, attached_file_path, urgency) ".
    "VALUES ('$title', '$wisher', '$content', '$file_path', '$urgency')";

mysql_query("SET NAMES 'utf8'");
mysql_select_db($dbname);

$result = mysql_query($sql) or die('MySQL query error');

$url = "wishing_pond.php";
echo "<script type='text/javascript'>";
echo "window.location.href='$url'";
echo "</script>";
?>


