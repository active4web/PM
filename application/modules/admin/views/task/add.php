<?php
//session_start();
ob_start();
if (!isset($_SESSION['admin_name']) || $_SESSION['admin_name'] == "") {
	header("Location:" . base_url() . "admin/login");
} else {
	$id_admin = $_SESSION['id_admin'];
	$admin_name = $_SESSION['admin_name'];
	$last_login = $_SESSION['last_login'];
	$curt = 'tasks';
}
$id_project=$this->input->get('id_project');
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" dir="<?=lang("rtl");?>">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8">
<title><?= lang ("add_task");?></title>
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
$id_projects=$this->input->get("id_project");
$status=get_table_filed("tbl_projects",array("id"=>$id_projects),"status");
if($status==1){
?>
<li>
<a href="<?= $url . 'admin/projects/current_projects'; ?>"><?=lang("cproject");?></a>
<i class="fa fa-circle"></i>
</li>
<?php }?>
<?php 
if($status==4){
?>
<li>
<a href="<?= $url . 'admin/projects/finished'; ?>"><?=lang("endproject");?></a>
<i class="fa fa-circle"></i>
</li>
<?php }?>
						<li>
							<a href="<?= $url . 'admin/task/tasks?id_project='.$id_project; ?>"><?=lang("task");?></a>
							<i class="fa fa-circle"></i>
						</li>
						
						
						
						<li>
							<span><?=lang("add_task");?></span>
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
															<i class="fa fa-gift"></i><?=lang("add_task");?></div>
													</div>
	                                   
													<div class="portlet light bordered form-fit" >
													           <div class="portlet-body form">
														    
														<div class="portlet-title" style="padding:0px;min-height:10px">
														    	<div class="col-md-12" style="text-align:center;font-size:11px;padding-top:10px;">
														    <label><?= lang("note_add_task");?> </label>
														    </div>
														    <hr>
															<div class="caption"></div>
															<div class="actions"></div>
														</div>
													
															<!-- BEGIN FORM-->
																<input type="hidden" value="1" id="service_type">
															<form id="myForm" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
															<input type="hidden" name="id_project" value="<?=$id_project?>">
																<div class="form-body">
										
																	<div class="form-group">
																		<div class="col-md-1"></div>
																		<div class="col-md-10">
																		<span class="help-block"><?= lang("name_task");?> </span>
																			<input name="name_task" id="mainid"  type="text" placeholder="<?= lang("name_task");?> " class="form-control" required>
																		</div>
																		<div class="col-md-1"></div>
																	</div>
																	
<style>
.font_style{    font-size: 14px;
color: #ef4136;}
</style>																


<div class="form-group">
<div class="col-md-12">
<div class="row">	
<div class="col-md-12" style="margin-bottom:10px;">
<span class="help-block"><?= lang("mydep");?></span>
</div>

<div class="col-md-6">
<div class="row" style="margin: 20px 0px;"> 
<div class="col-md-4 font_style text-right" style="line-height:20px;"><?= lang("mydep_curr");?> </div>
<div class="col-md-8"><input type="radio"  class="form-control" style="height:22px;width:20px" name="mydep" value="1" checked>  </div> </div>
</div>

<div class="col-md-6">
<div class="row" style="margin: 20px 0px;"> 
<div class="col-md-4 font_style text-right" style="line-height:20px;"> <?= lang("mydep_new");?></div>
<div class="col-md-8"><input type="radio"  class="form-control" style="height:22px;width:20px" name="mydep" value="2" > </div> </div>
</div>
<div class="col-md-1"></div>
<div class="col-md-10 dep_id" style="display:none">
<select class="form-control" name="dep_id"  style="padding:2px 12px;height:40px">
<?php
$main_service=get_table_data("services_type",array('view'=>'1','type'=>'1') , '', 'id','desc');
if(count($main_service)>0){
foreach($main_service as $main_service){
?>
<option value="<?=$main_service->id?>"><?=$main_service->name?></option>
<?php } }else {?>
<option value="0"><?= lang("nodata");?></option>
<?php }?>
<!-- <option value="2">Editor</option>-->
</select>  
</div>
<div class="col-md-1"></div>
																		</div>	
																		</div>


</div>

<div class="form-group">
<div class="col-md-1"></div>
<div class="col-md-10">
<span class="help-block"><?= lang("task_details");?> </span>
<textarea name="desc_ar" id="contents" style="width:100%;height:100px"></textarea>
<?php //echo $this->ckeditor->editor("desc_ar", "contents"); ?>
</div>
<div class="col-md-1"></div>
</div>
																
<div class="form-group">
<div class="row">
<div class="col-md-12" style="margin-bottom:10px;"><span class="help-block"><?= lang("task_type_job");?></span></div>



<div class="col-md-6">
<div class="row"> 
<div class="col-md-8 font_style text-right"><?= lang("task_type_current");?></div>
<div class="col-md-4"><input type="radio"  class="form-control" style="height:20px;width:20px" name="task_type_job" value="1" checked> </div>
</div>
</div>

<div class="col-md-6">
<div class="row"> 
<div class="col-md-8 font_style text-right"><?= lang("othertask");?></div>
<div class="col-md-4"><input type="radio"  class="form-control" style="height:20px;width:20px" name="task_type_job" value="2" > </div>
</div>
</div>


</div>

</div>



<div class="form-group">
<div class="row">
<div class="col-md-12" style="margin-bottom:10px;"><span class="help-block"><?= lang("task_status");?></span></div>


<div class="col-md-6">
<div class="row"> 
<div class="col-md-8 font_style text-right"><?= lang("task_type_new");?></div>
<div class="col-md-4"><input type="radio"  class="form-control" style="height:20px;width:20px" name="task_status_job" value="1" checked> </div>
</div>
</div>

<div class="col-md-6">
<div class="row"> 
<div class="col-md-8 font_style text-right"><?= lang("task_type_note");?></div>
<div class="col-md-4"><input type="radio"  class="form-control" style="height:20px;width:20px" name="task_status_job" value="2"> </div>
</div>
</div>

</div>

</div>
																	
													
																	

<div class="form-group">
<div class="col-md-6">
<div class="row">	
<div class="col-md-12" style="margin-bottom:10px;">
<span class="help-block"><?= lang("task_date");?></span>
</div>
<!----<div class="row" style="margin: 20px 0px;"> 
<div class="col-md-4 font_style text-right" style="line-height:20px;"><?= lang("select_unknown");?> </div>
<div class="col-md-8 "><input type="radio"  class="form-control" style="height:22px;width:20px" name="select_date" value="1" checked>  </div> </div>-->

<div class="row" style="margin: 20px 0px;"> 
<div class="col-md-4 font_style text-right" style="line-height:20px;"> <?= lang("select_start_date");?></div>
<div class="col-md-8"><input type="radio checked"  class="form-control" style="height:22px;width:20px;display:none" name="select_date" value="2" > </div> </div>
<div class="col-md-12"><input name="start_time" style="direction: ltr;width: 100%; display:block"   size="18" id="start_date" type="text"  class="form_datetime form-control" ></div>	
																		</div>	
																		</div>

<div class="col-md-6">
<div class="row">	
<div class="col-md-12" style="margin-bottom:10px;">    
<span class="help-block"><br></span></div>

<!--<div class="row" style="margin: 20px 0px;"> 
<div class="col-md-4 font_style text-right" style="line-height:20px;"><?= lang("auto_expiry_date");?></div>
<div class="col-md-8 "><input type="radio"  class="form-control" style="height:22px;width:20px" name="select_enddate" value="1" checked ></div></div>--->

<div class="row" style="margin: 20px 0px;"> 
<div class="col-md-4 font_style text-right" style="line-height:20px;"><?= lang("select_expiry_date");?> </div>
<div class="col-md-8 "><input type="radio"  class="form-control" style="height:22px;width:20px;display:none" name="select_enddate" checked value="2"  > </div></div>
<div class="col-md-12"><input name="enddate"    style="direction: ltr;width: 100%;display:block" size="18" id="enddate" type="text"  class="form_datetime form-control editable editable-click" ></div>
</div>

</div>
</div>



																	<div class="form-group">
																			<div class="col-md-12"><?= lang("duration_task");?></div>
																			<div class="col-md-1"></div>
																		<div class="col-md-5" style="padding:5px;">
																		    <span class="help-block font_style"><?= lang ("time_type");?></span>
												<select  id="time_type" class="form-control" name="time_type" style="height: auto;" required>
												    	<option value="1"><?= lang("with_hours");?></option>
												    <option value="2"><?= lang ("with_minutes");?></option>
												</select></div>
												
												<div class="col-md-5" style="padding:5px;">
																		<span class="help-block font_style"><?= lang("duration_task")?></span>
                            <input name="num_hrs" required style="direction: ltr;width:99%;" size="18" type=number step=any id="num" class="form-control" min="1" >
																		</div>
																		
																	</div>
																	
																		<div class="form-group">
																		<div class="col-md-12"><?= lang("duration_overtime_task");?></div>
																		<div class="col-md-1"></div>
																		<div class="col-md-5"  style="padding:5px;">
																		    <span class="help-block font_style"><?= lang("duration_overtime_type");?></span>
												<select  id="time_type" class="form-control" name="time_type_overtime" style="height: auto;" required>
												    	<option value="1"><?= lang("with_hours");?></option>
												    <option value="2"><?= lang("with_minutes");?></option>
												</select>
																		    
																		</div>
																		<div class="col-md-5" style="padding:5px;">
																		<span class="help-block font_style">  <?= lang("hrs_overtime");?> </span>
                            <input name="over_num_hrs" required style="direction: ltr;width:99%;" size="18" type=number step=any id="over_num_hrs" class="form-control" min="1" >
																		</div>
																		
																	</div>

                                                                <div class="form-group">
																				<div class="col-md-1"></div>
																				<div class="col-md-10">
																				<span class="help-block font_style"><?= lang("adding");?></span>
                        <select  id="select_manager_id" class="form-control" name="manager_id" style="height: auto;">
					
						<?php if($this->session->userdata('teamwork')=="teamwork"){	?>
						<option value="0"><?= lang("without");?></option>
					<?php	$manager_user = $this->db->get_where('tbl_users', array('view' => '1','status'=>'1'))->result();
						if (count($manager_user) > 0) {
						foreach ($manager_user as $manager_user) {
						$group_id=$manager_user->group_id;
						$job_description=get_table_filed("tbl_user_groups",array("id"=>$group_id),"name");
													?>
												
							<option value="<?= $manager_user->id; ?>"><?= $manager_user->fname."&nbsp&nbsp(".$job_description.")"; ?></option>
															<?php
                                                                  }
													          } 
																 }
																 else {
											$id_admin= $this->session->userdata('id_admin');
													$fname=get_table_filed("tbl_users",array("id"=>$id_admin),"fname");
													$group_id=get_table_filed("tbl_users",array("id"=>$id_admin),"group_id");
													$job_description=get_table_filed("tbl_user_groups",array("id"=>$group_id),"name");
                                                       
												                ?>
												                	<option value="<?= $id_admin; ?>"><?= $fname."&nbsp&nbsp(".$job_description.")"; ?></option>
												                	<?php }?>
																		</select>		
																				</div>
																				<div class="col-md-1"></div>
																			</div>
																			
																


																	<div class="form-actions">
																		<div class="row">
																			<div class="col-md-offset-3 col-md-9">
						                 	<button type="button" class="mainbutton btn green taskbutton">
																					<i class="fa fa-check"></i><?= lang("saved");?></button>
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
	
/*$(document).ready(function(e) {
	$("input[type='radio']").click(function(){
		var radioValue = $("input[name='select_date']:checked").val();
            if(radioValue==2){
               $("#start_date").show();
            }
			else {
				$("#start_date").hide();	
			}

var radioValue = $("input[name='select_enddate']:checked").val();
if(radioValue==2){
$("#enddate").show();
}
else {
$("#enddate").hide();	
}

        });
});*/
</script>

<script>
	//this script for select if time of start project selected or no as :
	 //if value==2 mean select start date or value =1 mean not selected date
	
$(document).ready(function(e) {
	$("input[name='mydep']").click(function(){
		var radioValue = $("input[name='mydep']:checked").val();
            if(radioValue==2){
               $(".dep_id").show();
            }
			else {
				$(".dep_id").hide();	
			}
});
});
</script>


<script type="text/javascript">
    $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
</script>  
</body>
</html>
