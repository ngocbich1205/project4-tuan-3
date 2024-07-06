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
    <link rel="icon" href="../../../favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="QLTK.css">
    <!-- <link href="admin.css" rel="stylesheet"> -->
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
                    <a href="../../index.php" class="nav__mobile-link">Home</a>
                </li>
                <li>
                    <a class="nav__mobile-link" href="../QuanLyTK/index.php">Quản lý Tài Khoản</a>
                </li>
                <li>
                    <a class="nav__mobile-link" href="../QuanLySP/index.php">Quản lý Sản Phẩm</a>
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
            ?>
            <tbody>
                <div class="container">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h2 class="text-center">Quản Lý Tài Khoản</h2>
                        </div>
                        <form method="post">
                            <button type="submit" name="tim" style="float: right;width: 38px;margin-right:100px;
                            height: 26px;border-left-width: 2px;margin-left: 10px;padding-bottom: 21px;margin-top: 20px;margin-bottom: 10px;"><i class="material-icons">search</i></button>
                            <input type="text" name="noidung" style="float: right;margin-top: 20px;width: 358px;margin-bottom: 10px;">
                        </form>
                        <div class="panel-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="50px">STT</th>
                                        <th>Tên khách hàng</th>
                                        <th>Email</th>
                                        <th>Tài Khoản</th>
                                        <th>Mật Khẩu</th>
                                        <th>Ngày cập nhật</th>
                                        <th width="50px"></th>
                                        <th width="50px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($_POST['tim'])) {
                                        $noidung = $_POST['noidung'];
                                        $SSSS = "SELECT * FROM acc WHERE TenKh LIKE '%$noidung%';";
                                        $accList = executeResult($SSSS);

                                        $index = 1;
                                        foreach ($accList as $item) {
                                            echo '<tr>
                                    <td>' . ($index++) . '</td>
                                    <td> ' . $item['TenKh'] . '</td>
                                    <td>' . $item['email'] . '</td>                                
                                    <td>' . $item['userName'] . '</td>
                                    <td>' . $item['password'] . '</td>
                                    <td>' . $item['ngaytao'] . '</td>
                                    <td>
                                    <a href="#?id=' . $item['id'] . '"><button class="btn btn-warning">Sửa</button></a>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger" onclick="deleteproduct(' . $item['id'] . ')">Xoá</button>
                                    </td>
                                </tr>';
                                        }
                                    } else {
                                        require_once('../../../db/dbhelper.php');
                                        $noidung = false;
                                        $sql          = 'select * from acc';
                                        $accList = executeResult($sql);

                                        $index = 1;
                                        foreach ($accList as $item) {
                                            echo '<tr>
                                    <td>' . ($index++) . '</td>
                                    <td> ' . $item['TenKh'] . '</td>
                                    <td>' . $item['email'] . '</td>                                
                                    <td>' . $item['userName'] . '</td>
                                    <td>' . $item['password'] . '</td>
                                    <td>' . $item['ngaytao'] . '</td>
                                    <td>
                                    <a href="add.php?id=' . $item['id'] . '"><button class="btn btn-warning">Sửa</button></a>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger" onclick="deleteproduct(' . $item['id'] . ')">Xoá</button>
                                    </td>
                                </tr>';
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </tbody>
        </section>
    </div>
</body>

</html>
<script type="text/javascript">
    function deleteproduct(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                swalWithBootstrapButtons.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'

                )
                setTimeout(function() {
                    console.log(id)
                    $.post('ajax.php', {
                        'id': id,
                        'action': 'delete'
                    }, function(data) {
                        location.reload()
                    })
                }, 1500)


            }
        })
    }
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>