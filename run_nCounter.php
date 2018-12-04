<?php
/**
 * Created by PhpStorm.
 * User: Yian.Tung
 * Date: 2018/12/4
 * Time: 下午 12:35
 */

//$command = escapeshellcmd('python script/parse_nCounter_general.py');
echo("<img src='images/waiting.jpg'/>");

$file_name = $_GET['file_name'];
$command_inline = 'sudo -u www-data python3.4 scripts/parse_nCounter_general.py' .  $file_name;
$command = exec('sudo -u www-data python3.4 scripts/parse_nCounter_general.py $file_name');

$url = "nCounter_result.php?file=$file_name";
echo "<script type='text/javascript'>";
echo "window.location.href='$url'";
echo "</script>";

?>