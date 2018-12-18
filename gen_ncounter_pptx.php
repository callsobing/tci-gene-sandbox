<?php
/**
 * Created by PhpStorm.
 * User: yiantung
 * Date: 2018-12-18
 * Time: 14:30
 */

$user_id = $_COOKIE['user'];
$output = fopen("reports/$user_id/$uuid/selected_figures.txt", "w");
if (isset($_POST['gene']))
{
    $i=count($_POST['gene']);
    for($j=0 ; $j<$i ; $j++){
        $items = preg_split('/\t/', $_POST['gene'][$j]);
        $gene_id = $items[0];
        $platform = $items[1];
        fwrite($output, $platform."\t".$gene_id."\n");
    }
}
fclose($output);



?>