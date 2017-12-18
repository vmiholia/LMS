<?php
include('dbcon.php');
$data = "<select name='member_id' class='chzn-select' id='student_details' />";
$year_level = $_POST['class_name'];
$result =  mysql_query("select * from member where year_level='$year_level'")or die(mysql_error()); 
$student_detail[$year_level] = array();
while ($row=mysql_fetch_array($result)){ 
	$student_detail[$year_level][$row['member_id']] = $row;
	$data = $data."<option value=".$row['member_id']." id=".$row['member_id']." class='year_level_class'>".$row['firstname'].' '.$row['lastname'].' '.$row['member_id']."</option>";
}
$data = $data."</select>";
echo $data;

 ?>

