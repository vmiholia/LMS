<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('navbar_member.php'); ?>
    <div class="container">
		<div class="margin-top">
			<div class="row">	
			<div class="span12">	
		
             <div class="alert alert-info">Add Member</div>
			<p><a href="member.php" class="btn btn-info"><i class="icon-arrow-left icon-large"></i>&nbsp;Back</a></p>
<?php
//load the database configuration file


if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusMsgClass = 'alert-success';
            $statusMsg = 'Students data has been inserted successfully.';
            break;
        case 'err':
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusMsgClass = '';
            $statusMsg = '';
    }
}
?>
<div class="container">
    <?php if(!empty($statusMsg)){
        echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
    } ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            Members List
            <a href="javascript:void(0);" onclick="$('#importFrm').slideToggle();">Import Members</a>
        </div>
        <div class="panel-body">
            <form action="importData1.php" method="post" enctype="multipart/form-data" id="importFrm">
                <input type="file" name="file" />
                <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
            </form>
			<button><a href="Member.csv" download="demo.csv">Download Demo CSV </a></button>
			<!--<button><a href = "https://github.com/marshal1234/marshal/archive/master.zip" download>Click to Download demo file!</a></button>-->
			<a href="https://github.com/marshal1234/marshal/archive/master.zip"></a>
			<br>
			</br>
       <!--     <table class="table table-bordered  n1"  >
                <thead>
                    <tr>
                     <th>class</th>	
                      <th>Gender</th>
                      <th>FirstName</th>
                      <th>MiddleName</th>
                      <th>LastName</th>
					   <th>FatherName</th>
					    <th>Age</th>
						 <th>BirthDate</th>
						  <th>Adress</th>
						   <th>Contact</th>
						   <th>Discount_A</th>
						  <th>Discount_B</th>
						   <th>BusRoute</th>
						    <th width="1%" !important >AdmissionFee</th>
							 <th>DOR(yyyy/mm/dd)</th>
							 <th>discount</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                   /* //get records from database
                    $query=mysql_query("SELECT * FROM tenant ORDER BY tenant_id DESC ")or die(mysql_error());
					$row_cnt = mysql_num_rows($query);
                    if($row_cnt > 0){ 
                        while( $row = mysql_fetch_array($query)){ ?>
                    <tr>
                      <td><?php echo $row['room_id']; ?></td>
                      <td><?php echo $row['gender']; ?></td>
                      <td><?php echo $row['fname']; ?></td>
                      <td><?php echo $row['mname']; ?></td>
					  <td><?php echo $row['lname']; ?></td>
					  <td><?php echo $row['nname']; ?></td>
					  <td><?php echo $row['age']; ?></td>
					  <td><?php echo $row['bdate']; ?></td>
					  <td><?php echo $row['address']; ?></td>
					  <td><?php echo $row['contact']; ?></td>
					  <td><?php echo $row['dis_id2']; ?></td>
					  <td><?php echo $row['dis_id3']; ?></td>
					  <td><?php echo $row['busroute']; ?></td>
					  <td><?php echo $row['water']; ?></td>
					<td><?php echo $row['date_registered']; ?></td>
					<td><?php echo $row['dis_id']; ?></td>
                    </tr>
                    <?php } }else{ ?>
                    <tr><td colspan="5">No member(s) found.....</td></tr>
                    <?php } */?>
                </tbody>
            </table>
        </div>
    </div>
</div>
            </div>
            <!-- /.container-fluid --> 

        </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>	
			</div>		
			</div>
		</div>
    </div>
<?php include('footer.php') ?>