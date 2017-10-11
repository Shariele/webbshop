<?php

include "../include/classes/user.php";

session_start();
session_name("webshop");

include "../include/connect_db.php";

$var1 = $_REQUEST['q'];

if($var1 == "account"){
	$acc_id = $_SESSION['user']->Get_id();
	$email = $_SESSION['user']->Get_email();
	$full_name= $_SESSION['user']->Get_full_name();
	$residental = $_SESSION['user']->Get_residental();
	$zip = $_SESSION['user']->Get_zip_code();
	$country = $_SESSION['user']->Get_country();
	$mobile = $_SESSION['user']->Get_mobile();
	$city = $_SESSION['user']->Get_city();
	$region = $_SESSION['user']->Get_region();

	$arrlength = count($_SESSION['cart']);
	$prod_id = "";
	$name = "";
	$quantity = "";
	$tot_price = "";
	$price = "";
	for($i = 0; $i < $arrlength; $i++){
		$prod_id = ($prod_id ."". $_SESSION['cart'][$i][0] ."\n");
		$name = ($name ."". $_SESSION['cart'][$i][1] ."\n");
		$quantity = ($quantity ."". $_SESSION['cart'][$i][2] ."\n");
		$price = ($price ."". $_SESSION['cart'][$i][3] ."\n");
		$tot_price = ($tot_price + ($_SESSION['cart'][$i][3] * $_SESSION['cart'][$i][2]));
	}

	$sql = "INSERT INTO shipping(article_id, article_name, quantity, price, tot_price, acc_id, email, full_name, residental_adress, zip_code, country, 
		mobile_number, city, region) 
		VALUES('$prod_id', '$name', '$quantity', '$price', '$tot_price', '".$_SESSION['user']->Get_id()."', '".$_SESSION['user']->Get_email()."', '".$_SESSION['user']->Get_full_name()."', 
		'".$_SESSION['user']->Get_residental()."', '".$_SESSION['user']->Get_zip_code()."', '".$_SESSION['user']->Get_country()."',
		'".$_SESSION['user']->Get_mobile()."', '".$_SESSION['user']->Get_city()."', '".$_SESSION['user']->Get_region()."')"; 
	$sth = $pdo->prepare($sql);
	$sth->execute();

}else{

}