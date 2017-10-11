<!--Page containing all functions.-->

<?php
//Ajax functions.

//Change the shipped status of a order.
function changeStatus(){
	include "../include/connect_db.php";

	$id = $_POST['q'];
	$choice = $_POST['r'];

	$sql = "SELECT * FROM shipping WHERE order_id=$id";
	$sth = $pdo->prepare($sql);
	$sth->execute();

	$result = $sth->fetchAll();
	foreach($result as $row){
		$status = $row['shipped'];
		if($choice == "upd"){
			if($status == "false"){
				$status = "true";

				$sql = "UPDATE shipping SET shipped = 'true' WHERE order_id=$id";
				$sth = $pdo->prepare($sql);
				$sth->execute();

				echo $status;
			}else{
				$status = "false";

				$sql = "UPDATE shipping SET shipped = 'false' WHERE order_id=$id";
				$sth = $pdo->prepare($sql);
				$sth->execute();

				echo $status;
			}
		}else{
			echo $status;
		}
	}	
}

//The function from hell, takes data from my_acc.php and it is believed it takes data from the check_out.php page too...
function myAccChoice(){
	?>
	<script type="text/javascript">var data = {};</script>
	
	<?php
	include "../include/classes/user.php";

	session_start();
	session_name("webshop");

	include "../include/connect_db.php";

	$choice = 0;
	$choice2 = 0;
	$choice1 = $_REQUEST['q'];
	$choice2 = $_REQUEST['r'];


	switch ($choice1) {
		case 'order':
			orderList(1);
		break;
		case 'shipping':
			if($choice2 == 1){
				$account = array(
					$_SESSION['user']->Get_email(), 
					$_SESSION['user']->Get_full_name(),
					$_SESSION['user']->Get_residental(),
					$_SESSION['user']->Get_zip_code(),
					$_SESSION['user']->Get_country(),
					$_SESSION['user']->Get_mobile(),
					$_SESSION['user']->Get_city(),
					$_SESSION['user']->Get_region()
				);

				$name = array(
					"Email",
					"Name",
					"Residental adress",
					"Zip code",
					"Country",
					"Mobile",
					"City",
					"Region"
				);

				for($i = 0; $i < count($account); $i++){
					?>
					<div class="row">
						<div class="col-sm-12">
				        	<label class="col-sm-4"><?php echo $name[$i] ." : "; ?></label>
							<label class="col-sm-6"><?php echo $account[$i]; ?></label> 
						</div>
					</div>
					<?php
				}
				?>
				<div class="row" style="margin-top:20px">
			        <div class="col-sm-12">
			        	<div class="col-sm-4">
			    			<button name="order_btn" value="account" onclick="place_order(this.value, 'account')" class="btn btn-success btn-ms">Submit</button>
			    		</div>
			    	</div>
				</div>
				<?php
			}else{
				$placeholder = array(
					"New email",
					"New name",
					"New residental adress",
					"New zip code",
					"New country",
					"New mobile",
					"New city",
					"New region"
				);
				$name = array(
					"email",
					"name",
					"residental_adress",
					"zip_code",
					"country",
					"mobile",
					"city",
					"region"
				);
				?>
				<?php
				for($i = 0; $i < count($name); $i++){
					?>
					<div class="row" style="margin-bottom:10px">
				      <div class="col-sm-10">
				        <div class="col-sm-12">
				          <input type="<?php if($name[$i] == 'email'){ echo $name[$i]; }else{ echo 'text'; } ?>"  class="form-control" id="<?php echo $name[$i]; ?>"
				           placeholder="<?php echo $placeholder[$i]; ?>" name="<?php echo $name[$i]; ?>" onblur="create_array(this.value, '<?php echo $name[$i]; ?>')">
				        </div>
				      </div>
				    </div>
					<?php
				}
				?>
				<div class="row" style="margin-top:20px">
			        <div class="col-sm-12">
			        	<div class="col-sm-4">
			    			<button name="search_btn" value="account" onclick="place_order(this.value, 'nonAccount')" class="btn btn-success btn-ms">Submit</button>
			    		</div>
			    	</div>
				</div>
				<?php
			}
		break;
		case 'account':

		if($choice2 == 1){
			$show = 2;

			$account = array(
			$_SESSION['user']->Get_email(), 
			$_SESSION['user']->Get_full_name(),
			$_SESSION['user']->Get_residental(),
			$_SESSION['user']->Get_zip_code(),
			$_SESSION['user']->Get_country(),
			$_SESSION['user']->Get_mobile(),
			$_SESSION['user']->Get_city(),
			$_SESSION['user']->Get_region()
			);
			$placeholder = array(
				"New email",
				"New name",
				"New residental adress",
				"New zip code",
				"New country",
				"New mobile",
				"New city",
				"New region"
			);
			$name = array(
				"email",
				"name",
				"residental_adress",
				"zip_code",
				"country",
				"mobile",
				"city",
				"region"
			);
			?>
			<div id="settings">
					<?php
					for($i = 0; $i < count($account); $i++){
						?>
						<div class="row" style="margin-bottom:10px">
					      <div class="col-sm-12">
					        <div class="col-sm-4">
					          <input type="<?php if($name[$i] == 'email'){ echo $name[$i]; }else{ echo 'text'; } ?>"  class="form-control" id="<?php echo $name[$i]; ?>"
					           placeholder="<?php echo $placeholder[$i]; ?>" name="<?php echo $name[$i]; ?>" onblur="create_array(this.value, '<?php echo $name[$i]; ?>')">
					        </div>
					        <div class="col-sm-7">
					        	<label class="col-sm-12">Current: <?php echo $account[$i]; ?></label>
							</div>
					      </div>
					    </div>
						<?php
					}
					?>
				    <!--Password -->
				    <div class="row" style="margin-top:20px">
				      <div class="col-sm-12">
				        <div class="col-sm-4 currentPassword">
				          <input type="password" class="form-control" id="current_password" placeholder="Current password" name="current_password"
				          onblur="create_array(this.value, 'current_password')">
				        </div>
				        <div class="col-sm-4">
				          <input type="password" class="form-control" id="password" placeholder="New password" name="new_password"
				          onblur="create_array(this.value, 'new_password')">
				        </div>
				      </div>
				    </div>
				    <div class="row" style="margin-top:20px">
				        <div class="col-sm-12">
				        	<div class="col-sm-4">

				    			<button name="search_btn" value="account" onclick="settings(this.value, 3)" class="btn btn-success btn-ms">Submit</button>
				    		</div>
				    	</div>
					</div>
			</div>
			<?php
		}elseif($choice2 == 3){
			$email = $_SESSION['user']->Get_email();
			$name = $_SESSION['user']->Get_full_name();
			$residental = $_SESSION['user']->Get_residental();
			$zip = $_SESSION['user']->Get_zip_code();
			$country = $_SESSION['user']->Get_country();
			$mobile = $_SESSION['user']->Get_mobile();
			$city = $_SESSION['user']->Get_city();
			$region = $_SESSION['user']->Get_region();
			$current_pass = "";
			$new_pass = "";

			if(isset($_POST['email']) && $_POST['email'] != ""){
				$email = $_POST['email'];
			}
			if(isset($_POST['name']) && $_POST['name'] != ""){
				$name = $_POST['name'];
			}
			if(isset($_POST['residental']) && $_POST['residental'] != ""){
				$residental = $_POST['residental'];
			}
			if(isset($_POST['zip']) && $_POST['zip'] != ""){
				$zip = $_POST['zip'];
			}
			if(isset($_POST['country']) && $_POST['country'] != ""){
				$country = $_POST['country'];
			}
			if(isset($_POST['mobile']) && $_POST['mobile'] != ""){
				$mobile = $_POST['mobile'];
			}
			if(isset($_POST['city']) && $_POST['city'] != ""){
				$city = $_POST['city'];
			}
			if(isset($_POST['region']) && $_POST['region'] != ""){
				$region = $_POST['region'];
			}
			if(isset($_POST['current_password'])){
				$str = $_POST['current_password'];
				$current_pass = md5($str);
			}
			if(isset($_POST['new_password'])){
				$str = $_POST['new_password'];
				$new_pass = md5($str);
			}

			$insert = array(
				"email",
				"full_name",
				"residental_adress",
				"zip_code",
				"country",
				"mobile_number",
				"city",
				"region",
				"password"
			);

			$data = array(
				$email,
				$name,
				$residental,
				$zip,
				$country,
				$mobile,
				$city,
				$region
			);

			for($i = 0; $i <= count($insert); $i++){
				$s_insert = array(
					$_SESSION['user']->Set_email($email),
					$_SESSION['user']->Set_full_name($name),
					$_SESSION['user']->Set_residental($residental),
					$_SESSION['user']->Set_zip_code($zip),
					$_SESSION['user']->Set_country($country),
					$_SESSION['user']->Set_mobile($mobile),
					$_SESSION['user']->Set_city($city),
					$_SESSION['user']->Set_region($region)
				);
				if(!empty($data[$i]) && isset($data[$i]) && $insert[$i] != "password"){
					$sql = "UPDATE account SET ".$insert[$i]."='".$data[$i]."' WHERE acc_id='".$_SESSION['user']->Get_id()."'";
					$sth = $pdo->prepare($sql);
			        $sth->execute();

			        echo $s_insert[$i];
				}else{
					$sql = "SELECT password FROM account WHERE acc_id='".$_SESSION['user']->Get_id()."'";
					$sth = $pdo->prepare($sql);
			        $sth->execute();

			        $result = $sth->fetchAll();
			        foreach($result as $n){
			        	if($n['password'] == $current_pass){
			        		$sql = "UPDATE account SET password ='".$new_pass."' WHERE acc_id='".$_SESSION['user']->Get_id()."'";
							$sth = $pdo->prepare($sql);
					        $sth->execute();

					        $_SESSION['changed_pass'] = "Your password has been changed!";
			        	}else{
			        		//$_SESSION['wrong_pass'] = "Entered current password doesn't match your existing password, please try again.";
			        	}
			        }
				}
			}

			$name = array(
				"email",
				"name",
				"residental_adress",
				"zip_code",
				"country",
				"mobile",
				"city",
				"region"
			);

			$account = array(
				$_SESSION['user']->Get_email(), 
				$_SESSION['user']->Get_full_name(),
				$_SESSION['user']->Get_residental(),
				$_SESSION['user']->Get_zip_code(),
				$_SESSION['user']->Get_country(),
				$_SESSION['user']->Get_mobile(),
				$_SESSION['user']->Get_city(),
				$_SESSION['user']->Get_region()
			);
			$placeholder = array(
				"New email",
				"New name",
				"New residental adress",
				"New zip code",
				"New country",
				"New mobile",
				"New city",
				"New region"
			);
			?>
			<div id="settings">
					<?php
					if(isset($_SESSION['wrong_pass'])){
						echo $_SESSION['wrong_pass'];
						unset($_SESSION['wrong_pass']);
					}
					if(isset($_SESSION['changed_pass'])){
						echo $_SESSION['changed_pass'];
						unset($_SESSION['changed_pass']);
					}
					
					for($i = 0; $i < count($account); $i++){
						?>
						<div class="row" style="margin-bottom:10px">
					      <div class="col-sm-12">
					        <div class="col-sm-4">
					          <input type="<?php if($name[$i] == 'email'){ echo $name[$i]; }else{ echo 'text'; } ?>"  class="form-control" id="<?php echo $name[$i]; ?>"
					           placeholder="<?php echo $placeholder[$i]; ?>" name="<?php echo $name[$i]; ?>" onblur="create_array(this.value, '<?php echo $name[$i]; ?>')">
					        </div>
					        <div class="col-sm-7">
					        	<label class="col-sm-12">Current: <?php echo $account[$i]; ?></label>
							</div>
					      </div>
					    </div>
						<?php
					}
					?>
				    <!--Password -->
				    <div class="row" style="margin-top:20px">
				      <div class="col-sm-12">
				        <div class="col-sm-4">
				          <input type="password" class="form-control" id="current_password" placeholder="Current password" name="current_password"
				          onblur="create_array(this.value, 'current_password')">
				        </div>
				        <div class="col-sm-4">
				          <input type="password" class="form-control" id="password" placeholder="New password" name="new_password"
				          onblur="create_array(this.value, 'new_password')">
				        </div>
				      </div>
				    </div>
				    <div class="row" style="margin-top:20px">
				        <div class="col-sm-12">
				        	<div class="col-sm-4">

				    			<button name="search_btn" value="account" onclick="settings(this.value, 3)" class="btn btn-success btn-ms">Submit</button>
				    		</div>
				    	</div>
					</div>
			</div>
			<?php
		}else{
			$email = $_SESSION['user']->Get_email();
			$name = $_SESSION['user']->Get_full_name();
			$residental = $_SESSION['user']->Get_residental();
			$zip = $_SESSION['user']->Get_zip_code();
			$country = $_SESSION['user']->Get_country();
			$mobile = $_SESSION['user']->Get_mobile();
			$city = $_SESSION['user']->Get_city();
			$region = $_SESSION['user']->Get_region();

			if(isset($_POST['email']) && $_POST['email'] != ""){
				$email = $_POST['email'];
			}
			if(isset($_POST['name']) && $_POST['name'] != ""){
				$name = $_POST['name'];
			}
			if(isset($_POST['residental']) && $_POST['residental'] != ""){
				$residental = $_POST['residental'];
			}
			if(isset($_POST['zip']) && $_POST['zip'] != ""){
				$zip = $_POST['zip'];
			}
			if(isset($_POST['country']) && $_POST['country'] != ""){
				$country = $_POST['country'];
			}
			if(isset($_POST['mobile']) && $_POST['mobile'] != ""){
				$mobile = $_POST['mobile'];
			}
			if(isset($_POST['city']) && $_POST['city'] != ""){
				$city = $_POST['city'];
			}
			if(isset($_POST['region']) && $_POST['region'] != ""){
				$region = $_POST['region'];
			}

			//Array för att sätta in datan i ordning i databasen.
			$insert = array(
				"email",
				"full_name",
				"residental_adress",
				"zip_code",
				"country",
				"mobile_number",
				"city",
				"region"
			);

			//Array för att mata in data i databasen.
			$data = array(
				$email,
				$name,
				$residental,
				$zip,
				$country,
				$mobile,
				$city,
				$region
			);

			//Sätter in användarens angivna data i databasen.
			for($i = 0; $i <= count($insert); $i++){
				$s_insert = array(
					$_SESSION['user']->Set_email($email),
					$_SESSION['user']->Set_full_name($name),
					$_SESSION['user']->Set_residental($residental),
					$_SESSION['user']->Set_zip_code($zip),
					$_SESSION['user']->Set_country($country),
					$_SESSION['user']->Set_mobile($mobile),
					$_SESSION['user']->Set_city($city),
					$_SESSION['user']->Set_region($region)
				);
				if(!empty($data[$i]) && isset($data[$i])){
					$sql = "UPDATE account SET ".$insert[$i]."='".$data[$i]."' WHERE acc_id='".$_SESSION['user']->Get_id()."'";
					$sth = $pdo->prepare($sql);
			        $sth->execute();
				}
			}

			//Array för att namnge textboxarna.
			$name = array(
				"email",
				"name",
				"residental_adress",
				"zip_code",
				"country",
				"mobile",
				"city",
				"region"
			);

			//För utskrivning av nuvarande data.
			$account = array(
				$_SESSION['user']->Get_email(), 
				$_SESSION['user']->Get_full_name(),
				$_SESSION['user']->Get_residental(),
				$_SESSION['user']->Get_zip_code(),
				$_SESSION['user']->Get_country(),
				$_SESSION['user']->Get_mobile(),
				$_SESSION['user']->Get_city(),
				$_SESSION['user']->Get_region()
			);

			//Placeholder till input boxarna.
			$placeholder = array(
				"New email",
				"New name",
				"New residental adress",
				"New zip code",
				"New country",
				"New mobile",
				"New city",
				"New region"
			);
			?>
				<?php
				
				for($i = 0; $i < count($account); $i++){
					?>
					<div class="row" style="margin-bottom:10px">
				      <div class="col-sm-12">
				        <div class="col-sm-4">
				          <input type="<?php if($name[$i] == 'email'){ echo $name[$i]; }else{ echo 'text'; } ?>"  class="form-control" id="<?php echo $name[$i]; ?>"
				           placeholder="<?php echo $placeholder[$i]; ?>" name="<?php echo $name[$i]; ?>" onblur="create_array(this.value, '<?php echo $name[$i]; ?>')">
				        </div>
				        <div class="col-sm-7">
				        	<label class="col-sm-12">Current: <?php echo $account[$i]; ?></label>
						</div>
				      </div>
				    </div>
					<?php
				}
		}
			break;
		default:
			# code...
			break;
	}

	include "../include/footer.php";
}

//Shows the shopping cart.
function showCart(){
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
				if($_SESSION['cart'][$i][2] != "*"){
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
	<?php
}

//Shows products at the product.php page.
function products(){
	include "../include/connect_db.php";
	$a = 0;
	if(isset($_POST['q'])){
		$a = $_POST['q'];
	}
	if(isset($_GET['q'])){
		$a = $_GET['q'];
	}


	if($a == "all"){
		$sql = "SELECT * FROM article ";
		$sql10 = "SELECT COUNT(id) FROM article";
	}elseif($a == 13 || $a == 14 || $a == 15){
		if($a == 13){
			$sql3 = "";
			$sql = "SELECT cat_id FROM under_category WHERE id=$a";
			$sth = $pdo->prepare($sql);
			$sth->execute();

			$result = $sth->fetchAll();
			$or = "";

			foreach($result as $i){
				$sql2 = "SELECT id FROM under_category WHERE cat_id = $i[cat_id] AND cat_id <> ".$a."";
				$sth = $pdo->prepare($sql2);
				$sth->execute();

				$result2 = $sth->fetchAll();
				foreach($result2 as $i2){
					$or = $or." OR u_cat_id=$i2[id]";
				}
			}
			$sql = "SELECT * FROM article WHERE u_cat_id=$a".$or;
			$sql10 = "SELECT COUNT(id) FROM article WHERE u_cat_id=$a".$or;

		}if($a == 14){
			$sql3 = "";
			$sql = "SELECT cat_id FROM under_category WHERE id=$a";
			$sth = $pdo->prepare($sql);
			$sth->execute();

			$result = $sth->fetchAll();
			$or = "";

			foreach($result as $i){
				$sql2 = "SELECT id FROM under_category WHERE cat_id = $i[cat_id] AND cat_id <> ".$a."";
				$sth = $pdo->prepare($sql2);
				$sth->execute();

				$result2 = $sth->fetchAll();
				foreach($result2 as $i2){
					$or = $or." OR u_cat_id=$i2[id]";
				}
			}
			$sql = "SELECT * FROM article WHERE u_cat_id=$a".$or;
			$sql10 = "SELECT COUNT(id) FROM article WHERE u_cat_id=$a".$or;

		}if($a == 15){
			$sql3 = "";
			$sql = "SELECT cat_id FROM under_category WHERE id=$a";
			$sth = $pdo->prepare($sql);
			$sth->execute();

			$result = $sth->fetchAll();
			$or = "";

			foreach($result as $i){
				$sql2 = "SELECT id FROM under_category WHERE cat_id = $i[cat_id] AND cat_id <> ".$a."";
				$sth = $pdo->prepare($sql2);
				$sth->execute();

				$result2 = $sth->fetchAll();
				foreach($result2 as $i2){
					$or = $or." OR u_cat_id=$i2[id]";
				}
			}
			$sql = "SELECT * FROM article WHERE u_cat_id=$a".$or;
			$sql10 = "SELECT COUNT(id) FROM article WHERE u_cat_id=$a".$or;

		}
		
	}else{
		$sql = "SELECT * FROM article WHERE u_cat_id=$a";
		$sql10 = "SELECT COUNT(id) FROM article WHERE u_cat_id=$a";
	}

	// find out how many rows are in the table 
	$sth10 = $pdo->prepare($sql10);
	$sth10->execute();
	$result10 = $sth10->fetch();
	$numrows = $result10[0];

	// number of rows to show per page
	$rowsperpage = 20;
	// find out total pages
	$totalpages = ceil($numrows / $rowsperpage);

	// get the current page or set a default
	if(isset($_POST['c']) && is_numeric($_POST['c'])){
	   // cast var as int
	   $currentpage = (int) $_POST['c'];
	}else{
	   // default page num
	   $currentpage = 1;
	}

	// if current page is greater than total pages...
	if ($currentpage > $totalpages){
	   // set current page to last page
	   $currentpage = $totalpages;
	} 
	// if current page is less than first page...
	if ($currentpage < 1){
	   // set current page to first page
	   $currentpage = 1;
	}

	// the offset of the list, based on current page 
	$offset = ($currentpage - 1) * $rowsperpage;

	$sql = $sql." LIMIT $offset, $rowsperpage";

	$sth = $pdo->prepare($sql);
	$sth->execute();

	$result = $sth->fetchAll();
	?>
	<div class="row">
		<?php
		foreach($result as $i){
			?>
			<div class="col-sm-3 productsProduct">
				<?php
				if(strlen($i['name']) <= 15){
					echo "<a href=\"detailed.php?id=$i[id]\"><center><h5>".$i['name']."</h5></center></a>";
				}else{
					echo "<a href=\"detailed.php?id=$i[id]\"><center><h5>".substr($i['name'], 0, 13)."...</h5></center></a>";
				}?><center><div class="itemImage"><?php
				echo "<a href=\"detailed.php?id=$i[id]\"><img  class=\"img-rounded\" border=\"0\" name=\"myimage\" src=\"http://placehold.it/150\" alt=\"I have no picture yet!\"></a>";
				echo "<center><button class=\"butButton btn btn-warning btn-default\" onclick=\"add_prod($i[id], 1)\"><span class=\"glyphicon glyphicon-shopping-cart\" aria-hidden=\"true\">
						</span> $i[price] Add</button></center>";
				?></div>
				<div class="buyMoreInfo">

							<?php
							echo substr($i['description'], 0, 100);
							?>
					<div class="row">
						<div class="col-sm-2 col-sm-offset-9">
							<button onclick="add_prod( <?php echo $i['id']; ?> , 1)" class="butButton btn btn-warning btn-default"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true">
								<?php
								echo $i['price'];
								?>
							</span></button>
						</div>
					</div>
					
				</div><center>
				
			</div>
			<?php
		}
		/******  build the pagination links ******/
		?>
	</div>
	</br>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<?php
			// range of num links to show
			$range = 3;

			// if not on page 1, don't show back links
			if ($currentpage > 1) {
			   // show << link to go back to page 1
			   echo " <a value=\"1\" id=\"$a\" class=\"pagination\" href=''><<</a> ";
			   // get previous page num
			   $prevpage = $currentpage - 1;
			   // show < link to go back to 1 page
			   echo " <a value=\"$prevpage\" id=\"$a\" class=\"pagination\" href=''><</a> ";
			}

			// loop to show links to range of pages around current page
			for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
			   // if it's a valid page number...
			   if (($x > 0) && ($x <= $totalpages)) {
			      // if we're on current page...
			      if ($x == $currentpage) {
			         // 'highlight' it but don't make a link
			         echo " [<b>$x</b>] ";
			      // if not current page...
			      } else {
			         // make it a link
			         echo " <a value=\"$x\" id=\"$a\" class=\"pagination\" href=''>$x</a> ";
			      } // end else
			   } // end if 
			} // end for

			// if not on last page, show forward and last page links        
			if ($currentpage != $totalpages) {
			   // get next page
			   $nextpage = $currentpage + 1;
			    // echo forward link for next page 
			   echo " <a value=\"$nextpage\" id=\"$a\" class=\"pagination\" href=''>></a> ";
			   // echo forward link for lastpage
			   echo " <a value=\"$totalpages\" id=\"$a\" class=\"pagination\" href=''>>></a> ";
			} // end if
			/****** end build pagination links ******/
			?>
		</div>
	</div>

	<script>
	$(document).ready(function(){
	    $(document).on('click', '.pagination', function(e) {
	    	e.preventDefault();

	    	show_products($(this).attr('id'), $(this).attr('value'));
	    	
	    })
	});

	</script>
	<?php
}

//Used to search products at the product.php page.
function prodSearch(){
	include "../include/connect_db.php";

	$data = $_REQUEST['q'];


	$sql = "SELECT * FROM article WHERE name like '%$data%' ";
	$sth = $pdo->prepare($sql);
	$sth->execute();
	$result = $sth->fetchAll();

	if(!empty($result)){
		foreach ($result as $i) {
			?>
			<div class="col-md-3 indexProducts" style="max-width:200px">
				<?php
				echo "<a href=\"detailed.php?id=$i[id]\"><center><h5>".$i['name']."</h5></center></a>";
				echo "<a href=\"detailed.php?id=$i[id]\"><img  class=\"img-rounded\" border=\"0\" name=\"myimage\" src=\"http://placehold.it/150\" alt=\"I have no picture yet!\" width=\"100%\" height=\"100%\"></a>";
				?>
			</div>
			<?php
		}
	}else{
		echo "No products with that name can be found.";
	}
}

//Used for searching the products for admins.
function adminSearch(){
	?>
	<form class="form-horizontal" role="form" method="get">
		<div class="input-group col-sm-5">
			<input id="search" name="search" onkeyup="admin_prod_search(this.value)" type="text" class="form-control" placeholder="Type the product name" />
		</div>
	</form>
	<div class="row">
		<div class="col-md-11 col-md-offset-1">
			<div id="search_result">
			</div>
		</div>
	</div>
	<?php
}

//Shows a list of orders.
function orderList($choice){
	include "../include/connect_db.php";

	if($choice == 0){
		$sql = "SELECT * FROM shipping ORDER BY shipped asc";
		$sth = $pdo->prepare($sql);
		$sth->execute();

		$result = $sth->fetchAll();
		?>
		<div class="row">
		    <div class="col-md-12">
		        <div class="table-responsive  col-md-12">
		          <table class="table table-condensed">
					<tr>
						<td><Strong>Order id</strong></td>
						<td><Strong>Time</strong></td>
						<td><Strong>Shipped</strong></td>
					</tr>
					<?php
					foreach($result as $row){
						?>
						<?php
							echo "<tr class=\"clickable-row\" onClick=\"admin('orderDetail', $row[order_id])\">";
								echo "<td>$row[order_id]</td>";
								echo "<td>$row[time]</td>";
								echo "<td>$row[shipped]</td>";
								echo "</a>";
							echo "</tr>";	
			           }
			           ?>
					</table>
				</div>
		    </div>
		</div>
		<?php
	}elseif($choice == 1){
		$sql = "SELECT * FROM shipping WHERE acc_id=".$_SESSION['user']->Get_id()." ORDER BY time desc";
		$sth = $pdo->prepare($sql);
		$sth->execute();

		$result = $sth->fetchAll();
		?>
		<div class="row">
		    <div class="col-md-12">
		        <div class="table-responsive  col-md-12">
		          <table class="table table-condensed">
					<tr>
						<td><Strong>Order id</strong></td>
						<td><Strong>Time</strong></td>
						<td><Strong>Shipped</strong></td>
					</tr>
					<?php
					foreach($result as $row){
						?>
						<?php
							echo "<tr class=\"clickable-row\" onClick=\"admin('orderDetail', $row[order_id])\">";
								echo "<td>$row[order_id]</td>";
								echo "<td>$row[time]</td>";
								echo "<td>$row[shipped]</td>";
								echo "</a>";
							echo "</tr>";	
			           }
			           ?>
					</table>
				</div>
		    </div>
		</div>
		<?php
	}
	?>
	<script>
	//Gör så att raderna är clickbara.
	/*jQuery(document).ready(function($) {
	    $(".clickable-row").click(function() {
	        window.document.location = $(this).data("href");
	    });
	});*/
	//Ger en hover effekt på tr raderna i tablet.
	$(".clickable-row").hover(
	  function () {
	    $(this).css("color","yellow");
	  }, 
	  function () {
	    $(this).css("color","");
	  }
	);
	</script>
	<?php
}

//Shows a detailed version of the order.
function orderDetail(){
	include "../include/connect_db.php";

	include "../include/classes/user.php";

	session_start();
	session_name("webshop");

	$id = $_POST['q'];


	$sql = "SELECT * FROM shipping WHERE order_id=$id";
	$sth = $pdo->prepare($sql);
	$sth->execute();

	$result = $sth->fetchAll();
	foreach($result as $row){
		$data = array();

		$data[0] = $row['full_name'];
	    $data[1] = $row['email'];
	    $data[2] = $row['country'];
	    $data[3] = $row['region'];
	    $data[4] = $row['city'];
	    $data[5] = $row['residental_adress'];
	    $data[6] = $row['zip_code'];
	    $data[7] = $row['mobile_number'];
	    $data[8] = $row['time'];
	    $data[9] = $row['order_id'];
	    $data[10] = $row['article_id'];
	    $data[11] = $row['article_name'];
	    $data[12] = $row['quantity'];
	    $data[13] = $row['price'];
	    $data[14] = $row['tot_price'];

	    $text = array(
	            "Name: ",
	            "Email: ",
	            "Country: ",
	            "Region: ",
	            "City: ",
	            "Residental address: ",
	            "Zip code: ",
	            "Mobile number: ",
	            "Time ordered: "
	        );

	    ?>
		<div class="row">
			<div class="col-md-3 col-md-offset-8">
				<?php echo "<button name=\"admin_btn\" data-href=\"php/phpScripts.php?id=$id&action=printOrder\" class=\"btn btn-primary btn-xs clickable-row\">Create order</button>"; ?>
				<?php if($_SESSION['user']->Get_type() == "admin"){ echo "<button style=\"margin-left: 5px\" name=\"admin_btn\" onclick=\"changeStatus('upd', $id)\" class=\"btn btn-warning btn-xs\">Ship</button>"; } ?>
				<strong>Shipped: </strong> 
			</div>
			<div id="ship" class="col-md-1">
			</div>
			</br>
			</br>
			</br>
		</div>

	    <div class="row">
			<div class="col-md-12">
				<center><strong>Order list for order: <?php echo $row['order_id']; ?></strong></center>
				</br>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<strong>Customer information:</strong>
				</br>
				</br>
			</div>
		</div>
		<?php
	    for($i = 0; $i < count($text); $i++){
	    	?>
	    	<div class="row">
				<div class="col-md-3">
					<strong><?php echo $text[$i]; ?> </strong>
				</div>
				<div class="col-md-9">
					<?php echo $data[$i]; ?>
				</div>
			</div>
	    	<?php
	        }

	    $w = array("Article id: ", "Article name: ", "Quantity: ", "Price: ");
	    $a = array($data[10], $data[11], $data[12], $data[13]);

	    ?>
	    <div class="row">
			<div class="col-md-12">
				</br>
				<strong>Products:</strong>
			</div>
		</div>
	    <div class="row">
			</br>
		    <?php
		    for($i=0; $i < count($w); $i++){
		        ?>
				<div class="col-md-3">
					<center><strong><?php echo $w[$i]; ?></strong></center>
					<div class="row">
						<div class="col-md-12">
							<center><?php echo nl2br(htmlspecialchars($a[$i])); ?></center>
						</div>
					</div>
				</div>
		        <?php
		    }
		    ?>
	    </div>
	    

		<div class="row" style="margin-bottom:50px; border-bottom: 1px white solid">
			<div class="col-md-2 col-md-offset-10">
				<strong>Total price: <?php echo $data[14]; ?></strong>
			</div>
		</div>

	    <?php
	}
	?>

	<script>
	//Gör så att raderna är clickbara.
	jQuery(document).ready(function($) {
	    $(".clickable-row").click(function() {
	        window.document.location = $(this).data("href");
	    });
	});

	function status_update(choice1, choice2) {
	        if (choice1 == "status_upd"){
	            $.ajax({
	                type: "POST",
	                url: "./php/change_status.php",
	                data: {
	                    q: choice2,
	                    w: "upd"
	                },
	                success:  function(data){
	                    $('#status').html(data);
	                }
	            });
	        }
	        else if (choice1 == "status"){
	            $.ajax({
	                type: "POST",
	                url: "./php/change_status.php",
	                data: {
	                    q: choice2,
	                    w: "no_upd"
	                },
	                success:  function(data){
	                    $('#status').html(data);
	                }
	            });
	        }
	    }
	</script>
	<?php
}

//Creates an order
function addOrder(){
	include "../include/classes/user.php";

	session_start();
	session_name("webshop");

	include "../include/connect_db.php";

	$var1 = $_REQUEST['q'];
	$var2 = $_REQUEST['r'];

	if($var1 == "account" && $var2 == "account"){
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
			if($_SESSION['cart'][$i][2] != "*"){
				$prod_id = ($prod_id ."". $_SESSION['cart'][$i][0] ."\n");
				$name = ($name ."". $_SESSION['cart'][$i][1] ."\n");
				$quantity = ($quantity ."". $_SESSION['cart'][$i][2] ."\n");
				$price = ($price ."". $_SESSION['cart'][$i][3] ."\n");
				$tot_price = ($tot_price + ($_SESSION['cart'][$i][3] * $_SESSION['cart'][$i][2]));
			}
		}

		$sql = "INSERT INTO shipping(article_id, article_name, quantity, price, tot_price, acc_id, email, full_name, residental_adress, zip_code, country, 
			mobile_number, city, region) 
			VALUES('$prod_id', '$name', '$quantity', '$price', '$tot_price', '".$_SESSION['user']->Get_id()."', '".$_SESSION['user']->Get_email()."', '".$_SESSION['user']->Get_full_name()."', 
			'".$_SESSION['user']->Get_residental()."', '".$_SESSION['user']->Get_zip_code()."', '".$_SESSION['user']->Get_country()."',
			'".$_SESSION['user']->Get_mobile()."', '".$_SESSION['user']->Get_city()."', '".$_SESSION['user']->Get_region()."')"; 
		$sth = $pdo->prepare($sql);
		$sth->execute();

	}elseif($var1 == "account" && $var2 == "nonAccount"){
		$acc_id = $_SESSION['user']->Get_id();
		$email = $_SESSION['user']->Get_email();
		$full_name= $_SESSION['user']->Get_full_name();
		$residental = $_SESSION['user']->Get_residental();
		$zip = $_SESSION['user']->Get_zip_code();
		$country = $_SESSION['user']->Get_country();
		$mobile = $_SESSION['user']->Get_mobile();
		$city = $_SESSION['user']->Get_city();
		$region = $_SESSION['user']->Get_region();

		if(isset($_POST['email']) && $_POST['email'] != ""){
			$email = $_POST['email'];
		}
		if(isset($_POST['name']) && $_POST['name'] != ""){
			$name = $_POST['name'];
		}
		if(isset($_POST['residental']) && $_POST['residental'] != ""){
			$residental = $_POST['residental'];
		}
		if(isset($_POST['zip']) && $_POST['zip'] != ""){
			$zip = $_POST['zip'];
		}
		if(isset($_POST['country']) && $_POST['country'] != ""){
			$country = $_POST['country'];
		}
		if(isset($_POST['mobile']) && $_POST['mobile'] != ""){
			$mobile = $_POST['mobile'];
		}
		if(isset($_POST['city']) && $_POST['city'] != ""){
			$city = $_POST['city'];
		}
		if(isset($_POST['region']) && $_POST['region'] != ""){
			$region = $_POST['region'];
		}

		$arrlength = count($_SESSION['cart']);
		$prod_id = "";
		$name = "";
		$quantity = "";
		$tot_price = "";
		$price = "";
		for($i = 0; $i < $arrlength; $i++){
			if($_SESSION['cart'][$i][2] != "*"){
				$prod_id = ($prod_id ."". $_SESSION['cart'][$i][0] ."\n");
				$name = ($name ."". $_SESSION['cart'][$i][1] ."\n");
				$quantity = ($quantity ."". $_SESSION['cart'][$i][2] ."\n");
				$price = ($price ."". $_SESSION['cart'][$i][3] ."\n");
				$tot_price = ($tot_price + ($_SESSION['cart'][$i][3] * $_SESSION['cart'][$i][2]));
			}
		}

		$sql = "INSERT INTO shipping(article_id, article_name, quantity, price, tot_price, acc_id, email, full_name, residental_adress, zip_code, country, 
			mobile_number, city, region) VALUES('$prod_id', '$name', '$quantity', '$price', '$tot_price', 
			'".$_SESSION['user']->Get_id()."', '".$email."', '".$name."', '".$residental."', '".$zip."', '".$country."',
			'".$mobile."', '".$city."', '".$region."')"; 
		$sth = $pdo->prepare($sql);
		$sth->execute();
	}
}

//Creates a pdf file of the order in the browser.
function printOrder(){
	require "../lib/FPDF/fpdf.php";

	class PDF extends FPDF
	{

	    var $B;
	    var $I;
	    var $U;
	    var $HREF;

	    function PDF($orientation='P', $unit='mm', $size='A4'){
	        // Call parent constructor
	        $this->FPDF($orientation,$unit,$size);
	        // Initialization
	        $this->B = 0;
	        $this->I = 0;
	        $this->U = 0;
	        $this->HREF = '';
	    }
	    function get_data(){
	        include "../include/connect_db.php";

	        $id = $_GET['id']; 

	        $order_id = 0;
	        $article_id = "";
	        $article = "";
	        $quantity = "";
	        $price = "";
	        $tot_price = "";
	        $email = "";
	        $full_name = "";
	        $residental_address = "";
	        $zip_code = "";
	        $country = "";
	        $mobile_number = "";
	        $city = "";
	        $region = "";
	        $time = "";

	        $data = array();

	        $sql = "SELECT * FROM shipping WHERE order_id=$id";
	        $sth = $pdo->prepare($sql);
	        $sth->execute();

	        $result = $sth->fetchAll();
	        foreach($result as $row){
	            $data[0] = $row['full_name'];
	            $data[1] = $row['email'];
	            $data[2] = $row['country'];
	            $data[3] = $row['region'];
	            $data[4] = $row['city'];
	            $data[5] = $row['residental_adress'];
	            $data[6] = $row['zip_code'];
	            $data[7] = $row['mobile_number'];
	            $data[8] = $row['time'];
	            $data[9] = $row['order_id'];
	            $data[10] = $row['article_id'];
	            $data[11] = $row['article_name'];
	            $data[12] = $row['quantity'];
	            $data[13] = $row['price'];
	            $data[14] = $row['tot_price'];
	            
	        }

	        return $data;
	    }

	    function OpenTag($tag, $attr){
	    // Opening tag
	    if($tag=='B' || $tag=='I' || $tag=='U')
	        $this->SetStyle($tag,true);
	    if($tag=='A')
	        $this->HREF = $attr['HREF'];
	    if($tag=='BR')
	        $this->Ln(5);
	    }

	    function SetStyle($tag, $enable){
	        // Modify style and select corresponding font
	        $this->$tag += ($enable ? 1 : -1);
	        $style = '';
	        foreach(array('B', 'I', 'U') as $s)
	        {
	            if($this->$s>0)
	                $style .= $s;
	        }
	        $this->SetFont('',$style);
	    }

	    function CloseTag($tag){
	        // Closing tag
	        if($tag=='B' || $tag=='I' || $tag=='U')
	            $this->SetStyle($tag,false);
	        if($tag=='A')
	            $this->HREF = '';
	    }

	    function PutLink($URL, $txt){
	        // Put a hyperlink
	        $this->SetTextColor(0,0,255);
	        $this->SetStyle('U',true);
	        $this->Write(5,$txt,$URL);
	        $this->SetStyle('U',false);
	        $this->SetTextColor(0);
	    }

	        // Simple table
	    function content($data)
	    {
	        /*-----Header-----*/

	        // Logo
	        //$this->Image('logo.png',10,6,30);
	        // Arial bold 15
	        $this->SetFont('Arial','B',15);
	        // Move to the right
	        $this->Cell(80);
	        // Title
	        $this->Cell(30,10,"Order list for order: ".$data[9]."");
	        // Line break
	        $this->Ln(20);

	        /*-----end of header-----*/

	        $text = array(
	            "Name: ",
	            "Email: ",
	            "Country: ",
	            "Region: ",
	            "City: ",
	            "Residental address: ",
	            "Zip code: ",
	            "Mobile number: ",
	            "Time ordered: "
	        );

	        $this->SetFont('Arial','B',12);
	        $this->Cell(30,10,"Customer information:");
	        $this->Ln(10);

	        for($i = 0; $i < count($text); $i++){
	            $this->SetFont('Arial','B',10);
	            $this->Cell(40,10,$text[$i]);
	            $this->SetFont('Arial','',10);
	            $this->Cell(60,10,$data[$i]);
	            $this->Ln(5);
	        }

	        $this->Ln(15);

	        $this->SetFont('Arial','B',12);
	        $this->Cell(30,10,"Products:");
	        $this->Ln(10);


	        $articles = array();
	        for($i = 0; $i < 4; $i++){
	            $articles[$i] = $data[$i+10];
	        }

	        $w = array("Article id: ", "Article name: ", "Quantity: ", "Price: ");
	        // Data
	        $this->SetFont('Arial','B',10);
	        for($i=0; $i < count($w); $i++){
	            $this->Cell(47,10,$w[$i],1,0,'C');
	        }
	        $this->Ln();

	        $string = "";
	        $x=$this->GetX();
	        $y=$this->GetY();

	        $this->Ln(10);
	        $this->SetXY($x,$y);
	        $this->MultiCell(47,10,$articles[0],0,'C');
	        $this->SetXY($x+47,$y);
	        $this->MultiCell(47,10,$articles[1],0,'C');
	        $this->SetXY($x+94,$y);
	        $this->MultiCell(47,10,$articles[2],0,'C');
	        $this->SetXY($x+141,$y);
	        $this->MultiCell(47,10,$articles[3],0,'C');
	        //$this->Ln(10);
	        //$this->SetXY($x+141,$y);
	        $this->MultiCell(191,10,"Total price: ".$data[14]." Kr",0,'R');
	        $this->Cell(0,0,'','T');
	    }

	    // Page footer
	    function Footer(){
	        // Position at 1.5 cm from bottom
	        $this->SetY(-15);
	        // Arial italic 8
	        $this->SetFont('Arial','I',8);
	        // Page number
	        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	    }
	}

	    // Instanciation of inherited class
	    $pdf = new PDF();

	    $data = $pdf->get_data();

	    //$pdf->SetAutoPageBreak(false);
	    $pdf->AliasNbPages();
	    $pdf->AddPage();
	    $pdf->SetFont('Times','',12);
	    $pdf->content($data);
	    $pdf->Output();
}

//Adds product to cart.
function addCart(){
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

		//Checks if there's a sale.
		$curPrice = 0;
		$curPrice = $i['price'];
		if($i['saleAll'] != 0){
			$curPrice = ($i['price'] * (1 - ($i['saleAll'] / 100)));
		}

		$content = array($i['id'], $i['name'], $amount, $curPrice);
		$aval = $i['availabillity'];

		$arrlength = count($_SESSION['cart']);

		//If true through whole add product process, a new product will be pushed into the array.
		$none = true;

		//Adds one product to a current product.
		if($choice == "1"){
			$aval = ($aval - 1);
			if($aval < 0){
				$_SESSION['no_stock'] = "There's currently no ".$i['name']." in stock, please return another time.";
				break;
			}else{
				for($n = 0; $n < $arrlength; $n++){
					if(!empty($_SESSION['cart'][$n])){
						$id = 0;
						$id = $_SESSION['cart'][$n][0];
						if($id == $i['id']){
							$amount = ($_SESSION['cart'][$n][2]);
							$_SESSION['cart'][$n][2] = $amount + 1;
							$none = false;
						}
					}else{
						array_filter($_SESSION['cart']);
					}
				}
				$sql = "UPDATE article SET availabillity=".$aval." WHERE id=".$i['id']."";
				$sth = $pdo->prepare($sql);
				$sth->execute();
			}
			//Takes away one from the product items.
		}elseif($choice == "0"){
			for($n = 0; $n < $arrlength; $n++){
				//if(array_key_exists($n, $_SESSION['cart'])){
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
						foreach($result as $row){
							$aval = $row['availabillity'];
							$aval = ($aval + 1);
						}

						$sql2 = "UPDATE article SET availabillity=".$aval." WHERE id=".$i['id']."";
						$sth2 = $pdo->prepare($sql2);
						$sth2->execute();

						if($_SESSION['cart'][$n][2] <= 0){
							$_SESSION['cart'][$n][2] = "*";
						}
						if(empty($_SESSION['cart'])){
							unset($_SESSION['cart']);
						}
					}
				//}
			}
			//Discards whole cart and adds the item quantity back to availabillity in database.
		}elseif($choice == "2"){
			if(!empty($_SESSION['cart'])){
				for($n = 0; $n < $arrlength; $n++){
					if(!empty($_SESSION[$n])){
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
				}
				unset($_SESSION['cart']);
			}
		}
		if(isset($_SESSION['cart'])){
			if($none == true){
				array_push($_SESSION['cart'], $content);
			}
		}
	}
	include "../components/shopping_cart.php";
}

//Shows sale in admin page.
function sale(){
	include "../include/connect_db.php";
	?>

	<div class="row">
		<div class="col-md-12">
			<h4>Create a sale on all products</h4>
			<div class="row">
				<div class="col-md-6">
					How big should the sale be?
				</div>
				
				<div class="col-md-2">
					<input id="percent" type="salePercent" class="form-control" placeholder="%" name="sale">
				</div>
				<div class="col-md-1">
					<button onclick="checkPercent()" data-animation="true" data-toggle="tooltip" data-placement="top" title="
						If 70% sale, it means 70% of original price will be displayed." class="btn btn-info btn-sm">Submit</button>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div id="currentPercent">
			</div>
		</div>
	</div>

	<?php
	include "../include/footer.php";
	?>

	<script language="javascript">
		function checkPercent() {
		    var percent = document.getElementById('percent');
		    var filter = /^([0-9])+$/;
		    if (!filter.test(percent.value)) {
			    alert('Please only use numbers');
			    percent.focus;
			    return false;
		 	}else{
		 		percent = $('#percent').val();
		 		setSale(percent, 0);
		 	}
		}
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		})
	</script>
	<?php
}

//Sets sale on all items.
function setSale(){
	include "../include/connect_db.php";

	$percent = $_POST['q'];

	$sql = "UPDATE article SET saleAll=$percent";
	$sth = $pdo->prepare($sql);
	$sth->execute();
}

//Shows current sale.
function curSale(){
	include "../include/connect_db.php";

	$sql = "SELECT DISTINCT saleAll FROM article";
	$sth = $pdo->prepare($sql);
	$sth->execute();

	$result = $sth->fetchAll();
	foreach($result as $row){
		?>
		<h5><strong>Current sale: </strong></h5> <?php echo $row['saleAll'] ."%"; ?>
		<?php
	}
}

//Non ajax functions.
function count_views($input_id){
	require "include/connect_db.php";

	$sql = "SELECT view FROM article WHERE id='$input_id'";
	$sth = $pdo->prepare($sql);
	$sth->execute();

	$result = $sth->fetchAll();
	foreach($result as $i){
		$view = $i['view'];
		$view = ($view + 1);

		$sql = "UPDATE article SET view=$view WHERE id='$input_id'";
		$sth = $pdo->prepare($sql);
		$sth->execute();
	}
}

function put_cart($input_id){
	require "include/connect_db.php";
	
	if(empty($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	}

	$amount = 1;

	$sql = "SELECT * FROM article WHERE id=$input_id";
	$sth = $pdo->prepare($sql);
	$sth->execute();

	$result = $sth->fetchAll();
	foreach($result as $i){
		//new Cart($i['id'], $i['name'], $amount, $i['price']);
		$content = array($i['id'], $i['name'], $amount, $i['price']);

		$arrlength = count($_SESSION['cart']);
		$none = true;

		for($n = 0; $n < $arrlength; $n++){
			$id = 0;
			$id = $_SESSION['cart'][$n][0];
			if($id == $i['id']){
				$amount = ($_SESSION['cart'][$n][2]);
				$_SESSION['cart'][$n][2] = $amount + 1;
				$none = false;

			}
		}
		if($none == true){
			array_push($_SESSION['cart'], $content);
		}
		}
}

//Different components containing only html or php/html for various places on the page.

?>