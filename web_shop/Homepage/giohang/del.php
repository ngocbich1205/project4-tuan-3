<?php
session_start();
require_once('../../db/dbhelper.php');
$cart = $_SESSION['login'];

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id == "donhang") {
        $sql_cart_delALL = 'DELETE FROM `cart`WHERE `userName_acc` = "' . $_SESSION['login'] . '"';
        unset($_SESSION[$cart]);
        execute($sql_cart_delALL);
        header('Location:../donhang/index.php');
    } else {
        
        $id_cart = $id . "_" . $_SESSION['login'];
        $sql      = 'select * from product where id = ' . $id . '';
        $product = executeSingleResult($sql);
        if ($product) {
            if (isset($_SESSION[$cart])) {
                if (isset($_SESSION[$cart][$id])) {
                    unset($_SESSION[$cart][$id]);
                    $sql_cart_del = 'DELETE FROM `cart` WHERE id_cart = "' . $id_cart . '"';
                    execute($sql_cart_del);
                }
                header('Location:../index.php?id=giohang');
            } else {
                header('Location:../index.php?id=giohang');
            }
        }
    }
} else {
    $sql_cart_delALL = 'DELETE FROM `cart`WHERE `userName_acc` = "' . $_SESSION['login'] . '"';
    unset($_SESSION[$cart]);
    execute($sql_cart_delALL);
    header('Location:../index.php');
}
