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
		    			<button name="order_btn" value="account" onclick="place_order(this.value)" class="btn btn-success btn-ms">Submit</button>
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
		    			<button name="search_btn" value="account" onclick="" class="btn btn-success btn-ms">Submit</button>
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
?>