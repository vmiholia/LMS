<?php
include('dbcon.php');
?>



<?php
//load the database configuration file


if(isset($_POST['importSubmit'])){
    
    //validate whether uploaded file is a csv file
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes)){
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            //open uploaded csv file with read only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
             
            //skip first line
            fgetcsv($csvFile);
            
            //parse data from csv file line by line
			
            while(($line = fgetcsv($csvFile)) !== FALSE){
				
				
				$prevQuery = "SELECT member_id FROM member WHERE member_id = '".$line[0]."'";
                $prevResult = mysql_query($prevQuery);
				$row_cnt = mysql_num_rows($prevResult);
                if($row_cnt > 0){
                    //update member data
                     mysql_query("UPDATE member SET member_id = '".$line[0]."', firstname = '".$line[1]."', lastname = '".$line[2]."', gender = '".$line[3]."', address = '".$line[4]."', contact = '".$line[5]."', type = '".$line[6]."', year_level = '".$line[7]."',status = '".$line[8]."' WHERE member_id = '".$line[0]."'");
                }else{
					
                    //insert member data into database
					//mysql_query("insert into bill (tenant_id,room_id,bill_id,date_issued,issued_by,status) values('$tid','$id','$tid','$monv','$isby','$zero')")or die(mysql_error());
                  mysql_query("insert into member (member_id,firstname,lastname,gender,address,contact,type,year_level,status) VALUES ('".$line[0]."','".$line[1]."','".$line[2]."','".$line[3]."','".$line[4]."','".$line[5]."','".$line[6]."','".$line[7]."','".$line[8]."')") or die(mysql_error());
                
				
				
				
				
            }
			
						
				
				
                
                    
            }
			
			
            
            //close opened csv file
            fclose($csvFile);

            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

//redirect to the listing page
header("Location: member.php".$qstring);