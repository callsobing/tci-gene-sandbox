<?php
/**
 * Created by PhpStorm.
 * User: Yian.Tung
 * Date: 2018/12/4
 * Time: 下午 12:35
 */

//$command = escapeshellcmd('python script/parse_nCounter_general.py');
echo("<img src='images/waiting.jpg' width='100%'/>");
ob_flush();
flush();

# 上傳使用者資料到uploaded_files
$target_dir = "uploaded_files/";
$target_file = $target_dir.$_FILES["file_input"]["name"];

# Debug區域
//echo($target_file);
//echo($_FILES['file_input']['tmp_name']);

if (move_uploaded_file($_FILES['file_input']['tmp_name'], $target_file)) {
//    echo "File is valid, and was successfully uploaded.\\\\n";
} else {
    echo "Possible file upload attack!\\\\n";
}

ob_flush();
flush();

$file_name = $_FILES["file_input"]["name"];
$command_inline = 'sudo -u www-data python3.4 scripts/parse_nCounter_general.py ' .  $file_name;
$command = exec($command_inline);

//echo($command);

$url = "nCounter_result.php?file=$file_name";
echo "<script type='text/javascript'>";
echo "window.location.href='$url'";
echo "</script>";

?>