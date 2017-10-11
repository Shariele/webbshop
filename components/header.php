<!--Contains the top menus outlook and buttons. -->

<div class="container">
	<div class="header-nav">
	    <nav class="navbar navbar-default" role="navigation">
	  		<div class="container-fluid">
		        <!-- Brand and toggle get grouped for better mobile display -->
		        <div class="navbar-header">
		            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		            	<span class="sr-only">Toggle navigation</span>
		            	<span class="icon-bar"></span>
		            	<span class="icon-bar"></span>
		        		<span class="icon-bar"></span>
		      		</button>
		  		</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<form name="search" method="post" action="#">
						<ul class="nav navbar-nav">
							<li><a href="index.php" style="padding-right:100px">Webshop</a></li>
		                </ul>
	            	</form>

	            	<ul class="nav navbar-nav">
                      <li><a href="index.php">Home</a></li>
                      <li><a href="product.php">Products</a></li>
                      
                      <li><a href="contact_us.php">Contact us</a></li>
                    </ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a id="dropdownShoppingCart" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Shopping Cart<span class="caret"></span></a>
							<ul class="dropdown-menu shopping_cart" role="menu">
								<div id="shopping_cart">
									<?php if(isset($_SESSION['cart'])){ ?>
										<?php include "components/shopping_cart.php"; ?>
									<?php
									}else{
										?>
										<legend></legend>
										<fieldset>
											<div class="row">
												<div class="col-md-3">
													<div class="form-group">
														<li>You have no items!</li>
													</div>
												</div>
											</div>
										</fieldset>
										<?php
									}
									?>
								</div>
							</ul>
						</li>
						<?php if(!isset($_SESSION['user'])){
							?>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Login<span class="caret"></span></a>
								<ul class="dropdown-menu login" role="menu">
									<form action="actions_index.php?action=login" class="form-inline" method="post" name="sign_in">
										<fieldset>
											<legend></legend>
											<div class="form-group">
												<input type="text" class="form-control" placeholder="Username" name="username" required>
											</div>
											<br />
											<div class="form-group">
												<input type="password" class="form-control" placeholder="Password" name="password" required>
											</div>
											<div class="form-group">
												<button type="submit" class="btn btn-default">Log in</button>
											</div>
											<div class="form-group">
												<a href="register.php">Don't have an account? Click here to register</a>
											</div>
										</fieldset>
									</form>
								</ul>
							</li>

							<?php
						}else{
							?>
							<?php if($_SESSION['user']->Get_type() == "admin"){
								?>
								<li><a href="admin_interface.php"><button name="admin_btn" class="btn btn-danger btn-xs">Admin's</button></a></li>
								<?php
							}
							?>
							<li><a href="my_acc.php">My account</a></li>
							<li><a href="actions_index.php?action=log_out&log_out=1">Log out</a></li>
							<?php
						}
						?>
					</ul>
                </div><!-- /.navbar-collapse -->
	    	</div><!-- /.container-fluid -->
	  	</nav>
	</div>
</div><!--Container-->

<?php include "include/footer.php";