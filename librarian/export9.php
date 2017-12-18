<?php include('dbcon.php'); ?>
<?php  
//export.php  

//mysql_select_db('eb_lms',mysql_connect('localhost','root','root'))or die(mysql_error());
$output = '';
if(isset($_POST["export"]))
{
								$query = "select * from book where status = 'old'";
 $result = mysql_query($query);
 
 if(mysql_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                           <th>Accession No.</th> 
                        <th>Book Title</th>  
                         
						
						
						<th>Book Pub</th>
						<th>Publisher Name</th>
						<th>ISBN</th>
						<th>Book Copies</th>
						<th>Copy Right Year</th>
						<th>Date Added</th>
						
                    </tr>
  ';
  while($row = mysql_fetch_array($result))
  {
   $output .= '
    <tr>  
                          <td>'.$row["book_id"].'</td>
                         <td>'.$row["book_title"].'</td>  
                        
                        <td>'.$row["book_pub"].'</td>
						<td>'.$row["publisher_name"].'</td>  
                        <td>'.$row["isbn"].'</td> 
						<td>'.$row["book_copies"].'</td>
						<td>'.$row["copyright_year"].'</td> 
						<td>'.$row["date_added"].'</td> 
              
						 
                         
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