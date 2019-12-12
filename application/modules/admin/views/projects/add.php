<?php
//session_start();
ob_start();
if (!isset($_SESSION['admin_name']) || $_SESSION['admin_name'] == "") {
redirect(base_url().'admin/login/','refresh');
} else {
	$id_admin = $_SESSION['id_admin'];
	$admin_name = $_SESSION['admin_name'];
	$last_login = $_SESSION['last_login'];
	$curt = 'allprojects';
}
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
<title><?= lang("add_project");?></title>
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
							<a href="<?= $url . 'admin/projects/current_projects'; ?>"><?= lang('cproject'); ?></a>
							<i class="fa fa-circle"></i>
						</li>
						<?php }?>
					
						<?php 
						if($this->input->get("project_id")==1){
						?>
						
							<li>
							<a href="<?= $url . 'admin/projects/wait'; ?>"><?= lang('wproject'); ?></a>
							<i class="fa fa-circle"></i>
						</li>
						<?php }?>
						
							<?php 
						if($this->input->get("project_id")==3){
						?>
						
							<li>
							<a href="<?= $url . 'admin/projects/future'; ?>"><?= lang('fproject'); ?></a>
							<i class="fa fa-circle"></i>
						</li>
						<?php }?>
						<?php 
						if($this->input->get("project_id")==4){
						?>
						
							<li>
							<a href="<?= $url . 'admin/projects/finished'; ?>"><?= lang('endproject'); ?></a>
							<i class="fa fa-circle"></i>
						</li>
						<?php }?>
					
						<li>
							<span><?= lang('add_project'); ?></span>
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
															<i class="fa fa-gift"></i><?= lang('add_project'); ?></div>
													</div>

													<div class="portlet light bordered form-fit">
														<div class="portlet-title">
															<div class="caption"></div>
															<div class="actions"></div>
														</div>
														<div class="portlet-body form">
															<!-- BEGIN FORM-->
															<input type="hidden" value="1" id="service_type">
															<form  id="myForm" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
															    <input type="hidden" name="project_id" value="<?= $this->input->get("project_id");?>">
																<div class="form-body">
										
<div class="form-group">
<div class="col-md-1"></div>
<div class="col-md-10">
<span class="help-block"><?= lang('project_name'); ?></span>
<input name="name_project" id="mainid" type="text" placeholder="<?= lang('project_name'); ?>" class="form-control" required>
</div>
<div class="col-md-1"></div>
</div>
																	
																

<div class="form-group">
<div class="col-md-1"></div>
<div class="col-md-10">
<span class="help-block"><?= lang('project_details'); ?> </span>
<textarea name="desc_ar" id="contents" style="width:100%;height:150px"></textarea>
<?php //echo $this->ckeditor->editor("desc_ar", "contents"); ?>
</div>
<div class="col-md-1"></div>
</div>
																
																	
																
																	

<div class="form-group">
<div class="col-md-1"></div>
<div class="col-md-10">
<span class="help-block"><?= lang("start_date");?></span>
<input name="start_time" style="direction: ltr;width: 100%" size="18" id="start_date" type="text"  class="form_datetime form-control" >
</div>
<div class="col-md-1"></div>
</div>


<div class="form-group">
<div class="col-md-1"></div>
<div class="col-md-10">
<span class="help-block"> <?= lang("finished_date");?></span>
<input name="enddate"  style="direction: ltr;width: 100%;" size="18" id="enddate" type="text" 
class="form_datetime form-control editable editable-click" >
</div>
<div class="col-md-1"></div>
</div>


<div class="form-group">
<div class="col-md-1"></div>
<div class="col-md-10">
<span class="help-block"><?= lang("project_status");?></span>
<select class="form-control" name="status_executed" style="height: auto;">
<?php
if($this->input->get("project_id")==2){
?>
<option value="1"><?= lang("cproject_status");?></option> 
<?php }?>
<option value="2"><?= lang("wproject_status");?></option>
<option value="3"><?= lang("fproject_status");?></option>
</select>																					
</div>
<div class="col-md-1"></div>
</div>

<div class="form-group">
<div class="col-md-1"></div>
<div class="col-md-10" style="padding:5px;">
<span class="help-block"><?= lang("duration_project_hrs")?></span>
<input name="duration_project_hrs" required style="direction: ltr;width:99%;" size="18" type=number step=any id="hrs_num" class="form-control" min="1" >
</div>
</div>

<div class="form-group">
<div class="col-md-1"></div>
<div class="col-md-10" style="padding:5px;">
<span class="help-block"><?= lang("duration_project_daies")?></span>
<input name="duration_project_daies" required style="direction: ltr;width:99%;" size="18" type=number step=any id="daies_num" class="form-control" min="1" >
</div></div>
																	
<div class="form-group">
<div class="col-md-1"></div>
<div class="col-md-10">
<span class="help-block"><?= lang("department");?></span>
<div class="row">
<?php
$services_type=get_table_data('services_type',array('view'=>'1','type'=>'1'),'','id','desc');
if(count($services_type)>0){
foreach($services_type as $services_type){
?>
<div class="col-md-3 col-xs-12" style="margin-bottom:2px;text-align:justify;min-height:60px">

<input type="text" value="0" class="txt_typeproject  form-control"  style="width:100px;display:none;font-size:13px"
placeholder="<?= lang("deps_hrs_num");?>">
<input type="checkbox" class="typeproject" name="services_type[]" value="<?=$services_type->id;?>">	
<span style="padding-right:2px;"><?=$services_type->name;?></span>
</div>
<?php }?>
<?php }?>	
</div>																			
</div>
<div class="col-md-1"></div>
</div>


																			<div class="form-group">
																				<div class="col-md-1"></div>
																				<div class="col-md-10">
																				<span class="help-block"><?= lang("task_pm");?></span>
																	<select class="form-control" id="select_manager_id" name="manager_id" style="height: auto;">
																			<option value="0"><?= lang("without");?></option>
																			<?php
														$manager_user = $this->db->get_where('tbl_users', array('view' => '1','status'=>'1'))->result();
														
																		if (count($manager_user) > 0) {
																			foreach ($manager_user as $manager_user) {
																				$group_id=$manager_user->group_id;
													$job_description=get_table_filed("tbl_user_groups",array("id"=>$group_id),"name");
																				?>
														<option value="<?= $manager_user->id; ?>"><?= $manager_user->fname."&nbsp;&nbsp;".$manager_user->lname."&nbsp&nbsp(".$job_description.")"; ?></option>
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
																						<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"></div>
																						<div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px; height: 150px;"> </div>
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
               $("#start_date").show();
            }
			else {
				$("#start_date").hide();	
			}
        });
});
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
