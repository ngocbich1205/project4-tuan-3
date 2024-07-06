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
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="QuanLyDon.css">
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
                    <a class="nav__mobile-link" href="../QuanLyTK/index.php">Quản lý Tài Khoản</a>
                </li>
                <li>
                    <a class="nav__mobile-link" href="../QuanLySP/index.php">Quản lý Sản Phẩm</a>
                </li>
                <li>
                    <a href="donhang/index.php" class="nav__mobile-link">Quản lý Đơn Hàng</a>
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
            <h2 style="margin-bottom: 50px;">Quản Lý Đơn Hàng</h2>
            <table class="table table-striped" style="text-align: center;">
                <thead>
                    <tr>
                        <th style="width:30px">STT</th>
                        <th style="width:200px">Thông Tin Khách Hàng</th>
                        <th style="width:40px">Tên Sản Phẩm</th>
                        <th style="width:30px">Số Lương</th>
                        <th style="width:30px">Giá</th>
                    </tr>
                </thead>
                <?php 
                $EMAIL='';
                $sql= 'select * from oder';
                $oderList = executeResult($sql);
                foreach ($oderList as $item) { 
                    $tong=$item['SoLuong']*$item['price'];
                    if($item['email']!=$EMAIL){
                        $STT=1;
                        echo'<th style="background-color: rgba(120, 119, 119, 0.334);text-align: left;" colspan="5">'.$item['TenKh'].'</th>';
                        echo'
                            <tbody>
                                <tr>
                                    <td>'.$STT.'</td>
                                    <td>'.$item['TenKh'].' - '.$item['Diachi'].' - '.$item['Phone'].'</td>
                                    <td>'.$item['title'].'<br> <img style="width:100px" src="' . $item['anh'] . '"/> </td>
                                    <td>'.$item['SoLuong'].'</td>
                                    <td>'.$item['SoLuong'].'<br>X<br>'.number_format($item['price']).'<br>&#10597;<br>'.number_format($tong).'đ</td>
                                </tr>
                            </tbody>
                        ';
                        $EMAIL=$item['email'];
                    }else{
                        echo'
                            <tbody>
                                <tr>
                                    <td>'.$STT.'</td>
                                    <td>'.$item['TenKh'].' - '.$item['Diachi'].' - '.$item['Phone'].'</td>
                                    <td>'.$item['title'].'<br> <img style="width:100px" src="' . $item['anh'] . '"/> </td>
                                    <td>'.$item['SoLuong'].'</td>
                                    <td>'.$item['SoLuong'].'<br>X<br>'.number_format($item['price']).'<br>=<br>'.number_format($tong).'đ</td>
                                </tr>
                            </tbody>
                        ';
                        
                   }
                    $STT++;
                }
                ?>

            </table>
        </section>
    </div>
</body>

</html>
<!-- <script type="text/javascript">
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
</script> -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>