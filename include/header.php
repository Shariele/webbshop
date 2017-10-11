<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="img/favicon.png">

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">

<!-- Bootstrap core CSS -->
<link href="lib/css/bootstrap.min.css" rel="stylesheet">
<!--Behövs för att använda glyphicons -->
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

<link href="include/style.css" rel="stylesheet">

<?php
	include "include/classes/user.php";

	session_start();
	session_name("webshop");

	require "include/connect_db.php";
	include "include/functions.php";
?>




<?php include "components/header.php"; ?>

<!--jQuery-->
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
	$('.dropdown-menu').on({
		"click":function(e){
	      e.stopPropagation();
	    }
	});
</script>
<!--Bootstrap-->
<script src="lib/js/bootstrap.min.js"></script>
