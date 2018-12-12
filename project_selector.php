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
    echo "post('get_nCounter_samples.php', {file_select: '$file_path'})";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "window.location.href='new_project.php'";
    echo "</script>";
}

?>