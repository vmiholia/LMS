<?php include('dbcon.php'); ?>

<?php  
//export.php  

//mysql_select_db('eb_lms',mysql_connect('localhost','root','root'))or die(mysql_error());
$output = '';
if(isset($_POST["export"]))
{
								$query = "select * from member";
								  
 $result = mysql_query($query);
 if(mysql_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
						<th>Member id</th> 
                         <th>Name</th>  
                         
                         <th>ADDRESS</th>  
						<th>CONTACT</th>
						<th>TYPE</th>
						<th>Year</th>
						<th>STATUS</th>
                    </tr>
  ';
  while($row = mysql_fetch_array($result))
  {
   $output .= '	
   
    <tr>
							 <td>'.$row["member_id"].'</td>
						<td>'.$row["firstname"].' '.$row["lastname"].'</td> 
					 
                          
                         <td>'.$row["address"].'</td>  
                       <td>'.$row["contact"].'</td>  
                        <td>'.$row["type"].'</td>
						<td>'.$row["year_level"].'</td>
						<td>'.$row["status"].'</td>
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