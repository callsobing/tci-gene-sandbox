<!DOCTYPE html>
<html lang="en">
<?php
include 'check_login.php';
session_cache_limiter("private");
session_start();

if($_GET['error'] == "sample_not_selected"){
    echo "<script type='text/javascript'>";
    echo "window.location.href='new_project.php?error=sample_not_selected'";
    echo "</script>";
} elseif ($_GET['error'] == "condition_name_not_added"){
    echo "<script type='text/javascript'>";
    echo "window.location.href='new_project.php?error=condition_name_not_added'";
    echo "</script>";
}

if (!file_exists($_POST["file_select"])){ # 檢查檔案存不存在
    echo "<script type='text/javascript'>";
    echo "window.location.href='new_project.php?error=file_not_exist'";
    echo "</script>";
} elseif (mime_content_type($_POST["file_select"]) == 'text/plain'){ #如果是文字檔就檢查格式
    $file = fopen($_POST["file_select"], "r");
    $line = fgets($file);
    if (!(substr($line, 0, strlen('Probe Name')) === 'Probe Name')) {
        fclose($file);
        echo "<script type='text/javascript'>";
        echo "window.location.href='new_project.php?error=wrong_format'";
        echo "</script>";
    }
} else{ # 如果連文字檔都不是就不檢查
    echo "<script type='text/javascript'>";
    echo "window.location.href='new_project.php?error=wrong_mime'";
    echo "</script>";
}

$file_name = $_POST["file_select"];
$uuid = uniqid();
$command = shell_exec("sudo -u www-data python3.4 scripts/nCounter_selection.py '".$file_name."' '".$uuid."'");

?>

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard</title>

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
        <!-- HEADER DESKTOP-->

        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <!-- /# column -->
                    <div class="col-lg-12">
                        <div class="card">
                            <form action="run_nCounter.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="card-header">
                                    <h4>nCounter 報告設定</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">專案名稱</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="project_name" name="project_name" placeholder="請輸入你的專案名稱" class="form-control">
                                            <small class="form-text text-muted">請使用與專案直接相關的敘述，方便未來辨識</small>
                                            <input type="hidden" id="file_input" name="file_input" value="<?php echo($_POST["file_select"]) ?>">
                                        </div>
                                    </div>
                                    <div class="custom-tab">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <a class="nav-item nav-link active" id="custom-nav-1-tab" data-toggle="tab" href="#custom-nav-1" role="tab" aria-controls="custom-nav-1"
                                                   aria-selected="true">Mock</a>
                                                <a class="nav-item nav-link" id="custom-nav-2-tab" data-toggle="tab" href="#custom-nav-2" role="tab" aria-controls="custom-nav-2"
                                                   aria-selected="false">C1 - T1</a>
                                                <a class="nav-item nav-link" id="custom-nav-3-tab" data-toggle="tab" href="#custom-nav-3" role="tab" aria-controls="custom-nav-3"
                                                   aria-selected="false">C1 - T2</a>
                                                <a class="nav-item nav-link" id="custom-nav-4-tab" data-toggle="tab" href="#custom-nav-4" role="tab" aria-controls="custom-nav-4"
                                                   aria-selected="false">C2 - T1</a>
                                                <a class="nav-item nav-link" id="custom-nav-5-tab" data-toggle="tab" href="#custom-nav-5" role="tab" aria-controls="custom-nav-5"
                                                   aria-selected="false">C2 - T2</a>

                                            </div>
                                        </nav>
                                        <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="custom-nav-1" role="tabpanel" aria-labelledby="custom-nav-1-tab">
                                                <div class="col col-md-9">
                                                    <input type="text" placeholder="控制組" class="form-control" disabled>
                                                </div>
                                                <div class="col col-md-9">
                                                    <div class="form-check">
                                                <?php
                                                $file = fopen("data/nCounter_$uuid.txt", "r");
                                                while (!feof($file)) {
                                                    $items = preg_split ('/\t/', fgets($file));
                                                ?>
                                                    <div>
                                                        <label for="checkbox" class="form-check-label ">
                                                                    <input type="checkbox" name="mock[]" value="<?php echo($items[0]); ?>" class="form-check-input"> <?php echo($items[0]); ?>
                                                        </label>
                                                    </div>
                                                <?php
                                                }
                                                fclose($file);
                                                ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="custom-nav-2" role="tabpanel" aria-labelledby="custom-nav-2-tab">
                                                <div class="col col-md-9">
                                                    <input type="text" id="c1t1_name" name="c1t1_name" placeholder="請輸入c1t1名稱" class="form-control">
                                                </div>
                                                <div class="col col-md-9">
                                                    <div class="form-check">
                                                        <?php
                                                        $file = fopen("data/nCounter_$uuid.txt", "r");
                                                        while (!feof($file)) {
                                                            $items = preg_split ('/\t/', fgets($file));
                                                            ?>
                                                            <div>
                                                                <label for="checkbox" class="form-check-label ">
                                                                    <input type="checkbox" name="c1t1[]" value="<?php echo($items[0]); ?>" class="form-check-input"> <?php echo($items[0]); ?>
                                                                </label>
                                                            </div>
                                                            <?php
                                                        }
                                                        fclose($file);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="custom-nav-3" role="tabpanel" aria-labelledby="custom-nav-3-tab">
                                                <div class="col col-md-9">
                                                    <input type="text" id="c1t2_name" name="c1t2_name" placeholder="請輸入c1t2名稱" class="form-control">
                                                </div>
                                                <div class="col col-md-9">
                                                    <div class="form-check">
                                                        <?php
                                                        $file = fopen("data/nCounter_$uuid.txt", "r");
                                                        while (!feof($file)) {
                                                            $items = preg_split ('/\t/', fgets($file));
                                                            ?>
                                                            <div>
                                                                <label for="checkbox" class="form-check-label ">
                                                                    <input type="checkbox" name="c1t2[]" value="<?php echo($items[0]); ?>" class="form-check-input"> <?php echo($items[0]); ?>
                                                                </label>
                                                            </div>
                                                            <?php
                                                        }
                                                        fclose($file);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="custom-nav-4" role="tabpanel" aria-labelledby="custom-nav-4-tab">
                                                <div class="col col-md-9">
                                                    <input type="text" id="c2t1_name" name="c2t1_name" placeholder="請輸入c2t1名稱" class="form-control">
                                                </div>
                                                <div class="col col-md-9">
                                                    <div class="form-check">
                                                        <?php
                                                        $file = fopen("data/nCounter_$uuid.txt", "r");
                                                        while (!feof($file)) {
                                                            $items = preg_split ('/\t/', fgets($file));
                                                            ?>
                                                            <div>
                                                                <label for="checkbox" class="form-check-label ">
                                                                    <input type="checkbox" name="c2t1[]" value="<?php echo($items[0]); ?>" class="form-check-input"> <?php echo($items[0]); ?>
                                                                </label>
                                                            </div>
                                                            <?php
                                                        }
                                                        fclose($file);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="custom-nav-5" role="tabpanel" aria-labelledby="custom-nav-5-tab">
                                                <div class="col col-md-9">
                                                    <input type="text" id="c2t2_name" name="c2t2_name" placeholder="請輸入c2t2名稱" class="form-control">
                                                </div>
                                                <div class="col col-md-9">
                                                    <div class="form-check">
                                                        <?php
                                                        $file = fopen("data/nCounter_$uuid.txt", "r");
                                                        while (!feof($file)) {
                                                            $items = preg_split ('/\t/', fgets($file));
                                                            ?>
                                                            <div>
                                                                <label for="checkbox" class="form-check-label ">
                                                                    <input type="checkbox" name="c2t2[]" value="<?php echo($items[0]); ?>" class="form-check-input"> <?php echo($items[0]); ?>
                                                                </label>
                                                            </div>
                                                            <?php
                                                        }
                                                        fclose($file);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-columns">
                                    <div class="col col-md-9">
                                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                        <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                                    </div>
                                </div>
                                <div class="card-columns">
                                    <p><br></p>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /# column -->


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
        <!-- END PAGE CONTAINER-->
    </div>

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

</body>

</html>
<!-- end document-->

