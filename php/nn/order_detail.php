<?php

include "../include/connect_db.php";

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
		<div class="col-md-4 col-md-offset-8">
			<?php echo "<button name=\"admin_btn\" data-href=\"php/phpScripts.php?id=$id&action=printOrder\" class=\"btn btn-primary btn-xs clickable-row\">Create order</button>"; ?>
			<?php echo "<button style=\"margin-left: 5px\" name=\"admin_btn\" onclick=\"status_update('status_upd', $id)\" class=\"btn btn-warning btn-xs\">Ship</button>"; ?>
			<strong>Shipped: </strong> <?php echo $row['shipped']; ?>
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
/*jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.document.location = $(this).data("href");
    });
});*/

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
