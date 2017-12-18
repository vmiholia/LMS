	<?php
 	include('dbcon.php');
	
		$id=$_POST['selector'];
 	$member_id  = $_POST['member_id'];

        $member_id1  = $_POST['member_id1'];
       // echo $member_id1." ".$member_id;
        //die();
	$due_date  = $_POST['due_date'];

	if ($id == '' ){ 
	header("location: borrow.php");
	?>
	

	<?php }else{
		if($member_id == '')
		$member_id =$member_id1;
	
 echo $member_id1." ".$member_id;
 //die();
	mysql_query("insert into borrow (member_id,date_borrow,due_date) values ('$member_id',NOW(),'$due_date')")or die(mysql_error());
	$query = mysql_query("select * from borrow order by borrow_id DESC")or die(mysql_error());
	
	$row = mysql_fetch_array($query);
	$borrow_id  = $row['borrow_id']; 
		
		$N = count($id);
for($i=0; $i < $N; $i++)
{
	 mysql_query("insert borrowdetails (book_id,borrow_id,borrow_status) values('$id[$i]','$borrow_id','pending')")or die(mysql_error());
	$query2 = mysql_query("select * from borrowdetails order by borrow_id DESC")or die(mysql_error());
	$row2 = mysql_fetch_array($query2);
	$book_id    = $row2['book_id'];
	$query1 = mysql_query("select * from book where book_id='$book_id'")or die(mysql_error());
	$row1 = mysql_fetch_array($query1);
	$nbook_issued   = $row1['nbook_issued'];
	$nbook_issued++;
	if($nbook_issued==$row1['book_copies']){
		mysql_query("UPDATE book SET  status='Borrowed' where book.book_id='$book_id' ")or die(mysql_error());
	}
	mysql_query("UPDATE book SET  nbook_issued='$nbook_issued' where book.book_id='$book_id'")or die(mysql_error());	
}
		
	echo "borrowed successfully!";
// echo "<script type='text/javascript'>alert('Borrowed successfully!')</script>";
header( "location:borrow.php" );
}
 
?>
	
