

<?php // $this->load->view('header/header_title'); ?>
<?php $this->load->view('menu/menu'); ?>
<script>
function check(elem) {
    document.getElementById('mySelect1').disabled = !elem.selectedIndex;
}
</script>
    
		<link href="../../asset/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../asset/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
        <script src="../../asset/js/fileinput.js" type="text/javascript"></script>
        <script src="java/javasm.js" type="text/javasm.js" ></script>
                                    <div class="span15">
                                    <div class="text-right">
                                    </div>
<div class="span11"  style="margin-left : 25%">
	 <div class="span11"  style="margin-left : 25%">
	 <div class="container-signin">
 
	 <?php $attributes = array('id' => 'upload_pdf'); 
echo form_open_multipart('localhost/j3databox/index.php/mainFunction/do_upload', $attributes); ?>
													<div align="center">
                                                    <legend >เพิ่มหมวดเรื่อง</legend>
													</div>
                                                    <div class="form-inner">
                                               
                                                    <div class="input-prepend">
                                                    <div style="position:relative;">

                                                    <a class='' href='javascript:;'>
                                                    <table width="41%" border="0">
													<tr>
													  <div class="input-prepend">
                                                    <span class="add-on" style="width : 15%;  text-align: left;"><i class="icon-pencil"  ></i>  เรื่อง</span>
                                                    <input type='text' class='span6' id='head' name='head' />
                                                    </div>
													</tr>
                                                    <tr>
                                                    <td  > 
												
				 <div class="span1" >
   	                <input id="file-5" class="file" type="file" multiple  data-upload-url="#" >
                    <div id="errorBlock" class="help-block"></div>
                    </div>
					</td>
					   
					<td> 

					<div class="span1" >
			  <span class="add-on1"  >&nbsp;&nbsp;&nbsp;</span>
                    </div>
                    </td> 
						<td> 

					 <div class="span1" >
				    <input id="file-6" class="file" type="file" multiple  data-upload-url="#">
                    <div id="errorBlock" class="help-block"></div>
                    </div>
                    </td> 
                                                    </tr>
													<tr>
                                                    <td width="10px" > 
													<br>

													</td>									
                                                    </tr>
                                                    </table>
                                                    </div>				
                                                    </div>
                                                    
                                                 
                                                    <table>
													 <td>   

													<div class="input-prepend"><span class="add-on" >หมวดเรื่อง</span>
                                                    <select id='btn1'  class='span6' onchange="getComboA(this)">
																<?php
													foreach ($data_type as $row){
												    $type_id_ck = $row['type_id']."'";
                                                    echo "<option  value='".$type_id_ck.">".$row['type_name']."</option>";
													}
													?>
												    <?php
													foreach ($division as $row){
													$division_id_ck = $row['divisid']."'";
                                                    echo "<option   value='".$division_id_ck."-divisid'>".$row['divisname']."</option>";
													}
													?>
													
                                                    </select></td>
                                                    <tr>
                                                    <td>
																<input type="text" id="code" name="code" cols="45" rows="5"></input>
													<script>
													
													function getComboA(sel) {
														document.getElementById("code").value="nnnnnnnsss";
                                                    var value = sel.value;  
                                                	alert(value);
                                                     }

													</script>

													<div class="input-prepend"><span class="add-on"  >หมวดย่อย</span>
                                                     <div id="showajax" ></div>
													<script type="text/javascript" src="jquery-1.7.2.min.js"></script>
													<script type="text/javascript">
													$(document).ready(function(){
													$("#btn1").change(function(){
													$.post("http://localhost/j3databoxNEW/index.php/mainFunction/select", { 
													data1: $("#code").val()}, 
													function(data){
													$("#showajax").html(data);
													}
													);
													});
													});
													</script>
										
							

													 </td>
                                                    <td  valign="bottom" align="right"> 
							                        <div class="input-prepend" >
													<a class="flip"  >
                                                     <span class="add-on" >  + </span>
                                                    </a>
                                                    </div>
                                                   
                                                    </td>
                                                    </tr>
                                                   
                                                    </div>
													 <tr>
													 <td>
													
													 <div class="panel_hidden">
														 <table>
												    <tr>
														 <td>
													 <div class="input-prepend"><span class="add-on"  style="width : 20%;  text-align: left;">หมวดหลัก</span>
                                                     <select class='span5'  name="menu_master" id="menu_master"  >
                                                     <?php   foreach ($upload_menu_type as $row) {  echo "<option value=".$row['type_id'].">".$row['type_name']."</option>"; }  ?>
													 </select>
													    </td>
													</tr>
													<tr><td>&nbsp;</td></tr>
												    <tr>
														  <td>
													<div class="input-prepend"><span class="add-on" style="width : 20%;  text-align: left;">หมวดเรื่อง</span>
                                                    <input type='text'  id='menu_second' name='menu_second' class='span5' /></input>
														 </td>
														 <td>
														    <input type="button" name="id"></input>
														 <td>
													</tr>
														
												    </table>
													 </td>
													 </tr>
														</div>
													</table>
													<table>
													
                                            
                                                    <div class="input-prepend">
                                                     <span class="add-on" style="width : 15%;  text-align: left;">คำค้นหา</span>
                                                    <input type='text' class='span6' id='serach'  />
                                                    </div>
                                                    <div class="input-prepend">
                                                     <span class="add-on" style="width : 40%;  text-align: left;" style="width : 15%;">รายละเอียด</span><br>
                                                    <textarea rows="4" cols="1" class='span6' ></textarea>
                                                    </div>
                                                    </label>
                                                    </div>
													 </table>
                                                    <footer class="signin-actions">
                                         
													<a onclick="document.getElementById('upload_pdf').submit()" href="#" class="btn btn-small btn-danger">
                                                    <i   class="btn-icon-only icon-save"  >บันทึก</i>
                                                    </a>
													   
                                                    </footer>
                                                    </div>
                                                    <div class="row">          
                                    </div>
                                    </div>
									</div>
									</div>
        
                                    <?php    ?>
                                    <?php echo form_close(); ?>
                                    <?php $attributes = array('id' => 'myform'); 
                                    echo form_open('http://localhost/databoxx/index.php/mainFunction/save', $attributes); ?>
                                    <div class="span21">
                                    <input type="hidden" name="check" id="check" ></input>
<br>
<br>
                                    <table id="sample-table" class="table table-hover table-bordered tablesorter" >
                                    <thead>
                                    <tr>
                                    <th>รหัส</th>
                                    <th>เรื่อง</th>
                                    <th style="width: 30%" >คำค้นหา</th>
                                    <th style="width: 15%" >คำสัง</th>
                           
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <input type="hidden" name="databox_save" id="databox_save" > </input>
                                    <input type="hidden" name="subject_save" id="subject_save" > </input>
                                    <input type="hidden" name="databox_search_text_save" id="databox_search_text_save" > </input>
<?php

foreach ($upload as $row) { 

$databox_id       = $row['databox_id']; 
$subject          = $row['subject']; 
$databox_search  = $row['databox_search']; 
$databox_id_text  = $databox_id."id"; 
$subject_text  = $databox_id."subject"; 
$databox_search_text  = $databox_id."search"; 
$databox_id_div  = $databox_id."id_div"; 
$subject_div = $databox_id."subject_div"; 
$databox_search_div  = $databox_id."search_div"; 
$save_id  = $databox_id."save"; 
$add_id  = $databox_id."add";  

?>
                                    <script>
                                    //alert(<?php echo $databox_id;?>);
                                    </script>
                                    <tr>
                                    <td>
                                    <input type="text" name="databox_id" id="<?php echo  $databox_id_text;  ?>" value="<?php echo  $databox_id  ?>"   
                                    onkeypress="return runScript(event)" style="display: none" >
                                    <div id="<?php echo  $databox_id_div;  ?>"><?php echo  $databox_id  ?></div>
                                    </td>
                                    <td>
                                    <input type="text" name="subject" id="<?php echo  $subject_text;  ?>" value="<?php echo  $subject  ?>" 
                                    onkeypress="return runScript(event)" style="display: none" >
                                    <div id="<?php echo  $subject_div;  ?>"><?php echo  $subject  ?></div>
                                    </td>
                                    <td>
                                    <input type="text" name="databox_search"   id="<?php echo  $databox_search_text;  ?>" value="<?php echo  $databox_search  ?>" onkeypress="return runScript(event)" style="display: none" >
                                    <div id="<?php echo  $databox_search_div;  ?>" ><?php echo  $databox_search  ?>
                                    </div></td>
                                    <td class="td-actions"  >
                                            <div id="<?php echo  $add_id;  ?>"  >
                                    <a href="javascript:;" class="btn btn-small btn-info">
                                    <i class="btn-icon-only icon-ok"  onClick="add(
                                            '<?php echo  $databox_id_text  ?>','<?php echo  $subject_text ?>','<?php echo  $databox_search_text; ?>',
                                            '<?php echo  $databox_id  ?>','<?php echo  $subject  ?>','<?php echo  $databox_search  ?>',
                                            '<?php echo  $databox_id_div  ?>','<?php echo  $subject_div  ?>','<?php echo  $databox_search_div  ?>',
                                            '<?php echo  $save_id;  ?>','<?php echo  $add_id;  ?>');"></i>
                                    </a>
                                             <a href="javascript:;" class="btn btn-small btn-danger">
                                    <i class="btn-icon-only icon-remove" onClick="del_row(
                                            '<?php echo  $databox_id_text  ?>','<?php echo  $subject_text ?>','<?php echo  $databox_search_text; ?>',
                                            '<?php echo  $databox_id  ?>','<?php echo  $subject  ?>','<?php echo  $databox_search  ?>',
                                            '<?php echo  $databox_id_div  ?>','<?php echo  $subject_div  ?>','<?php echo  $databox_search_div  ?>',
                                            '<?php echo  $save_id;  ?>','<?php echo  $add_id;  ?>');"></i>
                                    </a>
                                    </div>
                                            <div id="<?php echo  $save_id;  ?>" style="display: none" >
                                    <a href="javascript:;" class="btn btn-small btn-info">
                                    <i class="btn-icon-only icon-save"  onClick="save(
                                            '<?php echo  $databox_id_text  ?>','<?php echo  $subject_text ?>','<?php echo  $databox_search_text; ?>',
                                            '<?php echo  $databox_id  ?>','<?php echo  $subject  ?>','<?php echo  $databox_search  ?>',
                                            '<?php echo  $databox_id_div  ?>','<?php echo  $subject_div  ?>','<?php echo  $databox_search_div  ?>',
                                            '<?php echo  $save_id  ?>');"  ></i>
                                               </a>
                                                     <a href="javascript:;" class="btn btn-small btn-danger">
                                                <i class="btn-icon-only icon-remove" onClick="close_row(
                                                        '<?php echo  $databox_id_text  ?>','<?php echo  $subject_text ?>','<?php echo  $databox_search_text; ?>',
                                                        '<?php echo  $databox_id  ?>','<?php echo  $subject  ?>','<?php echo  $databox_search  ?>',
                                                        '<?php echo  $databox_id_div  ?>','<?php echo  $subject_div  ?>','<?php echo  $databox_search_div  ?>',
                                                        '<?php echo  $save_id;  ?>','<?php echo  $add_id;  ?>');"></i>
                                                </a>
                                                </div>
                                                </td>
                                                </div>	    
                                                </tr>
                                             

<?php   } ?>
                                                </tbody>
                                                </table>																									
                                                </div>
                                                </div>
                                                </div>
                                                </div>

<?php echo form_close(); ?>
<?php $this->load->view('footer/footer'); ?>




