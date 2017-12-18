
<?php
include('dbcon.php');
ini_set('max_execution_time', 300);
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
                
                
                /*$prevQuery = "SELECT book_id FROM book WHERE isbn = '".$line[7]."'";
                $prevResult = mysql_query($prevQuery);
                $row_cnt = mysql_num_rows($prevResult);
                if($row_cnt > 0){
                    //update member data
                     mysql_query("UPDATE book SET book_id = '".$line[0]."',book_title = '".$line[1]."', category_id = '".$line[2]."', author = '".$line[3]."', book_copies = '".$line[4]."', book_pub = '".$line[5]."', publisher_name = '".$line[6]."', isbn = '".$line[7]."', copyright_year = '".$line[8]."',date_recieve = '".$line[9]."',date_added= '".$line[10]."',status = '".$line[11]."',p_price = '".$line[12]."',pages = '".$line[13]."',class = '".$line[14]."',nbook_issued = '".$line[15]."',nlost = '".$line[16]."',ndamage = '".$line[17]."',bill_date = '".$line[18]."' WHERE isbn = '".$line[7]."'");
                }else{*/
                    //$n1=NOW();
                    //insert member data into database
                    //mysql_query("insert into bill (tenant_id,room_id,bill_id,date_issued,issued_by,status) values('$tid','$id','$tid','$monv','$isby','$zero')")or die(mysql_error());
                  mysql_query("insert into book (book_id,book_title,category_id,author,book_copies,book_pub,publisher_name,isbn,copyright_year,date_receive,date_added,status,p_price,pages,class) VALUES ('".$line[0]."','".$line[1]."','".$line[2]."','".$line[3]."','".$line[4]."','".$line[5]."','".$line[6]."','".$line[7]."','".$line[8]."','".$line[15]."',NOW(),'".$line[11]."','".$line[12]."','".$line[13]."','".$line[14]."')") or die(mysql_error());
                
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
header("Location: books.php".$qstring);