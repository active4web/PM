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
<title><?= lang("wproject");?></title>
<?php include ("design/inc/header.php");?>
</head>
<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md">
		<!-- BEGIN HEADER -->
        <?php include ("design/inc/topbar.php");?>
        <!-- END HEADER -->
		<!-- BEGIN HEADER & CONTENT DIVIDER -->
		<div class="clearfix"> </div>
		<!-- END HEADER & CONTENT DIVIDER -->
		<!-- BEGIN CONTAINER -->
		<div class="page-container">
			<!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <?php include ("design/inc/sidebar.php");?>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
			<!-- BEGIN CONTENT -->
			<div class="page-content-wrapper">
				<!-- BEGIN CONTENT BODY -->
				<div class="page-content">
					<!-- BEGIN PAGE BREADCRUMB -->
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<a href="<?=$url.'admin';?>"> <?= lang("admin_panel");?></a>
							<i class="fa fa-circle"></i>
						</li>
						
						<li>
							<span class="active"><?= lang("wproject");?></span>
						</li>
					</ul>
					<!-- END PAGE BREADCRUMB -->

					<!-- Start Table Data -->
					<div class="row">
						<div class="col-md-12">
							<!-- BEGIN EXAMPLE TABLE PORTLET-->
							<div class="portlet light bordered">
								<div class="portlet-title">
									<div class="caption font-dark">
										<i class="icon-settings font-dark"></i>
										<span class="caption-subject bold uppercase"><?= lang("wproject");?></span>
									</div>
								</div>
								<span class="portlet-body">
									<div class="table-toolbar">
										<div class="row">
											<div class="col-md-12">
												<?php if($result_amount>0){
													if($this->session->userdata('projects_delete')=="projects_delete"){
													?>
													<div class="btn-group">
														<button id="sample_editable_1_2_new" class="btn sbold red delbutton_project"> <?= lang("delete");?>
															<i class="fa fa-remove"></i>
														</button>
													</div>
													<?php }?>
												<?php }?>
												<?php 
													if($this->session->userdata('projects_add')=="projects_add"){
													?>
													<div class="btn-group">
													<button id="sample_editable_1_2_new" class="btn sbold green addbutton"><?= lang("add");?> 
														<i class="fa fa-plus"></i>
													</button>
													</div>
													<?php }?>
													<?php 
													if($this->session->userdata('projects_add')=="projects_add"){
													?>
												<!--	<div class="btn-group">
													<button id="sample_editable_1_2_new" class="btn sbold green addallprojects"> كل المشاريع
														<i class="fa fa-plus"></i>
													</button>
													</div>
													<?php }?>

													<?php 
													if($this->session->userdata('current_project')=="current_project"||$this->session->userdata('allprojects_view')=="allprojects_view"){
													?>
													<div class="btn-group">
													<button id="sample_editable_1_2_new" class="btn sbold green addcurrent"> المشاريع الحالية
														<i class="fa fa-plus"></i>
													</button>
													</div>
													<?php }?>


													<?php 
													if($this->session->userdata('wait_project')=="wait_project"||$this->session->userdata('allprojects_view')=="allprojects_view"){
													?>
													<div class="btn-group">
													<button id="sample_editable_1_2_new" class="btn sbold green addwait"> المشاريع المنتظرة
														<i class="fa fa-plus"></i>
													</button>
													</div>
													<?php }?>

													<?php 
													if($this->session->userdata('future_project')=="future_project"||$this->session->userdata('allprojects_view')=="allprojects_view"){
													?>
													<div class="btn-group">
													<button id="sample_editable_1_2_new" class="btn sbold green addfuture"> المشاريع المستقبلية
														<i class="fa fa-plus"></i>
													</button>
													</div>
													<?php }?>

													<?php 
													if($this->session->userdata('finished_project')=="finished_project"||$this->session->userdata('allprojects_view')=="allprojects_view"){
													?>
													<div class="btn-group">
													<button id="sample_editable_1_2_new" class="btn sbold green addfinished"> المشاريع المنتهية
														<i class="fa fa-plus"></i>
													</button>
													</div>--->
													<?php }?>

											</div>
										</div>
									</div>
									<?php if(!empty($results)){?>
									<form action="<?=$url?>admin/projects/delete" method="POST" id="form">
									    <input type="hidden" name="project_id" value="1">
									<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1_2">
										<thead>
											<tr>
												<th>
													<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
														<input id="checkAll" type="checkbox" class="group-checkable" data-set="#sample_1_2 .checkboxes" />
														<span></span>
													</label>
												</th>
                                               <th><?=lang("code");?></th>
												<th> <?=lang("name");?></th>
												<th><?=lang("status");?></th>
												<th><?=lang("date");?></th>
												<th><?=lang("update");?></th>
												<th><?=lang("start");?></th>
												<th><?=lang("adding");?></th>
												<th><?=lang("pm");?></th>
												<?php if($this->session->userdata('teamwork_project')=="teamwork_project"){	?>
												<?php }?>
												<th> <?=lang("operations");?> </th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
											</tr>
										</tfoot>
										<tbody>
                                        <?php
                                            foreach($results as $data) {
											$id_magager=$data->id_magager;
											$user_id=$data->user_id;
											$status=$data->status;
											$start_date=$data->start_date;
											$task_start_date=$data->task_start_date;
											$manager_name=get_table_filed("tbl_users",array("id"=>$id_magager),"fname");
											$manager_lname=get_table_filed("tbl_users",array("id"=>$id_magager),"lname");
											$user_name=get_table_filed("tbl_users",array("id"=>$user_id),"fname");
											$user_lname=get_table_filed("tbl_users",array("id"=>$user_id),"lname");
											
											$email=get_table_filed("tbl_config",array("config_key"=>"site_email"),"config_value");
												if($data->select_date==1&&$task_start_date==""){
                                           $start_date=lang("undefined");
											}
											else  if($data->select_date==2&&$task_start_date==""){
												$start_date=$start_date	;
											}
												else  if($task_start_date!=""){
												$start_date=$task_start_date	;
											}
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
                                        ?>
											<tr class="odd gradeX">
												<td>
													<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
														<input name="check[]" type="checkbox" class="checkboxes" value="<?=$data->id;?>" />
														<span></span>
													</label>
												</td>
												<td> <?=$data->code;?> </td>
												<td><?=$data->name;?></td>
												<td> <?=$status;?> </td>
												<td> <?=$data->creation_date;?> </td>
												<td> <?=$data->update_date;?> </td>
												<td> <?=$start_date;?> </td>
												<td> <?=$user_name."".$user_lname;?> </td>
													<td> <?=$manager_name."".$manager_lname;?> </td>
												<td>
													<div class="btn-group">
														<button class="btn btn-xs red dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> <?= lang("operations");?>
															<i class="fa fa-angle-down"></i>
														</button>
														<ul class="dropdown-menu pull-left" role="menu">
															<li><a href="<?=$url?>admin/projects/files?project_id=1&id_project=<?=$data->id;?>">
															<i class="fa fa-file-pdf-o"></i>  <?= lang("files");?> </a></li>
															<li><a href="<?=$url?>admin/projects/details?project_id=1&id_project=<?=$data->id;?>">
															<i class="fa fa-eye"></i>  <?= lang("details");?> </a></li>
															<?php
														if($this->session->userdata('projects_edit')=="projects_edit"){
														?>
														<li><a href="<?=$url?>admin/projects/edit?project_id=1&id=<?=$data->id;?>"><i class="fa fa-pencil"></i> <?= lang("update");?> </a></li>
														<?php
														}
													 if($data->status!=4) {
														
														if($this->session->userdata('projects_delete')=="projects_delete"){
														?>
															<li><a href="<?=$url?>admin/projects/delete?project_id=1&id_projects=<?=$data->id;?>"><i class="fa fa-remove"></i> <?= lang("delete");?>  </a></li>
														<?php 
														}
														}
														if($this->session->userdata('project_status')=="project_status"){
														?>
														<li><a href="<?=$url?>admin/projects/project_status?project_id=1&id_projects=<?=$data->id;?>"><i class="fa fa-pencil"></i> <?= lang("status");?> </a></li>
														<?php 
														}
														if($this->session->userdata('project_users')=="project_users"){
														?>
	<!--<li><a href="<?=$url?>admin/projects/project_users?id_project=<?=$data->id;?>"><i class="fa fa-users"></i> فريق العمل </a></li>-->
														<?php }?>
														</ul>
													</div>
												</td>
											</tr>
                                            <?php }?>
										</tbody>
									</table>
									</form>
									<?php 
											
									  } else{?>
									<center><span class="caption-subject font-red bold uppercase"><?= lang("nodata");?></span></center>
									<?php }?>
								<div class="row">
                                    <div class="col-md-5 col-sm-5">
									<br>
                                        <div class="dataTables_info" id="sample_1_2_info" role="status" aria-live="polite">
                                        <ul class="nav nav-pills">
                                            <li>
                                            <a href="javascript:;"> <?= lang("total");?>  :
                                                <span class="badge badge-success pull-right"> <?php echo $result_amount; ?> </span>
                                            </a>
                                            </li>
                                        </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-sm-7">
                                        <div style="text-align: right;" class="dataTables_paginate paging_bootstrap_full_number" id="sample_1_2_paginate">
                                            <ul class="pagination" style="visibility: visible;">
                                                <?php echo $pagination; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
								</div>
							</div>
							<!-- END EXAMPLE TABLE PORTLET-->
						</div>
					</div>
					<!-- END Table Data-->

				</div>
				<!-- END CONTENT -->
		</div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <?php include ("design/inc/footer.php");?>
        <!-- END FOOTER -->

        <?php include ("design/inc/footer_js.php");?>
		<script>
$(document).ready(function(e) {
	
    $(".addbutton").click(function(e) {
        window.location.assign("<?= DIR?>admin/projects/add?project_id=1");
    });

	$(".addallprojects").click(function(e) {
        window.location.assign("<?= DIR?>admin/projects/allprojects");
    });

	$(".addcurrent").click(function(e) {
        window.location.assign("<?= DIR?>admin/projects/current_projects");
    });

	$(".addwait").click(function(e) {
        window.location.assign("<?= DIR?>admin/projects/wait");
    });
	$(".addfuture").click(function(e) {
        window.location.assign("<?= DIR?>admin/projects/future");
    });
	$(".addfinished").click(function(e) {
        window.location.assign("<?= DIR?>admin/projects/finished");
    });



	$(".delbutton").click(function(e) {
        window.location.assign("delete");
	});
});
</script>

<script>
$(document).ready(function(e) {
    $("#checkAll").change(function(){
		$("input[type=checkbox]").not("#checkAll").each(function() {
            this.checked=!this.checked;
        });
	});
	$(".delbutton_project").click(function(){

if($('input[type=checkbox]:not("#checkAll"):checked').length>0){
var b=confirm("<?= lang("delete_p");?>");
if(b==true){
$('#form').unbind('submit').submit();//renable submit
}
}
else{
window.stop();
//alert("<?=lang('row_one_alert');?>");
toastr.warning("<?=lang('row_one_alert');?>");
}

	});
});
</script>
<?php if(isset($_SESSION['msg']) && $_SESSION['msg']!=''){?>
<script>
$(document).ready(function(e) {
	toastr.success("<?php echo $_SESSION['msg']?>");
});
</script>
<?php }?>
</body>
</html>
