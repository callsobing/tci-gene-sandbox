<!DOCTYPE html>
<html lang="en">
<?php
include 'check_login.php';
?>
<?php
/**
 * Created by PhpStorm.
 * User: Yian.Tung
 * Date: 2018/12/6
 * Time: 下午 05:21
 */
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "tcigene";
$dbname = "tci_gene_dashboard";
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
mysql_query("SET NAMES 'utf8'");
mysql_select_db($dbname);
$userid = $_COOKIE['user'];
$sql = "SELECT * FROM `uploaded_files` WHERE `uploader` = '$userid'";
$result = mysql_query($sql);
$target_dir = "uploaded_files/". $userid ."/";

$file_name = "";
$file_size = 0;
$uploader = "";
$memo = "";
$date = "";

?>
<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>TCI Gene </title>

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.3/sweetalert2.css" />

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
<!--引用jQuery--><!--引用SweetAlert2.js-->
<script src="https://code.jquery.com/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.3/sweetalert2.js" type="text/javascript"></script>

<?php
if(isset($_GET['error'])) {
    if ($_GET['error'] == 'wrong_format'){
        ?>
        <script>
            swal("資料格式錯誤!","請檢查檔案是否為nCounter資料，<br>此檔案格式並不正確。","info");
        </script>
    <?php
    } if ($_GET['error'] == 'file_not_exist'){ ?>
        <script>
            swal("資料不存在!","此檔案並不存在，<br>請重新操作一次。","info");
        </script>
        <?php
    } if ($_GET['error'] == 'wrong_mime'){ ?>
    <script>
        swal("資料類型錯誤!","此檔案非純文字(*.txt)資料，<br>請重新操作一次。","info");
    </script>
    <?php
    } if ($_GET['error'] == 'sample_not_selected'){
        ?>
    <script>
        swal("你沒有選到samples噢!","請檢查你mock/cond1/cond2的選擇，<br>正確的選擇才會有正確的數據喲。","info");
    </script>
    <?php
    }  if ($_GET['error'] == 'condition_name_not_added'){
    ?>
    <script>
        swal("你沒有填寫樣本名稱噢!","請檢查你cond1/cond2的樣本名稱，<br>正確填寫樣本名稱才有正確的呈現結果喔。","info");
    </script>
    <?php
    }
}
if(isset($_GET['deleted'])) {
    $deleted_uuid =$_GET['deleted'];
    ?>
    <script>
    swal("你的專案 <?php echo($deleted_uuid); ?>", "已刪除！","info");
    </script>
<?php
}
?>
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.php">
                            <img src="images/tci-gene.png" alt="Tci-Gene" height="80%" />
                        </a><button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                            <a class="js-arrow" href="index.php">
                                <i class="fas fa-tachometer-alt"></i>資訊主頁
                            </a>
                        </li>
                        <li>
                            <a href="new_project.php">
                                <i class="fas fa-chart-bar"></i>分析專案
                            </a>
                        </li>
                        <li>
                            <a href="wishing_pond.php">
                                <i class="fa fa-magic"></i>許願池</a>
                        </li>
                        <li>
                            <a href="file_management.php">
                                <i class="fas fa-table"></i>檔案管理</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="far fa-check-square"></i>表格填寫</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-calendar-alt"></i>儀器排程</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-map-marker-alt"></i>已出貨區域</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="images/tci-gene.png" alt="Tci-Gene" height="80%" />
                        </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="has-sub">
                            <a class="js-arrow" href="index.php">
                                <i class="fas fa-tachometer-alt"></i>資訊主頁
                            </a>
                        </li>
                        <li>
                            <a href="new_project.php">
                                <i class="fas fa-chart-bar"></i>分析專案
                            </a>
                        </li>
                        <li>
                            <a href="wishing_pond.php">
                                <i class="fa fa-magic"></i>許願池</a>
                        </li>
                        <li>
                            <a href="file_management.php">
                                <i class="fas fa-table"></i>檔案管理</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="far fa-check-square"></i>表格填寫</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-calendar-alt"></i>儀器排程</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-map-marker-alt"></i>已出貨區域</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <div class="header-button">

                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="https://img.icons8.com/doodle/96/000000/user-<?php echo $_COOKIE['user_gender'] ?>.png">
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?php echo $_COOKIE['user']; ?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="https://img.icons8.com/doodle/96/000000/user-<?php echo $_COOKIE['user_gender'] ?>.png">
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"><?php echo $_COOKIE['user']; ?></a>
                                                    </h5>
                                                    <span class="email"><?php echo $_COOKIE['user']; ?>@tci-bio.com</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-settings"></i>Setting</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-money-box"></i>Billing</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="logout.php">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- END HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-header">
                                <strong>新分析專案</strong>
                            </div>
                            <div class="card-body card-block">
                                <form action="./project_selector.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="project_type" class=" form-control-label">分析類別</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <select name="project_type" id="project_type" class="form-control">
                                                <option value="nCounter">nCounter資料分析</option>
                                                <option value="qpcr">qPCR數據分析</option>
                                                <option value="g2">G2報告生成</option>
                                                <option value="r1">R1報告生成</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="file_select" class=" form-control-label">相關檔案</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <select name="file_select" id="file_select" class="form-control">
                                                <?php
                                                while($row = mysql_fetch_array($result))
                                                {
                                                    $file_name = $row['name'];
                                                    $display_name = $row['name'];
                                                    echo("<option value='$target_dir$file_name'>$display_name</option>");
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col col-md-9">
                                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                        <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row m-t-30">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                        <tr>
                                            <th>流水號</th>
                                            <th>專案敘述</th>
                                            <th>關聯資料</th>
                                            <th>建立時間</th>
                                            <th>刪除專案</th>
                                        </tr>
                                        </thead>
                                        <tr>
                                        <?php
                                        mysql_query("SET NAMES 'utf8'");
                                        mysql_select_db($dbname);
                                        $userid = $_COOKIE['user'];
                                        $sql = "SELECT * FROM `projects` WHERE `user_id` = '$userid'";
                                        $result = mysql_query($sql);

                                        while($row = mysql_fetch_array($result))
                                        {
                                            $file_name = $row['associated_file'];
                                            $uuid = $row['uuid'];
                                            $description = $row['description'];
                                            $date = $row['date'];
                                            echo("<tr>");
                                            echo("<td>");
                                            $file_basename = basename($file_name);
                                            ?>
                                            <form method="post" action="nCounter_result.php" class="inline">
                                                <input type="hidden" name="file_select" value="<?php echo($file_name); ?>">
                                                <input type="hidden" name="uuid" value="<?php echo($uuid); ?>">
                                                <input type="hidden" name="description" value="<?php echo($description); ?>">
                                                <input type="hidden" name="date" value="<?php echo($date); ?>">
                                                <button type="submit" name="submit_param" value="submit_value" class="link-button">
                                                    <?php echo($uuid); ?>
                                                </button>
                                            </form>
                                            <?php
                                            echo("</td>");
                                            echo("<td><font color='black'>$description</font></td>");
                                            echo("<td><font color='black'><a href='$file_name'>$file_basename</a> </font></td>");
                                            echo("<td><font color='black'>$date</font></td>");
                                            ?>
                                            <td><button onclick='confirm_click("<?php echo($uuid); ?>", "<?php echo($description); ?>")'>刪除</button></td></tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2018 Colorlib. All rights reserved. </p>
                                    <p>Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                                    <p>Modified by Yian.Tung / TCI Gene.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
        </div>
        <!-- END PAGE CONTAINER-->

    </div>

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
    <script>
    function confirm_click()
    {
        if(confirm("請問是否刪除 ".concat(arguments[0], "(", arguments[1], ")"))){
            window.location.replace("delete_project.php?uuid=".concat(arguments[0]));
        }
    }

    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>
</body>

</html>
<!-- end document-->
