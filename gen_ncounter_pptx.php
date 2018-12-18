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

$command_inline = "sudo -u www-data python3.4 scripts/gen_pptx_ncounter.py $user_id $uuid";
$command = exec($command_inline);

$link = "reports/$user_id/$uuid/$uuid.pptx";
echo "<script type='text/javascript'>";
echo "window.location.href='$link'";
echo "</script>";


?>