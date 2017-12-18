
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
								LEFT JOIN category on book.category_id =  category.category_id 
								where borrowdetails.borrow_status = 'returned'ORDER BY borrow.borrow_id DESC
								  ";
 $result = mysql_query($query);
 if(mysql_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
						<th>Accession No.</th> 
                          <th>Book Title</th>  
                         <th>ISBN</th> 
						  <th>author</th> 
							 <th>book published</th> 
							 <th>book publisher Name</th> 
							<th>Book Category</th>
					
						<th>Borrower</th>
						<th>Contact</th>
						<th>Type</th>
						<th>Year</th>
						<th>Returned after No. days</th>
	   <th>Date Returned</th>
	   <th>Date</th>
						<th>Time</th>
	   
                    </tr>
  ';
  while($row = mysql_fetch_array($result))
  {
	  $timestamp = strtotime($row['date_return']);
	  $date = date('d-m-Y', $timestamp);
     $time = date('Gi.s', $timestamp);
	  
	  	 $now = strtotime($row['date_return']); // or your date as well
$your_date = strtotime($row['date_borrow']);

$datediff = $now - $your_date;
$datediff =floor($datediff / (60 * 60 * 24));	  
   $output .= '
    <tr>  
                              <td>'.$row["book_id"].'</td>
                         <td>'.$row["book_title"].'</td>  
						 <td>'.$row["isbn"].'</td>  
						 <td>'.$row["author"].'</td>
						 <td>'.$row["book_pub"].'</td>
							 <td>'.$row["publisher_name"].'</td> 
						 
							<td>'.$row["classname"].'</td> 
                         <td>'.$row["firstname"].''.$row["lastname"].'</td>
						 <td>'.$row["contact"].'</td> 
						 <td>'.$row["type"].'</td> 
						 <td>'.$row["year_level"].'</td>
						 <td>'.$datediff.'</td>
						<td>'.$row["date_return"].'</td>
						<td>'.$date.'</td>
						<td>'.$time.'</td>
						
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