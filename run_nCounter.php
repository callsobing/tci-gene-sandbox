<?php
/**
 * Created by PhpStorm.
 * User: Yian.Tung
 * Date: 2018/12/4
 * Time: 下午 12:35
 */

//$command = escapeshellcmd('python script/parse_nCounter_general.py');
echo("<img src='images/waiting.jpg'/>");
ob_flush();
flush();

# 上傳使用者資料到uploaded_files
$target_dir = "uploaded_files/";
$target_file = $target_dir.$_FILES["file_input"]["name"];
echo($target_file);
echo($_FILES['file_input']['tmp_name']);

if ($_FILES["file"]["error"] > 0){
    echo "Error: " . $_FILES["file"]["error"];
}else{
    echo "檔案名稱: " . $_FILES["file"]["name"]."<br/>";
    echo "檔案類型: " . $_FILES["file"]["type"]."<br/>";
    echo "檔案大小: " . ($_FILES["file"]["size"] / 1024)." Kb<br />";
    echo "暫存名稱: " . $_FILES["file"]["tmp_name"];
}

if (move_uploaded_file($_FILES['file_input']['tmp_name'], $target_file)) {
    echo "File is valid, and was successfully uploaded.\\\\n";
} else {
    echo "Possible file upload attack!\\\\n";
}

ob_flush();
flush();
//
//$file_name = $_FILES["file_input"]["name"];
//$command_inline = 'sudo -u www-data python3.4 scripts/parse_nCounter_general.py' .  $file_name;
//$command = exec('sudo -u www-data python3.4 scripts/parse_nCounter_general.py');
//
//$url = "nCounter_result.php?file=$file_name";
//echo "<script type='text/javascript'>";
//echo "window.location.href='$url'";
//echo "</script>";

?>