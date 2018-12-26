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
    <title>TCI Gene 檔案管理</title>

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
                        <a href="#">
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
                            <strong>TCI Gene - G2 全檢資料管理</strong>
                        </div>
                        <div class="card-body card-block">
                            <form id="pond_form" name="pond_form" action="g2_management.php" method="post" enctype="multipart/form-data" class="form-horizontal" onSubmit="return check_filed(this)">
                                <div>
                                    <pre>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="肥胖症" class="form-check-input">肥胖症</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="第二型糖尿病" class="form-check-input">第二型糖尿病</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="高血壓" class="form-check-input">高血壓</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="高血脂" class="form-check-input">高血脂</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="高尿酸血症" class="form-check-input">高尿酸血症</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="冠狀動脈疾病" class="form-check-input">冠狀動脈疾病</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="心房顫動" class="form-check-input">心房顫動</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="腦中風" class="form-check-input">腦中風</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="靜脈曲張" class="form-check-input">靜脈曲張</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="晚發型阿茲海默症" class="form-check-input">晚發型阿茲海默症</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="帕金森氏症" class="form-check-input">帕金森氏症</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="退化性關節炎" class="form-check-input">退化性關節炎</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="骨質疏鬆" class="form-check-input">骨質疏鬆</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="肌少症" class="form-check-input">肌少症</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="子宮內膜異位症" class="form-check-input">子宮內膜異位症</label>                                                
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="子宮肌瘤" class="form-check-input">子宮肌瘤</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="多囊性卵巢症候群" class="form-check-input">多囊性卵巢症候群</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="女性尿道感染" class="form-check-input">女性尿道感染</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="類風濕性關節炎" class="form-check-input">類風濕性關節炎</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="紅斑性狼瘡" class="form-check-input">紅斑性狼瘡</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="自體免疫甲狀腺疾病" class="form-check-input">自體免疫甲狀腺疾病</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="僵直性脊椎炎" class="form-check-input">僵直性脊椎炎</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="肝硬化" class="form-check-input">肝硬化</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="脂肪肝" class="form-check-input">脂肪肝</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="膽石症" class="form-check-input">膽石症</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="消化性潰瘍" class="form-check-input">消化性潰瘍</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="大腸息肉症" class="form-check-input">大腸息肉症</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="胰臟炎" class="form-check-input">胰臟炎</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="白內障" class="form-check-input">白內障</label>                               
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="青光眼" class="form-check-input">青光眼</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="黃斑部病變" class="form-check-input">黃斑部病變</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="高度近視" class="form-check-input">高度近視</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="憂鬱症" class="form-check-input">憂鬱症</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="躁鬱症" class="form-check-input">躁鬱症</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="思覺失調症" class="form-check-input">思覺失調症</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="慢性阻塞性肺病" class="form-check-input">慢性阻塞性肺病</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="攝護腺肥大" class="form-check-input">攝護腺肥大</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="腎結石" class="form-check-input">腎結石</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="腎衰竭" class="form-check-input">腎衰竭</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="氣喘" class="form-check-input">氣喘</label><br>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="過敏性鼻炎" class="form-check-input">過敏性鼻炎</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="異位性皮膚炎" class="form-check-input">異位性皮膚炎</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="乾癬" class="form-check-input">乾癬</label>                               
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="牙周病" class="form-check-input">牙周病</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="口腔癌" class="form-check-input">口腔癌</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="鼻咽癌" class="form-check-input">鼻咽癌</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="食道癌" class="form-check-input">食道癌</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="肺癌" class="form-check-input">肺癌</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="胃癌" class="form-check-input">胃癌</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="肝癌" class="form-check-input">肝癌</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="大腸癌" class="form-check-input">大腸癌</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="胰臟癌" class="form-check-input">胰臟癌</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="乳癌" class="form-check-input">乳癌</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="卵巢癌" class="form-check-input">卵巢癌</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="子宮頸癌" class="form-check-input">子宮頸癌</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="攝護腺癌" class="form-check-input">攝護腺癌</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="膀胱癌" class="form-check-input">膀胱癌</label>
                                    <label for="checkbox" class="form-check-label "><input type="checkbox" name="disease[]" value="淋巴癌" class="form-check-input">淋巴癌</label>
                                    </pre>
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

                    <!-- 有收到資料才show下面欄位 -->
                    <div class="row m-t-30">
                        <div class="col-md-12">
                            <!-- DATA TABLE-->
                            <div class="table-responsive m-b-40">
                                <table class="table table-borderless table-data3">
                                    <thead>
                                    <tr>
                                        <th width="15%">會員編號</th>
                                        <th width="10%">姓名</th>
                                        <th width="15%">性別</th>
                                        <th width="15%">生日</th>
                                        <th width="15%">年齡</th>
                                        <th width="30%">電話</th>
                                        <th width="30%">地址</th>
                                        <th width="30%">備註</th>
                                        <th width="30%">電話</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    while($row = mysql_fetch_array($result))
                                    {
                                        $file_name = $row['name'];
                                        $file_size = $row['size'];
                                        $uploader = $row['uploader'];
                                        $memo = $row['memo'];
                                        $date = $row['date'];
                                        echo("<tr>");
                                        echo("<td>$file_name</td>");
                                        echo("<td>$file_size KB</td>");
                                        echo("<td>$date</td>");
                                        echo("<td><a href='$target_dir$file_name' target=\"_blank\">下載</a></td>");
                                        echo("<td>刪除</td>");
                                        echo("<td>$memo</td></tr>");
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
