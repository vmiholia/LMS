


<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('navbar_borrow.php'); ?>
<style type="text/css">
	#example_filter{
	display:none;
}	
.dataTables_empty{
	display:none;
}
#example_info{
	display:none;
}
.row-fluid{
	display:none;	
}
</style>
    <div class="container">
		<div class="margin-top">
			<div class="row">	
				<div class="span12">

						<div class="alert alert-info"><strong>Borrowed Books</strong></div>
							<label>Search: <input type="text" name="search_book"></label>
								<button class="search_book btn btn-primary">OK</button>
                            <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">

                                <thead>
                                    <tr>
					<th>Accession No</th>
                                        <th>Book title</th>                                 
                                        <th>Borrower</th>                                 
                                        <th>Class</th>                                 
                                        <th>Date Borrow</th>                                 
                                        <th>Due Date</th>                                
                                        <th>Fine Status</th>
										<th>Borrow Status</th>
										<th class="action">Return</th>
                                    </tr>
                                </thead>
                                <tbody>
								 
                                  <?php  $user_query=mysql_query("select * from borrow
								LEFT JOIN member ON borrow.member_id = member.member_id
								LEFT JOIN borrowdetails ON borrow.borrow_id = borrowdetails.borrow_id
								LEFT JOIN book on borrowdetails.book_id =  book.book_id
								where borrowdetails.borrow_status = 'pending'
								ORDER BY borrow.borrow_id DESC
								  ")or die(mysql_error());
								  $book_details = array();
								  
									while($row=mysql_fetch_array($user_query)){
									$id=$row['borrow_id'];
									$book_id=$row['book_id'];
									$borrow_details_id=$row['borrow_details_id'];
									$book_details[$row['book_id']] = 1;
									?>
									<tr class="del<?php echo $id ?> <?php echo $row['book_id'] ?>">
									
				<td><?php echo $row['book_id']; ?></td>				                              
                                    <td><?php echo $row['book_title']; ?></td>
                                    <td><?php echo $row['firstname']." ".$row['lastname']; ?></td>
                                    <td><?php echo $row['year_level']; ?></td>
									<td><?php echo $row['date_borrow']; ?></td> 
                                    <td><?php echo $row['due_date']; ?> </td>
									<!--<td><?php echo $row['date_return']; ?></td>-->
									<td><?php $datecur = (date('d/m/Y'));	$duedate= ($row['due_date']);
									list($dayc, $monthc, $yearc) = split('[/.-]', $datecur);
									list($dayd, $monthd, $yeard) = split('[/.-]', $duedate);
									if($yearc==$yeard&&$monthc==$monthd){
										echo "Days left: ".($dayd-$dayc);
									}else if($yearc==$yeard&&$monthc!=$monthd){
										$monthdiff = $monthd-$monthc-1;
										$daydiff = 30-$dayc+$dayd;
										$daydiff = 30*$monthdiff+$daydiff;
										echo "Days left: ".($daydiff);
									}else if($yearc!=$yeard){
										$yeardiff=$yeard-$yearc-1;
										$monthdiff = 12-$monthc+$monthc-1;
										$daydiff = 30-$dayc+$dayd;
										$daydiff = 365*$yeardiff+30*$monthdiff+$daydiff;
										echo "Days left: ".($daydiff);
									}
								
									$datecur = implode('/', array_reverse(explode('/', $datecur)));
									$datecur=str_replace("/","",$datecur);
									$duedate = implode('/', array_reverse(explode('/', $duedate)));
									$duedate=str_replace("/","",$duedate);
									if(($datecur) > ($duedate))
										{echo "</br>Yes";} 
									else
										{echo "</br>No";} ?> </td>
									<td><?php echo $row['borrow_status'];?></td>
									<td> <a rel="tooltip"  title="Return" id="<?php echo $borrow_details_id; ?>" href="#delete_book<?php echo $borrow_details_id; ?>" data-toggle="modal"    class="btn btn-success"><i class="icon-check icon-large"></i>Return</a>
                                    <?php include('modal_return.php'); ?>
                         
									 
                                    </tr>
									<?php  } 
									//print_r($book_details); ?>
                                </tbody>
                            </table>
							

			</div>		
	
<script>	
$('.search_book').click(function(e){
	e.preventDefault();
	var id = $('input[name=search_book]').val();
	$('input[name=search_book]').val('');
	var tbody = document.getElementsByTagName('tbody')[0];
	var book_details = <?= json_encode($book_details); ?>;
	//console.log(book_details);
	for(var key in book_details){
		var c = '.'+key;
		if(key!=id){
			
			$(c).hide();
		}else{
			$(c).show();
		}
	}
});
$(".uniform_on").change(function(){
    var max= 3;
    if( $(".uniform_on:checked").length == max ){
	
        $(".uniform_on").attr('disabled', 'disabled');
		         alert('3 Books are allowed per borrow');
        $(".uniform_on:checked").removeAttr('disabled');
		
    }else{

         $(".uniform_on").removeAttr('disabled');
    }
})
</script>		
			</div>
		</div>
    </div>
<?php include('footer.php') ?>
