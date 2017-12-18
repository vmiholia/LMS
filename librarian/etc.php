<?php  $user_query=mysql_query("select * from book where status!= 'Borrowed' ")or die(mysql_error());
									while($row=mysql_fetch_array($user_query)){
									$id=$row['book_id'];  
									$cat_id=$row['category_id'];

											$cat_query = mysql_query("select * from category where category_id = '$cat_id'")or die(mysql_error());
											$cat_row = mysql_fetch_array($cat_query);
									?>
									<tr class="del<?php echo $id ?>">
									
									                              
                                    <td><?php echo $row['book_id']; ?></td>
                                    <td><?php echo $row['book_title']; ?></td>
									<td><?php echo $cat_row ['classname']; ?> </td> 
                                    <td><?php echo $row['author']; ?> </td> 
									 <td><?php echo $row['publisher_name']; ?></td>
									  <td><?php echo $row['status']; ?></td> 
									<?php include('toolttip_edit_delete.php'); ?>
                                    <td width="20">
												<input id="" class="uniform_on" name="selector[]" type="checkbox" value="<?php echo $id; ?>" >
												
                                    </td>
									
                                    </tr>
									<?php  }  ?>


<label>Search: <input type="text" name="search_book"></label>
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


while ($row=mysql_fetch_array($result)){ ?>
					<option value="<?php echo $row['member_id']; ?>" id="<?php echo $row['member_id']; ?>" class="year_level_class" data="<?php echo $year_level ?>"><?php echo $row['member_id']; ?></option>
					<?php }



<option></option>
				<?php $result_year =  mysql_query("SELECT DISTINCT(`year_level`) FROM member WHERE `year_level`!='faculty' ")or die(mysql_error()); 
				$student_detail = array();
				while($row_y = mysql_fetch_array($result_year)){
					$year_level = $row_y['year_level'];
					
					$result =  mysql_query("select * from member where year_level='$year_level'")or die(mysql_error()); 
					$student_detail[$year_level] = array();
					while ($row=mysql_fetch_array($result)){ 
						$student_detail[$year_level][$row['member_id']] = $row;
						?>
						<option value="<?php echo $row['member_id']; ?>" id="<?php echo $row['member_id']; ?>" class="year_level_class" data="<?php echo $year_level ?>"><?php echo $row['member_id']; ?></option>
						<?php
					}
				}

				 ?>
$.post("filter_student.php",
	{
		'class_name':classname,
	},
	function(data, status){
		document.getElementById('student_details').innerHTML = data;
		console.log(data);
		$('#student').css('pointer-events','');
	});







var classname = $('.year_class').val();
	var student_detail = <?= json_encode($student_detail); ?>;
	//var center_std_details = document.getElementById("student_details");
	//center_std_details.innerHTML = "";
	var select_std_detail = document.getElementById('student_details');
	console.log(select_std_detail);
	//select_std_detail.class = "chzn-select";
	//select_std_detail.name = "member-id";
	//var option = document.createElement('Option');
	var i=0;
	//select_std_detail.add(option,i);
	//console.log(Object.keys(student_detail[classname]).length);
	i+=1;
	for(var key in student_detail[classname]){
		var option = document.createElement('Option');
		option.setAttribute('value',student_detail[classname][key]['member_id']);
		option.setAttribute('value',student_detail[classname][key]['member_id']);
		option.text = student_detail[classname][key]['member_id'];
		//option.style.display = "block";
		select_std_detail.add(option,i);
		console.log(option);
		i+=1;
	}
	//select_std_detail.style.display = "block";
	console.log(select_std_detail);
	//center_std_details.appendChild(select_std_detail);