<?php
/**
 * Created by PhpStorm.
 * User: Yian.Tung
 * Date: 2018/12/4
 * Time: 下午 12:35
 */

//$command = escapeshellcmd('python script/parse_nCounter_general.py');
echo("<img src='images/waiting.jpg' width='100%' height='100%'/>");
ob_flush();
flush();
$uuid = uniqid();
$user_id = $_COOKIE['user'];


$output = fopen("reports/args_$uuid.txt", "w");

if (isset($_POST['mock']))
{
    $i=count($_POST['mock']);
    for($j=0 ; $j<$i ; $j++){
        if($j == 0) {
            fwrite($output, $_POST['mock'][$j]);
        } else {
            fwrite($output, "\t".$_POST['mock'][$j]);
        }
    }
    fwrite($output, "\n");
}

if (isset($_POST['cond1']))
{
    $i=count($_POST['cond1']);
    for($j=0 ; $j<$i ; $j++){
        if($j == 0) {
            fwrite($output, $_POST['cond1'][$j]);
        } else {
            fwrite($output, "\t".$_POST['cond1'][$j]);
        }
    }
    fwrite($output, "\n");
}

if (isset($_POST['cond2']))
{
    $i=count($_POST['cond2']);
    for($j=0 ; $j<$i ; $j++){
        if($j == 0) {
            fwrite($output, $_POST['cond2'][$j]);
        } else {
            fwrite($output, "\t".$_POST['cond2'][$j]);
        }
    }
    fwrite($output, "\n");
}

fclose($output);

$file_name = $_FILES["file_input"]["name"];
$command_inline = "sudo -u www-data python3.4 scripts/parse_nCounter_general.py $file_name reports/args_$uuid.txt $user_id $uuid";
$command = exec($command_inline);

//
//$url = "nCounter_result.php?file=$file_name";
//echo "<script type='text/javascript'>";
//echo "window.location.href='$url'";
//echo "</script>";

?>