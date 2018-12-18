<?php
/**
 * Created by PhpStorm.
 * User: yiantung
 * Date: 2018-12-18
 * Time: 14:30
 */

$user_id = $_COOKIE['user'];
$uuid = $_POST['uuid'];
$output = fopen("reports/$user_id/$uuid/selected_figures.txt", "w");

if (isset($_POST['gene']))
{
    $i=count($_POST['gene']);
    for($j=0 ; $j<$i ; $j++){
        fwrite($output, $_POST['gene'][$j]."\n");
    }
}
fclose($output);



?>