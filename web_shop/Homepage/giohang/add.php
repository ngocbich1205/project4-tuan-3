<?php
session_start();
require_once('../../db/dbhelper.php');
$cart = $_SESSION['login'];
$id = isset($_GET['id']) ? $_GET['id'] : '';
$id_cart = $id . "_" . $_SESSION['login'];
$sql      = 'select * from product where id = ' . $id;
$product = executeSingleResult($sql);
if ($_SESSION['login'] == 'khach hang') {
    echo '<script> alert("vui lòng đăng nhập để sử dụng tính năng này")</script>';
    echo '<script> window.location.href="../index.php" </script>';
} elseif ($product) {
    if (isset($_SESSION[$cart])) {
        if (isset($_SESSION[$cart][$id])) {
            $_SESSION[$cart][$id]['qty'] += 1;
            $_SESSION[$cart][$id]['ten'] = $product['title'];
            $_SESSION[$cart][$id]['anh'] = $product['thumbnail'];
            $_SESSION[$cart][$id]['gia'] = $product['price'];
            $_SESSION[$cart][$id]['Sl'] = $_SESSION[$cart][$id]['qty'];
            $_SESSION[$cart][$id]['id'] = $product['id'];
            $sql_cart_up = 'UPDATE `cart` SET `amount`="' . $_SESSION[$cart][$id]['Sl'] . '" WHERE id_cart="' . $id_cart . '"';
            execute($sql_cart_up);
        } else {
            $_SESSION[$cart][$id]['qty'] = 1;
            $_SESSION[$cart][$id]['ten'] = $product['title'];
            $_SESSION[$cart][$id]['anh'] = $product['thumbnail'];
            $_SESSION[$cart][$id]['gia'] = $product['price'];
            $_SESSION[$cart][$id]['Sl'] = $_SESSION[$cart][$id]['qty'];
            $_SESSION[$cart][$id]['id'] = $product['id'];
            // $sqli= 'SELECT * FROM cart WHERE '
            if (isset($_SESSION[$cart])) {
                $sql_cart = 'INSERT INTO `cart`( `id_product`,`id_cart`,`userName_acc`, `title`, `thumbnail`, `price`, `amount`) VALUES ("' . $id . '","' . $id_cart . '","' . $_SESSION['login'] . '", "' . $product['title'] . '","' . $product['thumbnail'] . '","' . $product['price'] . '","' . $_SESSION[$cart][$id]['qty'] . '")';
                execute($sql_cart);
            }
        }
    } else {
        $_SESSION[$cart][$id]['qty'] = 1;
        $_SESSION[$cart][$id]['ten'] = $product['title'];
        $_SESSION[$cart][$id]['anh'] = $product['thumbnail'];
        $_SESSION[$cart][$id]['gia'] = $product['price'];
        $_SESSION[$cart][$id]['Sl'] = $_SESSION[$cart][$id]['qty'];
        $_SESSION[$cart][$id]['id'] = $product['id'];
        $sql_cart = 'INSERT INTO `cart`( `id_product`,`id_cart`,`userName_acc`, `title`, `thumbnail`, `price`, `amount`) VALUES ("' . $id . '","' . $id_cart . '","' . $_SESSION['login'] . '", "' . $product['title'] . '","' . $product['thumbnail'] . '","' . $product['price'] . '","' . $_SESSION[$cart][$id]['qty'] . '")';
        execute($sql_cart);
    }
    header('Location:../index.php');
}
