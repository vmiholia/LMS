	<div id="delete_book<?php echo $borrow_details_id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-body">
			<div class="alert alert-success">Do you want to Return this Book?</div>

		</div>
		<div class="modal-footer">
		
		<form action="return_save.php" method="get">
		Fine Amount: <input type="number" name="dues" value=0></br>
			<a class="btn btn-success" href="return_save.php<?php echo '?id='.$id; ?>&<?php echo 'book_id='.$book_id; ?>">Return</a>
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			</form>
		</div>
    </div>
	
