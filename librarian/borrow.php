
<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('navbar_borrow.php'); ?>
<style type="text/css">
	#student{
		display:none;
	}
	#example_filter{
	display:none;
}	
.dataTables_empty{
	display:none;
}
#example_info{
	display:none;
}
.row-fluid{
	display:none;	
}
</style>

  

ini_set('max_execution_time', 3000);

    <div class="container">
		<div class="margin-top">
			<div class="row">	
								<div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong><i class="icon-user icon-large"></i>&nbsp;Borrow Table</strong>
                                </div>

		<div class="span12">		

		<form method="post" action="borrow_save.php">

<div class="span3">
				Faculty: <input type="radio" name="bselector[]" class="borrower" value="fac"><br> 
                Student: <input type="radio" name="bselector[]" class="borrower" value="std"> 
                      
	
	           <div class="control-group" id="faculty" style="pointer-events: none;">
		
                 <center><b> <p>Pick Faculty</p></b> </center>

				<div class="controls">
					<center>
				<select name="member_id1" class="chzn-select"  />
				<option></option>
				<?php $result =  mysql_query("select * from member where year_level='faculty'")or die(mysql_error()); 
				while ($row=mysql_fetch_array($result)){ ?>
				<option value="<?php echo $row['member_id']; ?>"><?php echo $row['firstname'].' '.$row['lastname']; ?></option>
				<?php } ?>
				</select>
					</center>
				</div>
			     </div>
			
        	<div class="control-group" id="year_level" style="pointer-events: none;">
		
                 <center><b> <p>Pick Class</p></b> </center>

				<div class="controls">
					<center>
				<select name="member_id2" class="chzn-select year_class"  />
				<option></option>
				<?php $result =  mysql_query("SELECT DISTINCT(`year_level`) FROM member WHERE `year_level`!='faculty' ")or die(mysql_error()); 

				while ($row=mysql_fetch_array($result)){ ?>
				<option value="<?php echo $row['year_level']; ?>" ><?php echo $row['year_level']; ?></option>

				<?php } ?>
				</select>
					</center>
				</div>
			     </div>
			     <?php $result_year =  mysql_query("SELECT DISTINCT(`year_level`) FROM member WHERE `year_level`!='faculty' ")or die(mysql_error()); 
				$student_detail = array();
				while($row_y = mysql_fetch_array($result_year)){
					$year_level = $row_y['year_level'];
					
					$result =  mysql_query("select * from member where year_level='$year_level'")or die(mysql_error()); 
					$student_detail[$year_level] = array();
					while ($row=mysql_fetch_array($result)){ 
						$student_detail[$year_level][$row['member_id']] = $row;
					}
				}

				 ?>
			<div class="control-group" id="student" style="pointer-events: none;">
		
                 <center><b> <p>Pick Student</p></b> </center>

				<div class="controls">
					<center id="student_details">
				<!-- <select name="member_id" class="chzn-select" id="student_details" />
				<option></option>
				
				</select> -->
			</center>
				</div>
			     </div>
			
			
	
			<center>
			
			
				<div class="control-group"> 
					<label class="control-label" for="inputEmail">Due Date</label>
					<div class="controls">
					<input type="text"  class="w8em format-d-m-y highlight-days-67 range-low-today" name="due_date" id="sd" maxlength="10" style="border: 3px double #CCCCCC;" required/>
					</div>
				</div>
			
				<div class="control-group"> 
					<div class="controls">

								<button name="delete_student" class="btn btn-success"><i class="icon-plus-sign icon-large"></i> Borrow</button>
					</div>
				</div>
				
			</center>
			
	</div>
	
			
				<div class="span8">
						<div class="alert alert-success"><strong>Select Book</strong></div>
								<label>Search: <input type="text" name="search_book"></label>
								<button class="search_book btn btn-primary">OK</button>
								<?php  $user_query=mysql_query("select * from book")or die(mysql_error());
								$book_details = array();
								while($row=mysql_fetch_array($user_query)){
									$id=$row['book_id'];  
									$cat_id=$row['category_id'];
									$cat_query = mysql_query("select * from category where category_id = '$cat_id'")or die(mysql_error());
									$cat_row = mysql_fetch_array($cat_query);
									$book_details[$id] = array($row,$cat_row);
								}
								//print_r($book_details)
								?>
                            <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">

                                <thead>
                                    <tr>
                       						
                                        <th>Accession No.</th>                                 
                                        <th>Book title</th>                                 
                                        <th>Category</th>
										<th>Author</th>
										<th>Publisher name</th>
										<th>status</th>
										<th>Add</th>
										
                                    </tr>
                                    
                                </thead>
                                <p>Enter Accession No. To Search Book</p>
                                <tbody>
                                </tbody>
                            </table>
							
			    </form>
			</div>		
			</div>		
<script>	

var cart = [];
$('.borrower').change(function(){
	if($('.borrower:checked').val()=='std'){
		$('#faculty').children('center').children('b').children('p').css('color','#333333');
		$('#faculty').css('pointer-events','none');
		$('#student').css('pointer-events','none');
		$('#year_level').children('center').children('b').children('p').css('color','black');
		$('#year_level').css('pointer-events','');

	}else{
		$('#student').css('display','none');
		$('#year_level').children('center').children('b').children('p').css('color','#333333');
		$('#student').children('center').children('b').children('p').css('color','#333333');
		$('#year_level').css('pointer-events','none');
		$('#student').css('pointer-events','none');
		$('#faculty').children('center').children('b').children('p').css('color','black');
		$('#faculty').css('pointer-events','');
	}
});
$('.year_class').change(function(){
	var classname = $('.year_class').val();
	//console.log(classname);
	$.post("filter_student.php",
	{
		'class_name':classname,
	},
	function(data, status){
		document.getElementById('student_details').innerHTML = data;
		$('#student').children('center').children('b').children('p').css('color','black');
		$('#student').css('display','block');
		$('#student').css('pointer-events','');
	});
});
$('.search_book').click(function(e){
	e.preventDefault();
	var id = $('input[name=search_book]').val();

	$('input[name=search_book]').val('');
	var flag = 0;
	for(var i =0;i<cart.length;i++){
		if(parseInt(id)==cart[i]){
			flag=1;
			break;
		}
	}
	var tbody = document.getElementsByTagName('tbody')[0];
		for (var i=0;i<tbody.children.length;i++) {
			if(!tbody.childNodes[i].lastChild['children'].hasOwnProperty(0) || tbody.childNodes[i].lastChild['children'][0]['checked']==false){
	    		tbody.removeChild(tbody.childNodes[i]);
			}
		}
		var book_details = <?= json_encode($book_details); ?>;
		if(flag)
			return;
	if((book_details.hasOwnProperty(id)) && (parseInt(book_details[id][0]['book_copies'])>parseInt(book_details[id][0]['nbook_issued']) || book_details[id][0]['nbook_issued']=="")){
		var tr = document.createElement('tr');
		
		var td1 = document.createElement('td');
		var td2 = document.createElement('td');
		var td3 = document.createElement('td');
		var td4 = document.createElement('td');
		var td5 = document.createElement('td');
		var td6 = document.createElement('td');
		var td7 = document.createElement('td');
		td1.innerHTML = id;
		td2.innerHTML = book_details[id][0]['book_title'];
		td3.innerHTML = book_details[id][1]['classname'];
		td4.innerHTML = book_details[id][0]['author'];
		td5.innerHTML = book_details[id][0]['publisher_name'];
		td6.innerHTML = book_details[id][0]['status'];
		var checkbox = document.createElement('input');
		checkbox.addEventListener("change",function(){
			addBucket(this);
		});	
		checkbox.type = 'checkbox';
		checkbox.class="uniform_on"; 
		checkbox.name="selector[]";
		checkbox.value = id;
		checkbox.id = id;
		td7.appendChild(checkbox);
		tr.appendChild(td1);tr.appendChild(td2);
		tr.appendChild(td3);tr.appendChild(td4);
		tr.appendChild(td5);tr.appendChild(td6);
		tr.appendChild(td7);
		tbody.appendChild(tr);
	}else{
		alert("No copy available");
	}
});
$(".uniform_on").change(function(){
	console.log($(".uniform_on"));
    var max= 3;
    if( $(".uniform_on:checked").length == max ){
	
        $(".uniform_on").attr('disabled', 'disabled');
		         alert('3 Books are allowed per borrow');
        $(".uniform_on:checked").removeAttr('disabled');
		
    }else{

         $(".uniform_on").removeAttr('disabled');
    }
});



function addBucket(element){
	if(element.checked){
		cart.push(element.id);
	}else{
		var idx = cart.indexOf(element.id);
		cart.splice(idx,1);
	}
	console.log(cart);
}
</script>		
			</div>
		</div>
    </div>
   
<?php include('footer.php') ?>

