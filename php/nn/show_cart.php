<?php
session_start();
session_name("webshop");

include "../include/connect_db.php";
$prod_id = 0;
$choice = 0;
$prod_id = $_REQUEST['q'];
$choice = $_REQUEST['r'];

if($choice != "nothing"){
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
}
?>
<fieldset>
	<?php
	if(isset($_SESSION['cart'])){
		$product_id = 0;
		$arrlength = count($_SESSION['cart']);
		for($i = 0; $i < $arrlength; $i++){
			$product_id = 0;
			$product_id = $_SESSION['cart'][$i][0];
			$choice1 = 1;
			$choice2 = 0;
			$choice3 = 2;
			?>
			<p><div class="row">
				<div class="col-md-5">
						<?php echo $_SESSION['cart'][$i][1]; ?>
				</div>
				<div class="col-md-4">
					<?php echo 'Items: '. $_SESSION["cart"][$i][2] .' <a onclick="show_cart('.$product_id.', '.$choice1.')" href="#"> 
		            <span class="glyphicon glyphicon-plus"> </span></a> / 
		            <a onclick="show_cart('.$product_id.', '.$choice2.')" href="#"> 
		            <span class="glyphicon glyphicon-minus"></span> </a>';
					?>
				</div>
				<div class="col-md-3">
						<?php echo "Price: ". ($_SESSION['cart'][$i][3] * $_SESSION['cart'][$i][2])."kr"; ?>
				</div>
			</div></p>
			<?php
		}
		$arrlength = count($_SESSION['cart']);
		$quantity = 0;
		$price = 0;
		$choice3 = 2;
		for($i = 0; $i < $arrlength; $i++){
			$quantity = ($quantity + $_SESSION['cart'][$i][2]);
			$price = ($price + ($_SESSION['cart'][$i][3] * $_SESSION['cart'][$i][2]));
		}
		?>
		<p><div class="row">
			<div class="col-md-4 col-md-offset-4">
				<?php echo "<p class=\"text-right\">Total items: ". $quantity. "</p>"; ?>
			</div>
			<div class="col-md-4">
				<?php echo "<p class=\"text-right\">Total price: ".$price."kr</p>"; ?>
			</div>
		</div></p>
		<p><div class="row">
			<div class="col-md-4 col-md-offset-1">
				<?php 
				echo '<a onclick="add_prod('.$product_id.', '.$choice3.')" href="#"> 
	            <span class="glyphicon glyphicon-trash"></span> Discard cart</a>';
				?>
			</div>
		</div></p>
	<?php
	}
	?>

</fieldset>