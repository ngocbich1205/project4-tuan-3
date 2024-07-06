<?php
require_once('../../../db/dbhelper.php');
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
    header('Location:../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEB BÁN SMART PHONE</title>
    <link rel="icon" href="../../../favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="QLSP.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="main">
        <div class="nav fixed-top">
            <label for="menu__hien" class="nav_bars-btn">
                <span class="material-symbols-outlined"><b style="font-size:30px;">menu</b></span>
            </label>
            <div style="width:8%;float:left; min-width: 55px; max-width: 65px;padding-top: 9px;">
                <a href="index.php"><img src="../../../img/logo.png" width="60%"></a>
            </div>
        </div>
        <input hidden type="checkbox" class="menu__hien" id="menu__hien">
        <div class="nav__menu">
            <ul class="nav__mobile-list">
                <li style="margin-top:80px ;">
                    <form class="d-flex nav__search">
                        <input class="form-control me-2 " type="text" placeholder="Bạn cần tìm gì ? &#9997;">
                        <button style="background:#ffffff ;" hidden type="submit" name="tim"><i class="material-icons">search</i></button>
                    </form>
                </li>
                <b style="color:black;font-size:17px;padding-left:15px;">Xin chào&ensp;<?php $_SESSION['login'] ?></b>
                <li>
                    <a href="index.php" class="nav__mobile-link">Home</a>
                </li>
                <li>
                    <a class="nav__mobile-link" href="">Quản lý Tài Khoản</a>
                </li>
                <li>
                    <a class="nav__mobile-link" href="">Quản lý Sản Phẩm</a>
                </li>
                <li>
                    <a href="donhang/index.php" class="nav__mobile-link">Quản lý Đơn Hàng</a>
                </li>
                <li>
                    <a href="../Homepage/Tk/delsession.php" class="nav__mobile-link">Đăng xuất</a>
                </li>
            </ul>
        </div>
        <?php
        $id = $name = '';
        if (!empty($_POST)) {
            if (isset($_POST['name'])) {
                $name = $_POST['name'];
                $name = str_replace('"', '\\"', $name);
            }
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
            }

            if (!empty($name)) {
                $created_at = $updated_at = date('Y-m-d H:s:i');
                //Luu vao database
                if ($id == '') {
                    $sql = 'insert into thumuc(name, created_at, updated_at) values ("' . $name . '", "' . $created_at . '", "' . $updated_at . '")';
                } else {
                    $sql = 'update thumuc set name = "' . $name . '", updated_at = "' . $updated_at . '" where id = ' . $id;
                }

                execute($sql);

                header('Location:index.php');
                die();
            }
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = 'select * from thumuc where id = ' . $id;
            $thumuc = executeSingleResult($sql);
            if ($thumuc != null) {
                $name = $thumuc['name'];
            }
        }
        ?>
        <div class="container" >
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="text-center">Thêm/Sửa Danh Mục Sản Phẩm</h2>
                </div>
                <div class="panel-body">
                    <form method="post" style="margin-top:100px;margin-left:20%">
                        <div class="form-group">
                            <label for="name">Tên Danh Mục:</label>
                            <input type="text" name="id" value="<?= $id ?>" hidden="true">
                            <input required="true" type="text" class="form-control" id="name" name="name" value="<?= $name ?>">
                        </div>
                        <button class="btn btn-success">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
</body>
</div>
</body>

</html>