<?php
/**
 * Created by PhpStorm.
 * User: Yian.Tung
 * Date: 2018/12/4
 * Time: 下午 12:35
 */

$file_name = $_POST["file_select"];
echo($file_name);
$command_inline = 'sudo -u www-data python3.4 scripts/nCounter_selection.py ' .  $file_name . ' ' . uniqid();
$command = exec($command_inline);

?>