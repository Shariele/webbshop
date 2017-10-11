<!--This is the content shown at the index page. -->

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<!-- Indicators -->
					<ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1"></li>
					<li data-target="#myCarousel" data-slide-to="2"></li>
					<li data-target="#myCarousel" data-slide-to="3"></li>
					</ol>

					<!-- Wrapper for slides -->
					<div class="carousel-inner" role="listbox">
						<div class="item active">
							<div class="col-xs-12">
								<img class="img-rounded" border="0" name="myimage" src="http://placehold.it/700x400" alt="I have no picture yet!" width="100%" height="400">
							</div>
						</div>
						<div class="item">
							<div class="col-xs-12">
								<img class="img-rounded" border="0" name="myimage" src="http://placehold.it/700x400" alt="I have no picture yet!" width="100%" height="400">
							</div>
						</div>
						<div class="item">
							<div class="col-xs-12">
								<img class="img-rounded" border="0" name="myimage" src="http://placehold.it/700x400" alt="I have no picture yet!" width="100%" height="400">
							</div>
						</div>
						<div class="item">
							<div class="col-xs-12">
								<img class="img-rounded" border="0" name="myimage" src="http://placehold.it/700x400" alt="I have no picture yet!" width="100%" height="400">
							</div>
						</div>
					</div>

					<!-- Left and right controls -->
					<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
					</a>
					<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<center><h3>Our most popular products!</h3></center>
			</div>
		</div>
		<div class="row">
			<div class="col-md-11 col-md-offset-1">
				<?php
				$sql = "SELECT * FROM article ORDER BY view asc LIMIT 1, 8";
				$sth = $pdo->prepare($sql);
				$sth->execute();

				$result = $sth->fetchAll();
				foreach($result as $i){
					?>
					<div class="col-md-3 indexProducts" style="max-width:200px">
						<?php
						echo "<a href=\"detailed.php?id=$i[id]\"><center><h5>".$i['name']."</h5></center></a>";
						echo "<a href=\"detailed.php?id=$i[id]\"><img  class=\"img-rounded\" border=\"0\" name=\"myimage\" src=\"http://placehold.it/150\" alt=\"I have no picture yet!\" width=\"100%\" height=\"100%\"></a>";
						echo "<center><button class=\"butButton btn btn-warning btn-default\" onclick=\"add_prod($i[id], 1)\"><span class=\"glyphicon glyphicon-shopping-cart\" aria-hidden=\"true\">
							</span> $i[price] Add</button></center>";
						?>
					</div>
					<?php
				}
				?>
		</div>
	</div>
</div>

<?php include "./include/footer.php"; ?>