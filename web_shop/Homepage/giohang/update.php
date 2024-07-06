<?php
session_start();
require_once('../../db/dbhelper.php');
$cart = $_SESSION['login'];
$id = isset($_GET['id']) ? $_GET['id'] : '';
$id_cart = $id . "_" . $_SESSION['login'];
$sql      = 'select * from product where id = ' . $id;
$product = executeSingleResult($sql);
if ($product) {
    if (isset($_SESSION[$cart])) {
        if (isset($_SESSION[$cart][$id])) {
            $_SESSION[$cart][$id]['Sl']= $_POST['SL_sp_' . $id . ''];
            $_SESSION[$cart][$id]['qty']=$_SESSION[$cart][$id]['Sl'];
            $sql_cart_up = 'UPDATE `cart` SET `amount`="' . $_SESSION[$cart][$id]['Sl'] . '" WHERE id_cart="' . $id_cart . '"';
            execute($sql_cart_up);
        }
        header('Location:../index.php?id=giohang');
    }
}
