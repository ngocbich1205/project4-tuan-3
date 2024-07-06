<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>WEB BÁN SMART PHONE</title>
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="Tk.css">
</head>
<?php
ob_start();
session_start();
require_once('../../db/dbhelper.php');
$userName = '';
$password = '';
if(isset($_SESSION['login'])){
    unset($_SESSION['login']);
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
        header('location:../../Homepage/index.php');
    } else{
        echo '<script> alert ("Tài khoản Hoặc Mật Khẩu Sai") </script>';
    }
    // đăng nhập vào admin
    if (executeResult($sql_admin)) {
        $_SESSION["admin"] = $_POST['userName'];
        header('location: ../../admin/index.php');
    } else{
        echo '<script> alert (" Tài khoản Hoặc Mật Khẩu Sai") </script>';
    }
    
}
//kiểm tra có tích vào hiện password hay ko
$check = false;
if (isset($_COOKIE['userName']) && isset($_COOKIE['password'])) {
    $userName = $_COOKIE['userName'];
    $password = $_COOKIE['password'];
    $check = true;
}
?>
<div style="width:100%;height:150%; background-image: url('../../img/background.jpg');">
    <div id="container" class="container">
        <div class="row justify-content-around">
            <form action="login.php" method="post" class="col-md-6 bg-light p-3">
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
                <label for="hien">Hiện Mật Khẩu</label>
                <!--nhớ Mật khẩu -->
                <tr>
                    <td>
                        <input style="margin-bottom: 2%;" type="checkbox" id="checkbox" name="checkbox" <?php echo ($check) ? "checked" : '' ?>>
                        <label for="checkbox">Nhớ Mật Khẩu</label><br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <br><a href="forgotaccount.php">Quên mật Khẩu</a>
                    </td>
                    <td>
                        <a href="Register.php" style="float:right;margin-right:5%">
                            Đăng Ký
                        </a>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><br><br><input type="submit" value="Đăng Nhập" name="dangnhap" class="btn-primary btn" style="width: 100%; margin-top: 4%;" /></td>
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">