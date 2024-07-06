<?php
session_start();
require_once('../../db/dbhelper.php');
    if (isset($_SESSION['qty'])) {
            $_SESSION['qty'] = $_POST['SL'];
        }
        header('Location:index.php');
    

