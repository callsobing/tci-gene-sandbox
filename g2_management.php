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
    <style>
        /* Sortable tables */
        table.sortable thead {
            background-color:#eee;
            color:#666666;
            font-weight: bold;
            cursor: default;
        }

    </style>

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
                            <form id="pond_form" name="pond_form" action="g2_management.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="row form-group">
                                    <select multiple name="selected_disease[]" class="form-control">
                                        <option value="肥胖症">肥胖症</option>
                                        <option value="第二型糖尿病">第二型糖尿病</option>
                                        <option value="高血壓">高血壓</option>
                                        <option value="高血脂">高血脂</option>
                                        <option value="高尿酸血症">高尿酸血症</option>
                                        <option value="冠狀動脈疾病">冠狀動脈疾病</option>
                                        <option value="心房顫動">心房顫動</option>
                                        <option value="腦中風">腦中風</option>
                                        <option value="靜脈曲張">靜脈曲張</option>
                                        <option value="晚發型阿茲海默症">晚發型阿茲海默症</option>
                                        <option value="帕金森氏症">帕金森氏症</option>
                                        <option value="退化性關節炎">退化性關節炎</option>
                                        <option value="骨質疏鬆">骨質疏鬆</option>
                                        <option value="肌少症">肌少症</option>
                                        <option value="子宮內膜異位症">子宮內膜異位症</option>
                                        <option value="子宮肌瘤">子宮肌瘤</option>
                                        <option value="多囊性卵巢症候群">多囊性卵巢症候群</option>
                                        <option value="女性尿道感染">女性尿道感染</option>
                                        <option value="類風濕性關節炎">類風濕性關節炎</option>
                                        <option value="紅斑性狼瘡">紅斑性狼瘡</option>
                                        <option value="自體免疫甲狀腺疾病">自體免疫甲狀腺疾病</option>
                                        <option value="僵直性脊椎炎">僵直性脊椎炎</option>
                                        <option value="肝硬化">肝硬化</option>
                                        <option value="脂肪肝">脂肪肝</option>
                                        <option value="膽石症">膽石症</option>
                                        <option value="消化性潰瘍">消化性潰瘍</option>
                                        <option value="大腸息肉症">大腸息肉症</option>
                                        <option value="胰臟炎">胰臟炎</option>
                                        <option value="白內障">白內障</option>
                                        <option value="青光眼">青光眼</option>
                                        <option value="黃斑部病變">黃斑部病變</option>
                                        <option value="高度近視">高度近視</option>
                                        <option value="憂鬱症">憂鬱症</option>
                                        <option value="躁鬱症">躁鬱症</option>
                                        <option value="思覺失調症">思覺失調症</option>
                                        <option value="慢性阻塞性肺病">慢性阻塞性肺病</option>
                                        <option value="攝護腺肥大">攝護腺肥大</option>
                                        <option value="腎結石">腎結石</option>
                                        <option value="腎衰竭">腎衰竭</option>
                                        <option value="氣喘">氣喘</option>
                                        <option value="過敏性鼻炎">過敏性鼻炎</option>
                                        <option value="異位性皮膚炎">異位性皮膚炎</option>
                                        <option value="乾癬">乾癬</option>
                                        <option value="牙周病">牙周病</option>
                                        <option value="口腔癌">口腔癌</option>
                                        <option value="鼻咽癌">鼻咽癌</option>
                                        <option value="食道癌">食道癌</option>
                                        <option value="肺癌">肺癌</option>
                                        <option value="胃癌">胃癌</option>
                                        <option value="肝癌">肝癌</option>
                                        <option value="大腸癌">大腸癌</option>
                                        <option value="胰臟癌">胰臟癌</option>
                                        <option value="乳癌">乳癌</option>
                                        <option value="卵巢癌">卵巢癌</option>
                                        <option value="子宮頸癌">子宮頸癌</option>
                                        <option value="攝護腺癌">攝護腺癌</option>
                                        <option value="膀胱癌">膀胱癌</option>
                                        <option value="淋巴癌">淋巴癌</option>
                                    </select>
                                    <p><br></p>
                                    <div>
                                        <button type="submit" name="submit" id="submit" class="btn btn-primary btn-sm">Submit</button>
                                        <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- 有收到資料才show下面欄位 -->
                <!-- DATA TABLE-->
                <p align="right"><button onclick="exportTableToExcel('customer_Data')" class="button" formtarget="_blank"><span>輸出為xls檔案</span></button></p>
                <div class="card">
                    <table class="sortable" cellpadding="2px" id="customer_Data" border="2px">
                        <thead>
                        <tr>
                            <th>會員編號</th>
                            <th>姓名</th>
                            <th>性別</th>
                            <!-- <th width="15%">生日</th> -->
                            <th>客服</th>
                            <th>年齡</th>
                            <th>電話</th>
                            <th>備註</th>
                            <?php
                            if (isset($_POST['selected_disease']))
                            {
                                $i=count($_POST['selected_disease']);
                                for($j=0 ; $j<$i ; $j++) {
                                    echo("<th>".$_POST["selected_disease"][$j]."</th>");
                                }
                            }
                            ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql = "SELECT * FROM `customer_g2`";
                        $result = mysql_query($sql);
                        while($row = mysql_fetch_array($result))
                        {
                            $member_id = $row['會員編號'];
                            $cs_id = $row['客服'];
                            $name = $row['姓名'];
                            $gender = $row['性別'];
                            $bd = $row['生日'];
                            $age = $row['年齡'];
                            $phone = $row['電話'];
                            $memo = $row['備註'];
                            echo("<tr>");
                            echo("<td>$member_id</td>");
                            echo("<td>$name</td>");
                            echo("<td>$gender</td>");
//                            echo("<td>$bd</td>");
                            echo("<td>$cs_id</td>");
                            echo("<td>$age</td>");
                            echo("<td>$phone</td>");
                            echo("<td>$memo</td>");
                            if (isset($_POST['selected_disease']))
                            {
                                $i=count($_POST['selected_disease']);
                                for($j=0 ; $j<$i ; $j++) {
                                    $disease = $_POST['selected_disease'][$j];
                                    echo("<td>".$row[$disease]."</td>");
                                }
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                    <!-- END DATA TABLE-->
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
<script src="vendor/select2/select2.min.js"></script>
<script src="vendor/sorttable.js"></script>

<!-- Main JS-->
<script src="js/main.js"></script>
<!-- export to Excel  -->
<script>
    function exportTableToExcel(tableID, filename = ''){
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

        // Specify file name
        filename = filename?filename+'.xls':'excel_data.xls';

        // Create download link element
        downloadLink = document.createElement("a");

        document.body.appendChild(downloadLink);

        if(navigator.msSaveOrOpenBlob){
            var blob = new Blob(['\ufeff', tableHTML], {
                type: dataType
            });
            navigator.msSaveOrOpenBlob( blob, filename);
        }else{
            // Create a link to the file
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

            // Setting the file name
            downloadLink.download = filename;

            //triggering the function
            downloadLink.click();
        }
    }
</script>

<style>
    .button {
        display: inline-block;
        border-radius: 2px;
        background-color: #ff462e;
        border: none;
        color: #FFFFFF;
        text-align: center;
        font-size: 12px;
        padding: 4px;
        width: 140px;
        transition: all 0.2s;
        cursor: pointer;
        margin: 2px;
    }

    .button span {
        cursor: pointer;
        display: inline-block;
        position: relative;
        transition: 0.5s;
    }

    .button span:after {
        content: '\00bb';
        position: absolute;
        opacity: 0;
        top: 0;
        right: -20px;
        transition: 0.5s;
    }

    .button:hover span {
        padding-right: 20px;
    }

    .button:hover span:after {
        opacity: 1;
        right: 0;
    }
</style>

</body>

</html>
<!-- end document-->