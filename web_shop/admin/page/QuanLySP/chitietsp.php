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
            $check = 0;
$id_CTSP = $kichthuoc = $dophangiai = $congnghemh = $tinhnangmh = $soquet =
    $hedieuhanh = $wifi = $bluetooth = $jack = $matlung = $khung =
    $nfc = $mang = $sac = $gps = $camsau = $tinhnangcamsau =
    $pin = $congsac = $kichthuocsp = $trongluong = $quay = $camtruoc =
    $ram = $gb = $kieumh = $tinhnangdacbiet = $cpu = '';
if($_GET['id']==''){
    header('location:index.php');
}
elseif (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if (isset($_POST['ok'])) {
    if (isset($_POST['kichthuoc'])) {
        $kichthuoc = $_POST['kichthuoc'];
        $dophangiai = $_POST['dophangiai'];
        $congnghemh = $_POST['congnghemh'];
        $tinhnangmh = $_POST['tinhnangmh'];
        $soquet = $_POST['soquet'];
        $hedieuhanh = $_POST['hedieuhanh'];
        $wifi = $_POST['wifi'];
        $bluetooth = $_POST['bluetooth'];
        $jack = $_POST['jack'];
        $matlung = $_POST['matlung'];
        $khung = $_POST['khung'];
        $nfc = $_POST['nfc'];
        $mang = $_POST['mang'];
        $sac = $_POST['sac'];
        $gps = $_POST['gps'];
        $camsau = $_POST['camsau'];
        $tinhnangcamsau = $_POST['tinhnangcamsau'];
        $pin = $_POST['pin'];
        $congsac = $_POST['congsac'];
        $kichthuocsp = $_POST['kichthuocsp'];
        $trongluong = $_POST['trongluong'];
        $quay = $_POST['quay'];
        $camtruoc = $_POST['camtruoc'];
        $ram = $_POST['ram'];
        $gb = $_POST['gb'];
        $kieumh = $_POST['kieumh'];
        $tinhnangdacbiet = $_POST['tinhnangdacbiet'];
        $cpu = $_POST['cpu'];
    }
    if (isset($_POST['ok'])) {
        //Luu vao database
        if ($id_CTSP == '') {
            $sql = 'INSERT INTO ct_sanpham(id_CTSP,kichthuoc, dophangiai, congnghemh, tinhnangmh,soquet,hedieuhanh, wifi,bluetooth,jack,matlung,khung, nfc, mang,sac, gps, camsau, tinhnangcamsau,pin, congsac,kichthuocsp,trongluong,quay, camtruoc, ram, gb, kieumh, tinhnangdacbiet, cpu) values 
            ("' . $id . '","' . $kichthuoc . '",  "' . $dophangiai . '","' . $congnghemh . '", "' . $tinhnangmh . '", "' . $soquet . '", "' . $hedieuhanh . '", "' . $wifi . '", "' . $bluetooth . '", ' . $jack . ', "' . $matlung . '", "' . $khung . '", ' . $nfc . ', "' . $mang . '", "' . $sac . '", "' . $gps . '", "' . $camsau . '", "' . $tinhnangcamsau . '", "' . $pin . '", "' . $congsac . '"
            , "' . $kichthuocsp . '", "' . $trongluong . '", "' . $quay . '", "' . $camtruoc . '", "' . $ram . '", "' . $gb . '", "' . $kieumh . '", "' . $tinhnangdacbiet . '", "' . $cpu . '")';
            $check = 1;
        } else {
            $sql = 'UPDATE ct_sanpham set kichthuoc = "' . $kichthuoc . '", dophangiai = "' . $dophangiai . '",congnghemh = "' . $congnghemh . '",tinhnangmh = "' . $tinhnangmh . '",soquet = "' . $soquet . '" , hedieuhanh = "' . $hedieuhanh . '"
            ,wifi = "' . $wifi . '", bluetooth = "' . $bluetooth . '",jack = "' . $jack . '",matlung = "' . $matlung . '",khung = "' . $khung . '" , nfc = "' . $nfc . '", mang = "' . $mang . '",sac = "' . $sac . '" , gps = "' . $gps . '", camsau = "' . $camsau . '", tinhnangcamsau = "' . $tinhnangcamsau . '"
            ,pin = "' . $pin . '", congsac = "' . $congsac . '",kichthuocsp = "' . $kichthuocsp . '",trongluong = "' . $trongluong . '",quay = "' . $quay . '" , camtruoc = "' . $camtruoc . '", ram = "' . $ram . '", gb = "' . $gb . '", kieumh = "' . $kieumh . '", tinhnangdacbiet = "' . $tinhnangdacbiet . '", cpu = "' . $cpu . '"
              where id_CTSP = ' . $id_CTSP;
            $check = 1;
        }
        $sqli = "INSERT INTO `ct_sanpham`( `id_CTSP`, `kichthuoc`, `dophangiai`, `congnghemh`, `tinhnangmh`, `soquet`, `hedieuhanh`, `wifi`, `bluetooth`, `jack`, `nfc`, `mang`, `gps`, `pin`, `sac`, `congsac`, `kichthuocsp`, `trongluong`, `matlung`, `khung`, `camsau`, `tinhnangcamsau`, `quay`, `camtruoc`, `ram`, `gb`, `kieumh`, `tinhnangdacbiet`, `cpu`) VALUES ('123','456','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]','[value-10]','[value-11]','[value-12]','[value-13]','[value-14]','[value-15]','[value-16]','[value-17]','[value-18]','[value-19]','[value-20]','[value-21]','[value-22]','[value-23]','[value-24]','[value-25]','[value-26]','[value-27]','[value-28]','[value-29]','[value-30]')";
        if (mysqli_query($con, $sql)) {
            $check=1;
            echo $check;
        }
    }
    if ($check == 1) {
        header('location:index.php');
    }
}

if (isset($_GET['id'])) {
	$id_CTSP       = $_GET['id'];
	$sql      = 'select * from ct_sanpham where id_CTSP = ' . $id_CTSP;
	$item = executeSingleResult($sql);
	if ($item != null) {
		$kichthuoc = $item['kichthuoc'];
        $dophangiai = $item['dophangiai'];
        $congnghemh = $item['congnghemh'];
        $tinhnangmh = $item['tinhnangmh'];
        $soquet = $item['soquet'];
        $hedieuhanh = $item['hedieuhanh'];
        $wifi = $item['wifi'];
        $bluetooth = $item['bluetooth'];
        $jack = $item['jack'];
        $matlung = $item['matlung'];
        $khung = $item['khung'];
        $nfc = $item['nfc'];
        $mang = $item['mang'];
        $sac = $item['sac'];
        $gps = $item['gps'];
        $camsau = $item['camsau'];
        $tinhnangcamsau = $item['tinhnangcamsau'];
        $pin = $item['pin'];
        $congsac = $item['congsac'];
        $kichthuocsp = $item['kichthuocsp'];
        $trongluong = $item['trongluong'];
        $quay = $item['quay'];
        $camtruoc = $item['camtruoc'];
        $ram = $item['ram'];
        $gb = $item['gb'];
        $kieumh = $item['kieumh'];
        $tinhnangdacbiet = $item['tinhnangdacbiet'];
        $cpu = $item['cpu'];
    }
}
        ?>
            <div class="container">
                <div class="row justify-content-around">
                    <form action="chitietsp.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data"
                        class="col-md-6 bg-light p-3">
                        <table>
                            <h2 style="margin-left: 20%;">Thêm / Sửa chi tiết sản phẩm</h2>
                            <tr>
                                <td>Kích thước màn hình :</td>
                                <td>
                                    <input type="text" class="form-control" id="kichthuoc" name="kichthuoc"
                                        value="<?= $kichthuoc ?>">
                                </td>

                            </tr>
                            <!--độ phân giải-->
                            <tr>
                                <td>Độ phân giải:</td>
                                <td>
                                    <input type="text" class="form-control" id="dophangiai" name="dophangiai"
                                        value="<?= $dophangiai ?>">
                                </td>
                            </tr>
                            <!--cong nghệ màn hình-->
                            <tr>
                                <td>Công nghệ màn hình:</td>
                                <td>
                                    <input type="text" class="form-control" id="congnghemh" name="congnghemh"
                                        value="<?= $congnghemh ?>">
                                </td>
                            </tr>
                            <!--Tính năng màn hình-->
                            <tr>
                                <td>Tính năng màn hình:</td>
                                <td>
                                    <input type="text" class="form-control" id="tinhnangmh" name="tinhnangmh"
                                        value="<?= $tinhnangmh ?>">
                                </td>
                            </tr>
                            <!--Tần số quét-->
                            <tr>
                                <td>Tần số quét:</td>
                                <td>
                                    <input type="text" class="form-control" id="soquet" name="soquet"
                                        value="<?= $soquet ?>">
                                </td>
                            </tr>
                            <!--Hệ điều hành-->
                            <tr>
                                <td>Hệ điều hành:</td>
                                <td>
                                    <input type="text" class="form-control" id="hedieuhanh" name="hedieuhanh"
                                        value="<?= $hedieuhanh ?>">
                                </td>
                            </tr>
                            <!--Wi-Fi-->
                            <tr>
                                <td>Wi-Fi:</td>
                                <td>
                                    <input type="text" class="form-control" id="wifi" name="wifi" value="<?= $wifi ?>">
                                </td>
                            </tr>
                            <!--Bluetooth-->
                            <tr>
                                <td>Bluetooth:</td>
                                <td>
                                    <input type="text" class="form-control" id="bluetooth" name="bluetooth"
                                        value="<?= $bluetooth ?>">
                                </td>
                            </tr>
                            <!--Jack 3.5mm-->
                            <tr>
                                <td>Jack 3.5mm:</td>
                                <td>
                                    <input type="radio" name="jack" id="co" checked value="1" /><label
                                        for="Có">Có</label>
                                    <input type="radio" name="jack" id="khong" value="0" /><label
                                        for="Không">Không</label>
                                </td>
                            </tr>
                            <!--Chất liệu mặt lưng-->
                            <tr>
                                <td>Chất liệu mặt lưng:</td>
                                <td>
                                    <input type="text" class="form-control" id="matlung" name="matlung"
                                        value="<?= $matlung ?>">
                                </td>
                            </tr>
                            <!--Chất liệu khung-->
                            <tr>
                                <td>Chất liệu khung:</td>
                                <td>
                                    <input type="text" class="form-control" id="khung" name="khung"
                                        value="<?= $khung ?>">
                                </td>
                            </tr>
                            <!--Công nghệ NFC-->
                            <tr>
                                <td>Công nghệ NFC:</td>
                                <td>
                                    <input type="radio" name="nfc" id="co" checked value="1" /><label
                                        for="Có">Có</label>
                                    <input type="radio" name="nfc" id="khong" value="0" /><label
                                        for="Không">Không</label>
                                </td>
                            </tr>
                            <!--Công nghệ Mạng-->
                            <tr>
                                <td>Công nghệ Mạng:</td>
                                <td>
                                    <input type="text" class="form-control" id="mang" name="mang" value="<?= $mang ?>">
                                </td>
                            </tr>
                            <!--Công nghệ Sạc-->
                            <tr>
                                <td>Công nghệ Sạc:</td>
                                <td>
                                    <input type="text" class="form-control" id="sac" name="sac" value="<?= $sac ?>">
                                </td>
                            </tr>
                            <!--GPS-->
                            <tr>
                                <td>GPS:</td>
                                <td>
                                    <input type="text" class="form-control" id="gps" name="gps" value="<?= $gps ?>">
                                </td>
                            </tr>
                            <!--Camera sau-->
                            <tr>
                                <td>Camera sau:</td>
                                <td>
                                    <input type="text" class="form-control" id="camsau" name="camsau"
                                        value="<?= $camsau ?>">
                                </td>
                            </tr>
                            <!--Tính năng Camera sau-->
                            <tr>
                                <td>Tính năng camera sau:</td>
                                <td>
                                    <input type="text" class="form-control" id="tinhnangcamsau" name="tinhnangcamsau"
                                        value="<?= $tinhnangcamsau ?>">
                                </td>
                            </tr>
                            <!--Pin-->
                            <tr>
                                <td>Pin:</td>
                                <td>
                                    <input type="text" class="form-control" id="pin" name="pin" value="<?= $pin ?>">
                                </td>
                            </tr>
                            <!--Cổng sạc-->
                            <tr>
                                <td>Cổng sạc:</td>
                                <td>
                                    <input type="text" class="form-control" id="congsac" name="congsac"
                                        value="<?= $congsac ?>">
                                </td>
                            </tr>
                            <!--Kích thước sản phẩm-->
                            <tr>
                                <td>Kích thước sản phẩm:</td>
                                <td>
                                    <input type="text" class="form-control" id="kichthuocsp" name="kichthuocsp"
                                        value="<?= $kichthuocsp ?>">
                                </td>
                            </tr>
                            <!--Trọng lượng sản phẩm-->
                            <tr>
                                <td>Trọng lượng sản phẩm:</td>
                                <td>
                                    <input type="text" class="form-control" id="trongluong" name="trongluong"
                                        value="<?= $trongluong ?>">
                                </td>
                            </tr>
                            <!--Quay video-->
                            <tr>
                                <td>Quay video:</td>
                                <td>
                                    <input type="text" class="form-control" id="quay" name="quay" value="<?= $quay ?>">
                                </td>
                            </tr>
                            <!--Camera trước-->
                            <tr>
                                <td>Camera trước:</td>
                                <td>
                                    <input type="text" class="form-control" id="camtruoc" name="camtruoc"
                                        value="<?= $camtruoc ?>">
                                </td>
                            </tr>
                            <!--Ram-->
                            <tr>
                                <td>Ram:</td>
                                <td>
                                    <input type="text" class="form-control" id="ram" name="ram" value="<?= $ram ?>">
                                </td>
                            </tr>
                            <!--Bộ nhớ trong-->
                            <tr>
                                <td>Bộ nhớ trong:</td>
                                <td>
                                    <input type="text" class="form-control" id="gb" name="gb" value="<?= $gb ?>">
                                </td>
                            </tr>
                            <!--Kiểu màn hình-->
                            <tr>
                                <td>Kiểu màn hình:</td>
                                <td>
                                    <input type="text" class="form-control" id="kieumh" name="kieumh"
                                        value="<?= $kieumh ?>">
                                </td>
                            </tr>
                            <!--Tính năng đặc biệt-->
                            <tr>
                                <td>Tính năng đặc biệt:</td>
                                <td>
                                    <input type="text" class="form-control" id="tinhnangdacbiet" name="tinhnangdacbiet"
                                        value="<?= $tinhnangdacbiet ?>">
                                </td>
                            </tr>
                            <!--Vi sử lý-->
                            <tr>
                                <td>Vi sử lý:</td>
                                <td>
                                    <input type="text" class="form-control" id="cpu" name="cpu" value="<?= $cpu ?>">
                                </td>
                            </tr>
                            <tr style="margin-top: 2%;">
                                <td><input type="submit" value="Lưu" name="ok" class="btn-primary btn"
                                        style="width: 90%;" /></td>
                                <td><a href="add.php?id=<?php echo $id_CTSP ?>"><input value="Quay lại" name="ok"
                                            class="btn-primary btn" style="width: 90%;" /></a></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>