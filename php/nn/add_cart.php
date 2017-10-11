<?php
session_start();
session_name("webshop");

include "../include/connect_db.php";
$prod_id = 0;
$choice = 0;
$prod_id = $_REQUEST['q'];
$choice = $_REQUEST['r'];

/*Creates an array for storing products. array[$i][$n]. index $i in the array 
means product as a whole and only stores one unique product in it's index. $n in the
array means the unique product's properties such as id, name, amount and price.
[$i][0] = id
[$i][1] = name
[$i][2] = amount
[$i][3] = price
*/


if(!isset($_SESSION['cart'])){
	$_SESSION['cart'] = array();
}

$amount = 1;

$sql = "SELECT * FROM article WHERE id='".$prod_id."'";
$sth = $pdo->prepare($sql);
$sth->execute();

$result = $sth->fetchAll();
foreach($result as $i){
	$curPrice = 0;
	$curPrice = $i['price'];
	if($i['saleAll'] != 0){
		$curPrice = ($i['price'] * (1 - ($i['saleAll'] / 100)));
	}
	$content = array($i['id'], $i['name'], $amount, $curPrice);
	$aval = $i['availabillity'];

	$arrlength = count($_SESSION['cart']);
	$none = true;
	if($choice == "1"){
		$aval = ($aval - 1);
		if($aval < 0){
			$_SESSION['no_stock'] = "There's currently no ".$i['name']." in stock, please return another time.";
			break;
		}else{
			for($n = 0; $n < $arrlength; $n++){
				$id = 0;
				$id = $_SESSION['cart'][$n][0];
				if($id == $i['id']){
					$amount = ($_SESSION['cart'][$n][2]);
					$_SESSION['cart'][$n][2] = $amount + 1;
					$none = false;
				}
			}
			$sql = "UPDATE article SET availabillity=".$aval." WHERE id=".$i['id']."";
			$sth = $pdo->prepare($sql);
			$sth->execute();
		}
	}elseif($choice == "0"){
		for($n = 0; $n < $arrlength; $n++){
			$id = 0;
			$id = $_SESSION['cart'][$n][0];
			if($id == $i['id']){
				$amount = ($_SESSION['cart'][$n][2]);
				$_SESSION['cart'][$n][2] = $amount - 1;
				$none = false;

				$sql = "SELECT availabillity FROM article WHERE id='".$id."'";
				$sth = $pdo->prepare($sql);
				$sth->execute();

				$aval = 0;
				$result = $sth->fetchAll();
				foreach($result AS $row){
					$aval = $row['availabillity'];
					$aval = ($aval + 1);
				}

				$sql2 = "UPDATE article SET availabillity=".$aval." WHERE id=".$i['id']."";
				$sth2 = $pdo->prepare($sql2);
				$sth2->execute();

				if($_SESSION['cart'][$n][2] <= 0){
					unset($_SESSION['cart'][$n]);
				}
				if(empty($_SESSION['cart'])){
					unset($_SESSION['cart']);
				}
			}
		}
	}elseif($choice == "2"){
		for($n = 0; $n < $arrlength; $n++){
			$id = 0;
			$amount = 0;
			$none = false;	
			$id = $_SESSION['cart'][$n][0];
			$amount = ($_SESSION['cart'][$n][2]);


			$sql = "SELECT availabillity FROM article WHERE id='".$id."'";
			$sth = $pdo->prepare($sql);
			$sth->execute();

			$aval = 0;
			$result = $sth->fetchAll();
			foreach($result as $row){
				$aval = $row['availabillity'];
				$aval = ($aval + $amount);
			}

			$sql2 = "UPDATE article SET availabillity=".$aval." WHERE id=".$id."";
			$sth2 = $pdo->prepare($sql2);
			$sth2->execute();
		}
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
