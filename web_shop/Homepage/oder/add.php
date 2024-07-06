<?php
session_start();
require_once('../../db/dbhelper.php');
$cart = $_SESSION['login'];
$id = isset($_GET['id']) ? $_GET['id'] : '';
// $id_cart = $id . "_" . $_SESSION['login'];
$sql      = 'select * from product where id = ' . $id;
$product = executeSingleResult($sql);
if ($_SESSION['login'] == 'khach hang') {
    echo '<script> alert("vui lòng đăng nhập để sử dụng tính năng này")</script>';
    echo '<script> window.location.href="../index.php" </script>';
} elseif ($product) {
    if(isset($_SESSION['ten'])){
        unset($_SESSION['qty']);
        unset($_SESSION['ten']);
        unset($_SESSION['qnh']);
        unset($_SESSION['gia']);
        unset($_SESSION['id']);
        $_SESSION['qty'] = 1;
        $_SESSION['ten'] = $product['title'];
        $_SESSION['anh'] = $product['thumbnail'];
        $_SESSION['gia'] = $product['price'];
        $_SESSION['id'] = $product['id'];
    }else{
        $_SESSION['qty'] = 1;
        $_SESSION['ten'] = $product['title'];
        $_SESSION['anh'] = $product['thumbnail'];
        $_SESSION['gia'] = $product['price'];
        $_SESSION['id'] = $product['id'];
    }
        header('location:index.php');
    }
