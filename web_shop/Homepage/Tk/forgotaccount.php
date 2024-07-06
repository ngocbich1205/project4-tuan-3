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
$title = 'Email:';
$pass = '';
$kiemtra = 1;
if (isset($_POST['sumbit'])) {
    $email = $_POST['email'];
    $sql = "select * from acc where email='$email' ";
    if (executeResult($sql)) {
        $matkhau = "select * from acc";
        $accList = executeResult($matkhau);
        foreach ($accList as $item) {
            $title = 'Mật khẩu của bạn là :';
            $pass = $item['password'];
            $username = $item['userName'];
            $valuesubmit = 'Tiếp Tục Đăng Nhập';
            $kiemtra = 0;
        }
    }else{
        echo'<script> alert ("Email sai vui lòng thử lại ") </script>';
    }
}
if (isset($_POST['okok'])) {
    header('location:login.php');
}
?>
<div style="width:100%;height:100%; background-image: url('../../img/background.jpg');">
    <div id="container" class="container" >
        <div class="row justify-content-around">
            <form id="form" action="forgotaccount.php" method="post" class="col-md-6 bg-light p-3"  ">
                <h2 style="text-align:center ;">Lấy Lại Mật Khẩu</h2>
                <p style="color:red;font-size:18px"><b><i>vui lòng nhập vào Email để lấy lại mật khẩu</i></b>
                <p>
                    <!--tài khoản-->
                    <?php
                    if (isset($username)) {
                        echo "<tr>
                                <td >  
                                    <label for='username' class='form-label'> Tài Khoản của bạn là: </label>
                                    <input style='margin-bottom: 2%;' type='text' class='form-control'value='$username'>                        
                                </td>
                            </tr>";
                    }

                    ?>
                    <!-- email -->
                    <tr>
                        <td>
                            <label for="email" class="form-label"><?php echo $title ?></label>
                            <input style="margin-bottom: 2%;" type="text" class="form-control" id="email" name="email" value="<?php echo $pass ?>" required>
                        </td>
                    </tr>
                    <?php
                    if ($kiemtra == 1) {
                        echo '
                        <tr>
                            <td >
                                <br><a href="#">Quên mật Khẩu</a>
                            </td>
                            <td>
                                <a href="Register.php" style="float:right;margin-right:5%" >
                                    Đăng Ký
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" value="Lấy Lại Mật Khẩu" name="sumbit" class="btn-primary btn" style="width: 100%; margin-top: 4%;" /></td>
                        </tr>';
                    } else {
                        echo ' 
                        <tr>
                            <td colspan="2"><input type="submit" value="Tiếp Tục Đăng Nhập" name="okok" class="btn-primary btn" style="width: 100%; margin-top: 4%;" /></td>
                        </tr>';
                    }
                    ?>

            </form>
        </div>
    </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">