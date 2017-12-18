<?php 
include('dbcon.php');
if (isset($_POST['submit'])){
$id=$_POST['id'];
$book_title=$_POST['book_title'];
$category_id=$_POST['category_id'];
$author=$_POST['author'];
$book_copies=$_POST['book_copies'];
$book_pub=$_POST['book_pub'];
$publisher_name=$_POST['publisher_name'];
$isbn=$_POST['isbn'];
$copyright_year=$_POST['copyright_year'];
/* $date_receive=$_POST['date_receive'];
$date_added=$_POST['date_added']; */
$status=$_POST['status'];
$s1=Lost;
$s2=Damage;

if($status==$s1)
{
	mysql_query("update book set book_title='$book_title',category_id='$category_id',author='$author'
,nlost = '$book_copies',book_pub = '$book_pub',publisher_name = '$publisher_name',isbn = '$isbn',copyright_year='$copyright_year',status='$status' where book_id='$id'")or die(mysql_error());
			
	
}
if($status==$s2)
{
	mysql_query("update book set book_title='$book_title',category_id='$category_id',author='$author'
,ndamage = '$book_copies',book_pub = '$book_pub',publisher_name = '$publisher_name',isbn = '$isbn',copyright_year='$copyright_year',status='$status' where book_id='$id'")or die(mysql_error());
			
	
}


else
{
mysql_query("update book set book_title='$book_title',category_id='$category_id',author='$author'
,book_copies = '$book_copies',book_pub = '$book_pub',publisher_name = '$publisher_name',isbn = '$isbn',copyright_year='$copyright_year',status='$status' where book_id='$id'")or die(mysql_error());
								
}								
 header('location:books.php');
}
?>	