<?php
require_once "../include/connect_db.php";

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
	echo "No products with that name are found.";
}


?>