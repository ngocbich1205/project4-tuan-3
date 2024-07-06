<?php
require_once('../../../db/dbhelper.php');
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = 'delete from thumuc where id = ' . $id;
	execute($sql);
	header('location:index.php');
}
?>
