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
$sql = "SELECT * FROM `wishing_pond`";
$result = mysql_query($sql) or die('MySQL query error');

$title = "";
$wisher = "";
$content = "";
$file_path = "";
$urgency = "";
$date = "";

?>

<!DOCTYPE html>
<html lang="en">
<?php
include 'check_login.php';
?>

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>TCI Gene 許願池</title>

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
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.php">
                            <img src="images/tci-gene.jpg" alt="Tci-Gene" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
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
                            <a href="chart.php">
                                <i class="fas fa-chart-bar"></i>圖表專區
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-magic"></i>許願池</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-table"></i>表單生成</a>
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
                    <img src="images/tci-gene.jpg" alt="Tci-Gene" />
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
                            <a href="chart.php">
                                <i class="fas fa-chart-bar"></i>圖表專區
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-magic"></i>許願池</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-table"></i>表單生成</a>
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
                        <img src="images/wish_pool.jpg"/>
                        <div class="card">
                            <div class="card-header">
                                <strong>TCI Gene - 許願池</strong>
                            </div>
                            <div class="card-body card-block">
                                <form id="pond_form" name="pond_form" action="./insert_wishing_pond.php" method="post" enctype="multipart/form-data" class="form-horizontal" onSubmit="return check_filed(this)">
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">主旨</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="title" name="title" placeholder="請輸入你的心願主旨" class="form-control">
                                            <small class="form-text text-muted">主旨請言簡意賅，便於理解與分類</small>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="select" class=" form-control-label">許願人員</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <select name="wisher" id="wisher" class="form-control">
                                                <option value="匿名">我要匿名許願</option>
                                                <option value="Austin">Austin</option>
                                                <option value="Bei">Bei</option>
                                                <option value="Chelsea">Chelsea</option>
                                                <option value="Elaine">Elaine</option>
                                                <option value="Karen">Karen</option>
                                                <option value="Lauren">Lauren</option>
                                                <option value="Nick">Nick</option>
                                                <option value="Ray">Ray</option>
                                                <option value="Summer">Summer</option>
                                                <option value="Yian">Yian</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="textarea-input" class=" form-control-label">許願內容</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <textarea name="content" id="content" rows="9" placeholder="請在這裡詳述你的心願是什麼，如果可以搭配圖片輔助會更好唷" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label class=" form-control-label">緊急程度</label>
                                        </div>
                                        <div class="col col-md-9">
                                            <div class="form-check-inline form-check">
                                                <label class="form-check-label ">
                                                    <input type="radio" id="urgency" name="urgency" value="緊急" class="form-check-input"> 緊急
                                                </label>
                                                <label class="form-check-label ">
                                                    <input type="radio" id="urgency" name="urgency" value="非常緊急" class="form-check-input"> 非常緊急
                                                </label>
                                                <label class="form-check-label ">
                                                    <input type="radio" id="urgency" name="urgency" value="真的非常緊急" class="form-check-input"> 真的非常緊急
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-6">
                                            附加檔案: <input type="file" name="file_path" id="file_path" />
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <button type="submit" name="submit" id="submit" class="btn btn-primary btn-sm">Submit</button>
                                            <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                                        </div>
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
                                            <th width="12%">發願者</th>
                                            <th width="26%">主旨</th>
                                            <th width="30%">內容</th>
                                            <th width="15%">緊急程度</th>
                                            <th width="18%">許願日期</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        while($row = mysql_fetch_array($result))
                                        {

                                            $title = mb_strimwidth($row['title'], 0, 50, "...", "UTF-8");
                                            $wisher = $row['wisher'];
                                            $content = mb_strimwidth($row['content'], 0, 60, "...", "UTF-8");
                                            $file_path = $row['attached_file_path'];
                                            $urgency = $row['urgency'];
                                            $date = $row['date'];
                                            echo("<tr>");
                                            echo("<td>$wisher</td>");
                                            echo("<td> $title </td>");
                                            echo("<td> $content </td>");
                                            echo("<td class=\"process\"> $urgency </td>");
                                            echo("<td> $date </td></tr>");
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

    <!-- Main JS-->
    <script src="js/main.js"></script>
    <!-- 檢查表單正確性  -->
    <script>
        function check_filed(form){
                if(form.title.value==""){
                    alert("你累了嗎，記得填寫主旨喔!!!");
                    eval("form['title'].focus()");
                    return false;
                }else if(form.content.value==""){
                    alert("如果把心願放在心裡面，我是不知道你到底需要什麼的...\n記得填內容阿前輩!");
                    eval("form['content'].focus()");
                    return false;
                }else{
                    return true;
                }
            }
    </script>

</body>

</html>
<!-- end document-->
