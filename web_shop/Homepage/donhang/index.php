<?php
require_once('../../db/dbhelper.php');
ob_start();
session_start();
$sql          = 'select * from thumuc';
$thumucList = executeResult($sql);
$sql1          = 'select * from menu';
$menuList = executeResult($sql1);
$sql2          = 'SELECT * FROM `acc` WHERE userName = "' . $_SESSION['login'] . '"';
$acc = executeSingleResult($sql2);
$login = 0;
if (!isset($_SESSION['login'])) {
    $acc['id'] = '';
    $_SESSION['login'] = 'khach hang';
    header('Location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEB BÁN SMART PHONE</title>
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../css.css">
    <link href="../home.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
</head>

<body>
    <div>
        <div class="main">
            <div class="nav fixed-top">
                <!-- Nav PC -->
                <nav class="nav__pc">
                    <div style="width:8%;float:left; max-width: 55px;padding-top: 9px;">
                        <a href="../index.php"><img src="../../img/logo.png" width="60%"></a>
                    </div>
                    <ul class="nav__list">
                        <li>
                            <a href="../index.php" style="color: #fff;" class="nav__link">Home</a>
                        </li>
                        <?php
                        foreach ($thumucList as $item) {
                            echo '<li >
                            <a class="nav__link" href="../index.php?id=' . $item['name'] . '"><button name = "hang" style="background:none;font-size:16px;width:80px">' . $item['name'] . '</button></a>
                            </li>';
                        }
                        $noidung = '';
                        foreach ($menuList as $item) {
                            echo '<li id="menu__pc">
                                <a  class="nav__link" href="../index.php?id=' . $item['content'] . '"><button style="background:none;font-size:16px;width:80px"> ' . $item['Name'] . '</button> </a>
                            </li>';
                        }
                        echo '
                        <li>
                            <form class="d-flex nav__search">
                                <input class="form-control me-2 " type="text" placeholder="Bạn cần tìm gì ? &#9997;">
                                <button style="background:#ffffff ;" hidden type="submit" name="tim"><i class="material-icons">search</i></button>
                            </form>
                        </li>';
                        $cart = $_SESSION['login'];
                        if ($_SESSION['login'] == 'khach hang') {
                            echo '<li>
                        <label style="margin-left:10px;width:60px" class="clickon__pc" for="dangky" class="nav__link">Đăng ký</label>
                            </li>';
                            echo '<li>
                           <label style="padding-left:20px;width: 100px" class="clickon__pc" for="login" class="nav__link">Đăng nhập</label>
                        </li>';
                        } else {
                            $stt = 0;
                            $sql_cart = 'SELECT * FROM `cart` WHERE userName_acc ="' . $_SESSION['login'] . '"';
                            $cart = executeResult($sql_cart);
                            foreach ($cart as $value) {
                                $stt++;
                            }
                            echo '<li><a href="index.php" class="nav__link"><button style="background:none;margin-left:30%;width:70px">Đơn Hàng</button></a></li>';
                            echo '<b class="xinchao__pc" style="color:#f1f1f1;font-size:17px;padding-left:8px">Xin chào&ensp;' . $_SESSION['login'] . '</b>';
                            echo '<div class="dropdown " style="padding-left:15px;padding-right:50px">
                                <span type="button" class="material-symbols-outlined" data-bs-toggle="dropdown" style="font-size:26px;color: #fff;">menu</span>
                                <ul class="dropdown-menu">
                                <li><button class="dropdown-item" style="border:0px;color:black;background:none;font-size:16px" onclick="myDoiTt()" >Đổi Thông Tin</button></li>
                                <li><button class="dropdown-item" style="border:0px;color:black;background:none;font-size:16px" for="login" onclick="DoiMK()" >Đổi Mật Khẩu</button> </li>
                                    <li><a class="dropdown-item" href="../Tk/delsession.php">Đăng xuất</a></li>
                                </ul>
                            </div>
                            <a href="../index.php?id=giohang"style="text-decoration: none;">
                                <div class="nav__cart">
                                    <span style="font-size: 38px;" class="material-symbols-outlined">shopping_bag</span>
                                    <div class="nav__sl" >' . $stt . '</div>
                                </div>
                            </a>';
                        }
                        ?>
                    </ul>
                </nav>
                <label for="close" class="nav_bars-btn">
                    <span class="material-symbols-outlined"><b style="font-size:30px;">menu</b></span>
                </label>
                <input hidden type="checkbox" class="nav__input" id="close">
                <label for="close" class="nav__overlay"></label>
                <nav class="nav__mobile fixed-top">
                    <label for="close" class="nav__mobile-close">
                        <div style="float:left; max-width: 55px;padding-top: 9px;margin-right: 180px;">
                            <a href="../index.php"><img src="../../img/logo.png" width="80%"></a>
                        </div>
                        <span class="material-symbols-outlined"><b style="font-size:40px;">close</b></span>
                    </label>
                    <ul class="nav__mobile-list">
                        <li style="margin-top:80px ;">
                            <form class="d-flex nav__search">
                                <input class="form-control me-2 " type="text" placeholder="Bạn cần tìm gì ? &#9997;">
                                <button style="background:#ffffff ;" hidden type="submit" name="tim"><i
                                        class="material-icons">search</i></button>
                            </form>
                        </li>

                        <?php
                        if ($_SESSION['login'] != 'khach hang') {
                            echo '<b style="color:black;font-size:17px;padding-left:15px;">Xin chào&ensp;' . $_SESSION['login'] . '</b>
                        ';
                        }
                        echo '<li>
                            <a href="index.php" class="nav__mobile-link">Home</a>
                        </li>';
                        foreach ($thumucList as $item) {
                            echo '<li >
                                <a class="nav__mobile-link" href="../index.php?id=' . $item['name'] . '"><button name = "hang" style="background:none">' . $item['name'] . '</button></a>
                                </li>';
                        }
                        $noidung = '';
                        echo '  <li>
                                    <a href="index.php" class="nav__mobile-link">Đơn Hàng</a>
                                </li> 
                                <li>
                                    <a href="../index.php?id=giohang" class="nav__mobile-link">Giỏ Hàng</a>
                                </li>';
                        ?>
                        <style>
                        .menu__cha {
                            list-style: none;
                            padding: 3px 30px;
                        }

                        .menu__cha li {
                            display: none;
                        }

                        :hover.menu__cha li {
                            display: block;
                            list-style: none;

                        }

                        a {
                            text-decoration: none;
                            color: #333;
                        }

                        .menu__con {
                            margin: 8px 0;
                        }

                        .menu__con:hover {
                            background-color: darkgray;
                        }
                        </style>
                        <?php

                        if ($_SESSION['login'] == 'khach hang') {
                            echo '<li>
                                    <label style="padding-left:25px" for="dangky" class="nav__mobile-link">Đăng ký</label>
                                </li>';
                            echo '<li>
                               <label style="padding-left:25px" for="login" class="nav__mobile-link">Đăng nhập</label>
                            </li>';
                        } else {

                            echo '<li>
                                <ul class="menu__cha"> <span>Tài Khoản</span> 
                                    <li class="menu__con"><button style="border:0px;color:black;background:none;font-size:16px" onclick="myDoiTt()" >Đổi Thông Tin</button></li>
                                    <li class="menu__con"><button style="border:0px;color:black;background:none;font-size:16px" for="login" onclick="DoiMK()" >Đổi Mật Khẩu</button> </li>
                                    <li class="menu__con"> <a href="Tk/delsession.php">Đăng xuất</a> </li>
                                </ul>
                            </li>';
                        }
                        ?>

                    </ul>

                </nav>

                <!-- Đăng nhập/ SĐăng ký tài khoản -->
                <?php
                $checkbox = false;
                $checkbox1 = false;
                if (isset($_POST['dangnhap'])) {
                    $checkbox = true;
                }
                ?>
                <input type="checkbox" hidden <?php echo ($checkbox1) ? "checked" : '' ?> class="dangky__pc-input"
                    id="dangky" onclick="mycheck()">
                <label for="dangky" class="nav__overlay_dangky" name="dangky"></label>
                <input type="checkbox" hidden <?php echo ($checkbox) ? "checked" : '' ?> class="dangnhap__pc-input"
                    id="login" onclick="mycheck()">
                <label for="login" class="nav__overlay_login"></label>
                <script>
                function mycheck() {
                    if (document.getElementById('dangky').checked) {
                        document.getElementById('close').checked = '';
                        document.getElementById('login').checked = '';
                    }
                    if (document.getElementById('login').checked) {
                        document.getElementById('dangky').checked = '';
                        document.getElementById('close').checked = '';
                    }
                }
                </script>
                <div class="dangnhap__pc">
                    <?php
                    $userName = '';
                    $password = '';
                    if (isset($_SESSION['login'])) {
                    }
                    if (isset($_POST['dangnhap'])) {
                        $userName = $_POST['userName'];
                        $password = $_POST['password'];
                        $sql_admin = "select * from admin where userName='$userName' and password='$password' ";
                        $sql = "select * from acc where userName='$userName' and password='$password' ";
                        //hiển thị password
                        if (isset($_POST['checkbox'])) {
                            setcookie('userName', $userName);
                            setcookie('password', $password);
                        }
                        // đăng nhập vào tk người dùng
                        if (executeResult($sql)) {
                            $_SESSION['login'] = $_POST['userName'];
                            header('location:index.php');
                        } elseif (executeResult($sql_admin)) {
                            $_SESSION["admin"] = $_POST['userName'];
                            header('location: ../admin/index.php');
                        }
                        echo '<script> alert ("Tài khoản Hoặc Mật Khẩu Sai") </script>';
                    }
                    //kiểm tra có tích vào hiện password hay ko
                    $check = false;
                    if (isset($_COOKIE['userName']) && isset($_COOKIE['password'])) {
                        $userName = $_COOKIE['userName'];
                        $password = $_COOKIE['password'];
                        $check = true;
                    }
                    ?>
                    <div style="height:400px;">
                        <div id="container" class="container">
                            <div class="row justify-content-around">
                                <form action="#" method="post" style="margin-top: 10%;">
                                    <label for="login" class="nav__mobile-close"><span
                                            class="material-symbols-outlined"><b
                                                style="font-size:40px;">close</b></span></label>
                                    <h2 style="text-align:center ;">Đăng Nhập </h2>
                                    <!--Tài khoản -->
                                    <tr>
                                        <td>
                                            <label for="userName" class="form-label">Tài Khoản :</label>
                                            <input type="userName" class="form-control" id="userName" name="userName"
                                                value="<?php echo $userName ?>" required>
                                        </td>
                                    </tr>
                                    <!-- Mật khẩu -->
                                    <tr>
                                        <td>
                                            <label for="password" class="form-label">Mật Khẩu:</label>
                                            <input style="margin-bottom: 2%;" type="password" class="form-control"
                                                id="password" name="password" value="<?php echo $password ?>" required>
                                        </td>
                                    </tr>
                                    <input id="hien" type="checkbox" onclick="myFunction()">
                                    <label for="hien" class="hienmk">Hiện Mật Khẩu</label>
                                    <!--nhớ Mật khẩu -->
                                    <tr>
                                        <td>
                                            <input style="margin-bottom: 1%;" type="checkbox" id="checkbox"
                                                name="checkbox" <?php echo ($check) ? "checked" : '' ?>>
                                            <label for="checkbox">Nhớ Mật Khẩu</label><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><input type="submit" value="Đăng Nhập" name="dangnhap"
                                                class="btn-primary btn"
                                                style="width: 100%; margin-top: 4%;font-size: 16px;" /></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <br><a href="forgotaccount.php" style="color:blue;margin-left:10px">Quên mật
                                                Khẩu ?</a>
                                        </td>
                                        <td>
                                            <a href="Register.php" style="float:right;margin-right:5%">
                                                Đăng Ký
                                            </a>
                                        </td>
                                    </tr>

                                </form>
                            </div>
                        </div>
                    </div>
                    <script>
                    function myFunction() {
                        var x = document.getElementById("password");
                        if (x.type === "password") {
                            x.type = "text";
                        } else {
                            x.type = "password";
                        }
                    }
                    </script>
                </div>

                <div class="dangky__pc">
                    <?php
                    $data = [];
                    $errors = [];
                    $kiemtra = 0;
                    $data['userName'] = $data['password'] = $data['confirmPass'] = $data['NamS'] = $data['gender'] =
                        $data['TenKh'] = $data['Diachi'] = $data['email'] = $data['Phone'] = '';
                    $data['userName'] = (isset($_POST['userName'])) ? $_POST['userName'] : '';
                    $data['password'] = (isset($_POST['password'])) ? $_POST['password'] : '';
                    $data['confirmPass'] = (isset($_POST['confirmPass'])) ? $_POST['confirmPass'] : '';
                    $data['gender'] = (isset($_POST['gender'])) ? $_POST['gender'] : '';
                    $data['email'] = (isset($_POST['email'])) ? $_POST['email'] : '';
                    $data['TenKh'] = (isset($_POST['TenKh'])) ? $_POST['TenKh'] : '';
                    $data['NamS'] = (isset($_POST['NamS'])) ? $_POST['NamS'] : '';
                    $data['Diachi'] = (isset($_POST['Diachi'])) ? $_POST['Diachi'] : '';
                    $data['Phone'] = (isset($_POST['Phone'])) ? $_POST['Phone'] : '';
                    if (isset($_POST['kt'])) {
                        $checkbox1 = true;
                        //Tài khoản
                        if (empty($data['userName'])) {
                            $errors['userName'] = "Bạn chưa nhập vào tên tài khoản";
                        } elseif ($data['userName'] == 'Admin') {
                            $errors['userName'] = "Tài Khoản đã tồn tại";
                        }
                        //Mật khẩu
                        elseif (empty($data['password'])) {
                            $errors['password'] = "Bạn chưa nhập vào mật khẩu";
                        } elseif (strlen($data['password']) < 6) {
                            $data['password'] = '';
                            $errors['password'] = "Mật khẩu gồm 6-20 ký tự";
                        }
                        //Xác nhận mật khẩu
                        elseif (empty($data['confirmPass'])) {
                            $errors['confirmPass'] = "Bạn chưa nhập vào mật khẩu";
                        } elseif ($data['password'] != $data['confirmPass']) {
                            $errors['confirmPass'] = "Mật khẩu và xác nhận mật khẩu phải giống nhau";
                        }
                        //Tên khach
                        elseif (empty($data['TenKh'])) {
                            $errors['TenKh'] = "Bạn chưa nhập vào tên ";
                        } elseif (strlen($data['TenKh']) > 50) {
                            $data['TenKh'] = '';
                            $errors['TenKh'] = "Tên không quá 50 ký tự";
                        } elseif (!preg_match('/[a-zA-Z]/', $data['TenKh'])) {
                            $errors['TenKh'] = "Tên chỉ bao gồm các ký tự từ A-Z ";
                        }
                        //Năm sinh
                        elseif (empty($data['NamS'])) {
                            $errors['NamS'] = "vui lòng nhấp Năm sinh";
                        }
                        //Địa chỉ
                        elseif (empty($data['Diachi'])) {
                            $errors['Diachi'] = "Bạn chưa nhập vào Địa chỉ";
                        }
                        //Email
                        elseif (empty($data['email'])) {
                            $errors['email'] = "Bạn chưa nhập email";
                        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                            $errors['email'] = "Email không đúng định dạng";
                        }
                        //Phone
                        elseif (empty($data['Phone'])) {
                            $errors['Phone'] = "Bạn chưa nhập vào số điện thoại ";
                        } elseif (strlen($data['Phone']) > 10) {
                            $data['Phone'] = '';
                            $errors['Phone'] = "số điện thoại gồm 10 số";
                        } elseif (strlen($data['Phone']) < 10) {
                            $data['Phone'] = '';
                            $errors['Phone'] = "số điện thoại gồm 10 số";
                        } elseif (!preg_match('/^[0-9]*$/', $data['Phone'])) {
                            $data['Phone'] = '';
                            $errors['Phone'] = "Số điện thoại là các số từ 0-9";
                        } elseif (isset($_POST['kt'])) {
                            $userName = $_POST['userName'];
                            $password = $_POST['password'];
                            $email = $_POST['email'];
                            $sql = "select * from acc where userName='$userName'";
                            $sql_email = "select * from acc where email='$email'";
                            if (executeResult($sql)) {
                                echo '<script> alert ("Tài khoản đã tồn tại") </script>';
                            } elseif (executeResult($sql_email)) {
                                echo '<script> alert ("Email đã đcược tạo tài khoản ") </script>';
                            } else {
                                $kiemtra = 1;
                            }
                        }
                        if ($kiemtra == 1) {
                            $ngaytao = date('Y-m-d H:s:i');
                            //Luu vao database
                            $sql = 'insert into acc(userName, password, gender, email,TenKh,NamS, Phone,Diachi,ngaytao) 
                values ("' . $data['userName'] . '",  "' . $data['password'] . '",' . $data['gender'] . ',
                "' . $data['email'] . '", "' . $data['TenKh'] . '", "' . $data['NamS'] . '", "' . $data['Phone'] . '","' . $data['Diachi'] . '","' . $ngaytao . '")';
                            execute($sql);
                        }
                    }
                    ?>
                    <div class="container">
                        <div class="row">
                            <form action="#" method="post" enctype="multipart/form-data" class="p-3">
                                <label for="dangky" class="nav__mobile-close"><span class="material-symbols-outlined"><b
                                            style="font-size:40px;">close</b></span></label>
                                <table style="border:none;text-align: left;margin-top:10px;width:100%">
                                    <h2 style="text-align:center ;">Đăng ký tài khoản </h2>
                                    <!--tài khoản-->
                                    <tr>
                                        <td style="text-align: left;font-size:16px">
                                            <label for="userName" class="form-label">Tài Khoản :</label>
                                            <span
                                                style="color:red ;padding-top: 25px;"><?= (empty($errors['userName'])) ? '' : $errors['userName'] ?></span>
                                            <input style="width:100%; " type="userName" class="form-control"
                                                id="userName" name="userName" value="<?= $data['userName'] ?>" required>
                                        </td>
                                        <td style="text-align: left;font-size:16px">
                                            <label for="TenKh" class="form-label">Tên Khách hàng:</label>
                                            <span style="color:red ;padding-top: 25px;">
                                                <?= (empty($errors['TenKh'])) ? '' : $errors['TenKh'] ?></span>
                                            <input style="width:100%; " type="text" class="form-control" id="TenKh"
                                                name="TenKh" value="<?= $data['TenKh'] ?>" required>
                                        </td>
                                    </tr>
                                    <!--mật khẩu-->
                                    <tr>
                                        <td style="text-align: left;font-size:16px">
                                            <label for="password" class="form-label" style="padding-top:24px">Mật
                                                Khẩu:</label>
                                            <span
                                                style="color:red ;padding-top: 25px;"><?= (empty($errors['password'])) ? '' : $errors['password'] ?></span>
                                            <input style="width:100%; " type="password" class="form-control"
                                                id="password" name="password" value="<?= $data['password'] ?>" required>
                                            <input id="hien" type="checkbox" onclick="myFunction()">
                                            <label for="hien">Hiện Mật Khẩu</label>
                                        </td>
                                        <td style="text-align: left;font-size:16px">
                                            <label for="Diachi" class="form-label">Địa Chỉ:</label>
                                            <span
                                                style="color:red ;padding-top: 25px;"><?= (empty($errors['Diachi'])) ? '' : $errors['Diachi'] ?></span>
                                            <input style="width:100%; " type="text" class="form-control" id="Diachi"
                                                name="Diachi" value="<?= $data['Diachi'] ?>" required>
                                        </td>
                                    </tr>
                                    <!--xh mật khẩu-->
                                    <tr>
                                        <td style="text-align: left;font-size:16px">
                                            <label for="confirmPass" class="form-label">Nhập lại Mật Khẩu:</label>
                                            <span
                                                style="color:red ;padding-top: 25px;"><?= (empty($errors['confirmPass'])) ? '' : $errors['confirmPass'] ?></span>
                                            <input style="width:100%; " type="password" class="form-control"
                                                id="confirmPass" name="confirmPass" value="<?= $data['confirmPass'] ?>"
                                                required>
                                        </td>
                                        <td style="text-align: left;font-size:16px">
                                            <label for="Phone" class="form-label">SĐT:</label>
                                            <span
                                                style="color:red ;padding-top: 25px;"><?= (empty($errors['Phone'])) ? '' : $errors['Phone'] ?></span>
                                            <input style="width:100%; " type="text" class="form-control" id="Phone"
                                                name="Phone" value="<?= $data['Phone'] ?>" required>
                                        </td>
                                    </tr>
                                    <!--năm sinh-->
                                    <tr>
                                        <td style="text-align: left;font-size:16px">
                                            <label for="NamS" class="form-label">Năm Sinh:</label>
                                            <span
                                                style="color:red ;padding-top: 25px;"><?= (empty($errors['NamS'])) ? '' : $errors['NamS'] ?></span>
                                            <input style="width:100%; " type="date" class="form-control" id="NamS"
                                                name="NamS" value="<?= $data['NamS'] ?>" required>
                                        </td>

                                        <td style="text-align: left;font-size:16px">
                                            <br>
                                            <label for="email" class="form-label">Email:</label>
                                            <span
                                                style="color:red ;padding-top: 25px;"><?= (empty($errors['email'])) ? '' : $errors['email'] ?></span>
                                            <input style="width:100%;margin-bottom: 25px; " type="email"
                                                class="form-control" id="email" placeholder="Enter email" name="email"
                                                value="<?= $data['email'] ?>" required>
                                        </td>
                                    </tr>
                                    <!--giới tính-->
                                    <tr>
                                        <td style="text-align: left;font-size:16px">
                                            <label class="form-check-label" style="margin:4% 0 4%;">Giới Tính:
                                                <input type="radio" name="gender" id="Nam" checked value="1" /><label
                                                    for="Nam">Nam</label>
                                                <input type="radio" name="gender" id="Nữ" value="0" /><label
                                                    for="Nữ">Nữ</label>
                                            </label>
                                        </td>
                                    </tr>

                                    <tr style="margin-top: 2%;">
                                        <td colspan="2"><input type="submit" value="Đăng ký" name="kt"
                                                class="btn-primary btn" style="width: 100%;font-size: 16px;" /></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                    <script>
                    function myFunction() {
                        var x = document.getElementById("password");
                        if (x.type === "password") {
                            x.type = "text";
                        } else {
                            x.type = "password";
                        }
                    }
                    </script>
                </div>
            </div>

            <section class="container-fluid"
                style="width:100%;margin-top: 0%;background-color: white;margin-left: 2.5%;padding-left:3%">
                <div class="container-fluid" style="width:100%;height:100%;">
                    <?php
                    echo '<table id="table_gio" class="table">
                        <tr style="border: 2px solid #ababab">
                            <td style="width:10px">TT</td>
                            <td>Tên Sản Phẩm</td>
                            <td>Giá</td>
                            <td>Số Lượng</td>
                        </tr>';
                    $stt = 0;
                    $SlSP = 1;
                    $tongSp = 0;
                    $tong = 0;
                    $sql_oder = 'SELECT * FROM `oder` WHERE Phone ="' . $acc['Phone'] . '"';
                    $oder = executeResult($sql_oder);
                    foreach ($oder as $value) {
                        $tongSp = $value['SoLuong'] * $value['price'];
                        $tong += $tongSp;
                        $stt++;
                        echo '<tr style="border: 2px solid #ababab" strle="height:160px">
                                <td style="vertical-align: middle;">' . $stt . '</td>
                                <td style="vertical-align: middle;">' . $value['title'] . '</td>
                                <td style="vertical-align: middle;"><img style="width:80px" src="' . $value['anh'] . '" /><br><br>' . number_format($value['price']) . '&ensp;đ</td>
                                <td style="vertical-align: middle;">
                                    ' . $value['SoLuong'] . '
                                </td>
                            </tr>';
                    }
                    echo '
                              <tr style="border: 2px solid #ababab">
                                <td style="width:50px" ></td>
                                <td style="vertical-align: middle;">Tổng:</td>
                                <td style="vertical-align: middle;">' . number_format($tong) . '&ensp;đ </td>
                                <td > <button style="width:70px" class=" btn btn-danger" onclick="huydon()"> Hủy Đơn </button></td>
                              </tr>';
                    echo "</table> ";
                    if ($stt == 0) {
                        echo '
                                <script> 
                                    window.onload=function(){
                                        Swal.fire({
                                            icon: "error",
                                            title: "Bạn Chưa Có Đơn Hàng Nào",
                                            showConfirmButton: false
                                        });}
                                        setTimeout(function() {
                                            window.location.href = "../index.php";
                                        }, 1500);
                                </script>';
                    }
                    ?>
                </div>
            </section>
        </div>
    </div>
    <div class="footer_pc" id="footer">
        <table style="margin:0px 20px">
            <tr>
                <th style="text-align: left;">
                    Tìm Cửa Hàng
                </th>
                <th style="text-align: left;">
                    Phương thức thanh toán
                </th>
                <th style="text-align: left;">
                    Điện Thoại
                </th>
                <th style="text-align: left;">
                    Dịch vụ
                </th>
            </tr>
            <tr>
                <td style="text-align: left;">
                    Tìm cửa hàng gần nhất</br>
                    Gặp trực tiếp của hàng gần nhất
                </td>
                <td style="text-align: left;">
                    <img data-src="https://image.cellphones.com.vn/x35/media/logo/payment/alepay-logo.png" alt="Alepay"
                        src="https://image.cellphones.com.vn/x35/media/logo/payment/alepay-logo.png" lazy="loaded">
                    <img data-src="https://image.cellphones.com.vn/x35/media/logo/payment/zalopay-logo.png"
                        alt="Zalopay" src="https://image.cellphones.com.vn/x35/media/logo/payment/zalopay-logo.png"
                        lazy="loaded">
                    <img data-src="https://image.cellphones.com.vn/x35/media/logo/payment/vnpay-logo.png" alt="Vnpay"
                        src="https://image.cellphones.com.vn/x35/media/logo/payment/vnpay-logo.png" lazy="loaded">
                    <img data-src="https://image.cellphones.com.vn/x35/media/logo/payment/moca-logo.png" alt="Moca"
                        src="https://image.cellphones.com.vn/x35/media/logo/payment/moca-logo.png" lazy="loaded">
                    <img data-src="https://image.cellphones.com.vn/x35/media/logo/payment/onepay-logo.png" alt="Onepay"
                        src="https://image.cellphones.com.vn/x35/media/logo/payment/onepay-logo.png" lazy="loaded">
                    <img data-src="https://image.cellphones.com.vn/x35/media/logo/payment/kredivo-logo.png"
                        alt="Kredivo" src="https://image.cellphones.com.vn/x35/media/logo/payment/kredivo-logo.png"
                        lazy="loaded">
                    <img data-src="https://image.cellphones.com.vn/x35/media/logo/payment/mpos-logo.png" alt="Mpos"
                        src="https://image.cellphones.com.vn/x35/media/logo/payment/mpos-logo.png" lazy="loaded">
                </td>
                <td style="text-align: left;">
                    Gọi mua hàng 123456789 (7h30-22h00)<br>
                    Gọi Khiếu lại 123456789 (8h-21h00)<br>
                    Gọi Bảo hành 123456789 (8h-21h00)
                </td>
                <td style="text-align: left;"> 
                Mua hàng và thnah toán online </br>
                Mua hàng trả góp online </br>
                Mua hàng online free ship </br>
                Dịch dụ bảo hành điện thoại 
                </td>
            </tr>
        </table>
    </div>
</body>
<script>
function myDoiTt() {
    document.getElementById("title_dk").innerHTML = "Đổi Thông Tin Người Dùng"
    document.getElementById("dangky").checked = true;
    document.getElementById("close").checked = false;
    document.getElementById("dangky_tk").style.display = "none";
    document.getElementById("DoiTt").style.display = "block";
}

function huydon() {
    document.getElementById('')
    Swal.fire({
        title: 'Bạn Có Chắc Chắn Muốn Hủy Đơn Không ?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Có,Tôi Muốn'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                icon: 'success',
                title: 'Đã Hủy Đơn',
                showConfirmButton: false,
                timer: 1000
            });
            setTimeout(function() {
                window.location.href = 'del.php';
            }, 800);
        }
    });
}
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>