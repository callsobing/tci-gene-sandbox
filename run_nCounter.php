<?php
/**
 * Created by PhpStorm.
 * User: Yian.Tung
 * Date: 2018/12/4
 * Time: 下午 12:35
 */

//$command = escapeshellcmd('python script/parse_nCounter_general.py');
$command = shell_exec('python script/test.py');
echo($command)

?>