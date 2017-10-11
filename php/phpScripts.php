<!--Page for coordinating all the different Ajax file requests-->

<?php
include "../include/connect_db.php";
include "../include/functions.php";

$action = $_REQUEST['action'];

switch($action){
	case 'changeStatus':
		changeStatus();
	break;

	case 'myAccChoice':
		myAccChoice();
	break;

	case 'showCart':
		showCart();
	break;

	case 'products':
		products();
	break;

	case 'prodSearch':
		prodSearch();
	break;

	case 'adminProdSearch':
		prodSearch();
	break;

	case 'adminSearch':
		adminSearch();
	break;

	case 'orderDetail':
		orderDetail();
	break;

	case 'orderList':
		orderList(0);
	break;

	case 'orderDetail':
		orderDetail();
	break;

	case 'addOrder':
		addOrder();
	break;

	case 'printOrder':
		printOrder();
	break;

	case 'addCart':
		addCart();
	break;

	case 'setSale':
		setSale();
	break;

	case 'curSale':
		curSale();
	break;

	case 'sale':
		sale();
		break;
}