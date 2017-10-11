<?php
session_start();
session_name("webshop");

include "../include/connect_db.php";
$prod_id = 0;
$choice = 0;
$prod_id = $_REQUEST['q'];
$choice = $_REQUEST['r'];


if(!isset($_SESSION['cart'])){
	$_SESSION['cart'] = array();
}

$amount = 1;

$sql = "SELECT * FROM article WHERE id='".$prod_id."'";
$sth = $pdo->prepare($sql);
$sth->execute();

$result = $sth->fetchAll();
foreach($result as $i){
	$content = array($i['id'], $i['name'], $amount, $i['price']);

	$arrlength = count($_SESSION['cart']);
	$none = true;
	if($choice == "1"){
		for($n = 0; $n < $arrlength; $n++){
			$id = 0;
			$id = $_SESSION['cart'][$n][0];
			if($id == $i['id']){
				$amount = ($_SESSION['cart'][$n][2]);
				$_SESSION['cart'][$n][2] = $amount + 1;
				$none = false;

			}
		}
	}elseif($choice == "0"){
		for($n = 0; $n < $arrlength; $n++){
			$id = 0;
			$id = $_SESSION['cart'][$n][0];
			if($id == $i['id']){
				$amount = ($_SESSION['cart'][$n][2]);
				$_SESSION['cart'][$n][2] = $amount - 1;
				$none = false;

				if($_SESSION['cart'][$n][2] <= 0){
					unset($_SESSION['cart'][$n]);
				}
				if(empty($_SESSION['cart'])){
					unset($_SESSION['cart']);
				}
			}
		}
	}else{
		unset($_SESSION['cart']);
	}
	if(isset($_SESSION['cart'])){
		if($none == true){
			array_push($_SESSION['cart'], $content);
		}
	}
}
include "../components/shopping_cart.php";
?>
