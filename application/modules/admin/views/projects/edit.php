<?php
//session_start();
ob_start();
if(!isset($_SESSION['admin_name'])||$_SESSION['admin_name']==""){ 
 redirect(base_url().'admin/login/','refresh');
}
else{
$id_admin=$_SESSION['id_admin'];
$admin_name=$_SESSION['admin_name'];
$last_login=$_SESSION['last_login'];
$curt='allprojects';
}
foreach($data as $data)
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" dir="<?= lang("rtl");?>">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8">
<title><?= lang("update");?></title>
<?php include("design/inc/header.php"); ?>
</head>
<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md">
		<!-- BEGIN HEADER -->
		<?php include("design/inc/topbar.php"); ?>
		<script type="text/javascript" src="<?= $url ?>design/ckeditor/ckeditor.js"></script>
		<script type="text/javascript" src="<?= $url ?>design/ckfinder/ckfinder.js"></script>
        <!-- END HEADER -->
		<!-- BEGIN HEADER & CONTENT DIVIDER -->
		<div class="clearfix"> </div>
		<!-- END HEADER & CONTENT DIVIDER -->
		<!-- BEGIN CONTAINER -->
		<div class="page-container">
			<!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <?php include("design/inc/sidebar.php"); ?>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
			<!-- BEGIN CONTENT -->
			<div class="page-content-wrapper">
				<div class="page-content" style="min-height: 1261px;">
					<!-- BEGIN PAGE HEAD-->

					<!-- END PAGE HEAD-->
					<!-- BEGIN PAGE BREADCRUMB -->
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<a href="<?= $url . 'admin'; ?>"><?= lang('admin_panel'); ?></a>
							<i class="fa fa-circle"></i>
						</li>
											
												<?php 
if($this->input->get("project_id")==2){
?>

<li>
<a href="<?= $url . 'admin/projects/current_projects'; ?>"><?= lang("cproject");?></a>
<i class="fa fa-circle"></i>
</li>
<?php }?>

<?php 
if($this->input->get("project_id")==1){
?>

<li>
<a href="<?= $url . 'admin/projects/wait'; ?>"><?= lang("wproject");?></a>
<i class="fa fa-circle"></i>
</li>
<?php }?>

<?php 
if($this->input->get("project_id")==4){
?>

<li>
<a href="<?= $url . 'admin/projects/future'; ?>"><?= lang("fproject");?></a>
<i class="fa fa-circle"></i>
</li>
<?php }?>
<?php 
if($this->input->get("project_id")==3){
?>

<li>
<a href="<?= $url . 'admin/projects/finished'; ?>"><?= lang("endproject");?></a>
<i class="fa fa-circle"></i>
</li>
<?php }?>
						<li>
							<span><?= lang("update");?></span>
						</li>
					</ul>
					<!-- END PAGE BREADCRUMB -->
					<!-- BEGIN PAGE BASE CONTENT -->
					<div class="row">
						<div class="col-md-12">
							<!-- BEGIN PROFILE SIDEBAR -->
							<div class="profile-sidebar">
								<!-- PORTLET MAIN -->
								<!-- END PORTLET MAIN -->
								<!-- PORTLET MAIN -->

								<!-- END PORTLET MAIN -->
							</div>
							<!-- END BEGIN PROFILE SIDEBAR -->
							<!-- BEGIN PROFILE CONTENT -->
							<div class="profile-content">
								<div class="row">
									<div class="col-md-12">
										<!--Start from-->
										<div class="tab-content">
											<div class="tab-pane active" id="tab_5">
												<div class="portlet box blue ">
													<div class="portlet-title">
														<div class="caption">
															<i class="fa fa-gift"></i><?= lang("update");?></div>
													</div>

													<div class="portlet light bordered form-fit">
														<div class="portlet-title">
															<div class="caption"></div>
															<div class="actions"></div>
														</div>
														<div class="portlet-body form">
															<!-- BEGIN FORM-->
															<input type="hidden" value="2" id="service_type">
															<form  id="myForm" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
															<input type="hidden" name="project_id" value="<?= $this->input->get("project_id");?>">
															<input type="hidden" name="id" value="<?=$data->id;?>">
																<div class="form-body">
										
																	<div class="form-group">
																		<div class="col-md-1"></div>
																		<div class="col-md-10">
																		<span class="help-block"><?= lang("project_name");?></span>

																			<input name="name_project" id="mainid" type="text" value="<?=$data->name?>" placeholder="<?= lang("project_name");?>" class="form-control" required>
																		</div>
																		<div class="col-md-1"></div>
																	</div>
																	
																

																	<div class="form-group">
																		<div class="col-md-1"></div>
																		<div class="col-md-10">
																		<span class="help-block"><?= lang("project_details");?></span>
																		<textarea name="desc_ar" id="dcontents" style="width:100%;height:150px"><?=$data->details?></textarea>
																		</div>
																		<div class="col-md-1"></div>
																	</div>
																
																	
																
																	

															<!---	<div class="form-group">
																		<div class="col-md-1"></div>
																		<div class="col-md-10">
																		    
																		<span class="help-block"> <?= lang("start_date");?></span>
																			<div class="row">
																			    
									<div class="col-md-5 col-sm-12" style="margin-bottom:10px;">
									 <span style="line-height: 13px;vertical-align: text-bottom;">
									     <input type="radio" style="height:22px;width: 20px;" name="select_date" value="1" checked> </span> 
									 <span style="padding-right:2px;"><?= lang("select_unknown");?></span> </div>
									 
									<div class="col-md-5 col-sm-12" style="margin-bottom:10px;">
									 <span style="line-height: 13px;vertical-align: text-bottom;">
									 <input type="radio"   style="height:22px;width: 20px;" name="select_date" value="2" ></span>
									 	 <span style="padding-right:2px;"><?= lang("select_start_date");?>  </span> </div>
		<div class="col-md-12">
	<input name="start_time"  <?php if($data->select_date==1){?> value="<?=date("Y-m-d H:i");?>" <?php }else {?>value="<?php echo $data->start_date;?>"
<?php }?>
 style="direction: ltr;width: 100%; <?php if($data->select_date==1){?> display:none <?php }?>" size="18" id="meeting_start" type="text"  class="form_datetime form-control editable editable-click" >	
 </div></div>
 </div>
																		<div class="col-md-1"></div>
																	</div>--->
																	
																	
																	
<div class="form-group">
<div class="col-md-1"></div>
<div class="col-md-10">
<span class="help-block"><?= lang("start_date");?></span>
<input name="start_time" style="direction: ltr;width: 100%" size="18" id="start_date" type="text"  class="form_datetime form-control" value="<?php echo $data->start_date;?>">
</div>
<div class="col-md-1"></div>
</div>


<div class="form-group">
<div class="col-md-1"></div>
<div class="col-md-10">
<span class="help-block"> <?= lang("finished_date");?></span>
<input name="enddate"  style="direction: ltr;width: 100%;" size="18" id="enddate" type="text" 
class="form_datetime form-control editable editable-click" value="<?php echo $data->finish_date;?>">
</div>
<div class="col-md-1"></div>
</div>													
																	

<div class="form-group">

<div class="col-md-1"></div>
<div class="col-md-10" style="padding:5px;">
<span class="help-block"><?= lang("duration_project_hrs")?></span>
<input name="duration_project_hrs" value="<?php echo $data->total_hrs_project;?>" required style="direction: ltr;width:99%;"
size="18" type=number step=any id="num" class="form-control" min="1" >
</div>
<div class="col-md-1"></div>
</div>												
	
<div class="form-group">
<div class="col-md-1"></div>
<div class="col-md-10" style="padding:5px;">
<span class="help-block"><?= lang("duration_project_daies")?></span>
<input name="duration_project_daies" value="<?php echo $data->total_daies_project;?>"
required style="direction: ltr;width:99%;" size="18" type=number step=any id="num" class="form-control" min="1" >
</div>
<div class="col-md-1"></div>
</div>
		




																<div class="form-group">
																			<div class="col-md-1"></div>
																			<div class="col-md-10">
																			<span class="help-block"> <?= lang("project_status");?>
																			<Span><?php
																			$status=$data->status	;
																			$working_progress=lang("working_progress");
										$working_wait=lang("working_wait");
										$project_Future=lang("project_Future");
										$project_end=lang("project_end");
												switch($status){
													case 1:
													  $status="<span class='label label-sm label-danger' style='background-color:#e7505a !important'>$working_progress</span>";
													  break;
													case 2:
													  $status="<span class='label label-sm label-success'>$working_wait</span>";
													  break;
													  case 3:
													  $status="<span class='label label-sm label-success'>$project_Future</span>";
													  break;
													  case 4:
													  $status="<span class='label label-sm label-success' style='background-color:#4099ff !important'>$project_end</span>";
													  break;
													default:
													  break; 
												}
																			   echo $status;?></Span>
																			</span>
																			<select class="form-control" name="status_executed" style="height: auto;">
																			<option value=""><?= lang("select_pm"); ?></option>
																				<option value="1"><?= lang("cproject_status");?></option> n>
																	    	<option value="2"><?= lang("wproject_status");?></option>
																			<option value="3"><?= lang("fproject_status");?></option>
																			</select>																					
																			</div>
																			<div class="col-md-1"></div>
																		</div>

																		<div class="form-group">
																			<div class="col-md-1"></div>
																			<div class="col-md-10">
																			<span class="help-block"><?= lang("department");?></span>
																			<div class="row">
																			<?php
																			$type_id=explode(",",$data->type_id);
																			$deps_total_hrs=explode(",",$data->deps_total_hrs);
																			
                                                                   
                                                                        
																			$services_type=get_table_data('services_type',array('view'=>'1','type'=>'1'),'','id','desc');
																			if(count($services_type)>0){
																			    $count=0;
																				 foreach($services_type as $services_type){
																				     if(in_array($services_type->id,$type_id)){
																				         $index_key=array_search($services_type->id,$type_id);
																				     }
																			?>
<div class="col-md-3 col-xs-12" style="margin-bottom:10px;text-align:justify;height:50px">
<input type="text"  class="txt_typeproject  form-control"   <?php if(in_array($services_type->id,$type_id)){?>name="typeproject_time[]"  value="<?= $deps_total_hrs[$index_key]?>"<?php } else {?>value="0"<?php }?>
style="width:100px;block;font-size:13px;display:<?php if(in_array($services_type->id,$type_id)){?>block<?php } else {?>none<?php }?>" placeholder="<?= lang("deps_hrs_num");?>">														
<input type="checkbox" class="typeproject" name="services_type[]" value="<?=$services_type->id;?>" <?php if(in_array($services_type->id,$type_id)){?>
																			checked <?php } ?>
																			>
																			<span style="padding-right:2px;"><?=$services_type->name;?></span>
																			</div>
																				 <?php
																				 
																				 if(in_array($services_type->id,$type_id)){
																				 $count++;
																				 }
																				  
																				 
																				 }?>
																			<?php }?>	
																			</div>																			
																			</div>
																			<div class="col-md-1"></div>
																		</div>


																			<div class="form-group">
																				<div class="col-md-1"></div>
																				<div class="col-md-10">
																				<span class="help-block"> <?= lang("task_pm");?>
																				
																				<?php
																				$bb=get_table_filed('tbl_users',array('id'=>$data->id_magager),'fname');
																				if($bb!=""){echo "($bb)";}
																				?>
																				</span>

																				<select class="form-control" name="manager_id" style="height: auto;">
																				<option value=""><?= lang("select_pm");?></option>
																			<option value="0"><?= lang("without");?></option>
																			<?php
														$manager_user = $this->db->get_where('tbl_users', array('user_key' => 'MGH'))->result();
																		if (count($manager_user) > 0) {
																			foreach ($manager_user as $manager_user) {
																				?>
														<option value="<?= $manager_user->id; ?>"><?= $manager_user->fname; ?></option>
															<?php

													}
												} ?>
																		</select>		
																				</div>
																				<div class="col-md-1"></div>
																			</div>
																			
															


																	<div class="form-group">
																	<div class="col-md-1"></div>
																	<div class="col-md-10">
																		<div class="fileinput fileinput-new" data-provides="fileinput">
																						<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
																						<img src="<?=$url;?>uploads/projects/<?php echo $data->logo?>" alt="" />
																						</div>
																						<div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px;height: 150px;">
																						    
																						     </div>
																							<div>
																							<span class="btn default btn-file">
																								<span class="fileinput-new"><?= lang("proj_logo");?></span>
																								<span class="fileinput-exists"><?= lang("change");?></span>
																								<input type="file" name="img"> </span>
																								<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> <?= lang("delete");?> </a>
																						</div>
																					</div>
																					<p style="color:red;direction:<?= lang("rtl");?>"></p>
																		<p style="color:red;direction:<?= lang("rtl");?>"> <?= lang("img_height");?>  400 <?= lang("pixel");?></p>
																		<p style="direction:<?= lang("rtl");?>"><?= lang("img_height");?> 400 <?= lang("pixel");?></p>
																	</div>
																	<div class="col-md-1"></div>
																	</div>
																	
																	
																	
																	
																	


																	<div class="form-actions">
																		<div class="row">
																			<div class="col-md-offset-3 col-md-9">
																				<button type="button" class="mainbutton btn green projectkbutton">
																					<i class="fa fa-check"></i> <?= lang("saved");?></button>
																				<button type="button" class="btn default cancelbutton"><?= lang("cancel");?></button>
																			</div>
																		</div>
																	</div>
																</div>
														</form>
														<!-- END FORM-->
														</div>

													</div>
													<!---END FROM-->



												</div>
											</div>
											<!-- END PROFILE CONTENT -->
										</div>
									</div>
									<!-- END PAGE BASE CONTENT -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <?php include("design/inc/footer.php"); ?>
        <!-- END FOOTER -->

        <?php include("design/inc/footer_js.php"); ?>
<script>
$(document).ready(function(e) {
    $(".cancelbutton").click(function(e) {
 window.history.back();
    });
});
</script>
<script>
	//this script for select if time of start project selected or no as :
	 //if value==2 mean select start date or value =1 mean not selected date
	
$(document).ready(function(e) {
	$("input[type='radio']").click(function(){
		var radioValue = $("input[name='select_date']:checked").val();
            if(radioValue==2){
               $("#meeting_start").show();
            }
			else {
				$("#meeting_start").hide();	
			}
        });
});
</script>
<script type="text/javascript">
	//CKEDITOR.replace('description');
	var editor = CKEDITOR.replace( 'contents' );
	CKFinder.setupCKEditor( editor );
</script>
<script type="text/javascript">
    $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
</script>  

<script>
$(document).ready(function(e) {
$('.typeproject').click(function(){
if($(this).prop("checked") == true){
$(this).prev(".txt_typeproject").css("display","block");

$(this).prev(".txt_typeproject").prop("name","typeproject_time[]");
$(this).prev(".txt_typeproject").prop('required',true);
}
else if($(this).prop("checked") == false){
$(this).prev(".txt_typeproject").css("display","none");
$(this).prev(".txt_typeproject").val(0);
$(this).prev(".txt_typeproject").removeProp("name");
}
});



});
</script>

</body>
</html>
