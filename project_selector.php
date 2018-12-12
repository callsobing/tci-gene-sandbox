<?php
/**
 * Created by PhpStorm.
 * User: Yian.Tung
 * Date: 2018/12/12
 * Time: 下午 12:26
 */

$project_type = $_POST['project_type'];
$file_path = $_POST['file_select'];

if($project_type == 'nCounter'){
    echo "<script type='text/javascript'>";
    echo "window.location.href='get_nCounter_samples.php'";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "window.location.href='new_project.php'";
    echo "</script>";
}

?>