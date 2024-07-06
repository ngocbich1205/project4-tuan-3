<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>WEB BÁN SMART PHONE</title>
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">
</head>
<?php
ob_start();
session_start();
require_once('../../db/dbhelper.php');
$errors = [];
$userName = '';
if (isset($_POST['doimk'])) {
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
        echo '<script> window.location.href="../index.php?id=" </script>';
    }
}
?>

<div style="width:100%;height:100%; background-image: url('../../img/background.jpg');">
    <div class="container" style="padding-top:13%; ">
        <div class="row justify-content-around">
            <form action="changePassword.php" method="post" class="col-md-6 bg-light p-3" style="width:40%; ">
                <h2 style="text-align:center ;">Đổi Mật Khẩu </h2>
                <!--Tài khoản -->
                <tr>
                    <td>
                        <label for="userName" class="form-label">Tài Khoản :</label><br>
                        <b style="color:red ;"><?= (empty($errors['userName'])) ? '' : $errors['userName'] ?></b>
                        <input type="userName" class="form-control" id="userName" name="userName" value="<?php echo $userName ?>" required>
                    </td>
                </tr>
                <!-- Mật khẩu -->
                <tr>
                    <td>
                        <label for="password" class="form-label">Mật Khẩu:</label><br>
                        <b style="color:red ;"><?= (empty($errors['password'])) ? '' : $errors['password'] ?></b>
                        <input style="margin-bottom: 2%;" type="password" class="form-control" id="password" name="password" required>
                    </td>
                </tr>
                <!--xác nhận Mật khẩu -->
                <tr>
                    <td>
                        <label for="confirmPass" class="form-label">Xác Nhận Mật Khẩu:</label><br>
                        <b style="color:red ;"><?= (empty($errors['confirmPass'])) ? '' : $errors['confirmPass'] ?></b>
                        <input style="margin-bottom: 2%;" type="password" class="form-control" id="confirmPass" name="confirmPass" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <br><a href="forgotaccount.php">Quên mật Khẩu</a>
                    </td>
                    <td>
                        <a href="Register.php" style="float:right;margin-right:5%">Đăng Ký</a>
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" value="Đổi Mật Khẩu" name="doimk" class="btn-primary btn" style="width: 100%; margin-top: 4%;" />
                    <a href="../index.php"><input value="Quay Lại" class="btn-primary btn" style="width: 100%;margin-top: 4%;" /></a></td>
                </tr>
            </form>
        </div>
    </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">