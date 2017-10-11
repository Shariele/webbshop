<!--Contains detailed information about the chosen product. -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
<?php
include "include/header.php";

$product_id = 0;
$choice = 1;
if(isset($_GET['id'])){
	$product_id = intval($_GET['id']);
}
$sql = "SELECT name FROM article WHERE id=$product_id";
$sth = $pdo->prepare($sql);
$sth->execute();

$result = $sth->fetchAll();
foreach($result as $i){
	echo "<title>".$i['name']."</title>";

	count_views($product_id);
}?>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<?php
			$sql = "SELECT * FROM article WHERE id=$product_id";
			$sth = $pdo->prepare($sql);
			$sth->execute();

			$result = $sth->fetchAll();
			foreach($result as$i){
			 	$price = 0;
			 	$oldPrice = 0;

			 	if($i['saleAll'] != 0){ $price = ($i['price'] * ( 1 - ($i['saleAll'] / 100))); $oldPrice = $i['price']; }else{ $price = $i['price']; }
				?>
				<div class="row">
					<div class="col-md-12">
						<?php echo "<center><h2><strong>$i[name]</strong></h2></center>";?>
					</div>
				</div>
				<div class="row" style="margin-bottom:10px">
					<div class="col-md-4">
						<img class="img-rounded" border="0" name="myimage" src="http://placehold.it/200" alt="I have no picture yet!" width="100%" height="100%">
					</div>
					<div class="col-md-8">
						<?php 
						if($i['saleAll'] != 0){ echo "<h3><strong>There is currently a sale on this item! </strong></br><strike>$oldPrice Kr</strike></h3>"; }
						echo "<h3><strong>Price: ". $price ."kr</strong></h3>";
						if($i['availabillity'] > 3){ echo "<small>Availabillity: <font color=\"green\">".$i['availabillity']."</font></small>"; }else{
							echo "<small>Availabillity: <font color=\"red\">".$i['availabillity']."</font></small>";
						} ?>
						<div class="row">
							<div class="col-md-8">
								<button name="purchase" id="btnAddProd" onclick="add_prod(<?php echo $product_id; ?>, <?php echo $choice; ?>)" class="btn btn-primary">Put in Shopping Cart</button>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div role="tabpanel">
							<!-- Nav tabs -->
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active"><a href="#description" aria-controls="description" role="tab" data-toggle="tab">Description</a></li>
								<li role="presentation"><a href="#specifications" aria-controls="specifications" role="tab" data-toggle="tab">Specifications</a></li>
								<li role="presentation"><a href="#review" aria-controls="review" role="tab" data-toggle="tab">Review</a></li>
							</ul>
							<!-- Tab panes -->
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="description"><?php echo $i['description']; ?></div>
								<div role="tabpanel" class="tab-pane" id="specifications"><?php echo $i['specification']; ?></div>
								<div role="tabpanel" class="tab-pane" id="review">Coming soon!</div>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
			?>
		</div>
	</div>
</div><!--Container-->

</body>
<?php
include "include/footer.php";
?>
</html>

<script>
	$(document).ready(function(){
	    $(document).on('click', '#btnAddProd', function(e) {
			$( "#dropdownShoppingCart" ).stop(true,true);
			$( "#dropdownShoppingCart" ).fadeOut(200).fadeIn(200).fadeOut(200).fadeIn(200);
		});
	});
</script>