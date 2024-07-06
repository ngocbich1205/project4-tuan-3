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
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="QLSP.css">
    <!-- <link href="admin.css" rel="stylesheet"> -->
    <script src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
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
                        <button style="background:#ffffff ;" hidden type="submit" name="tim"><i
                                class="material-icons">search</i></button>
                    </form>
                </li>
                <b style="color:black;font-size:17px;padding-left:15px;">Xin chào&ensp;<?php $_SESSION['login'] ?></b>
                <li>
                    <a href="../../index.php" class="nav__mobile-link">Home</a>
                </li>
                <li>
                    <a class="nav__mobile-link" href="#">Quản lý Tài Khoản</a>
                </li>
                <li>
                    <a class="nav__mobile-link" href="../QuanLySP/">Quản lý Sản Phẩm</a>
                </li>
                <li>
                    <a href="../QuanLyDon" class="nav__mobile-link">Quản lý Đơn Hàng</a>
                </li>
                <li>
                    <a href="../Homepage/Tk/delsession.php" class="nav__mobile-link">Đăng xuất</a>
                </li>
            </ul>
        </div>

        <section class="hienthi__noidung">
            <?php
require_once('../../../db/dbhelper.php');
$check=0;
$id = $title = $thumbnail = $price = $content = $id_thumuc = '';

if (!empty($_POST)) {
	if (isset($_POST['title'])) {
		$title = $_POST['title'];
		$title = str_replace('"', '\\"', $title);
	}
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	}
	if (isset($_POST['id_thumuc'])) {
		$id_thumuc = $_POST['id_thumuc'];
	}
	if (isset($_POST['thumbnail'])) {
		$thumbnail = $_POST['thumbnail'];
	}
	if (isset($_POST['price'])) {
		$price = $_POST['price'];
	}
	if (isset($_POST['content'])) {
		$content = $_POST['content'];
		$content = str_replace('"', '\\"', $content);
	}

	if (isset($_POST['ChitietSP'])) {
		$created_at = $updated_at = date('Y-m-d H:s:i');
		//Luu vao database
		if ($id == '') {
			$sql = 'insert into product(title, id_thumuc, price, thumbnail,content,created_at, updated_at) values ("' . $title . '",  "' . $id_thumuc . '","' . $price . '", "' . $thumbnail . '", "' . $content . '", "' . $created_at . '", "' . $updated_at . '")';
		} else {
			$sql = 'update product set title = "' . $title . '", price = "' . $price . '",thumbnail = "' . $thumbnail . '",content = "' . $content . '",id_thumuc = "' . $id_thumuc . '" , updated_at = "' . $updated_at . '"  where id = ' . $id;
		}
		execute($sql);
		$check = 1;
	}
    if (isset($_POST['luu'])) {
		$created_at = $updated_at = date('Y-m-d H:s:i');
		//Luu vao database
		if ($id == '') {
			$sql = 'insert into product(title, id_thumuc, price, thumbnail,content,created_at, updated_at) values ("' . $title . '",  "' . $id_thumuc . '","' . $price . '", "' . $thumbnail . '", "' . $content . '", "' . $created_at . '", "' . $updated_at . '")';
		} else {
			$sql = 'update product set title = "' . $title . '", price = "' . $price . '",thumbnail = "' . $thumbnail . '",content = "' . $content . '",id_thumuc = "' . $id_thumuc . '" , updated_at = "' . $updated_at . '"  where id = ' . $id;
		}
		execute($sql);
        $check=2;
	}
    if($check==2){
        header('location:index.php');
    }
	if ($check == 1) {
		header('location:chitietsp.php?id='.$id.'');
	}
}

if (isset($_GET['id'])) {
	$id       = $_GET['id'];
	$sql      = 'select * from product where id = ' . $id;
	$product = executeSingleResult($sql);
	if ($product != null) {
		$title = $product['title'];
		$price = $product['price'];
		$thumbnail = $product['thumbnail'];
		$id_thumuc = $product['id_thumuc'];
		$content = $product['content'];
	}
}
?>

            <head>
                <title>Thêm/Sửa Sản Phẩm</title>
            </head>

            <body>
                <div class="container" style="background-color:#ffffff;">
                    <div class="row justify-content-around">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h2 class="text-center">Thêm/Sửa Sản Phẩm</h2>
                            </div>
                            <div class="panel-body">
                                <form method="post">
                                    <div class="form-group">
                                        <label for="name">Tên Sản phẩm:</label>
                                        <input type="text" name="id" value="<?= $id ?>" hidden="true">
                                        <input required="true" type="text" class="form-control" id="title" name="title"
                                            value="<?= $title ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="id_thumuc">Chọn danh mục:</label>
                                        <select class="form-control" name="id_thumuc" id="id_thumuc">
                                            <option>-- Lựa chọn danh mục --</option>
                                            <?php
								$sql          = 'select * from thumuc';
								$thumucList = executeResult($sql);
								foreach ($thumucList as $item) {
									if ($item['id'] == $id_thumuc) {
										echo '<option selected value="' . $item['id'] . '">' . $item['name'] . '</option>';
									} else {
										echo '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
									}
								}
								?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Giá Sản phẩm:</label>
                                        <input required="true" type="price" class="form-control" id="price" name="price"
                                            value="<?= $price ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="thumbnail">Thumbnail:</label>
                                        <input required="true" type="text" class="form-control" id="thumbnail"
                                            name="thumbnail" value="<?= $thumbnail ?>" onchange="updatethumnail()">
                                        <img src="<?= $thumbnail ?>" style="max-width:200px" id=img_thumbnil>
                                    </div>
                                    <div class="form-group">
                                        <label for="content">Nội Dung:</label>
                                        <textarea class="form-control" name="content" id="content"
                                            rows="5"><?= $content ?></textarea>
                                    </div>
                                    <button style="width:350px" class="btn btn-success" name="luu">Lưu</button>
                                    <button style="width:350px" class="btn btn-success" name="ChitietSP">Thêm chi tiết
                                        SP</button>
                                    <a href="index.php" style="width:350px;margin-left:20px"
                                        class="btn btn-success">Quay Lại</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                function updatethumnail() {
                    $('#img_thumbnil').attr('src', $('#thumbnail').val());
                }

                $(function() {
                    $('#content').summernote({
                        height: 200,
                        codemirror: {
                            theme: 'monokai'
                        }
                    });
                })
                </script>
        </section>
    </div>
</body>

</html>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>