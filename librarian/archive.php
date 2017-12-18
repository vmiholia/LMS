<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('navbar_archive.php'); ?>
    <div class="container">
		<div class="margin-top">
			<div class="row">	
			<div class="span12">	
						<!--  -->
								    <ul class="nav nav-pills">
										<li   class="active"><a href="archive.php">Attendance</a></li>
									</ul>
						<!--  -->
						
							
								<h3>Enter Entry Number:</h3>
								
					
							<form class="form-horizontal" method="POST" action="send_attendance.php" enctype="multipart/form-data">
								<input type="text" id="inputEmail" name="firstname"  placeholder="Entry Number" required>
								<button name="submit" type="submit" class="btn btn-success"><i class="icon-save icon-large"></i>&nbsp;Sumbit</button>
							</form>
							
                            <table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="example">
								<div class="pull-right">
	
								</div>
							
                                <thead>
                                    <tr>
									    <th>Entry Numbers List:</th>  
										<th>Time In:</th>
										<th>Time Out:</th>
                                    </tr>
                                </thead>
                                <tbody>
								 
                                  <?php  $user_query=mysql_query("select * from attend")or die(mysql_error());
									while($row=mysql_fetch_array($user_query)){
									?>
									<tr class="del<?php echo $id ?>">
                                    <td><?php echo $row['attendance']; ?></td>
									<td><?php echo $row['date']; ?></td>
									<td><?php echo $row['odate']; ?></td>
                                    </tr>
									<?php  }  ?>
                                </tbody>
                            </table>
							
			
			</div>		
			</div>
		</div>
    </div>
<?php include('footer.php') ?>