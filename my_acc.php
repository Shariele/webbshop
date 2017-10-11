<!--My account page. -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My account</title>
	<?php include "include/header.php";  
	$show = 1;
	?>
</head>
<body onload="settings('account', 1)">
	<div class="container">
		<div class="row" style="margin-bottom:20px">
			<div class="col-md-3">
				<button type="submit" name="filter" value="account" onclick="settings(this.value, <?php echo $show; ?>)" class="btn btn-default btn-xs">Account</button>
				<button type="submit" name="filter" value="order" onclick="settings(this.value, <?php echo $show; ?>)" class="btn btn-default btn-xs">Orders</button>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div id="show_settings">
				</div>
			</div>
		</div>
	</div>
</body>
<?php include "include/footer.php"; ?>
</html>
