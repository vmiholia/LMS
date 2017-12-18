
<?php include('dbcon.php'); ?>

<?php  
//export.php  

//mysql_select_db('eb_lms',mysql_connect('localhost','root','root'))or die(mysql_error());
$output = '';
if(isset($_POST["export"]))
{
								$query = "select * from borrow
								LEFT JOIN member ON borrow.member_id = member.member_id
								LEFT JOIN borrowdetails ON borrow.borrow_id = borrowdetails.borrow_id
								LEFT JOIN book on borrowdetails.book_id =  book.book_id 
								where borrowdetails.borrow_status = 'returned'ORDER BY borrow.borrow_id DESC
								  ";
 $result = mysql_query($query);
 if(mysql_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>Book Title</th>  
                         <th>Borrower</th>  
                         <th>Year Level</th>  
       <th>Date Borrow</th>
       <th>Due Date</th>
	   <th>Date Returned</th>
                    </tr>
  ';
  while($row = mysql_fetch_array($result))
  {
   $output .= '	
    <tr>  
                         <td>'.$row["book_title"].'</td>  
                         <td>'.$row["firstname"].' '.$row["lastname"].'</td>  
                         <td>'.$row["year_level"].'</td>  
                       <td>'.$row["date_borrow"].'</td>  
                        <td>'.$row["due_date"].'</td>
						<td>'.$row["date_return"].'</td>
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
  echo $output;
 }
}
?>