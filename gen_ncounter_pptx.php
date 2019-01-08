<?php
/**
 * Created by PhpStorm.
 * User: yiantung
 * Date: 2018-12-18
 * Time: 14:30
 */

$user_id = $_COOKIE['user'];
$uuid = $_POST['uuid'];
$description = $_POST['description'];
$file_name = $_POST['file_select'];

$output = fopen("reports/$user_id/$uuid/selected_figures.txt", "w");

fwrite($output, $description."\n");

if (isset($_POST['gene']))
{
    $i=count($_POST['gene']);
    for($j=0 ; $j<$i ; $j++){
        fwrite($output, $_POST['gene'][$j]."\n");
    }
}
fclose($output);

$command_inline = "sudo -u www-data python3.4 scripts/gen_merged_figures.py \"$file_name\" reports/args_$uuid.txt $user_id $uuid 2>&1";

$command = exec($command_inline, $output);


$link = "reports/$user_id/$uuid/$uuid.pptx";
echo "<script type='text/javascript'>";
echo "window.location.href='$link'";
echo "</script>";
echo "window.open('', '_self', ''); window.close();";

?>