<?php
/**
 * Created by PhpStorm.
 * User: Yian.Tung
 * Date: 2018/12/4
 * Time: 下午 12:29
 */
?>

<!DOCTYPE html>
<html lang="en">

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
                        <a class="logo" href="index.html">
                            <img src="images/tci-gene.webp" alt="Tci-Gene" />
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
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="index.html">Dashboard 1</a>
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
                            <a href="chart.php">
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
                                    <a href="login.html">Login</a>
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
                    <img src="images/tci-gene.webp" alt="Tci-Gene" />
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
                            <!--<a href="chart.php">-->
                            <a href="chart.php">
                                <i class="fas fa-chart-bar"></i>圖表專區</a>
                        </li>
                        <li>
                            <!--<a href="table.html">-->
                            <a href="#">
                                <i class="fas fa-table"></i>表單生成</a>
                        </li>
                        <li>
                            <!--<a href="form.html">-->
                            <a href="#">
                                <i class="far fa-check-square"></i>表格填寫</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-calendar-alt"></i>儀器排程</a>
                        </li>
                        <li>
                            <!--<a href="map.html">-->
                            <a href="#">
                                <i class="fas fa-map-marker-alt"></i>已出貨區域</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Pages</a>
                            <!--<ul class="list-unstyled navbar__sub-list js-sub-list">-->
                                <!--<li>-->
                                    <!--<a href="login.html">Login</a>-->
                                <!--</li>-->
                                <!--<li>-->
                                    <!--<a href="register.html">Register</a>-->
                                <!--</li>-->
                                <!--<li>-->
                                    <!--<a href="forget-pass.html">Forget Password</a>-->
                                <!--</li>-->
                            <!--</ul>-->
                        </li>
                        <!--<li class="has-sub">-->
                            <!--<a class="js-arrow" href="#">-->
                                <!--<i class="fas fa-desktop"></i>UI Elements</a>-->
                            <!--<ul class="list-unstyled navbar__sub-list js-sub-list">-->
                                <!--<li>-->
                                    <!--<a href="button.html">Button</a>-->
                                <!--</li>-->
                                <!--<li>-->
                                    <!--<a href="badge.html">Badges</a>-->
                                <!--</li>-->
                                <!--<li>-->
                                    <!--<a href="tab.html">Tabs</a>-->
                                <!--</li>-->
                                <!--<li>-->
                                    <!--<a href="card.html">Cards</a>-->
                                <!--</li>-->
                                <!--<li>-->
                                    <!--<a href="alert.html">Alerts</a>-->
                                <!--</li>-->
                                <!--<li>-->
                                    <!--<a href="progress-bar.html">Progress Bars</a>-->
                                <!--</li>-->
                                <!--<li>-->
                                    <!--<a href="modal.html">Modals</a>-->
                                <!--</li>-->
                                <!--<li>-->
                                    <!--<a href="switch.html">Switchs</a>-->
                                <!--</li>-->
                                <!--<li>-->
                                    <!--<a href="grid.html">Grids</a>-->
                                <!--</li>-->
                                <!--<li>-->
                                    <!--<a href="fontawesome.html">Fontawesome Icon</a>-->
                                <!--</li>-->
                                <!--<li>-->
                                    <!--<a href="typo.html">Typography</a>-->
                                <!--</li>-->
                            <!--</ul>-->
                        <!--</li>-->
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
                                <div class="noti-wrap">
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-comment-more"></i>
                                        <span class="quantity">1</span>
                                        <div class="mess-dropdown js-dropdown">
                                            <div class="mess__title">
                                                <p>You have 2 news message</p>
                                            </div>
                                            <div class="mess__item">
                                                <div class="image img-cir img-40">
                                                    <img src="images/icon/avatar-06.jpg" alt="Michelle Moreno" />
                                                </div>
                                                <div class="content">
                                                    <h6>Michelle Moreno</h6>
                                                    <p>Have sent a photo</p>
                                                    <span class="time">3 min ago</span>
                                                </div>
                                            </div>
                                            <div class="mess__item">
                                                <div class="image img-cir img-40">
                                                    <img src="images/icon/avatar-04.jpg" alt="Diane Myers" />
                                                </div>
                                                <div class="content">
                                                    <h6>Diane Myers</h6>
                                                    <p>You are now connected on message</p>
                                                    <span class="time">Yesterday</span>
                                                </div>
                                            </div>
                                            <div class="mess__footer">
                                                <a href="#">View all messages</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-email"></i>
                                        <span class="quantity">1</span>
                                        <div class="email-dropdown js-dropdown">
                                            <div class="email__title">
                                                <p>You have 3 New Emails</p>
                                            </div>
                                            <div class="email__item">
                                                <div class="image img-cir img-40">
                                                    <img src="images/icon/avatar-06.jpg" alt="Cynthia Harvey" />
                                                </div>
                                                <div class="content">
                                                    <p>Meeting about new dashboard...</p>
                                                    <span>Cynthia Harvey, 3 min ago</span>
                                                </div>
                                            </div>
                                            <div class="email__item">
                                                <div class="image img-cir img-40">
                                                    <img src="images/icon/avatar-05.jpg" alt="Cynthia Harvey" />
                                                </div>
                                                <div class="content">
                                                    <p>Meeting about new dashboard...</p>
                                                    <span>Cynthia Harvey, Yesterday</span>
                                                </div>
                                            </div>
                                            <div class="email__item">
                                                <div class="image img-cir img-40">
                                                    <img src="images/icon/avatar-04.jpg" alt="Cynthia Harvey" />
                                                </div>
                                                <div class="content">
                                                    <p>Meeting about new dashboard...</p>
                                                    <span>Cynthia Harvey, April 12,,2018</span>
                                                </div>
                                            </div>
                                            <div class="email__footer">
                                                <a href="#">See all emails</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <span class="quantity">3</span>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title">
                                                <p>You have 3 Notifications</p>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c1 img-cir img-40">
                                                    <i class="zmdi zmdi-email-open"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a email notification</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c2 img-cir img-40">
                                                    <i class="zmdi zmdi-account-box"></i>
                                                </div>
                                                <div class="content">
                                                    <p>Your account has been blocked</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c3 img-cir img-40">
                                                    <i class="zmdi zmdi-file-text"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a new file</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__footer">
                                                <a href="#">All notifications</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="images/icon/avatar-01.jpg" alt="Yian.Tung" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">Yian.Tung</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="images/icon/avatar-01.jpg" alt="Yian.Tung" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">Yian.Tung</a>
                                                    </h5>
                                                    <span class="email">Yian.Tung@tci-bio.com</span>
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
                                                <a href="#">
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
                                    <h4>Custom Tab</h4>
                                </div>
                                <div class="card-body">
                                    <div class="custom-tab">
                                        <nav>
                                            <?php
                                            $file_name = "test"
                                            ?>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <a class="nav-item nav-link active" id="custom-nav-1-tab" data-toggle="tab" href="#custom-nav-1" role="tab" aria-controls="custom-nav-1"
                                                   aria-selected="true">抗氧化</a>
                                                <a class="nav-item nav-link" id="custom-nav-2-tab" data-toggle="tab" href="#custom-nav-2" role="tab" aria-controls="custom-nav-2"
                                                   aria-selected="false">抗老</a>
                                                <a class="nav-item nav-link" id="custom-nav-3-tab" data-toggle="tab" href="#custom-nav-3" role="tab" aria-controls="custom-nav-3"
                                                   aria-selected="false">DNA修復</a>
                                                <a class="nav-item nav-link" id="custom-nav-4-tab" data-toggle="tab" href="#custom-nav-4" role="tab" aria-controls="custom-nav-4"
                                                   aria-selected="true">免疫</a>
                                                <a class="nav-item nav-link" id="custom-nav-5-tab" data-toggle="tab" href="#custom-nav-5" role="tab" aria-controls="custom-nav-5"
                                                   aria-selected="false">護胃</a>
                                                <a class="nav-item nav-link" id="custom-nav-6-tab" data-toggle="tab" href="#custom-nav-6" role="tab" aria-controls="custom-nav-6"
                                                   aria-selected="false">護眼</a>
                                                <a class="nav-item nav-link" id="custom-nav-7-tab" data-toggle="tab" href="#custom-nav-7" role="tab" aria-controls="custom-nav-7"
                                                   aria-selected="false">美白</a>
                                                <a class="nav-item nav-link" id="custom-nav-8-tab" data-toggle="tab" href="#custom-nav-8" role="tab" aria-controls="custom-nav-8"
                                                   aria-selected="true">膠原蛋白合成</a>
                                                <a class="nav-item nav-link" id="custom-nav-9-tab" data-toggle="tab" href="#custom-nav-9" role="tab" aria-controls="custom-nav-9"
                                                   aria-selected="false">抗發炎</a>
                                                <a class="nav-item nav-link" id="custom-nav-10-tab" data-toggle="tab" href="#custom-nav-10" role="tab" aria-controls="custom-nav-10"
                                                   aria-selected="false">細胞凋亡</a>
                                                <a class="nav-item nav-link " id="custom-nav-11-tab" data-toggle="tab" href="#custom-nav-11" role="tab" aria-controls="custom-nav-11"
                                                   aria-selected="true">心血管保健</a>
                                                <a class="nav-item nav-link" id="custom-nav-12-tab" data-toggle="tab" href="#custom-nav-12" role="tab" aria-controls="custom-nav-12"
                                                   aria-selected="false">晝夜節律</a>
                                                <a class="nav-item nav-link" id="custom-nav-13-tab" data-toggle="tab" href="#custom-nav-13" role="tab" aria-controls="custom-nav-13"
                                                   aria-selected="false">非酒精性肝損傷</a>
                                                <a class="nav-item nav-link" id="custom-nav-14-tab" data-toggle="tab" href="#custom-nav-14" role="tab" aria-controls="custom-nav-14"
                                                   aria-selected="false">皮膚角質保濕</a>
                                            </div>
                                        </nav>
                                        <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="custom-nav-1" role="tabpanel" aria-labelledby="custom-nav-1-tab">
                                                <!-- DATA TABLE -->
                                                <h3 class="title-5 m-b-35">data table</h3>
                                                <div class="table-data__tool">
                                                    <div class="table-data__tool-left">
                                                        <div class="rs-select2--light rs-select2--md">
                                                            <select class="js-select2" name="property">
                                                                <option selected="selected">All Properties</option>
                                                                <option value="">Option 1</option>
                                                                <option value="">Option 2</option>
                                                            </select>
                                                            <div class="dropDownSelect2"></div>
                                                        </div>
                                                        <div class="rs-select2--light rs-select2--sm">
                                                            <select class="js-select2" name="time">
                                                                <option selected="selected">Today</option>
                                                                <option value="">3 Days</option>
                                                                <option value="">1 Week</option>
                                                            </select>
                                                            <div class="dropDownSelect2"></div>
                                                        </div>
                                                        <button class="au-btn-filter">
                                                            <i class="zmdi zmdi-filter-list"></i>filters</button>
                                                    </div>
                                                    <div class="table-data__tool-right">
                                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                                            <i class="zmdi zmdi-plus"></i>add item</button>
                                                        <div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                                                            <select class="js-select2" name="type">
                                                                <option selected="selected">Export</option>
                                                                <option value="">Option 1</option>
                                                                <option value="">Option 2</option>
                                                            </select>
                                                            <div class="dropDownSelect2"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="table-responsive table-responsive-data2">
                                                    <table class="table table-data2">
                                                        <thead>
                                                        <tr>
                                                            <th>
                                                                <label class="au-checkbox">
                                                                    <input type="checkbox">
                                                                    <span class="au-checkmark"></span>
                                                                </label>
                                                            </th>
                                                            <th>name</th>
                                                            <th>email</th>
                                                            <th>description</th>
                                                            <th>date</th>
                                                            <th>status</th>
                                                            <th>price</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr class="tr-shadow">
                                                            <td>
                                                                <label class="au-checkbox">
                                                                    <input type="checkbox">
                                                                    <span class="au-checkmark"></span>
                                                                </label>
                                                            </td>
                                                            <td>Lori Lynch</td>
                                                            <td>
                                                                <span class="block-email">lori@example.com</span>
                                                            </td>
                                                            <td class="desc">Samsung S8 Black</td>
                                                            <td>2018-09-27 02:12</td>
                                                            <td>
                                                                <span class="status--process">Processed</span>
                                                            </td>
                                                            <td>$679.00</td>
                                                        </tr>
                                                        <tr class="spacer"></tr>
                                                        <tr class="tr-shadow">
                                                            <td>
                                                                <label class="au-checkbox">
                                                                    <input type="checkbox">
                                                                    <span class="au-checkmark"></span>
                                                                </label>
                                                            </td>
                                                            <td>Lori Lynch</td>
                                                            <td>
                                                                <span class="block-email">john@example.com</span>
                                                            </td>
                                                            <td class="desc">iPhone X 64Gb Grey</td>
                                                            <td>2018-09-29 05:57</td>
                                                            <td>
                                                                <span class="status--process">Processed</span>
                                                            </td>
                                                            <td>$999.00</td>
                                                        </tr>
                                                        <tr class="spacer"></tr>
                                                        <tr class="tr-shadow">
                                                            <td>
                                                                <label class="au-checkbox">
                                                                    <input type="checkbox">
                                                                    <span class="au-checkmark"></span>
                                                                </label>
                                                            </td>
                                                            <td>Lori Lynch</td>
                                                            <td>
                                                                <span class="block-email">lyn@example.com</span>
                                                            </td>
                                                            <td class="desc">iPhone X 256Gb Black</td>
                                                            <td>2018-09-25 19:03</td>
                                                            <td>
                                                                <span class="status--denied">Denied</span>
                                                            </td>
                                                            <td>$1199.00</td>
                                                        </tr>
                                                        <tr class="spacer"></tr>
                                                        <tr class="tr-shadow">
                                                            <td>
                                                                <label class="au-checkbox">
                                                                    <input type="checkbox">
                                                                    <span class="au-checkmark"></span>
                                                                </label>
                                                            </td>
                                                            <td>Lori Lynch</td>
                                                            <td>
                                                                <span class="block-email">doe@example.com</span>
                                                            </td>
                                                            <td class="desc">Camera C430W 4k</td>
                                                            <td>2018-09-24 19:10</td>
                                                            <td>
                                                                <span class="status--process">Processed</span>
                                                            </td>
                                                            <td>$699.00</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- END DATA TABLE -->
                                            </div>
                                            <div class="tab-pane fade" id="custom-nav-2" role="tabpanel" aria-labelledby="custom-nav-2-tab">

                                            </div>
                                            <div class="tab-pane fade" id="custom-nav-3" role="tabpanel" aria-labelledby="custom-nav-3-tab">
                                            </div>
                                            <div class="tab-pane fade" id="custom-nav-4" role="tabpanel" aria-labelledby="custom-nav-4-tab">
                                            </div>
                                            <div class="tab-pane fade" id="custom-nav-5" role="tabpanel" aria-labelledby="custom-nav-5-tab">
                                            </div>
                                            <div class="tab-pane fade" id="custom-nav-6" role="tabpanel" aria-labelledby="custom-nav-6-tab">
                                            </div>
                                            <div class="tab-pane fade" id="custom-nav-7" role="tabpanel" aria-labelledby="custom-nav-7-tab">
                                            </div>
                                            <div class="tab-pane fade" id="custom-nav-8" role="tabpanel" aria-labelledby="custom-nav-8-tab">
                                            </div>
                                            <div class="tab-pane fade" id="custom-nav-9" role="tabpanel" aria-labelledby="custom-nav-9-tab">
                                            </div>
                                            <div class="tab-pane fade" id="custom-nav-10" role="tabpanel" aria-labelledby="custom-nav-10-tab">
                                            </div>
                                            <div class="tab-pane fade" id="custom-nav-11" role="tabpanel" aria-labelledby="custom-nav-11-tab">
                                            </div>
                                            <div class="tab-pane fade" id="custom-nav-12" role="tabpanel" aria-labelledby="custom-nav-12-tab">
                                            </div>
                                            <div class="tab-pane fade" id="custom-nav-13" role="tabpanel" aria-labelledby="custom-nav-13-tab">
                                            </div>
                                            <div class="tab-pane fade" id="custom-nav-14" role="tabpanel" aria-labelledby="custom-nav-14-tab">
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->


                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
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
