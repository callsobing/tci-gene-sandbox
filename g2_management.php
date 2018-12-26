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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css" rel="stylesheet" media="all">

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

    <!-- pager plugin -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.1/css/jquery.tablesorter.pager.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.1/js/extras/jquery.tablesorter.pager.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.1/js/widgets/widget-pager.min.js"></script>
    <style>
        .tablesorter-pager .btn-group-sm .btn {
            font-size: 1.2em; /* make pager arrows more visible */
        }
    </style>
</head>

<body class="animsition">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

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
                                <p>請選擇疾病</p>
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
                                </div>
                                <div class="row form-group">
                                    <button type="submit" name="submit" id="submit" class="btn btn-primary btn-sm">Submit</button>
                                    <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark"> <!-- add class="thead-light" for a light header -->
                    <tr>
                        <th>Name</th>
                        <th>Major</th>
                        <th class="filter-select filter-exact" data-placeholder="Pick a gender">Sex</th>
                        <th>English</th>
                        <th>Japanese</th>
                        <th>Calculus</th>
                        <th class="sorter-false filter-false">Geometry</th></tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Major</th>
                        <th>Sex</th>
                        <th>English</th>
                        <th>Japanese</th>
                        <th>Calculus</th>
                        <th>Geometry</th>
                    </tr>
                    <tr>
                        <th colspan="7" class="ts-pager">
                            <div class="form-inline">
                                <div class="btn-group btn-group-sm mx-1" role="group">
                                    <button type="button" class="btn btn-secondary first" title="first">⇤</button>
                                    <button type="button" class="btn btn-secondary prev" title="previous">←</button>
                                </div>
                                <span class="pagedisplay"></span>
                                <div class="btn-group btn-group-sm mx-1" role="group">
                                    <button type="button" class="btn btn-secondary next" title="next">→</button>
                                    <button type="button" class="btn btn-secondary last" title="last">⇥</button>
                                </div>
                                <select class="form-control-sm custom-select px-1 pagesize" title="Select page size">
                                    <option selected="selected" value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="all">All Rows</option>
                                </select>
                                <select class="form-control-sm custom-select px-4 mx-1 pagenum" title="Select page number"></select>
                            </div>
                        </th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <tr><td>Student01</td><td>Languages</td><td>male</td><td>80</td><td>70</td><td>75</td><td>80</td></tr>
                    <tr><td>Student02</td><td>Mathematics</td><td>male</td><td>90</td><td>88</td><td>100</td><td>90</td></tr>
                    <tr><td>Student03</td><td>Languages</td><td>female</td><td>85</td><td>95</td><td>80</td><td>85</td></tr>
                    <tr><td>Student04</td><td>Languages</td><td>male</td><td>60</td><td>55</td><td>100</td><td>100</td></tr>
                    <tr><td>Student05</td><td>Languages</td><td>female</td><td>68</td><td>80</td><td>95</td><td>80</td></tr>
                    <tr><td>Student06</td><td>Mathematics</td><td>male</td><td>100</td><td>99</td><td>100</td><td>90</td></tr>
                    <tr><td>Student07</td><td>Mathematics</td><td>male</td><td>85</td><td>68</td><td>90</td><td>90</td></tr>
                    <tr><td>Student08</td><td>Languages</td><td>male</td><td>100</td><td>90</td><td>90</td><td>85</td></tr>
                    <tr><td>Student09</td><td>Mathematics</td><td>male</td><td>80</td><td>50</td><td>65</td><td>75</td></tr>
                    <tr><td>Student10</td><td>Languages</td><td>male</td><td>85</td><td>100</td><td>100</td><td>90</td></tr>
                    <tr><td>Student11</td><td>Languages</td><td>male</td><td>86</td><td>85</td><td>100</td><td>100</td></tr>
                    <tr><td>Student12</td><td>Mathematics</td><td>female</td><td>100</td><td>75</td><td>70</td><td>85</td></tr>
                    <tr><td>Student13</td><td>Languages</td><td>female</td><td>100</td><td>80</td><td>100</td><td>90</td></tr>
                    <tr><td>Student14</td><td>Languages</td><td>female</td><td>50</td><td>45</td><td>55</td><td>90</td></tr>
                    <tr><td>Student15</td><td>Languages</td><td>male</td><td>95</td><td>35</td><td>100</td><td>90</td></tr>
                    <tr><td>Student16</td><td>Languages</td><td>female</td><td>100</td><td>50</td><td>30</td><td>70</td></tr>
                    <tr><td>Student17</td><td>Languages</td><td>female</td><td>80</td><td>100</td><td>55</td><td>65</td></tr>
                    <tr><td>Student18</td><td>Mathematics</td><td>male</td><td>30</td><td>49</td><td>55</td><td>75</td></tr>
                    <tr><td>Student19</td><td>Languages</td><td>male</td><td>68</td><td>90</td><td>88</td><td>70</td></tr>
                    <tr><td>Student20</td><td>Mathematics</td><td>male</td><td>40</td><td>45</td><td>40</td><td>80</td></tr>
                    <tr><td>Student21</td><td>Languages</td><td>male</td><td>50</td><td>45</td><td>100</td><td>100</td></tr>
                    <tr><td>Student22</td><td>Mathematics</td><td>male</td><td>100</td><td>99</td><td>100</td><td>90</td></tr>
                    <tr><td>Student23</td><td>Mathematics</td><td>male</td><td>82</td><td>77</td><td>0</td><td>79</td></tr>
                    <tr><td>Student24</td><td>Languages</td><td>female</td><td>100</td><td>91</td><td>13</td><td>82</td></tr>
                    <tr><td>Student25</td><td>Mathematics</td><td>male</td><td>22</td><td>96</td><td>82</td><td>53</td></tr>
                    <tr><td>Student26</td><td>Languages</td><td>female</td><td>37</td><td>29</td><td>56</td><td>59</td></tr>
                    <tr><td>Student27</td><td>Mathematics</td><td>male</td><td>86</td><td>82</td><td>69</td><td>23</td></tr>
                    <tr><td>Student28</td><td>Languages</td><td>female</td><td>44</td><td>25</td><td>43</td><td>1</td></tr>
                    <tr><td>Student29</td><td>Mathematics</td><td>male</td><td>77</td><td>47</td><td>22</td><td>38</td></tr>
                    <tr><td>Student30</td><td>Languages</td><td>female</td><td>19</td><td>35</td><td>23</td><td>10</td></tr>
                    <tr><td>Student31</td><td>Mathematics</td><td>male</td><td>90</td><td>27</td><td>17</td><td>50</td></tr>
                    <tr><td>Student32</td><td>Languages</td><td>female</td><td>60</td><td>75</td><td>33</td><td>38</td></tr>
                    <tr><td>Student33</td><td>Mathematics</td><td>male</td><td>4</td><td>31</td><td>37</td><td>15</td></tr>
                    <tr><td>Student34</td><td>Languages</td><td>female</td><td>77</td><td>97</td><td>81</td><td>44</td></tr>
                    <tr><td>Student35</td><td>Mathematics</td><td>male</td><td>5</td><td>81</td><td>51</td><td>95</td></tr>
                    <tr><td>Student36</td><td>Languages</td><td>female</td><td>70</td><td>61</td><td>70</td><td>94</td></tr>
                    <tr><td>Student37</td><td>Mathematics</td><td>male</td><td>60</td><td>3</td><td>61</td><td>84</td></tr>
                    <tr><td>Student38</td><td>Languages</td><td>female</td><td>63</td><td>39</td><td>0</td><td>11</td></tr>
                    <tr><td>Student39</td><td>Mathematics</td><td>male</td><td>50</td><td>46</td><td>32</td><td>38</td></tr>
                    <tr><td>Student40</td><td>Languages</td><td>female</td><td>51</td><td>75</td><td>25</td><td>3</td></tr>
                    <tr><td>Student41</td><td>Mathematics</td><td>male</td><td>43</td><td>34</td><td>28</td><td>78</td></tr>
                    <tr><td>Student42</td><td>Languages</td><td>female</td><td>11</td><td>89</td><td>60</td><td>95</td></tr>
                    <tr><td>Student43</td><td>Mathematics</td><td>male</td><td>48</td><td>92</td><td>18</td><td>88</td></tr>
                    <tr><td>Student44</td><td>Languages</td><td>female</td><td>82</td><td>2</td><td>59</td><td>73</td></tr>
                    <tr><td>Student45</td><td>Mathematics</td><td>male</td><td>91</td><td>73</td><td>37</td><td>39</td></tr>
                    <tr><td>Student46</td><td>Languages</td><td>female</td><td>4</td><td>8</td><td>12</td><td>10</td></tr>
                    <tr><td>Student47</td><td>Mathematics</td><td>male</td><td>89</td><td>10</td><td>6</td><td>11</td></tr>
                    <tr><td>Student48</td><td>Languages</td><td>female</td><td>90</td><td>32</td><td>21</td><td>18</td></tr>
                    <tr><td>Student49</td><td>Mathematics</td><td>male</td><td>42</td><td>49</td><td>49</td><td>72</td></tr>
                    <tr><td>Student50</td><td>Languages</td><td>female</td><td>56</td><td>37</td><td>67</td><td>54</td></tr>
                    </tbody>
                </table>
                <!-- 有收到資料才show下面欄位 -->
                    <!-- DATA TABLE-->
<!--                <table id="data_table" class="table table-striped table-bordered" style="width:100%">-->
<!--                    <thead>-->
<!--                    <tr>-->
<!--                        <th width="15%">會員編號</th>-->
<!--                        <th width="10%">姓名</th>-->
<!--                        <th width="15%">性別</th>-->
<!--                        <th width="15%">生日</th>-->
<!--                        <th width="15%">年齡</th>-->
<!--                        <th width="30%">電話</th>-->
<!--                        <th width="30%">地址</th>-->
<!--                        <th width="30%">備註</th>-->
<!--                        <th width="30%">電話</th>-->
<!--                    </tr>-->
<!--                    </thead>-->
<!--                    <tbody>-->
<!--                    --><?php
//                    while($row = mysql_fetch_array($result))
//                    {
//                        $file_name = $row['name'];
//                        $file_size = $row['size'];
//                        $uploader = $row['uploader'];
//                        $memo = $row['memo'];
//                        $date = $row['date'];
//                        echo("<tr>");
//                        echo("<td>$file_name</td>");
//                        echo("<td>$file_size KB</td>");
//                        echo("<td>$date</td>");
//                        echo("<td><a href='$target_dir$file_name' target=\"_blank\">下載</a></td>");
//                        echo("<td>刪除</td>");
//                        echo("<td>$memo</td></tr>");
//                    }
//                    ?>
<!--                    </tbody>-->
<!--                </table>-->
                <!-- END DATA TABLE-->

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


<!-- Main JS-->
<script src="js/main.js"></script>
<!-- 檢查表單正確性  -->
<script>
    $(function() {

        $("table").tablesorter({
            theme : "bootstrap",

            widthFixed: true,

            // widget code contained in the jquery.tablesorter.widgets.js file
            // use the zebra stripe widget if you plan on hiding any rows (filter widget)
            // the uitheme widget is NOT REQUIRED!
            widgets : [ "filter", "columns", "zebra" ],

            widgetOptions : {
                // using the default zebra striping class name, so it actually isn't included in the theme variable above
                // this is ONLY needed for bootstrap theming if you are using the filter widget, because rows are hidden
                zebra : ["even", "odd"],

                // class names added to columns when sorted
                columns: [ "primary", "secondary", "tertiary" ],

                // reset filters button
                filter_reset : ".reset",

                // extra css class name (string or array) added to the filter element (input or select)
                filter_cssFilter: [
                    'form-control',
                    'form-control',
                    'form-control custom-select', // select needs custom class names :(
                    'form-control',
                    'form-control',
                    'form-control',
                    'form-control'
                ]

            }
        })
            .tablesorterPager({

                // target the pager markup - see the HTML block below
                container: $(".ts-pager"),

                // target the pager page select dropdown - choose a page
                cssGoto  : ".pagenum",

                // remove rows from the table to speed up the sort of large tables.
                // setting this to false, only hides the non-visible rows; needed if you plan to add/remove rows with the pager enabled.
                removeRows: false,

                // output string - default is '{page}/{totalPages}';
                // possible variables: {page}, {totalPages}, {filteredPages}, {startRow}, {endRow}, {filteredRows} and {totalRows}
                output: '{startRow} - {endRow} / {filteredRows} ({totalRows})'

            });

    });
</script>
</body>

</html>
<!-- end document-->
