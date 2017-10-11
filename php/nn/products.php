<?php
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
			?></div>
			<div class="buyMoreInfo">

						<?php
						echo substr($i['description'], 0, 100);
						?>
				<div class="row">
					<div class="col-sm-2 col-sm-offset-9">
						<button onclick="" class="butButton btn btn-warning btn-default"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true">
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