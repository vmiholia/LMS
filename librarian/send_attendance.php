<?php 
include('dbcon.php');

if (isset($_POST['submit'])){
$entrynumber=$_POST['firstname'];	
	
			
//echo $tim;
$timezone = new DateTimeZone("Asia/Kolkata" );
$date = new DateTime();
$date->setTimezone($timezone );
//echo  $date->format( 'H:i:s A  /  D, M jS, Y' );
$tim = $date->format( 'H:i:s A  /  D, M jS, Y' );

$time = 255 * 60; //30 minutes
$start_time = date('H:i:s A  /  D, M jS, Y', time() + $time);
mysql_query("insert into attend(attendance,date,odate) values('$entrynumber','$tim','$start_time')")or die(mysql_error());
 
header('location:archive.php');
}
?>	