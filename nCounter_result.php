<?php
/**
 * Created by PhpStorm.
 * User: Yian.Tung
 * Date: 2018/12/4
 * Time: 下午 12:29
 */

$user = $_COOKIE['user'];
$uuid = $_POST['uuid'];
$file_name = $_POST['file_select'];
$platform_score_file = "reports/$user/$uuid/platform_score";
$description = $_POST['description'];
$date = $_POST['date'];

$significance = Array();
$file = fopen($platform_score_file, "r");
while (!feof($file)) {
    $items = preg_split('/\t/', fgets($file));
    $significance += array($items[0] => floatval($items[1]));
}

$platforms = Array(
            Array("抗氧化"=> Array("up"=> ["SOD1","SOD2","GPX1","CAT"], "down"=> [])),
            Array("抗老"=> Array("up"=> ["CCT2","CCT5","CCT6A","CCT7","CCT8","Pink1","Parkin","Atg1","Atg8","SIRT1","FOXO","NADSYN","MRPS5","Ubl-5","SOD3"], "down"=> ["PARP1","PARP2"])),
            Array("DNA修復"=> Array("up"=> ["UNG","OGG1","MPG","APEX1","ERCC1","ERCC6","XPA","XRCC1","XRCC5","MSH2","MLH1","MSH6"], "down"=> [])),
            Array("免疫"=> Array("up"=> ["IL-1B","IL-8","IL-6","IL-10","IL-18","TNF-a"], "down"=> [])),
            Array("護胃"=> Array("up"=> ["SOD1","SOD2","GPX1"], "down"=> ["IL-1B","IL-6","IL-8"])),
            Array("護眼"=> Array("up"=> [], "down"=> ["VEGFA","CASP3","CASP8","IL-1B","IL-8","TNF-a"])),
            Array("抗黑色素生成"=> Array("up"=> [], "down"=> ["TYR","TYRP1","MC1R","MITF"])),
            Array("膠原蛋白合成/組合/降解"=> Array("up"=> ["COL1A1","COL1A2","COL4A1","COL4A4","COL4A5","TIMP1","ELN","FBN1","LOX","HAS2","HAS3"], "down"=> ["MMP1","MMP9","MMP2"])),
            Array("抗發炎"=> Array("up"=> ["IL-10","TGFB","IL4"], "down"=> ["IL-1B","IL-8","IL-6","IL-18","TNF-a","IL-16","IL23","IL12A","IFNG","IL3"])),
            Array("細胞凋亡"=> Array("up"=> [], "down"=> ["BCL-2","BAX","BCLXL","BAD","CASP9","AIFM1","EndoG"])),
            Array("心血管保健"=> Array("up"=> ["PTGIS","NOS3","PLAT","PROC"], "down"=> ["EDN1","VWF","F3","SERPINE1","PDGFC","FGF2","IGF2BP3","IGF1R","IL-8","IL-6","ICAM1","VCAM1","CASP8"])),
            Array("晝夜節律"=> Array("up"=> ["SIRT1","CLOCK","BMAL1 (ARNTL)","PER2","CRY","KPNB1"], "down"=> [])),
            Array("LPS模擬體內發炎"=> Array("up"=> ["NOS3"], "down"=> ["ICAM1","VCAM1","IL-8"])),
            Array("非酒精性肝損傷"=> Array("up"=> ["UNG","OGG1","MPG","APEX1","ERCC1","ERCC6","XPA","XRCC1","XRCC5","MSH2","MLH1","MSH6","SOD1","SOD2","GPX1","CAT"], "down"=> [])),
            Array("皮膚角質保濕"=> Array("up"=> ["Tgm1","Krt1","Keratin 10","Keratin 14","AQP3","FLG-F","SMPD1","GBA","HAS2","HAS3"], "down"=> [])),
            Array("脂肪肝"=> Array("up"=> ["PPAR-g","PPAR-a"], "down"=> ["SREBP-1c (SREBF1)","SCD1 (SCD)","ACC (ACACA)"])),
            Array("提升HDL"=> Array("up"=> ["CETP","SCARB1","apoA-I (APA1)","LDLR","ABCA1"], "down"=> [])),
            Array("健髮平台"=> Array("up"=> ["KROX20","SCF","VEGFA","IGF1"], "down"=> ["SRD5A1","SRD5A2","AR","TGFB","BDNF"])),
            Array("端粒酶活性平台"=> Array("up"=> ["TERT","TERC","RTEL1"], "down"=> [])),
            Array("免疫活化與分化"=> Array("up"=> [], "down"=> ["CD40","ERBB2","LIF","MALT1","NCK1","PAF1","DYNLL2","GRK5","PSMD4","RDH10","RELB","SCARF1","TNFSF14","ABR","IL13","IL4R","IL5RA","RELA"]))
            );
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
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="index.php">Dashboard 1</a>
                                </li>
                                <li>
                                    <a href="index2.html">Dashboard 2</a>
                                </li>
                                <li>
                                    <a href="index3.html">Dashboard 3</a>
                                </li>
                                <li>
                                    <a href="index4.html">Dashboard 4</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="new_project.php">
                                <i class="fas fa-chart-bar"></i>Charts</a>
                        </li>
                        <li>
                            <a href="table.html">
                                <i class="fas fa-table"></i>Tables</a>
                        </li>
                        <li>
                            <a href="form.html">
                                <i class="far fa-check-square"></i>Forms</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-calendar-alt"></i>Calendar</a>
                        </li>
                        <li>
                            <a href="map.html">
                                <i class="fas fa-map-marker-alt"></i>Maps</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Pages</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="login.php">Login</a>
                                </li>
                                <li>
                                    <a href="register.html">Register</a>
                                </li>
                                <li>
                                    <a href="forget-pass.html">Forget Password</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-desktop"></i>UI Elements</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="button.html">Button</a>
                                </li>
                                <li>
                                    <a href="badge.html">Badges</a>
                                </li>
                                <li>
                                    <a href="tab.html">Tabs</a>
                                </li>
                                <li>
                                    <a href="card.html">Cards</a>
                                </li>
                                <li>
                                    <a href="alert.html">Alerts</a>
                                </li>
                                <li>
                                    <a href="progress-bar.html">Progress Bars</a>
                                </li>
                                <li>
                                    <a href="modal.html">Modals</a>
                                </li>
                                <li>
                                    <a href="switch.html">Switchs</a>
                                </li>
                                <li>
                                    <a href="grid.html">Grids</a>
                                </li>
                                <li>
                                    <a href="fontawesome.html">Fontawesome Icon</a>
                                </li>
                                <li>
                                    <a href="typo.html">Typography</a>
                                </li>
                            </ul>
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
                        <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>資訊主頁</a>
                        </li>
                        <li>
                            <a href="new_project.php">
                                <i class="fas fa-chart-bar"></i>分析專案</a>
                        </li>
                        <li>
                            <a href="#">
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
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Pages</a>
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
                                <div class="card-header">
                                    <h4>專案資訊</h4>
                                </div>
                                <div class="card-body">
                                    <span>分析日期: <?php echo($date); ?><br></span>
                                    <span>專案描述:<?php echo($description); ?><br></span>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h4>各平台評分</h4>
                                </div>
                                <div class="card-body">
                                        <?php
                                        foreach ($platforms as $platform_count) {
                                            foreach ($platform_count as $key => $value) {
                                                ?>
                                                <span class="progress-title"><?php echo($key); ?></span>
                                                <div class="progress mb-2">
                                                    <div class="progress-bar bg-<?php if($significance[$key] > 50){ echo("success"); } elseif($significance[$key] > 25){ echo("danger"); } else { echo("warning"); } ?>" role="progressbar" style="width:<?php echo($significance[$key]); ?>%" aria-valuenow="<?php echo($significance[$key]); ?>" aria-valuemin="0" aria-valuemax="100"><?php echo($significance[$key]); ?>%</div>
                                                </div>
                                            <?php }
                                        }?>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h4>nCounter 運算結果</h4>
                                </div>
                                <div class="card-body">
                                    <div class="custom-tab">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <?php
                                                $count = 0;
                                                foreach ($platforms as $platform_count) {
                                                    $count += 1;
                                                    foreach ($platform_count as $key => $value) {
                                                    ?>
                                                <a class="nav-item nav-link <?php if($count == 1){ echo("active");} ?>" id="custom-nav-<?php echo($count); ?>-tab" data-toggle="tab" href="#custom-nav-<?php echo($count); ?>" role="tab" aria-controls="custom-nav-<?php echo($count); ?>"
                                                   aria-selected="<?php if($count == 1){ echo("true");} else {echo("false");} ?>">
                                                    <?php echo($key); ?>
                                                    <div class="progress mb-2" style="height: 8px;">
                                                        <div class="progress-bar bg-<?php if($significance[$key] > 50){ echo("success"); } elseif($significance[$key] > 25){ echo("danger"); } else { echo("warning"); } ?>" role="progressbar" style="width:<?php echo($significance[$key]); ?>%" aria-valuenow="<?php echo($significance[$key]); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </a>
                                                <?php }
                                                }?>
                                            </div>
                                        </nav>
                                        <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                            <?php
                                            $count = 0;
                                            foreach ($platforms as $platform_count) {
                                                $count += 1;
                                                foreach ($platform_count as $key => $value) {
                                            ?>
                                            <div class="tab-pane fade show <?php if($count == 1){ echo("active");} ?>" id="custom-nav-<?php echo($count); ?>" role="tabpanel" aria-labelledby="custom-nav-<?php echo($count); ?>-tab">
                                                <!-- DATA TABLE -->
                                                <h3 class="title-5 m-b-35"><?php echo($key); ?> - 基因表現圖表</h3>
                                                <div class="table-responsive table-responsive-data2">
                                                    <table class="table table-data2" style="font-size:x-large;">
                                                        <thead>
                                                        <tr>
                                                            <th width="5%">
                                                            </th>
                                                            <th width="35%" style="font-size:medium;">表現量圖表</th>
                                                            <th width="15%" style="font-size:medium;">基因</th>
                                                            <th width="15%" style="font-size:medium;">期待方向</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        if(!empty($value['up'])){
                                                            foreach ($value['up'] as &$gene) {
                                                        ?>
                                                        <tr class="tr-shadow">
                                                            <td>
                                                                <label for="checkbox" class="form-check-label ">
                                                                    <input type="checkbox" name="gene[]" value="<?php echo($gene); ?>" class="form-check-input">
                                                                </label>
                                                            </td>
                                                            <td><img src="reports/<?php echo($user); ?>/<?php echo($uuid); ?>/<?php echo($gene); ?>.png" width="100%"></td>
                                                            <td><?php echo($gene) ?></td>
                                                            <td>
                                                                <span class="badge badge-success">提高</span>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                        <tr class="spacer"></tr>
                                                        <?php
                                                        if(!empty($value['down'])){
                                                            foreach ($value['down'] as &$gene) {
                                                                ?>
                                                                <tr class="tr-shadow">
                                                                    <td>
                                                                        <label for="checkbox" class="form-check-label ">
                                                                            <input type="checkbox" name="gene[]" value="<?php echo($gene); ?>" class="form-check-input">
                                                                        </label>
                                                                    </td>
                                                                    <td><img src="reports/<?php echo($user) ?>/<?php echo($uuid) ?>/<?php echo($gene) ?>.png" width="100%"></td>
                                                                    <td><?php echo($gene) ?></td>
                                                                    <td>
                                                                        <span class="badge badge-danger">降低</span>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        <tr class="spacer"></tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- END DATA TABLE -->
                                            </div>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
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
