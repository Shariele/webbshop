<?php

include "../include/connect_db.php";


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
					echo "<tr class=\"clickable-row\" onClick=\"admin('order_link', $row[order_id]); status_update('status', $row[order_id])\">";
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