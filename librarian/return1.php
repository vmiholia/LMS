<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('navbar_borrow.php'); ?>
    <div class="container">
		<div class="margin-top">
			<div class="row">	
				<div class="span12">		
						<div class="alert alert-info"><strong>Reports</strong></div>
                          <form method="post" action="export2.php">
     <input type="submit" name="export" class="btn btn-success" value="Attendance Report" />
    </form>
	
	  <form method="post" action="export4.php">
     <input type="submit" name="export" class="btn btn-success" value=" Borrowed Books  " />
    </form>
	
	
	<form method="post" action="export6.php">
     <input type="submit" name="export" class="btn btn-success" value=" Returned Books " />
    </form>
	
		 <form method="post" action="export8.php">
     <input type="submit" name="export" class="btn btn-success" value="    New Books    " />
    </form>
	
	 <form method="post" action="export9.php">
     <input type="submit" name="export" class="btn btn-success" value="    Old Books    " />
    </form>
	
	<form method="post" action="export11.php">
     <input type="submit" name="export" class="btn btn-success" value="    Lost Books    " />
    </form>
	
	 <form method="post" action="export10.php">
     <input type="submit" name="export" class="btn btn-success" value="  Damage Books  " />
    </form>
	
	 <form method="post" action="export5.php">
     <input type="submit" name="export" class="btn btn-success" value="    Books Stock    " />
    </form>
	
	<form method="post" action="export12.php">
     <input type="submit" name="export" class="btn btn-success" value="    Books Status    " />
    </form>
	
	 <form method="post" action="export7.php">
     <input type="submit" name="export" class="btn btn-success" value="Members of Library" />
    </form>
	
	
<?php include('footer.php'); ?>