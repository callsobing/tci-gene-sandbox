<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .button {
            background-color: #fdffff;
        }
    </style>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.3/sweetalert2.css" />

    <!-- Title Page-->
    <title>Login</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <!--引用jQuery-->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" type="text/javascript"></script>
    <!--引用SweetAlert2.js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.3/sweetalert2.js" type="text/javascript"></script>

    <?php
        /**
         * Created by PhpStorm.
         * User: Yian.Tung
         * Date: 2018/12/10
         * Time: 下午 06:09
         */

        $cookie_name = 'user';
        $cookie_value = '';
        $cookie_gender = 'user_gender';
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "tcigene";
        $dbname = "tci_gene_dashboard";
        $con = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
        $select_db = mysql_select_db($dbname) or die('Error with MySQL DB selection');

        if(isset($_POST['username'])) {
            $passwd = $_POST['password'];
            $userid = $_POST['username'];
            $cookie_value = $userid;

            $gender = 'female';
            $sql = "SELECT * FROM `members` WHERE `id` = '$userid'";
            $result = mysql_query($sql) or die("無法執行SQL語法!!");
            while ($row = mysql_fetch_array($result)){
                if ($row['male'] == 1) {
                    $gender = 'male';
                }
                if ($row['password'] == $passwd) {
                    session_start();
                    setcookie($cookie_name, $cookie_value, time() + 86400 , '/');
                    setcookie($cookie_gender, $gender, time() + 86400 , '/');
                    header("Location: index.php"); //將網址改為登入成功後要導向的頁面
                } else{
                    ?>
                    <script>
                        swal("Please contact:", "基因研發中心 生物資訊部<br>童翊安 #6552", "success");
                    </script>
                    <?php
                }
            }
        }
    ?>
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <img src="images/tci-gene.png" alt="TciGene">
                        </div>
                        <div class="login-form">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>User ID</label>
                                    <input class="au-input au-input--full" type="text" name="username" placeholder="User ID">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">Remember Me
                                    </label>
                                    <label>
                                        <input type="button" class="button">忘記密碼了嗎?</button>
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                                <small class="form-text text-muted">申請帳號請洽 生物資訊部 童翊安 #6552</small>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function () {
            $("input:button").click(function () {
                swal("Please contact:", "基因研發中心 生物資訊部<br>童翊安 #6552", "success");
            });
        });
    </script>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->