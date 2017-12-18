
<?php include('dbcon.php'); ?>			
<?php  

//export.php  
//mysql_select_db('eb_lms',mysql_connect('localhost','root','root'))or die(mysql_error());
$output = '';
if(isset($_POST["export"]))
{
								$query = "select * from member,attend where member.member_id=attend.attendance ";
 $result = mysql_query($query);
 if(mysql_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>Name</th>
						 <th>Gender</th>
							 <th>Address</th>
							  <th>Contact</th>
							   <th>Type</th>
							    <th>Year</th>
								<th>Time In</th>
								<th>Time Out</th>
								 <th>Status</th>
        
                    </tr>
  ';
  while($row = mysql_fetch_array($result))
  {
	  $dat=
   $output .= '
    <tr>  				
						<td>'.$row["firstname"].''.$row["lastname"].'</td>
                         <td>'.$row["gender"].'</td> 
						 <td>'.$row["address"].'</td>
						 <td>'.$row["contact"].'</td>
						 <td>'.$row["type"].'</td>
						 <td>'.$row["year_level"].'</td>
						 <td>'.$row["date"].'</td>
						 <td>'.$row["odate"].'</td>
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