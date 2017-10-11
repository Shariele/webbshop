<!--Product page where all the shops products are located. -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Products</title>
	<?php
	include "include/header.php";
	?>
</head>
<body onload="show_products('all')">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="header-nav">
					<nav class="navbar navbar-default" role="navigation">
						<div class="container-fluid">
					        <!-- Brand and toggle get grouped for better mobile display -->
					        <div class="navbar-header">

					            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
					            	<span class="sr-only">Toggle navigation</span>
					            	<span class="icon-bar"></span>
					            	<span class="icon-bar"></span>
					        		<span class="icon-bar"></span>
					      		</button>
					  		</div>
					  		<!-- Collect the nav links, forms, and other content for toggling -->
					  		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
					  			<?php
					  			include "components/sidebar.php";
					  			?>
							</div>
						</div>
					</nav>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<div class="input-group">
						<input id="search" name="search" onkeyup="prod_search(this.value)" type="text" class="form-control" placeholder="Search product" />
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div style="margin-bottom:50px" id="products">
				</div>
			</div>
		</div>
		
	</div><!--Container-->
</body>
</html>
