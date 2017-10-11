<?php
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