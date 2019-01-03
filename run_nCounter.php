<!DOCTYPE html>
<html lang="en">

<body>
<?php
/**
 * Created by PhpStorm.
 * User: Yian.Tung
 * Date: 2018/12/4
 * Time: 下午 12:35
 */

session_cache_limiter(‘private’);
session_start();

$uuid = uniqid();
$user_id = $_COOKIE['user'];
$description = $_POST['project_name'];
$file_name = $_POST['file_input'];

$output = fopen("reports/args_$uuid.txt", "w");

if(isset($_POST['c1t1_name']) && isset($_POST['c1t2_name']) && isset($_POST['c2t1_name']) && isset($_POST['c2t2_name'])){
    fwrite($output, $_POST['c1t1_name']."\t".$_POST['c1t2_name']."\t".$_POST['c2t1_name']."\t".$_POST['c2t2_name']);
} else{
    $url = $_SERVER['HTTP_REFERER'];
    echo ("<script> alert('You did not add proper condition identifiers!');document.location.href=\"$url?error=condition_name_not_added\";</script>");
}

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
} else{
    $url = $_SERVER['HTTP_REFERER'];
    echo ("<script> alert('You did not select samples for mock!');document.location.href=\"$url?error=sample_not_selected\";</script>");
}

if (isset($_POST['c1t1']))
{
    $i=count($_POST['c1t1']);
    for($j=0 ; $j<$i ; $j++){
        if($j == 0) {
            fwrite($output, $_POST['c1t1'][$j]);
        } else {
            fwrite($output, "\t".$_POST['c1t1'][$j]);
        }
    }
    fwrite($output, "\n");
} else{
    $url = $_SERVER['HTTP_REFERER'];
    echo ("<script> alert('You did not select samples for condition1!');document.location.href=\"$url?error=sample_not_selected\";</script>");
}

if (isset($_POST['c1t2']))
{
    $i=count($_POST['c1t2']);
    for($j=0 ; $j<$i ; $j++){
        if($j == 0) {
            fwrite($output, $_POST['c1t2'][$j]);
        } else {
            fwrite($output, "\t".$_POST['c1t2'][$j]);
        }
    }
    fwrite($output, "\n");
}else{
    $url = $_SERVER['HTTP_REFERER'];
    echo ("<script> alert('You did not select samples for condition1!');document.location.href=\"$url?error=sample_not_selected\";</script>");
}

if (isset($_POST['c2t1']))
{
    $i=count($_POST['c2t1']);
    for($j=0 ; $j<$i ; $j++){
        if($j == 0) {
            fwrite($output, $_POST['c2t1'][$j]);
        } else {
            fwrite($output, "\t".$_POST['c2t1'][$j]);
        }
    }
    fwrite($output, "\n");
}else{
    $url = $_SERVER['HTTP_REFERER'];
    echo ("<script> alert('You did not select samples for condition2!');document.location.href=\"$url?error=sample_not_selected\";</script>");
}

if (isset($_POST['c2t2']))
{
    $i=count($_POST['c2t2']);
    for($j=0 ; $j<$i ; $j++){
        if($j == 0) {
            fwrite($output, $_POST['c2t2'][$j]);
        } else {
            fwrite($output, "\t".$_POST['c2t2'][$j]);
        }
    }
    fwrite($output, "\n");
}else{
    $url = $_SERVER['HTTP_REFERER'];
    echo ("<script> alert('You did not select samples for condition2!');document.location.href=\"$url?error=sample_not_selected\";</script>");
}

fclose($output);

# 只有在接收到各狀況的樣本集之後才可以執行
if (isset($_POST['mock']) & isset($_POST['c1t1']) & isset($_POST['c1t2']) & isset($_POST['c2t1']) & isset($_POST['c2t2'])) {
    echo("<img src='images/waiting.jpg' width='100%' height='100%'/>");
    ob_flush();
    flush();

    $command_inline = "sudo -u www-data python3.4 scripts/parse_nCounter_general.py \"$file_name\" reports/args_$uuid.txt $user_id $uuid";
    $command = exec($command_inline);

    # 把專案寫到資料庫中
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "tcigene";
    $dbname = "tci_gene_dashboard";
    $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');

    $sql = "INSERT INTO projects " .
        "(uuid, associated_file, description, user_id) " .
        "VALUES ('$uuid', '$file_name', '$description', '$user_id')";

    mysql_query("SET NAMES 'utf8'");
    mysql_select_db($dbname);
    $result = mysql_query($sql) or die('MySQL query error');

    $sql = "SELECT * FROM `projects` WHERE `uuid` = '$uuid'";
    $result = mysql_query($sql);

    while ($row = mysql_fetch_array($result)) {
        $date = $row['date'];
    }
    ?>
    <script>
    function post(path, params, method) {
        method = method || "post"; // Set method to post by default if not specified.

        var form = document.createElement("form");
        form.setAttribute("method", method);
        form.setAttribute("action", path);

        for(var key in params) {
            if(params.hasOwnProperty(key)) {
                var hiddenField = document.createElement("input");
                hiddenField.setAttribute("type", "hidden");
                hiddenField.setAttribute("name", key);
                hiddenField.setAttribute("value", params[key]);

                form.appendChild(hiddenField);
            }
        }
        document.body.appendChild(form);
        form.submit();
    }

    </script>
    <script type='text/javascript'>
        post('nCounter_result.php', {file_select: '<?php echo($file_name) ?>', uuid: '<?php echo($uuid) ?>', description: '<?php echo($description) ?>', date: '<?php echo($date) ?>'})
    </script>
<?php
}
?>
</body>
</html>

