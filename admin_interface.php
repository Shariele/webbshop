<!DOCTYPE html>
<!--Admin interface. -->
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin's interface</title>

	<?php
	include "include/header.php";
	?>
</head>
<body>
	<div class="container">
		<div class="row" style="margin-bottom:20px">
			<div class="col-md-3">
				<button type="submit" name="filter" value="search" onclick="admin(this.value, 0)" class="btn btn-default btn-xs">Search</button>
				<button type="submit" name="filter" value="order" onclick="admin(this.value, 0)" class="btn btn-default btn-xs">Orders</button>
				<button type="submit" name="filter" value="sale" onclick="admin(this.value, 0); setSale('string', 1)" class="btn btn-default btn-xs">Sale</button>
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
</html>
<?php include "include/footer.php"; ?>