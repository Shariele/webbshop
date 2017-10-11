<?php
include "../include/connect_db.php";

	$id = $_POST['q'];
	$a = $_POST['w'];

	$sql = "SELECT * FROM shipping WHERE order_id=$id";
	$sth = $pdo->prepare($sql);
	$sth->execute();

	$result = $sth->fetchAll();
	foreach($result as $row){
		$status = $row['shipped'];
		if($a == "upd"){
			if($status == "false"){
				$status == "true";

				$sql = "UPDATE shipping SET shipped = 'true' WHERE order_id=$id";
				$sth = $pdo->prepare($sql);
				$sth->execute();
			}else{
				$status == "false";

				$sql = "UPDATE shipping SET shipped = 'false' WHERE order_id=$id";
				$sth = $pdo->prepare($sql);
				$sth->execute();
			}
		}else{
		}
	}
?>