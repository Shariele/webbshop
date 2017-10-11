<!--This is the sidebar shown in the products.php page. -->

<div class="row">
	<div class="col-md-6">
		<h5>Categories</h5>
	</div>
	<div class="col-md-4">
		<a href=""><h5 id="all">All</h5></a>
	</div>
</div>

<?php

$sql = "SELECT * FROM category";
$sth = $pdo->prepare($sql);
$sth->execute();

?>
<ul class="categories">
<?php

$result = $sth->fetchAll();

foreach($result as $row){
	echo "<li><a class='category' href=\"\">$row[name]</a></li>";
	$sql2 = "SELECT * FROM under_category WHERE cat_id=$row[id]";
	$sth2 = $pdo->prepare($sql2);
	$sth2->execute();

	$result2 = $sth2->fetchAll();

	?>
	<ul class="ul_under_categories">
		<?php
		foreach($result2 as $row2){
			echo "<li id='".$row2['id']."' class='$row[name]_under_category'><a href=\"\">$row2[name]</a></li>";
		}
		?>
	</ul>
	</br>
	<?php
}

?>
</ul>

<script>
	$(document).ready(function(){
        $(document).on('click', '.category', function(e) {
            e.preventDefault();

            var li = $("."+$(this).html()+"_under_category");
            $(li).slideToggle();
        })
    });

    $(document).ready(function(){
        $(document).on('click', '.ul_under_categories li', function(e) {
        	e.preventDefault();

        	show_products($(this).attr('id'), 1);
        })
    });

    $(document).ready(function(){
        $(document).on('click', '#all', function(e) {
            e.preventDefault();

            show_products('all');
        })
    });

</script>