<!--Registration page. --> 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register</title>
	<?php
	include "include/header.php";
	?>
</head>
<body>
	<div class="container">
		<div class="col-md-6 col-md-offset-3">
				<?php
				if(isset($_SESSION['existing_username'])){
					echo '<font color="red">' . $_SESSION['existing_username'] . '</font>';
					unset($_SESSION['existing_username']);
				}
				if(isset($_SESSION['success'])){
					echo '<font color="green">' . $_SESSION['success'] . '</font>';
					unset($_SESSION['success']);
				}
				?>
				<form action="actions_index.php?action=register" method="POST">
					<input type="username" id="username" class="form-control" placeholder="Username" name="username" required autofocus>
					<input style="margin-top:10px" id="password" type="password" class="form-control" placeholder="Password" name="password" required>
					<input style="margin-top:10px" type="e-mail" id="txtEmail" class="form-control" placeholder="E-mail" name="email" required>
					<button style="margin-top:10px" id="email" onclick="checkEmail()" class="btn btn-lg btn-primary" type="submit" name="button" value="register">Register</button>
				</form>
		</div>
    </div>
	
</body>
</html>

<script language="javascript">
function checkEmail() {

    var email = document.getElementById('txtEmail');
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!filter.test(email.value)) {
	    alert('Please provide a valid email address');
	    email.focus;
	    return false;
 	}
}
</script>