<?php
include "../include/connect_db.php";
?>

<div class="row">
	<div class="col-md-12">
		<h4>Create a sale on all products</h4>
		<div class="row">
			<div class="col-md-6">
				How big should the sale be?
			</div>
			
			<div class="col-md-2">
				<input id="percent" type="salePercent" class="form-control" placeholder="%" name="sale">
			</div>
			<div class="col-md-1">
				<button onclick="checkPercent()" data-animation="true" data-toggle="tooltip" data-placement="top" title="
					If 70% sale, it means 70% of original price will be displayed." class="btn btn-info btn-sm">Submit</button>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div id="currentPercent">
		</div>
	</div>
</div>

<?php
include "../include/footer.php";
?>

<script language="javascript">
	function checkPercent() {
	    var percent = document.getElementById('percent');
	    var filter = /^([0-9])+$/;
	    if (!filter.test(percent.value)) {
		    alert('Please only use numbers');
		    percent.focus;
		    return false;
	 	}else{
	 		percent = $('#percent').val();
	 		setSale(percent, 0);
	 	}
	}
	$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	})
</script>


