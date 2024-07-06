<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>WEB BÁN SMART PHONE</title>
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">
</head>

<?php
session_start();
require_once('../../db/dbhelper.php');
$data = [];
$errors = [];
$kiemtra = 0;
$userName = $password = $data['confirmPass'] = $password =
    $TenKh = $Diachi = $email = $Phone = '';
// $userName = (isset($_POST['userName'])) ? $_POST['userName'] : '';
// $password = (isset($_POST['password'])) ? $_POST['password'] : '';
// $password = (isset($_POST['gender'])) ? $_POST['gender'] : '';
// $email = (isset($_POST['email'])) ? $_POST['email'] : '';
// $TenKh = (isset($_POST['TenKh'])) ? $_POST['TenKh'] : '';
// $password = (isset($_POST['NamS'])) ? $_POST['NamS'] : '';
// $Diachi = (isset($_POST['Diachi'])) ? $_POST['Diachi'] : '';
// $Phone = (isset($_POST['Phone'])) ? $_POST['Phone'] : '';
if (isset($_GET['id'])) {
    $sql = "select * from acc where Username='" . $_SESSION['login'] . "'";
    $acc = executeSingleResult($sql);
    $id = $acc['id'];
}
if (isset($_POST['KT'])) {
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $TenKh = $_POST['TenKh'];
    $NamS = $_POST['NamS'];
    $Diachi = $_POST['Diachi'];
    $Phone = $_POST['Phone'];
    //Tên khach
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
}

?>
<div class="container">
    <div class="row justify-content-around">
        <form action="changeinformation.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data" class="col-md-6 bg-light p-3">
            <table>
                <h2 style="margin-left: 20%;">Đổi Thông Tin Người Dùng </h2>
                <!--ten khach-->
                <tr>
                    <td>
                        <label for="TenKh" class="form-label">Tên Khách hàng:</label>
                        <input style="width:190%; " type="text" class="form-control" id="TenKh" name="TenKh" value="<?= $acc['TenKh'] ?>" required>
                    </td>
                    <td style="color:red ;padding-top: 25px;"><?= (empty($errors['TenKh'])) ? '' : $errors['TenKh'] ?></td>
                </tr>
                <!--năm sinh-->
                <tr>
                    <td>
                        <label for="NamS" class="form-label">Năm Sinh:</label>
                        <input style="width:190%; " type="date" class="form-control" id="NamS" name="NamS" value="<?= $acc['namS'] ?>" required>
                    </td>
                    <td style="color:red ;padding-top: 25px;"><?= (empty($errors['NamS'])) ? '' : $errors['NamS'] ?></td>
                </tr>
                <!--giới tính-->
                <tr>
                    <td>
                        <label class="form-check-label" style="margin:4% 0 4%;">Giới Tính:
                            <input type="radio" name="gender" id="Nam" checked value="Nam" /><label for="Nam">Nam</label>
                            <input type="radio" name="gender" id="Nữ" value="Nữ" /><label for="Nữ">Nữ</label>
                            <input type="radio" name="gender" id="Khác" value="Khác" /><label for="Khác">Khác</label>
                        </label>
                    </td>
                </tr>
                <!--địa chỉ-->
                <tr>
                    <td>
                        <label for="Diachi" class="form-label">Địa Chỉ:</label>
                        <input style="width:190%; " type="text" class="form-control" id="Diachi" name="Diachi" value="<?= $acc['Diachi'] ?>" required>
                    </td>
                    <td style="color:red ;padding-top: 25px;"><?= (empty($errors['Diachi'])) ? '' : $errors['Diachi'] ?></td>
                </tr>
                <!--số điện thoại-->
                <tr>
                    <td>
                        <label for="Phone" class="form-label">SĐT:</label>
                        <input style="width:190%; " type="text" class="form-control" id="Phone" name="Phone" value="<?= $acc['Phone'] ?>" required>
                    </td>
                    <td style="color:red ;padding-top: 25px;"><?= (empty($errors['Phone'])) ? '' : $errors['Phone'] ?></td>
                </tr>
                <!--email-->
                <tr>
                    <td>
                        <label for="email" class="form-label">Email:</label>
                        <input style="width:190%;margin-bottom: 4%; " type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?= $acc['email'] ?>" required>
                    </td>
                    <td style="color:red ;padding-top: 25px;"><?= (empty($errors['email'])) ? '' : $errors['email'] ?></td>
                </tr>
                <tr style="margin-top: 2%;">
                    <td><input type="submit" value="Lưu Thay Đổi" name="KT" class="btn-primary btn" style="width: 90%;" /></td>
                    <td><a href="../index.php"><input value="Quay Lại" class="btn-primary btn" style="width: 90%;" /></a></td>
                </tr>
            </table>
        </form>
    </div>
</div>
</script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">