<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>WEB BÁN SMART PHONE</title>
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">
</head>
<?php
require_once('../../admin/db/dbhelper.php');
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
        if (executeResult($sql)) {
            echo '<script> alert ("tài khoản đã tồn tại") </script>';
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
        header('Location:login.php');
        die();
    }
}
// echo '"' . $data['userName'] . '",  "' . $data['password'] . '",' . $data['gender'] . ',
//         "' . $data['email'] . '", "' . $data['TenKh'] . '", "' . $data['NamS'] . '", "' . $data['Phone'] . '","' . $data['Diachi'] . '","' . $ngaytao . '"';
?>
<div class="container">
    <div class="row justify-content-around">
        <form action="Register.php" method="post" enctype="multipart/form-data" class="col-md-6 bg-light p-3">
            <table>
                <h2 style="margin-left: 20%;">Đăng ký tài khoản </h2>
                <!--tài khoản-->
                <tr>
                    <td>
                        <label for="userName" class="form-label">Tài Khoản :</label>
                        <span style="color:red ;padding-top: 25px;"><?= (empty($errors['userName'])) ? '' : $errors['userName'] ?></span>
                        <input style="width:190%; " type="userName" class="form-control" id="userName" name="userName" value="<?= $data['userName'] ?>" required>
                    </td>
                </tr>
                <!--mật khẩu-->
                <tr>
                    <td>
                        <label for="password" class="form-label">Mật Khẩu:</label>
                        <input style="width:190%; " type="password" class="form-control" id="password" name="password" value="<?= $data['password'] ?>" required>
                        <input id="hien" type="checkbox" onclick="myFunction()">
                        <label for="hien">Hiện Mật Khẩu</label>
                    </td>
                    <td style="color:red ;padding-top: 25px;"><?= (empty($errors['password'])) ? '' : $errors['password'] ?></td>
                </tr>
                <!--xh mật khẩu-->
                <tr>
                    <td>
                        <label for="confirmPass" class="form-label">Nhập lại Mật Khẩu:</label>
                        <input style="width:190%; " type="password" class="form-control" id="confirmPass" name="confirmPass" value="<?= $data['confirmPass'] ?>" required>
                    </td>
                    <td style="color:red ;padding-top: 25px;"><?= (empty($errors['confirmPass'])) ? '' : $errors['confirmPass'] ?></td>
                </tr>
                <!--ten khach-->
                <tr>
                    <td>
                        <label for="TenKh" class="form-label">Tên Khách hàng:</label>
                        <input style="width:190%; " type="text" class="form-control" id="TenKh" name="TenKh" value="<?= $data['TenKh'] ?>" required>
                    </td>
                    <td style="color:red ;padding-top: 25px;"><?= (empty($errors['TenKh'])) ? '' : $errors['TenKh'] ?></td>
                </tr>
                <!--năm sinh-->
                <tr>
                    <td>
                        <label for="NamS" class="form-label">Năm Sinh:</label>
                        <input style="width:190%; " type="date" class="form-control" id="NamS" name="NamS" value="<?= $data['NamS'] ?>" required>
                    </td>
                    <td style="color:red ;padding-top: 25px;"><?= (empty($errors['NamS'])) ? '' : $errors['NamS'] ?></td>
                </tr>
                <!--giới tính-->
                <tr>
                    <td>
                        <label class="form-check-label" style="margin:4% 0 4%;">Giới Tính:
                            <input type="radio" name="gender" id="Nam" checked value="1" /><label for="Nam">Nam</label>
                            <input type="radio" name="gender" id="Nữ" value="0" /><label for="Nữ">Nữ</label>
                        </label>
                    </td>
                </tr>
                <!--địa chỉ-->
                <tr>
                    <td>
                        <label for="Diachi" class="form-label">Địa Chỉ:</label>
                        <input style="width:190%; " type="text" class="form-control" id="Diachi" name="Diachi" value="<?= $data['Diachi'] ?>" required>
                    </td>
                    <td style="color:red ;padding-top: 25px;"><?= (empty($errors['Diachi'])) ? '' : $errors['Diachi'] ?></td>
                </tr>
                <!--số điện thoại-->
                <tr>
                    <td>
                        <label for="Phone" class="form-label">SĐT:</label>
                        <input style="width:190%; " type="text" class="form-control" id="Phone" name="Phone" value="<?= $data['Phone'] ?>" required>
                    </td>
                    <td style="color:red ;padding-top: 25px;"><?= (empty($errors['Phone'])) ? '' : $errors['Phone'] ?></td>
                </tr>
                <!--email-->
                <tr>
                    <td>
                        <label for="email" class="form-label">Email:</label>
                        <input style="width:190%;margin-bottom: 4%; " type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?= $data['email'] ?>" required>
                    </td>
                    <td style="color:red ;padding-top: 25px;"><?= (empty($errors['email'])) ? '' : $errors['email'] ?></td>
                </tr>
                <tr style="margin-top: 2%;">
                    <td><input type="submit" value="Đăng ký" name="kt" class="btn-primary btn" style="width: 90%;" /></td>
                    <td><a href="login.php"><input value="Đăng Nhập" class="btn-primary btn" style="width: 90%;" /></a></td>
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

    function myFunction_1() {
        var x = document.getElementById("confirmPass");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">