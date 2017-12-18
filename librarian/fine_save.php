<?php 
include('dbcon.php');
//if (isset($_GET['submit']))
{ 
	$name = $_GET['dues'];
	//mysql_query("update borrow LEFT JOIN borrowdetails on borrow.borrow_id = borrowdetails.borrow_id set fine_amount ='$name' where borrow.borrow_id='$id' and borrowdetails.book_id = '$book_id'")or die(mysql_error());
}
?>
<html>
<body>
<?php

header('location:fine_save.php');?>

Welcome <?php echo $name; ?><br>

</body>
</html>