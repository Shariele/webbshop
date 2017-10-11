<!--This is a stupid duplicate page for a function in functions.php -->

<?php if(!isset($_SESSION['cart'])){
	?>
	<legend></legend>
	<fieldset>
		<div class="row">
			<div class="col-xs-3">
				<div class="form-group">
					<li>You have no items!</li>
				</div>
			</div>
		</div>
		<br />
	</fieldset>
	<?php
}else{
	?>
	<fieldset>
		<?php
	if(isset($_SESSION['cart'])){
		$product_id = 0;
		$arrlength = count($_SESSION['cart']);
		for($i = 0; $i < $arrlength; $i++){
			if($_SESSION['cart'][$i][2] != "*"){
				$product_id = 0;
				$product_id = $_SESSION['cart'][$i][0];
				$choice1 = 1;
				$choice2 = 0;
				$choice3 = 2;
				?>
				<p><div class="row">
					<div class="col-xs-5">
							<?php echo $_SESSION['cart'][$i][1]; ?>
					</div>
					<div class="col-xs-4">
						<?php echo 'Items: '. $_SESSION["cart"][$i][2] .' <a class="link-cursor" onclick="add_prod('.$product_id.', '.$choice1.')" > 
			            <span class="glyphicon glyphicon-plus"> </span></a> / 
			            <a class="link-cursor" onclick="add_prod('.$product_id.', '.$choice2.')"> 
			            <span class="glyphicon glyphicon-minus"></span> </a>';
						?>
					</div>
					<div class="col-xs-3">
							<?php echo "Price: ". ($_SESSION['cart'][$i][3] * $_SESSION['cart'][$i][2])."kr"; ?>
					</div>
				</div></p>
				<?php
			}//else{
				//array_filter($_SESSION['cart']);
			//}
		}
		$arrlength = count($_SESSION['cart']);
		$quantity = 0;
		$price = 0;
		$choice3 = 2;
		for($i = 0; $i < $arrlength; $i++){
			if(!empty($_SESSION['cart'][$i])){
				$quantity = ($quantity + $_SESSION['cart'][$i][2]);
				$price = ($price + ($_SESSION['cart'][$i][3] * $_SESSION['cart'][$i][2]));
			}
		}
		?>
		<p><div class="row">
			<div class="col-xs-4 col-xs-offset-4">
				<?php echo "<p class=\"text-right\">Total items: ". $quantity. "</p>"; ?>
			</div>
			<div class="col-xs-4">
				<?php echo "<p class=\"text-right\">Total price: ".$price."kr</p>"; ?>
			</div>
		</div></p>
		<p><div class="row">
			<div class="col-xs-4 col-xs-offset-1">
				<?php 
				echo '<a onclick="add_prod('.$product_id.', '.$choice3.')" href="#"> 
	            <span class="glyphicon glyphicon-trash"></span> Discard cart</a>';
				?>
			</div>
			<div class="col-xs-3 col-xs-offset-4">
				<a href="check_out.php"><span class="glyphicon glyphicon-shopping-cart"></span>Check out</a>
			</div>
		</div></p>
	<?php
	}
	?>

</fieldset>
<?php
}
?>