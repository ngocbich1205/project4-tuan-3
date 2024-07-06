<?php 
    require_once('../../db/dbhelper.php');
    ob_start();
    session_start();
    $sql2          = 'SELECT * FROM `acc` WHERE userName = "' . $_SESSION['login'] . '"';
    $acc = executeSingleResult($sql2);
    $sql_huydon = 'DELETE FROM `oder`WHERE Phone ='.$acc['Phone'].'';
    echo $acc['Phone'],$_SESSION['login'];
    execute($sql_huydon);
    header('location:../index.php ' )
?>
