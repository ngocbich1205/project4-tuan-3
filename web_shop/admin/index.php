<?php
require_once('../db/dbhelper.php');
ob_start();
session_start();
$sql          = 'select * from thumuc';
$thumucList = executeResult($sql);
$sql1          = 'select * from menu';
$menuList = executeResult($sql1);
$sql2          = 'SELECT * FROM `acc` WHERE userName = "' . $_SESSION['login'] . '"';
$acc = executeSingleResult($sql2);
$sql3         = 'SELECT * FROM `admin` WHERE userName = "' . $_SESSION['login'] . '"';
$acc_admin = executeSingleResult($sql3);
$login = 0;
if (!isset($_SESSION['admin'])) {
    $acc['id'] = '';
    $_SESSION['login'] = 'khach hang';
    header('Location:../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEB BÁN SMART PHONE</title>
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="admin_css.css">
    <script src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <div class="main">
        <div class="nav fixed-top">
            <label for="menu__hien" class="nav_bars-btn">
                <span class="material-symbols-outlined"><b style="font-size:30px;">menu</b></span>
            </label>
            <div style="width:8%;float:left; min-width: 55px; max-width: 65px;padding-top: 9px;">
                <a href="index.php"><img src="../img/logo.png" width="60%"></a>
            </div>
        </div>
        <input hidden type="checkbox" class="menu__hien" id="menu__hien">
        <div class="nav__menu">
            <ul class="nav__mobile-list">
                <li style="margin-top:80px ;">
                    <form class="d-flex nav__search">
                        <input class="form-control me-2 " type="text" placeholder="Bạn cần tìm gì ? &#9997;">
                        <button style="background:#ffffff ;" hidden type="submit" name="tim"><i
                                class="material-icons">search</i></button>
                    </form>
                </li>
                <b style="color:black;font-size:17px;padding-left:15px;">Xin chào&ensp;<?php $_SESSION['login'] ?></b>
                <li>
                    <a href="index.php" class="nav__mobile-link">Home</a>
                </li>
                <li>
                    <a class="nav__mobile-link" href="page/QuanLyTK/index.php"><button name="hang"
                            style="background:none">Quản lý Tài Khoản </button></a>
                </li>
                <li>
                    <a class="nav__mobile-link" href="page/QuanLySP/index.php"><button name="hang"
                            style="background:none">Quản lý Sản Phẩm</button></a>
                </li>
                <li>
                    <a href="page/QuanLyDon/index.php" class="nav__mobile-link">Quản lý Đơn Hàng</a>
                </li>
                <li>
                    <a href="../Homepage/Tk/delsession.php" class="nav__mobile-link">Đăng xuất</a>
                </li>
            </ul>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="block-header">
                    <h1>Hệ thống quản trị nội dung</h2>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-pink hover-expand-effect">
                            <div class="icon">
                            <span class="material-symbols-outlined admin_icon" style="font-size: 60px;padding: 10px 10px;">playlist_add</span>
                            </div>
                            <div class="content">
                                <div class="text">NEW TASKS</div>
                                <div class="number count-to" data-from="0" data-to="105" data-speed="1000"
                                    data-fresh-interval="20"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-cyan hover-expand-effect">
                            <div class="icon">
                            <span class="material-symbols-outlined admin_icon" style="font-size: 60px;padding: 10px 10px;">help</span>
                            </div>
                            <div class="content">
                                <div class="text">NEW TICKETS</div>
                                <div class="number count-to" data-from="0" data-to="257" data-speed="1000"
                                    data-fresh-interval="20"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-light-green hover-expand-effect">
                            <div class="icon">
                            <span class="material-symbols-outlined admin_icon" style="font-size: 60px;padding: 10px 10px;">forum</span>
                            </div>
                            <div class="content">
                                <div class="text">NEW COMMENTS</div>
                                <div class="number count-to" data-from="0" data-to="243" data-speed="1000"
                                    data-fresh-interval="20"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-orange hover-expand-effect">
                            <div class="icon">
                            <span class="material-symbols-outlined admin_icon" style="font-size: 60px;padding: 10px 10px;">person_add</span>
                            </div>
                            <div class="content">
                                <div class="text">NEW VISITORS</div>
                                <div class="number count-to" data-from="0" data-to="1225" data-speed="1000"
                                    data-fresh-interval="20"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-6">
                        <div class="card">
                            <div class="body bg-cyan">
                                <div class="m-b--35 font-bold">SẢN PHẨM BÁN CHẠY</div>
                                <ul class="dashboard-stat-list">
                                    <li style="padding:0px">
                                        # Iphone 14 pro max
                                        <span class="pull-right">
                                        <span class="material-symbols-outlined">trending_up</span>
                                        </span>
                                    </li>
                                    <li style="padding:0px">
                                        # Iphone 13 pro max
                                        <span class="pull-right">
                                        <span class="material-symbols-outlined">trending_up</span>
                                        </span>
                                    </li>
                                    <li style="padding-top:17px"><span class="pull-right"># Xiaomi Mi 12</li>
                                    <li style="padding-top:17px"><span class="pull-right"># Samsung S22 </li>
                                    <li style="padding-top:17px"><span class="pull-right"># Samsung z flip 4</li>
                                    <li style="padding-top:17px">
                                        #Oppo Reno 7
                                        <span class="pull-right">
                                        <span class="material-symbols-outlined">trending_up</span>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-6">
                        <div class="card">
                            <div class="body bg-teal">
                                <div class="font-bold m-b--35">SỐ LƯỢNG ĐÃ BÁN</div>
                                <ul class="dashboard-stat-list">
                                    <li>
                                        HÔM NAY
                                        <span class="pull-right" style="float:right"><b>5</b> <small>SẢN PHẨM</small></span>
                                    </li>
                                    <li>
                                        HÔM QUA
                                        <span class="pull-right" style="float:right"><b>7</b> <small>SẢN PHẨM</small></span>
                                    </li>
                                    <li>
                                        TUẦN TRƯỚC
                                        <span class="pull-right" style="float:right"><b>50</b> <small>SẢN PHẨM</small></span>
                                    </li>
                                    <li>
                                        THÁNG TRƯỚC
                                        <span class="pull-right" style="float:right"><b>234</b> <small>SẢN PHẨM</small></span>
                                    </li>
                                    <li>
                                        NĂM TRƯỚC
                                        <span class="pull-right" style="float:right"><b>3024</b> <small>SẢN PHẨM</small></span>
                                    </li>
                                    <li>
                                        TỔNG
                                        <span class="pull-right" style="float:right"><b>3320</b> <small>SẢN PHẨM</small></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2>THÔNG TIN DOANH SỐ</h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-hover dashboard-task-infos">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Sản phẩm </th>
                                                <th>Trạng thái</th>
                                                <th>Quản lý</th>
                                                <th>Doanh Số</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Iphone</td>
                                                <td><span class="label bg-green">Active</span></td>
                                                <td>Admin</td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-green" role="progressbar"
                                                            aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"
                                                            style="width: 70%"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>SamSung</td>
                                                <td><span class="label bg-blue">Active</span></td>
                                                <td>Admin</td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-blue" role="progressbar"
                                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"
                                                            style="width: 50%"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Oppo</td>
                                                <td><span class="label bg-light-blue">Active</span></td>
                                                <td>Admin</td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-light-blue" role="progressbar"
                                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                                            style="width: 40%"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Xiaomi</td>
                                                <td><span class="label bg-orange">Active</span></td>
                                                <td>Admin</td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-orange" role="progressbar"
                                                            aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"
                                                            style="width: 35%"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Realme</td>
                                                <td>
                                                    <span class="label bg-red">Active</span>
                                                </td>
                                                <td>Admin</td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-red" role="progressbar"
                                                            aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"
                                                            style="width: 30%"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>
<script>
if ($(window).width() <= 1069) {
    document.getElementById('menu__hien').checked = '';
}
</script>