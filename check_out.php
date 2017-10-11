<!DOCTYPE html>
<!--Checkout page! -->
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Check out</title>
	<?php include "include/header.php"; ?>
</head>
<body onload="shipping('shipping', 1); show_cart(1,'nothing')">
	<div class="container" style="padding-bottom: 30px">
		<div class="row">
			<div class="col-md-12">
				<div class="radio">
				  <label>
				    <input type="radio" name="optionsRadios1" id="radio1" value="option1" onclick="shipping('shipping', 1); check1()" checked>
				    Use account specified shipping adress and information.
				  </label>
				</div>
				<div class="radio">
				  <label>
				    <input type="radio" name="optionsRadios2" id="radio2" value="option2" onclick="shipping('shipping', 2); check2()">
				    Specify shipping adress and other information.
				  </label>
				</div>
			</div>
			<div class="col-md-7">
				<div id="check_out" style="margin-top: 30px">
				</div>
			</div>
			<div class="col-md-5">
				<div id="show_cart" style="margin-top: 30px">
				</div>
			</div>
		</div>
	</div>
</body>
<script>
function check1() {
   var x =  document.getElementById("radio1").checked;
   if(x == true){
   		document.getElementById("radio2").checked = false;
   }else{
   		document.getElementById("radio1").checked = true;
   }
}
function check2() {
   var x =  document.getElementById("radio2").checked;
   if(x == true){
   		document.getElementById("radio1").checked = false;
   }else{
   		document.getElementById("radio2").checked = true;
   }
}
</script>
<?php include "include/footer.php"; ?>

</html>