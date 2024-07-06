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
    // header('Location:index.php');
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../css.css">
    <link href="../home.css" rel="stylesheet">
    <link rel="stylesheet" href="oder.css">
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
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
                            echo'<li><a href="donhang/index.php" class="nav__link"><button style="background:none;margin-left:10%;width:80px">Đơn Hàng</button></a></li>';
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
                        $checkmenu = false;
                        ?>
                    </ul>
                </nav>
                <label for="close" class="nav_bars-btn">
                    <span class="material-symbols-outlined"><b style="font-size:30px;">menu</b></span>
                </label>
                <input hidden type="checkbox" <?php echo ($checkmenu) ? "checked" : '' ?> class="nav__input" id="close">
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
                                <button style="background:#ffffff ;" hidden type="submit" name="tim"><i class="material-icons">search</i></button>
                            </form>
                        </li>

                        <?php
                        if ($_SESSION['login'] != 'khach hang') {
                            echo '<b style="color:black;font-size:17px;padding-left:15px;">Xin chào&ensp;' . $_SESSION['login'] . '</b>
                        ';
                        }
                        echo'<li>
                            <a href="index.php" class="nav__mobile-link">Home</a>
                        </li>';
                        foreach ($thumucList as $item) {
                            echo '<li >
                                <a class="nav__mobile-link" href="../index.php?id=' . $item['name'] . '"><button name = "hang" style="background:none">' . $item['name'] . '</button></a>
                                </li>';
                        }
                        $noidung = '';
                        echo '  <li>
                                    <a href="donhang/index.php" class="nav__mobile-link">Đơn Hàng</a>
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
                                    <li class="menu__con"> <button style="border:0px;color:black;background:none;font-size:16px" for="login" onclick="DoiMK()" >Đổi Mật Khẩu</button> </li>
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
                <input type="checkbox" hidden <?php echo ($checkbox1) ? "checked" : '' ?> class="dangky__pc-input" id="dangky" onclick="mycheck()">
                <label for="dangky" class="nav__overlay_dangky" name="dangky"></label>
                <input type="checkbox" hidden <?php echo ($checkbox) ? "checked" : '' ?> class="dangnhap__pc-input" id="login" onclick="mycheck()">
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
                                    <label for="login" class="nav__mobile-close"><span class="material-symbols-outlined"><b style="font-size:40px;">close</b></span></label>
                                    <h2 style="text-align:center ;">Đăng Nhập </h2>
                                    <!--Tài khoản -->
                                    <tr>
                                        <td>
                                            <label for="userName" class="form-label">Tài Khoản :</label>
                                            <input type="userName" class="form-control" id="userName" name="userName" value="<?php echo $userName ?>" required>
                                        </td>
                                    </tr>
                                    <!-- Mật khẩu -->
                                    <tr>
                                        <td>
                                            <label for="password" class="form-label">Mật Khẩu:</label>
                                            <input style="margin-bottom: 2%;" type="password" class="form-control" id="password" name="password" value="<?php echo $password ?>" required>
                                        </td>
                                    </tr>
                                    <input id="hien" type="checkbox" onclick="myFunction()">
                                    <label for="hien" class="hienmk">Hiện Mật Khẩu</label>
                                    <!--nhớ Mật khẩu -->
                                    <tr>
                                        <td>
                                            <input style="margin-bottom: 1%;" type="checkbox" id="checkbox" name="checkbox" <?php echo ($check) ? "checked" : '' ?>>
                                            <label for="checkbox">Nhớ Mật Khẩu</label><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><input type="submit" value="Đăng Nhập" name="dangnhap" class="btn-primary btn" style="width: 100%; margin-top: 4%;font-size: 16px;" /></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <br><a href="forgotaccount.php" style="color:blue;margin-left:10px">Quên mật Khẩu ?</a>
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
                                <label for="dangky" class="nav__mobile-close"><span class="material-symbols-outlined"><b style="font-size:40px;">close</b></span></label>
                                <table style="border:none;text-align: left;margin-top:10px;width:100%">
                                    <h2 style="text-align:center ;">Đăng ký tài khoản </h2>
                                    <!--tài khoản-->
                                    <tr>
                                        <td style="text-align: left;font-size:16px">
                                            <label for="userName" class="form-label">Tài Khoản :</label>
                                            <span style="color:red ;padding-top: 25px;"><?= (empty($errors['userName'])) ? '' : $errors['userName'] ?></span>
                                            <input style="width:100%; " type="userName" class="form-control" id="userName" name="userName" value="<?= $data['userName'] ?>" required>
                                        </td>
                                        <td style="text-align: left;font-size:16px">
                                            <label for="TenKh" class="form-label">Tên Khách hàng:</label>
                                            <span style="color:red ;padding-top: 25px;"> <?= (empty($errors['TenKh'])) ? '' : $errors['TenKh'] ?></span>
                                            <input style="width:100%; " type="text" class="form-control" id="TenKh" name="TenKh" value="<?= $data['TenKh'] ?>" required>
                                        </td>
                                    </tr>
                                    <!--mật khẩu-->
                                    <tr>
                                        <td style="text-align: left;font-size:16px">
                                            <label for="password" class="form-label" style="padding-top:24px">Mật Khẩu:</label>
                                            <span style="color:red ;padding-top: 25px;"><?= (empty($errors['password'])) ? '' : $errors['password'] ?></span>
                                            <input style="width:100%; " type="password" class="form-control" id="password" name="password" value="<?= $data['password'] ?>" required>
                                            <input id="hien" type="checkbox" onclick="myFunction()">
                                            <label for="hien">Hiện Mật Khẩu</label>
                                        </td>
                                        <td style="text-align: left;font-size:16px">
                                            <label for="Diachi" class="form-label">Địa Chỉ:</label>
                                            <span style="color:red ;padding-top: 25px;"><?= (empty($errors['Diachi'])) ? '' : $errors['Diachi'] ?></span>
                                            <input style="width:100%; " type="text" class="form-control" id="Diachi" name="Diachi" value="<?= $data['Diachi'] ?>" required>
                                        </td>
                                    </tr>
                                    <!--xh mật khẩu-->
                                    <tr>
                                        <td style="text-align: left;font-size:16px">
                                            <label for="confirmPass" class="form-label">Nhập lại Mật Khẩu:</label>
                                            <span style="color:red ;padding-top: 25px;"><?= (empty($errors['confirmPass'])) ? '' : $errors['confirmPass'] ?></span>
                                            <input style="width:100%; " type="password" class="form-control" id="confirmPass" name="confirmPass" value="<?= $data['confirmPass'] ?>" required>
                                        </td>
                                        <td style="text-align: left;font-size:16px">
                                            <label for="Phone" class="form-label">SĐT:</label>
                                            <span style="color:red ;padding-top: 25px;"><?= (empty($errors['Phone'])) ? '' : $errors['Phone'] ?></span>
                                            <input style="width:100%; " type="text" class="form-control" id="Phone" name="Phone" value="<?= $data['Phone'] ?>" required>
                                        </td>
                                    </tr>
                                    <!--năm sinh-->
                                    <tr>
                                        <td style="text-align: left;font-size:16px">
                                            <label for="NamS" class="form-label">Năm Sinh:</label>
                                            <span style="color:red ;padding-top: 25px;"><?= (empty($errors['NamS'])) ? '' : $errors['NamS'] ?></span>
                                            <input style="width:100%; " type="date" class="form-control" id="NamS" name="NamS" value="<?= $data['NamS'] ?>" required>
                                        </td>

                                        <td style="text-align: left;font-size:16px">
                                            <br>
                                            <label for="email" class="form-label">Email:</label>
                                            <span style="color:red ;padding-top: 25px;"><?= (empty($errors['email'])) ? '' : $errors['email'] ?></span>
                                            <input style="width:100%;margin-bottom: 25px; " type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?= $data['email'] ?>" required>
                                        </td>
                                    </tr>
                                    <!--giới tính-->
                                    <tr>
                                        <td style="text-align: left;font-size:16px">
                                            <label class="form-check-label" style="margin:4% 0 4%;">Giới Tính:
                                                <input type="radio" name="gender" id="Nam" checked value="1" /><label for="Nam">Nam</label>
                                                <input type="radio" name="gender" id="Nữ" value="0" /><label for="Nữ">Nữ</label>
                                            </label>
                                        </td>
                                    </tr>

                                    <tr style="margin-top: 2%;">
                                        <td colspan="2"><input type="submit" value="Đăng ký" name="kt" class="btn-primary btn" style="width: 100%;font-size: 16px;" /></td>
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
            
            <section class="container-fluid" style="width:100%;margin-top: 0%;background-color: white;margin-left: 2.5%;padding-left:3%">
                <div class="container-fluid" style="width:100%;height:800px;">
                    <?php
                    echo '
                        <table class="table" style="width: 100%; float:right; margin-top:80px; margin-right:2%; border: 2px solid #ababab;border-collapse: collapse;" >   
                          <tr style="border: 2px solid #ababab" >
                            <td>STT</td>
                            <td>Tên Sản Phẩm</td>
                            <td>Giá</td>
                            <td>Số lượng</td>
                          </tr>';
                    $stt = 1;
                    $SlSP = 1;
                    $tongSp = 0;
                    $tong = 0;
                    $tongSp = $_SESSION['qty'] * $_SESSION['gia'];
                    $tong += $tongSp;
                    echo    '<tr style="border: 2px solid #ababab">
                                <td style="vertical-align: middle;">' . $stt . '</th>
                                <td style="vertical-align: middle;">' . $_SESSION['ten'] . '</td>
                                <td style="vertical-align: middle;"><img style="width:100px" src="' . $_SESSION['anh'] . '"/><br><br>' . number_format($_SESSION['gia']) . '&ensp;đ</td>
                                <td style="vertical-align: middle;">
                                    <form action="update.php?id=' . $_SESSION['id'] . '" method="post">
                                        <input style="width:50px" type="number" min="1" max="10" name="SL" value="' . $_SESSION['qty'] . '"required><br>
                                        <a ><button type="submit" name="capnhatall" class="btn-primary btn" style="padding-top:0px;font-size:14px;border-radius: 5px;">Cập Nhật</button></a>
                                </td>
                                </form>
                                </tr>';
                    echo '
                              <tr style="border: 2px solid #ababab">
                                <td style="vertical-align: middle;">Tổng:</td>
                                <td></td>
                                <td style="vertical-align: middle;">' . number_format($tong) . '&ensp;đ </td>
                                <td vertical-align: middle;><a href=#footer__pc><button class="btn btn-danger" style="padding-top:0px;font-size:14px;border-radius: 5px;" onclick="myThanhtoan()" >Thanh Toán</button></a></td></td>
                              </tr>';
                    echo "</table> ";
                    $errors_Phone = "";
                    if (isset($_POST['Doitn'])) {
                        $errors_Phone = "";
                        $TenKh = $_POST['TenKh'];
                        $Diachi = $_POST['Diachi'];
                        $Phone = $_POST['Phone'];
                        $email = $_POST['email'];
                        if (!preg_match('/^[0-9]*$/', $Phone)) {
                            $errors_Phone = "Số điện thoại là các số từ 1-9";
                        } elseif (strlen($Phone) > 10 || strlen($Phone) < 10) {
                            $errors_Phone = "Số điện Thoại gồm 10 số";
                        }
                        if ($errors_Phone != "") {
                            echo '<table class="table table-bordered" style="height: 500px;width:600px;max-width:100%border: 0px;margin-top:1%;float:left" id="suaThongtin">
                            <form action="index.php#" method="post">
                                <tr style="border: 2px solid #ababab;width:500px;">
                                    <td colspan="2" style="text-align: center;font-size: 24px;padding:10px">
                                        <b>Thay Đổi Thông Tin</b>
                                    </td>
                                </tr>
                                <tr style="border: 2px solid #ababab">
                                    <td>
                                        <label>Tên Khách Hàng</label>
                                    </td>
                                    <td style="width:500px;"><input class="form-control" type="text" value="' . $acc['TenKh'] . '" name="TenKh" id="TenKh" required></td>
                                </tr>
                                <tr style="border: 2px solid #ababab">
                                    <td>
                                        <label>Điạ Chỉ</label>
                                    </td>
                                    <td><input class="form-control" type="text" value="' . $acc['Diachi'] . '" name="Diachi" id="Diachi" required></td>
                                </tr>
                                <tr style="border: 2px solid #ababab">
                                    <td>
                                        <label>Phone</label>
                                    </td>
                                    <td><input class="form-control" type="text" value="' . $acc['Phone'] . '" name="Phone" id="phone" required><span style="color:red">' . $errors_Phone . '</span></td>
                                </tr>
                                <tr style="border: 2px solid #ababab">
                                    <td>
                                        <label>Email</label>
                                    </td>
                                    <td><input class="form-control" type="email" value="' . $acc['email'] . '" name="email" id="email" required></td>
                                </tr>
                                <tr style="border: 2px solid #ababab">
                                    <td colspan="2">
                                        <input class="btn btn-primary" type="button" style="width:48%;margin-left: 1.5%;" value="Quay Lại" onclick="myThanhtoan()">
                                        <a href="#"><input class="btn btn-danger" style="width:48%" type="submit" name="Doitn" value="Đổi Thông Tin"></a>
                                    </td>
                                </tr>
                            </form>
                        </table>';
                        } else {
                            $UserKH = $_SESSION['login'];
                            $sql_upTT = "UPDATE `acc` SET `TenKh`='$TenKh',`Diachi`='$Diachi',`Phone`='$Phone',`email`='$email' WHERE userName='$UserKH'";
                            execute($sql_upTT);
                            header('Location:index.php');
                        }
                    }
                    if (isset($_POST['oder'])) {
                        echo $id_cart=$_SESSION['id']."_".$_SESSION['login'];
                        $sql_oder = 'INSERT INTO `oder` (`id_cart`, `title`, `anh`, `price`, `SoLuong`, `TenKh`, `Diachi`, `Phone`, `email`, `Pay`) 
                        VALUES ("'.$id_cart .'","' . $_SESSION['ten'] . '","' . $_SESSION['anh'] . '",'.$_SESSION['gia'].','.$_SESSION['qty'].',"' . $acc['TenKh'] . '","' . $acc['Diachi'] . '","' . $acc['Phone'] . '","' . $acc['email'] . '","' . $_POST['pay'] . '")' ;
                        if(execute($sql_oder)){
                            echo 1;
                        }
                        header('Location:../index.php');
                    }
                    ?>
                    <table class="table" style="width:600px;max-width:100%;border:0px;margin-top:2%;float:left" id="Thongtin">
                        <form method="post">
                            <tr style="border: 1px solid #ababab">
                                <td colspan="2" style="text-align: center;font-size: 24px;padding:10px">
                                    <b onclick="myThanhtoan()">Thông Tin đặt Hàng</b>
                                </td>
                            </tr>
                            <tr style="border: 1px solid #ababab; ">
                                <td style="border:1px solid #ababab;text-align: left;">
                                    <label>Tên Khách Hàng</label>
                                </td>
                                <td style="border:1px solid #ababab;text-align: left;width:500px"><?= $acc['TenKh'] ?></td>
                            </tr>
                            <tr style="border: 1px solid #ababab; text-align: left;">
                                <td style="border:1px solid #ababab;text-align: left;">
                                    <label>Điạ Chỉ</label>
                                </td>
                                <td style="border:1px solid #ababab;text-align: left;"><?= $acc['Diachi'] ?></td>
                            </tr>
                            <tr style="border: 1px solid #ababab">
                                <td style="border:1px solid #ababab;text-align: left;">
                                    <label>Phone</label>
                                </td>
                                <td style="border:1px solid #ababab;text-align: left;"><?= $acc['Phone'] ?></td>
                            </tr>
                            <tr style="border: 1px solid #ababab">
                                <td style="border:1px solid #ababab;text-align: left;">
                                    <label>Email</label>
                                </td>
                                <td style="border:1px solid #ababab;text-align: left;"><?= $acc['email'] ?></td>
                            </tr>
                            <tr style="border: 1px solid #ababab">
                                <td style="border:1px solid #ababab;text-align: left;">
                                    <label>Hình Thức Thanh Toán</label>
                                </td>
                                <td style="border:1px solid #ababab;text-align: left;">
                                    <input type="radio" checked name="pay" id="TM"><label for="TM">Trả Tiền Mặt</label><br>
                                    <input type="radio" name="pay" id="TG"><label for="TG">Trả Góp</label><br>
                                    <input type="radio" name="pay" id="ATM"><label for="ATM">Trả Qua ATM</label>
                                </td>
                            </tr>
                            <tr style="border: 1px solid #ababab">
                                <td colspan="2">
                                    <input class="btn btn-primary" style="width:48%;margin-left: 1.5%;" type="button" value="Thay Đổi Thông Tin" onclick="mySuaTn()">
                                    <input class="btn btn-danger" style="width:48%" type="submit" name="oder" value="Đặt Hàng">
                                </td>
                            </tr>
                        </form>
                    </table>
                    <table class="table table-bordered" style="height: 100%;width:100%; display:none;border: 0px;margin-top:1%" id="suaThongtin">
                        <form action="index.php#" method="post">
                            <tr style="border: 2px solid #ababab;width:500px;">
                                <td colspan="2" style="text-align: center;font-size: 24px;padding:10px">
                                    <b>Thay Đổi Thông Tin</b>
                                </td>
                            </tr>
                            <tr style="border: 2px solid #ababab">
                                <td>
                                    <label>Tên Khách Hàng</label>
                                </td>
                                <td style="width:500px;"><input class="form-control" type="text" value="<?= $acc['TenKh'] ?>" name="TenKh" id="TenKh" required></td>
                            </tr>
                            <tr style="border: 2px solid #ababab">
                                <td>
                                    <label>Điạ Chỉ</label>
                                </td>
                                <td><input class="form-control" type="text" value="<?= $acc['Diachi'] ?>" name="Diachi" id="Diachi" required></td>
                            </tr>
                            <tr style="border: 2px solid #ababab">
                                <td>
                                    <label>Phone</label>
                                </td>
                                <td><input class="form-control" type="text" value="<?= $acc['Phone'] ?>" name="Phone" id="phone" required></td>
                            </tr>
                            <tr style="border: 2px solid #ababab">
                                <td>
                                    <label>Email</label>
                                </td>
                                <td><input class="form-control" type="email" value="<?= $acc['email'] ?>" name="email" id="email" required></td>
                            </tr>
                            <tr style="border: 2px solid #ababab">
                                <td colspan="2">
                                    <input class="btn btn-primary" type="button" style="width:48%;margin-left: 1.5%;" value="Quay Lại" onclick="myThanhtoan()">
                                    <a href="#"><input class="btn btn-danger" style="width:48%" type="submit" name="Doitn" value="Đổi Thông Tin"></a>
                                </td>
                            </tr>
                        </form>
                    </table>
                </div>
            </section>
        </div>
    </div>
    <div class="footer_pc" id="footer__pc">
        <p>Footer</p>
    </div>
</body>
<script>
    function myThanhtoan() {
        document.getElementById("Thongtin").style.display = "block";
        document.getElementById("suaThongtin").style.display = "none";
    }

    function mySuaTn() {
        document.getElementById("Thongtin").style.display = "none";
        document.getElementById("suaThongtin").style.display = "block";
    }
</script>

</html>