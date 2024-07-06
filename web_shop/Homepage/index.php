<?php
require_once('../db/dbhelper.php');
ob_start();
session_start();
if (!isset($_SESSION['login'])) {
    $acc['id'] = '';
    $_SESSION['login'] = 'khach hang';
    // header('Location:index.php');
}
$sql          = 'select * from thumuc';
$thumucList = executeResult($sql);
$sql1          = 'select * from menu';
$menuList = executeResult($sql1);
$sql2          = 'SELECT * FROM `acc` WHERE userName = "' . $_SESSION['login'] . '"';
$acc = executeSingleResult($sql2);
$login = 0;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEB BÁN SMART PHONE</title>
    <link rel="icon" href="../favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="css.css">
    <link href="home.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="main">
        <div class="nav fixed-top">
            <!-- Nav PC -->
            <nav class="nav__pc">
                <div style="width:8%;float:left; max-width: 55px;padding-top: 9px;">
                    <a href="index.php"><img src="../img/logo.png" width="60%"></a>
                </div>
                <ul class="nav__list">
                    <li>
                        <a href="index.php" style="color: #fff;" class="nav__link">Home</a>
                    </li>
                    <?php
                    foreach ($thumucList as $item) {
                        echo '<li >
                            <a class="nav__link" href="index.php?id=' . $item['id'] . '"><button name = "hang" style="background:none">' . $item['name'] . '</button></a>
                            </li>';
                    }
                    $noidung = '';
                    foreach ($menuList as $item) {
                        echo '<li id="menu__pc">
                                <a  class="nav__link" href="#footer"><button style="background:none"> ' . $item['Name'] . '</button> </a>
                            </li>';
                    }
                    echo '
                        <li>
                        <form class="d-flex nav__search" method="post">
                            <input class="form-control me-2 " name="noidung" type="text" placeholder="Bạn cần tìm gì ? &#9997;">
                            <button style="background:#ffffff ;" hidden type="submit" name="tim"><i class="material-icons">search</i></button>
                        </form>
                        </li>';
                    $cart = $_SESSION['login'];
                    if ($_SESSION['login'] == 'khach hang') {
                        echo '<li>
                        <label style="margin-left:10px" class="clickon__pc" for="dangky" class="nav__link">Đăng ký</label>
                            </li>';
                        echo '<li>
                           <label style="padding-left:20px" class="clickon__pc" for="login" class="nav__link">Đăng nhập</label>
                        </li>';
                    } else {
                        $stt = 0;
                        $sql_cart = 'SELECT * FROM `cart` WHERE userName_acc ="' . $_SESSION['login'] . '"';
                        $cart = executeResult($sql_cart);
                        foreach ($cart as $value) {
                            $stt++;
                        }
                        echo '<li><a href="donhang/index.php" class="nav__link"><button style="background:none;margin-left:30%;width:70px">Đơn Hàng</button></a></li>';
                        echo '<b class="xinchao__pc" style="color:#f1f1f1;font-size:17px;padding-left:8px">Xin chào&ensp;' . $_SESSION['login'] . '</b>';
                        echo '<div class="dropdown " style="padding-left:15px;padding-right:50px">
                                <span type="button" class="material-symbols-outlined" data-bs-toggle="dropdown" style="font-size:26px;color: #fff;">menu</span>
                                <ul class="dropdown-menu">
                                    <li><button class="dropdown-item" style="border:0px;color:black;background:none;font-size:16px" onclick="myDoiTt()" >Đổi Thông Tin</button></li>
                                    <li><button class="dropdown-item" style="border:0px;color:black;background:none;font-size:16px" for="login" onclick="DoiMK()" >Đổi Mật Khẩu</button> </li>
                                    <li><a class="dropdown-item" href="Tk/delsession.php">Đăng xuất</a></li>
                                </ul>
                            </div>
                            <a href="index.php?id=giohang"style="text-decoration: none;">
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
                        <a href="index.php"><img src="../img/logo.png" width="80%"></a>
                    </div>
                    <span class="material-symbols-outlined"><b style="font-size:40px;">close</b></span>
                </label>
                <ul class="nav__mobile-list">
                    <li style="margin-top:80px ;">
                        <form class="d-flex nav__search" method="post">
                            <input class="form-control me-2 " name="noidung" type="text"
                                placeholder="Bạn cần tìm gì ? &#9997;">
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
                                <a class="nav__mobile-link" href="index.php?id=' . $item['name'] . '"><button name = "hang" style="background:none">' . $item['name'] . '</button></a>
                                </li>';
                    }
                    $noidung = '';
                    if ($_SESSION['login'] != 'khach hang') {
                        echo '<li>
                                <a href="donhang/index.php" class="nav__mobile-link">Đơn Hàng</a>
                            </li>  
                            <li>
                                <a href="index.php?id=giohang" class="nav__mobile-link">Giỏ Hàng</a>
                            </li>';
                    }
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
                        margin: 10px 0;
                        padding: 10px 0px;
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
                                    <li class="menu__con"><button style="border:0px;color:black;background:none;font-size:16px" onclick="myDoiTt()" >Đổi Thông Tin</button> </li>
                                    <li class="menu__con"> <button style="border:0px;color:black;background:none;font-size:16px" for="login" onclick="DoiMK()" >Đổi Mật Khẩu</button>  </li>
                                    <li class="menu__con"> <a href="Tk/delsession.php">Đăng xuất</a> </li>
                                </ul>
                            </li>';
                    }
                    ?>
                </ul>

            </nav>

            <!-- Đăng nhập/ Đăng ký tài khoản -->
            <?php
            $checkbox = false;
            $checkbox1 = false;
            if (isset($_POST['dangnhap'])) {
                $checkbox = true;
            }
            if (isset($_POST['KT'])) {
                $checkbox1 = true;
                echo '<script>
                document.getElementById("title_dk").innerHTML="Đổi Thông Tin Người Dùng"
                document.getElementById("dangky_tk").style.display = "none";
                document.getElementById("DoiTt").style.display = "block";
                </script>';
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
            <div id="rong" class="dangnhap__pc">
                <?php
                $errors = [];
                if (isset($_POST['doimk'])) {
                    echo '<script> alert (" vui lòng nhập mật khẩu mới") </script>';
                    $userName = $_POST['userName'];
                    $password = $_POST['password'];
                    $confirmPass = $_POST['confirmPass'];
                    $sql_select1 = "select * from acc where password='$password'";
                    $sql = 'UPDATE acc set password="' . $password . '" where username="' . $userName . '"';
                    if (executeResult($sql_select1)) {
                        echo '<script> alert (" vui lòng nhập mật khẩu mới") </script>';
                    }
                    //Mật khẩu
                    elseif (strlen($password) < 6) {
                        $errors['password'] = "Mật khẩu gồm 6-20 ký tự";
                    }
                    //Xác nhận mật khẩu
                    elseif ($password != $confirmPass) {
                        $errors['confirmPass'] = "Mật khẩu và xác nhận mật khẩu Không giống nhau";
                    } else {
                        execute($sql);
                        echo '<script> alert (" Đổi mật khẩu thành công") </script>';
                        echo '<script> window.location.href="index.php" </script>';
                    }
                } else {
                    $userName = '';
                    $password = '';
                    if (isset($_POST['dangnhap'])) {
                        $userName = $_POST['userName'];
                        $password = $_POST['password'];
                        $sql_admin = "select * from admin where userName='$userName' and password='$password' ";
                        $sql = "select * from acc where userName='$userName' and password='$password' ";
                        //hiển thị password
                        if (isset($_POST['checkbox_DN'])) {
                            setcookie('userName', $userName, time() + (86400 * 365), "/");
                            setcookie('password', $password, time() + (86400 * 365), "/");
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
                }
                ?>
                <div class="div_dn" id="rong" style="height:400px;">
                    <div id="container" class="container">
                        <div class="row justify-content-around">
                            <form action="#" method="post" style="margin-top: 5%;">
                                <label for="login" class="nav__mobile-close"><span class="material-symbols-outlined"><b
                                            style="font-size:40px;">close</b></span></label>
                                <h2 id="h2" style="text-align:center ;"> Đăng Nhập </h2>
                                <!--Tài khoản -->
                                <tr>
                                    <td>
                                        <label for="userName" class="form-label">Tài Khoản :</label>
                                        <b style="color:red ;display:none;"
                                            id="loi"><?= (empty($errors['userName'])) ? '' : $errors['userName'] ?></b>
                                        <input type="userName" class="form-control" id="userName" name="userName"
                                            value="<?php echo $userName ?>" required>
                                    </td>
                                </tr>
                                <!-- Mật khẩu -->
                                <tr>
                                    <td>
                                        <label for="password" class="form-label" id="mkm">Mật Khẩu:</label>
                                        <b style="color:red ;"
                                            id="loi"><?= (empty($errors['password'])) ? '' : $errors['password'] ?></b>
                                        <input style="margin-bottom: 2%;" type="password" class="form-control"
                                            id="password" name="password" value="<?php echo $password ?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label id="formDmk_hien" style="display:none" for="confirmPass"
                                            class="form-label">Xác Nhận Mật Khẩu:</label>
                                        <b
                                            style="color:red ;"><?= (empty($errors['confirmPass'])) ? '' : $errors['confirmPass'] ?></b>
                                        <input hidden style="margin-bottom: 2%;" type="password" class="form-control"
                                            id="confirmPass" name="confirmPass">
                                    </td>

                                </tr>
                                <!--nhớ Mật khẩu -->
                                <tr>
                                    <td>
                                        <input id="hien" type="checkbox" onclick="myFunction()">
                                        <label for="hien">Hiện Mật Khẩu</label>
                                    </td>
                                    <td>
                                        <input style="margin-bottom: 1%;" type="checkbox" id="checkbox"
                                            name="checkbox_DN" <?php echo ($check) ? "checked" : '' ?>>
                                        <label for="checkbox">Nhớ Mật Khẩu</label><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><input id="submit" type="submit" value="Đăng Nhập" name="dangnhap"
                                            class="btn-primary btn"
                                            style="width: 100%; margin-top: 4%;font-size: 16px;" /></td>
                                </tr>
                                <tr>
                                    <td>
                                        <br><a href="forgotaccount.php" style="color:blue">Quên mật
                                            Khẩu</a>
                                    </td>
                                    <td>
                                        <label for="dangky" id="formDmk"
                                            style="float:right;margin-right:5%;cursor: pointer;">
                                            Đăng Ký
                                        </label>
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

                function DoiMK() {
                    document.getElementById("h2").innerHTML = "Đổi Mật Khẩu";
                    document.getElementById("mkm").innerHTML = "Mật khẩu mới";
                    document.getElementById("login").checked = true;
                    document.getElementById("close").checked = false;
                    document.getElementById("formDmk").style.display = "none";
                    document.getElementById("formDmk_hien").style.display = "block";
                    document.getElementById("confirmPass").hidden = false;
                    document.getElementById("confirmPass").required = true;
                    document.getElementById("submit").name = "doimk";
                    document.getElementById("submit").value = "Đổi Mật Khẩu";
                    document.getElementById("rong").id = "div_dn";
                }
                </script>
                <style>
                #div_dn {
                    height: 450px
                }
                </style>
            </div>

            <div class="dangky__pc">
                <?php
                $data = [];
                $errors = [];
                $kiemtra = 0;
                $userName = $password =
                    $TenKh = $Diachi = $email = $Phone = '';
                if (isset($_POST['KT'])) {
                    $id = $acc['id'];
                    $gender = $_POST['gender'];
                    $email = $_POST['email'];
                    $TenKh = $_POST['TenKh'];
                    $NamS = $_POST['NamS'];
                    $Diachi = $_POST['Diachi'];
                    $Phone = $_POST['Phone'];
                    if (empty($TenKh)) {
                        $errors['TenKh'] = "Bạn chưa nhập vào tên ";
                    } elseif (strlen($TenKh) > 50) {
                        $TenKh = '';
                        $errors['TenKh'] = "Tên không quá 50 ký tự";
                    } elseif (!preg_match('/[a-zA-Z]/', $TenKh)) {
                        $errors['TenKh'] = "Tên chỉ bao gồm các ký tự từ A-Z ";
                    }
                    //Năm sinh
                    elseif (empty($NamS)) {
                        $errors['NamS'] = "vui lòng nhấp Năm sinh";
                    }
                    //Địa chỉ
                    elseif (empty($Diachi)) {
                        $errors['Diachi'] = "Bạn chưa nhập vào Địa chỉ";
                    }
                    //Email
                    elseif (empty($email)) {
                        $errors['email'] = "Bạn chưa nhập email";
                    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $errors['email'] = "Email không đúng định dạng";
                    }
                    //Phone
                    elseif (empty($Phone)) {
                        $errors['Phone'] = "Bạn chưa nhập vào số điện thoại ";
                    } elseif (strlen($Phone) > 10) {
                        $Phone = '';
                        $errors['Phone'] = "số điện thoại gồm 10 số";
                    } elseif (strlen($Phone) < 10) {
                        $Phone = '';
                        $errors['Phone'] = "số điện thoại gồm 10 số";
                    } elseif (!preg_match('/^[0-9]*$/', $Phone)) {
                        $Phone = '';
                        $errors['Phone'] = "Số điện thoại là các số từ 0-9";
                    } else {
                        $kiemtra = 2003;
                    }
                }
                if ($kiemtra == 2003) {
                    if (isset($_POST['KT'])) {
                        $ngaytao = date('Y-m-d H:s:i');
                        //Luu vao database
                        $sql = "UPDATE `acc` SET `TenKh`='$TenKh',`namS`='$NamS',`gender`='$gender',`Diachi`='$Diachi',`Phone`='$Phone',`email`='$email' WHERE id='$id'";
                        if (mysqli_query($con, $sql)) {
                            echo '<script> alert (" Đổi thông tin thành công") </script>';
                            echo '<script> window.location.href="index.php" </script>';
                            die();
                        }
                    }
                } else {
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
                                echo '<script> alert ("đăng ký ") </script>';
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
                }
                ?>
                <div class="container">
                    <div class="row">
                        <label for="dangky" class="nav__mobile-close"><span class="material-symbols-outlined"><b
                                    style="font-size:40px;">close</b></span></label>
                        <table id="dangky_tk" style="border:none;text-align: left;margin-top:10px">
                            <form action="#" method="post" enctype="multipart/form-data" class="p-3">
                                <h2 id="title_dk" style="text-align:center ;">Đăng ký tài khoản </h2>
                                <!--tài khoản-->
                                <tr>
                                    <td style="text-align: left;">
                                        <label for="userName" class="form-label">Tài Khoản :</label>
                                        <span
                                            style="color:red ;padding-top: 25px;"><?= (empty($errors['userName'])) ? '' : $errors['userName'] ?></span>
                                        <input style="width:100%; " type="userName" class="form-control" id="userName"
                                            name="userName" value="<?= $data['userName'] ?>">
                                    </td>
                                    <td style="text-align: left;">
                                        <label for="TenKh" class="form-label">Tên Khách hàng:</label>
                                        <span style="color:red ;padding-top: 25px;">
                                            <?= (empty($errors['TenKh'])) ? '' : $errors['TenKh'] ?></span>
                                        <input style="width:100%; " type="text" class="form-control" id="TenKh"
                                            name="TenKh" value="<?= $data['TenKh'] ?>">
                                    </td>
                                </tr>
                                <!--mật khẩu-->
                                <tr>
                                    <td style="text-align: left;">
                                        <label for="password" class="form-label">Mật Khẩu:</label>
                                        <span
                                            style="color:red ;padding-top: 25px;"><?= (empty($errors['password'])) ? '' : $errors['password'] ?></span>
                                        <input style="width:100%; " type="password" class="form-control"
                                            id="password_dk" name="password" value="<?= $data['password'] ?>">
                                        <input id="hien_mk" type="checkbox" onclick="myPassword()">
                                        <label for="hien_mk">Hiện Mật Khẩu</label>
                                    </td>
                                    <td style="text-align: left;">
                                        <br>
                                        <label for="Diachi" class="form-label">Địa Chỉ:</label>
                                        <span
                                            style="color:red ;padding-top: 25px;"><?= (empty($errors['Diachi'])) ? '' : $errors['Diachi'] ?></span>
                                        <input style="width:100%; " type="text" class="form-control" id="Diachi"
                                            name="Diachi" value="<?= $data['Diachi'] ?>">
                                        <br><br>
                                    </td>
                                </tr>
                                <!--xh mật khẩu-->
                                <tr>
                                    <td style="text-align: left;">
                                        <label for="confirmPass" class="form-label">Nhập lại Mật Khẩu:</label>
                                        <span
                                            style="color:red ;padding-top: 25px;"><?= (empty($errors['confirmPass'])) ? '' : $errors['confirmPass'] ?></span>
                                        <input style="width:100%; " type="password" class="form-control"
                                            id="confirmPass" name="confirmPass" value="<?= $data['confirmPass'] ?>">
                                    </td>
                                    <td style="text-align: left;">
                                        <label for="Phone" class="form-label">SĐT:</label>
                                        <span
                                            style="color:red ;padding-top: 25px;"><?= (empty($errors['Phone'])) ? '' : $errors['Phone'] ?></span>
                                        <input style="width:100%; " type="text" class="form-control" id="Phone"
                                            name="Phone" value="<?= $data['Phone'] ?>">
                                    </td>
                                </tr>
                                <!--năm sinh-->
                                <tr style="width:100%">
                                    <td style="text-align: left;">
                                        <label for="NamS" class="form-label">Năm Sinh:</label>
                                        <span
                                            style="color:red ;padding-top: 25px;"><?= (empty($errors['NamS'])) ? '' : $errors['NamS'] ?></span>
                                        <input style="width:100%; " type="date" class="form-control" id="NamS"
                                            name="NamS" value="<?= $data['NamS'] ?>">
                                    </td>

                                    <td style="text-align: left;">
                                        <br>
                                        <label for="email" class="form-label">Email:</label>
                                        <span
                                            style="color:red ;padding-top: 25px;"><?= (empty($errors['email'])) ? '' : $errors['email'] ?></span>
                                        <input style="width:100%;margin-bottom: 25px; " type="email"
                                            class="form-control" id="email" placeholder="Enter email" name="email"
                                            value="<?= $data['email'] ?>">
                                    </td>
                                </tr>
                                <!--giới tính-->
                                <tr>
                                    <td style="text-align: left;">
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
                            </form>
                        </table>

                        <table id="DoiTt" style="border:none;margin-top:10px;padding-left:2%;display:none">
                            <form action="#" method="post" enctype="multipart/form-data" class="p-3">
                                <!--ten khach-->
                                <tr>
                                    <td style="text-align: left;width:60%">
                                        <label for="TenKh" class="form-label">Tên Khách
                                            hàng:<?= (empty($errors['TenKh'])) ? '' : $errors['TenKh'] ?></label>
                                        <input style="width:100%; " type="text" class="form-control" id="TenKh"
                                            name="TenKh" value="<?= $acc['TenKh'] ?>">
                                    </td>
                                    <td style="text-align: left;width:100%">
                                        <label for="NamS" class="form-label">Năm
                                            Sinh:<?= (empty($errors['NamS'])) ? '' : $errors['NamS'] ?></label>
                                        <input style="width:100%; " type="date" class="form-control" id="NamS"
                                            name="NamS" value="<?= $acc['namS'] ?>">
                                    </td>
                                </tr>
                                <!--giới tính-->
                                <tr>
                                    <td style="text-align: left;">
                                        <label for="Phone"
                                            class="form-label">SĐT:<?= (empty($errors['Phone'])) ? '' : $errors['Phone'] ?></label>
                                        <input style="width:100%; " type="text" class="form-control" id="Phone"
                                            name="Phone" value="<?= $acc['Phone'] ?>">
                                    </td>
                                    <td style="text-align: left;">
                                        <label for="Diachi" class="form-label">Địa
                                            Chỉ:<?= (empty($errors['Diachi'])) ? '' : $errors['Diachi'] ?></label>
                                        <input style="width:100%; " type="text" class="form-control" id="Diachi"
                                            name="Diachi" value="<?= $acc['Diachi'] ?>">
                                    </td>
                                </tr>
                                <!--số điện thoại-->
                                <tr>

                                    <td style="text-align: left;">
                                        <label for="email"
                                            class="form-label">Email:<?= (empty($errors['email'])) ? '' : $errors['email'] ?></label>
                                        <input style="width:100%;margin-bottom: 4%; " type="email" class="form-control"
                                            id="email" placeholder="Enter email" name="email"
                                            value="<?= $acc['email'] ?>">
                                    </td>
                                    <td style="text-align: left;">
                                        <label class="form-check-label" style="margin:4% 0 4%;">Giới Tính:</label><br>
                                        <input type="radio" name="gender" id="Nam" checked value="Nam" /><label
                                            for="Nam">Nam</label>
                                        <input type="radio" name="gender" id="Nữ" value="Nữ" /><label
                                            for="Nữ">Nữ</label>
                                        <input type="radio" name="gender" id="Khác" value="Khác" /><label
                                            for="Khác">Khác</label>
                                    </td>
                                </tr>
                                <tr style="margin-top: 2%;">
                                    <td><input type="submit" value="Lưu Thay Đổi" name="KT" class="btn-primary btn"
                                            style="width:100%;" /></td>
                                </tr>
                            </form>
                        </table>

                    </div>
                </div>
                <script>
                function myPassword() {
                    var x = document.getElementById("password_dk");
                    if (x.type === "password") {
                        x.type = "text";
                    } else {
                        x.type = "password";
                    }
                }

                function myDoiTt() {
                    document.getElementById("title_dk").innerHTML = "Đổi Thông Tin Người Dùng"
                    document.getElementById("dangky").checked = true;
                    document.getElementById("close").checked = false;
                    document.getElementById("dangky_tk").style.display = "none";
                    document.getElementById("DoiTt").style.display = "block";
                }
                if ($(window).width() <= 768) {
                    document.getElementsByTagName("input").style.width = "120%";
                }
                </script>
            </div>
        </div>
        <section>
            <section class="content"
                style="width:100%;margin-top:5%;background-color: #ffffff;border-radius: 20px;margin-left: 0%;">
                <div class="container-fluid">
                    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"> -->
                    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
                    <style>
                    .carousel-inner img {
                        width: 100%;
                        height: 100%;
                    }
                    </style>
                    </head>

                    <body>

                        <div id="demo" class="carousel slide" data-ride="carousel" style="width:100%">

                            <!-- Indicators -->
                            <script>
                            var allCarousels = document.querySelectorAll('.carousel');
                            Array.from(allCarousels)
                                .forEach(function(carousel) {
                                    addAutoChangeFeature(carousel);
                                    carousel.addEventListener('click', debounceAutoChange);
                                });
                            </script>
                            <!-- The slideshow -->
                            <?php
                            if (isset($_GET['id'])) {
                                if ($_GET['id'] != 'giohang') {
                                    echo '
                            <div class="carousel-inner" style="width:100%">
                                <div class="carousel-item ">
                                <img src="https://cdn2.cellphones.com.vn/1200x/media/landing-page/iphone-14-subscription/mobile/banner-kv-edit-new.png" alt="Los Angeles"style="height:465px">
                                </div>
                                <div class="carousel-item">
                                <img src="https://cdn.didongviet.vn/pub/media/mageplaza/bannerslider/banner/image/1/0/1024x340_6__5.jpg" alt="New York" width="1100" height="500" style="height:465px">
                                </div>
                                <div class="carousel-item active">
                                <img src="http://file.hstatic.net/1000370129/collection/galaxy_s22_series__e2eda12f16464556af4832b107f6ff2e.png" width="1100" height="300" style="height:465px";>
                                </div>
                                <div class="carousel-item">
                                <img src="https://cdn.mobilecity.vn/mobilecity-vn/images/2022/05/banner-xiaomi-12.jpg" width="1100" height="300" style="height:465px";>
                                </div>
                                <div class="carousel-item">
                                <img src="https://www.viettablet.com/images/companies/1/0-hinh-moi/tin-tuc/2022/thang-9/12/banner-ip-14-series.png?1662974988907" width="1100" height="465" style="height:465px";>
                                </div>
                            </div>
                            <ul class="carousel-indicators" style="width: 50%">
                                <li data-target="#demo" data-slide-to="0" style="height: 3px;width: 30px;"></li>
                                <li data-target="#demo" data-slide-to="1" style="height: 3px;width: 30px;"></li>
                                <li data-target="#demo" data-slide-to="2" style="height: 3px;width: 30px;"></li>
                                <li data-target="#demo" data-slide-to="3" class="active" style="height: 3px;width: 30px;"></li>
                                <li data-target="#demo" data-slide-to="4" style="height: 3px;width: 30px;"></li>
                                <li data-target="#demo" data-slide-to="5" style="height: 3px;width: 30px;"></li>
                            </ul>
                            ';
                                }
                            } else {
                                echo '
                        <div class="carousel-inner" style="width:100%">
                            <div class="carousel-item ">
                            <img src="https://cdn2.cellphones.com.vn/1200x/media/landing-page/iphone-14-subscription/mobile/banner-kv-edit-new.png" alt="Los Angeles"style="height:465px">
                            </div>
                            <div class="carousel-item" >
                            <img src="https://cdn.didongviet.vn/pub/media/mageplaza/bannerslider/banner/image/s/a/sale-soc-galaxy-z-m_i-1024x340.jpg" alt="Chicago" width="1100" height="500" style="height:465px">
                            </div>
                            <div class="carousel-item">
                            <img src="https://cdn.didongviet.vn/pub/media/mageplaza/bannerslider/banner/image/1/0/1024x340_6__5.jpg" alt="New York" width="1100" height="500" style="height:465px">
                            </div>
                            <div class="carousel-item active">
                            <img src="http://file.hstatic.net/1000370129/collection/galaxy_s22_series__e2eda12f16464556af4832b107f6ff2e.png" width="1100" height="300" style="height:465px";>
                            </div>
                            <div class="carousel-item">
                            <img src="https://cdn.mobilecity.vn/mobilecity-vn/images/2022/05/banner-xiaomi-12.jpg" width="1100" height="300" style="height:465px";>
                            </div>
                            <div class="carousel-item">
                            <img src="https://www.viettablet.com/images/companies/1/0-hinh-moi/tin-tuc/2022/thang-9/12/banner-ip-14-series.png?1662974988907" width="1100" height="465" style="height:465px";>
                            </div>
                        </div>
                        <ul class="carousel-indicators" style="width: 50%">
                            <li data-target="#demo" data-slide-to="0" style="height: 3px;width: 30px;"></li>
                            <li data-target="#demo" data-slide-to="1" style="height: 3px;width: 30px;"></li>
                            <li data-target="#demo" data-slide-to="2" style="height: 3px;width: 30px;"></li>
                            <li data-target="#demo" data-slide-to="3" class="active" style="height: 3px;width: 30px;"></li>
                            <li data-target="#demo" data-slide-to="4" style="height: 3px;width: 30px;"></li>
                            <li data-target="#demo" data-slide-to="5" style="height: 3px;width: 30px;"></li>
                        </ul>
                        ';
                            }
                            ?>



                            <!-- Left and right controls -->
                            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </a>
                            <a class="carousel-control-next" href="#demo" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </a>
                        </div>
                </div>
            </section>
        </section>
        <!-- hết baner -->
        <section style="width:100%;margin-top:1%;background-color: white;padding-left:3%;padding-right:3%">
            <div class="container-fluid" id="hien_Sp" style="width:100%;height:1500px;overflow: hidden;">
                <?php
                //giỏ hàng
                if (isset($_GET['id'])) {
                    if ($_GET['id'] == 'giohang') {

                        if ($_SESSION['login'] == 'khach hang') {
                            echo '<script> alert("vui lòng đăng nhập để sử dụng tính năng này")</script>';
                            echo '<script> window.location.href="index.php" </script>';
                        } else {
                            if ($stt != 0) {
                                echo '
                                    <table id="table_gio" class="table" >   
                                    <tr style="border: 2px solid #ababab" >
                                        <td style="width:10px" >TT</td>
                                        <td>Tên Sản Phẩm</td>
                                        <td>Giá</td>
                                        <td>Số lượng</td>
                                        <td>Chức Năng</td>
                                    </tr>';
                                $stt = 0;
                                $SlSP = 1;
                                $tongSp = 0;
                                $tong = 0;
                                $sql_cart = 'SELECT * FROM `cart` WHERE userName_acc ="' . $_SESSION['login'] . '"';
                                $cart = executeResult($sql_cart);
                                foreach ($cart as $value) {
                                    $tongSp = $value['amount'] * $value['price'];
                                    $tong += $tongSp;
                                    $stt++;
                                    echo    '<tr style="border: 2px solid #ababab">
                                        <td style="vertical-align: middle;">' . $stt . '</th>
                                        <td style="vertical-align: middle;">' . $value['title'] . '</td>
                                        <td style="vertical-align: middle;"><img style="width:80px" src="' . $value['thumbnail'] . '"/><br><br>' . number_format($value['price']) . '&ensp;đ</td>
                                        <td style="vertical-align: middle;">
                                            <form action="giohang/update.php?id=' . $value['id_product'] . '" method="post" name="SLSP" >
                                                <a style="text-decoration: none;" href=giohang/giam.php?id=' . $value['id_product'] . '><b style="font-size:35px;padding-left: 5px">-</b></a> 
                                                <input style="width:50px" type="number" min="1" max="10" name="SL_sp_' . $value['id_product'] . '" value="' . $value['amount'] . '"required>
                                                <a style="text-decoration: none;" href=giohang/tang.php?id=' . $value['id_product'] . '><b style="font-size:25px;padding-left: 5px">+</b></a>
                                        </td>
                                        <td style="vertical-align: middle;">
                                                <a ><button type="submit" name="capnhatall" class="btn-primary btn"/>cập Nhật</button></a>
                                                </form>
                                                <a href=giohang/del.php?id=' . $value['id_product'] . '><button class="btn btn-danger">Xoá</button></a>
                                        </td>
                                        </tr>';
                                }
                                echo '
                                    <tr style="border: 2px solid #ababab">
                                        <td style="width:50px" ></td>
                                        <td style="vertical-align: middle;">Tổng:</td>
                                        <td style="vertical-align: middle;">' . number_format($tong) . '&ensp;đ </td>
                                        <td></td>
                                        <td>
                                            <a><button onclick="myDel()" class="btn btn-danger">Xoá Tất Cả</button></a>
                                            <a href="#footer"><button class="btn btn-danger">Đặt Hàng</button></a>
                                        
                                        </td>
                                    </tr>';
                                echo "</table> ";
                                echo '<script>
                                function myDel() {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Đã Xóa Thành Công",
                                        showConfirmButton: false,
                                        timer: 1000
                                    });
                                    setTimeout(function() {
                                        window.location = "giohang/del.php";
                                    }, 1000);
                                }
                                </script>';
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
                                        echo '<table  class="table table-bordered" style="height: 100%;width:600px;max-width:100%;border: 0px;margin-top:1%;float:left" id="suaThongtin">
                                        <form action="index.php?id=giohang" method="post">
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
                                        header('Location:index.php?id=giohang');
                                    }
                                }
                                if (isset($_POST['oder'])) {
                                    $ngay = date('Y-m-d H:s:i');
                                    foreach ($cart as $value) {
                                        $id_cart = $value['id_product'] . "_" . $_SESSION['login'];
                                        $sql_oder = 'INSERT INTO `oder` (`id_cart`, `title`, `anh`, `price`, `SoLuong`, `TenKh`, `Diachi`, `Phone`, `email`, `Pay`,`ngay`) 
                                VALUES ("' . $id_cart . '","' . $value['title'] . '","' .  $value['thumbnail'] . '",' . $value['price'] . ',' . $value['amount'] . ',"' . $acc['TenKh'] . '","' . $acc['Diachi'] . '","' . $acc['Phone'] . '","' . $acc['email'] . '","' . $_POST['pay'] . '","' . $ngay . '")';
                                        execute($sql_oder);
                                    }
                                    header('Location:thongbao.html');
                                }
                                echo '<table class="table" style="height:400px;width:700px;max-width:100%;border:0px;margin-top:2%;float:left" id="Thongtin">
                                    <form action="index.php?id=giohang" method="post">
                                        <tr style="border: 1px solid #ababab">
                                            <td colspan="2" style="text-align: center;font-size: 24px;padding:10px">
                                                <b onclick="myThanhtoan()">Thông Tin đặt Hàng</b>
                                            </td>
                                        </tr>
                                        <tr style="border: 1px solid #ababab; ">
                                            <td style="border:1px solid #ababab;text-align: left;">
                                                <label>Tên Khách Hàng</label>
                                            </td>
                                            <td style="border:1px solid #ababab;text-align: left;width:500px">' . $acc['TenKh'] . '</td>
                                        </tr>
                                        <tr style="border: 1px solid #ababab; text-align: left;">
                                            <td style="border:1px solid #ababab;text-align: left;">
                                                <label>Điạ Chỉ</label>
                                            </td>
                                            <td style="border:1px solid #ababab;text-align: left;">' . $acc['Diachi'] . '</td>
                                        </tr>
                                        <tr style="border: 1px solid #ababab">
                                            <td style="border:1px solid #ababab;text-align: left;">
                                                <label>Phone</label>
                                            </td>
                                            <td style="border:1px solid #ababab;text-align: left;">' . $acc['Phone'] . '</td>
                                        </tr>
                                        <tr style="border: 1px solid #ababab">
                                            <td style="border:1px solid #ababab;text-align: left;">
                                                <label>Email</label>
                                            </td>
                                            <td style="border:1px solid #ababab;text-align: left;">' . $acc['email'] . '</td>
                                        </tr>
                                        <tr style="border: 1px solid #ababab">
                                            <td style="border:1px solid #ababab;text-align: left;">
                                                <label>Hình Thức Thanh Toán</label>
                                            </td>
                                            <td style="border:1px solid #ababab;text-align: left;">
                                                <input type="radio" checked name="pay" value="Trả Tiền Mặt" id="TM"><label for="TM">Trả Tiền Mặt</label><br>
                                                <input type="radio" name="pay" value="Trả Góp" id="TG"><label for="TG">Trả Góp</label><br>
                                                <input type="radio" name="pay" id="ATM" value="Trả Qua ATM"><label for="ATM">Trả Qua ATM</label>
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
                                    <form action="index.php?id=giohang" method="post">
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
                                            <td><input class="form-control" type="text" value="' . $acc['Phone'] . '" name="Phone" id="phone" required></td>
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
                                </table>
                                <script>
                                    function myThanhtoan() {
                                        document.getElementById("Thongtin").style.display = "block";
                                        document.getElementById("suaThongtin").style.display = "none";
                                    }

                                    function mySuaTn() {
                                        document.getElementById("Thongtin").style.display = "none";
                                        document.getElementById("suaThongtin").style.display = "block";
                                    }
                                </script>';
                            } else {
                                echo '
                                    <script> 
                                        window.onload=function(){
                                            Swal.fire({
                                                icon: "error",
                                                title: "Giỏ Hàng Của Bạn Đang Trống",
                                                showConfirmButton: false
                                            });}
                                            setTimeout(function() {
                                                window.location.href = "index.php";
                                            }, 1500);
                                    </script>';
                            }
                        }
                        //sản phẩm 
                    } elseif (isset($_GET['id']) && !isset($_POST['noidung'])) {
                            $noidung = $_GET['id'];
                        $timkiem = "SELECT * FROM product WHERE id_thumuc LIKE $noidung;";
                        $productList = executeResult($timkiem);
                        $result = mysqli_query($con, $timkiem);
                        foreach ($productList as $item) {
                            echo '<div class="sp">
                            <a href=chitietsp/index.php?id=' . $item['id'] . ' style="text-decoration: none;color:black">
                            <center><img class="zoom" src="' . $item['thumbnail'] . '"/></center>
                            <p style="margin-bottom:5px"><b style="font-size:14px;"><br>' . $item['title'] . '</b></p>
                            <p style="margin-bottom:5px"><b style="color:red;font-size:14px;">&ensp;' . number_format($item['price']) . '&ensp;VNG</b></p>
                            </a>
                            <div class="mua_them">
                            <a href=oder/add.php?id=' . $item['id'] . '#><button style="float:left;margin-right:5%;width:60%" name="mua" class="btn btn-danger">Mua Ngay</button> </a>  
                            <a ><button  onclick="thongbaoadd(' . $item['id'] . ')" name="them" class="btn btn-danger" style="padding-left: 5px;padding-right: 5px;width:30%;font-size:10px;"><span class="material-symbols-outlined">add_shopping_cart</span></button></a>        
                            </div>
                            </div>';
                        }
                    } elseif (isset($_POST['tim'])) {
                        $noidung = $_POST['noidung'];
                        $timkiem = "SELECT * FROM product WHERE title LIKE '%$noidung%';";
                        $productList = executeResult($timkiem);
                        $result = mysqli_query($con, $timkiem);
                        if (mysqli_num_rows($result) <= 0) {
                            echo '<script> alert("Không Tìm Thấy Kết Quả! Vui Lòng Thử Lại")</script>';
                        }
                        foreach ($productList as $item) {
                            echo '<div class="sp">
                        <a href=chitietsp/index.php?id=' . $item['id'] . ' style="text-decoration: none;color:black">
                            <center><img class="zoom" src="' . $item['thumbnail'] . '"/></center>
                            <p style="margin-bottom:5px"><b style="font-size:14px;"><br>' . $item['title'] . '</b></p>
                            <p style="margin-bottom:5px"><b style="color:red;font-size:14px;">&ensp;' . number_format($item['price']) . '&ensp;VNG</b></p>
                            </a>
                            <div class="mua_them">
                            <a href=oder/add.php?id=' . $item['id'] . '#><button style="float:left;margin-right:5%;width:60%" name="mua" class="btn btn-danger">Mua Ngay</button> </a>  
                            <a ><button  onclick="thongbaoadd(' . $item['id'] . ')" name="them" class="btn btn-danger" style="padding-left: 5px;padding-right: 5px;width:30%;font-size:10px;"><span class="material-symbols-outlined">add_shopping_cart</span></button></a>        
                            </div>
                            </div>';
                        }
                    }
                } elseif (isset($_POST['tim'])) {
                    $noidung = $_POST['noidung'];
                    $timkiem = "SELECT * FROM product WHERE title LIKE '%$noidung%';";
                    $productList = executeResult($timkiem);
                    $result = mysqli_query($con, $timkiem);
                    if (mysqli_num_rows($result) <= 0) {
                        echo '<script> alert("Không Tìm Thấy Kết Quả! Vui Lòng Thử Lại")</script>';
                    }
                    foreach ($productList as $item) {
                        echo '<div class="sp">
                    <a href=chitietsp/index.php?id=' . $item['id'] . ' style="text-decoration: none;color:black">
                        <center><img class="zoom" src="' . $item['thumbnail'] . '"/></center>
                        <p style="margin-bottom:5px"><b style="font-size:14px;"><br>' . $item['title'] . '</b></p>
                        <p style="margin-bottom:5px"><b style="color:red;font-size:14px;">&ensp;' . number_format($item['price']) . '&ensp;VNG</b></p>
                        </a>
                        <div class="mua_them">
                            <a href=oder/add.php?id=' . $item['id'] . '#><button style="float:left;margin-right:5%;width:60%" name="mua" class="btn btn-danger">Mua Ngay</button> </a>  
                            <a ><button  onclick="thongbaoadd(' . $item['id'] . ')" name="them" class="btn btn-danger" style="padding-left: 5px;padding-right: 5px;width:30%;font-size:10px;"><span class="material-symbols-outlined">add_shopping_cart</span></button></a>        
                            </div>
                        </div>';
                    }
                } elseif (!isset($_GET['id'])) {
                    $dem = 0;
                    $chitiet = '';
                    $noidung = false;
                    $Sql = "SELECT * FROM product ";
                    $sqlproduct = 'select product.id, product.thumbnail ,product.title, product.price,
                    product.updated_at, thumuc.name
                    thumuc_name from product left join thumuc on 
                    product.id_thumuc = thumuc.id';
                    $productList = executeResult($sqlproduct);
                    foreach ($productList as $item) {
                        echo '<div class="sp">
                        <a href=chitietsp/index.php?id=' . $item['id'] . ' style="text-decoration: none;color:black">
                            <center><img class="zoom" src="' . $item['thumbnail'] . '"/></center>
                            <p style="margin-bottom:5px"><b style="font-size:14px;"><br>' . $item['title'] . '</b></p>
                            <p style="margin-bottom:5px"><b style="color:red;font-size:14px;margin-buttom:0px">&ensp;' . number_format($item['price']) . '&ensp;VNG</b></p>
                        </a>
                        <div class="mua_them">
                            <a href=oder/add.php?id=' . $item['id'] . '#><button style="float:left;margin-right:5%;width:60%;font-size:14px;" name="mua" class="btn btn-danger">Mua Ngay</button> </a>  
                            <a ><button  onclick="thongbaoadd(' . $item['id'] . ')" name="them" class="btn btn-danger" style="padding-left: 5px;padding-right: 5px;width:30%;font-size:10px;"><span class="material-symbols-outlined">add_shopping_cart</span></button></a> 
                            </div>
                        </div>';
                    }
                }
                ?>
                <script>
                $(document).ready(function() {
                    $('#xemthem').click(function() {});
                });
                y = 3000;
                z = 3000;

                function myXemthem() {
                    var x = document.getElementById("hien_Sp");
                    var an = document.getElementById("xemthem");
                    if ($(window).width() <= 768) {
                        // alert("nhỏ hơn 768px");
                        if (y <= 8000) {
                            var dai = x.style.height = y + "px";
                            y += 2000;
                        } else {
                            var dai = x.style.height = "100%";
                            an.type = "hidden";
                        }
                    } else {
                        // alert("lớn hơn 768px" + $(document).height());
                        if (z <= 10000) {
                            var dai = x.style.height = z + "px";
                            z += 2000;
                        } else {
                            var dai = x.style.height = "100%";
                            var an = document.getElementById("xemthem");
                            an.type = "hidden";
                        }
                    }
                }

                function thongbaoadd(id) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Đã Thêm Vào Giỏ',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    setTimeout(function() {
                        window.location = 'giohang/add.php?id=' + id;
                    }, 1000);
                    // document.getElementById('myform').submit();
                }
                </script>
            </div>
    </div>
    </div>
    </section>
    </div>
    <?php
    if (isset($_GET['id'])) {
        if ($_GET['id'] != '') {
            echo '
            <script>
                var x = document.getElementById("hien_Sp");
                var dai = x.style.height ="100%";
            </script>
            ';
        }
    } elseif (!isset($_POST['tim'])) {
        echo '
            <form method="post" id="formxemthem" style="width:100%;text-shadow: 2px 2px 5px red;">
                <input class="xemthem__sp" type="button" id="xemthem" onclick="myXemthem()" value="Xem Thêm" />
            </form>
            ';
    } elseif (isset($_POST['tim'])) {
        echo '<script>
                var x = document.getElementById("hien_Sp");
                var dai = x.style.height ="100%";
            </script>';
    }

    ?>
    <div class="lendau__pc__mobile">
        <a href=#demo style="font-size:14px;color:#fff">&#8896;<br>lên đầu</a>
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="giohang/add.php">

</html>