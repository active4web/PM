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
<html lang="en" dir="rtl">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8">
<title>المشاريع المستقبلية </title>
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
							<a href="<?=$url.'admin';?>">الرئيسية</a>
							<i class="fa fa-circle"></i>
						</li>
						
						<li>
							<span class="active">المشاريع المستقبلية  </span>
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
										<span class="caption-subject bold uppercase"> المشاريع المستقبلية</span>
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
					<button id="sample_editable_1_2_new" class="btn sbold red delbutton_project" type="button"> حذف مجموعة
															<i class="fa fa-remove"></i>
														</button>
													</div>
													<?php }?>
												<?php }?>
												<?php 
													if($this->session->userdata('projects_add')=="projects_add"){
													?>
													<div class="btn-group">
													<button id="sample_editable_1_2_new" class="btn sbold green addbutton" > إضافة مشروع
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
									    <input type="hidden" name="project_id" value="4">
									<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1_2">
										<thead>
											<tr>
												<th>
													<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
														<input id="checkAll" type="checkbox" class="group-checkable" data-set="#sample_1_2 .checkboxes" />
														<span></span>
													</label>
												</th>
												<th>الكود</th>
												<th> الاسم</th>
												<th>الحالة</th>
												<th>تاريخ الاضافة</th>
												<th>تاريخ التعديل</th>
												<th>تاريخ البداية</th>
												<th>المسئول</th>
												<th>مدير المشروع</th>
												<th> العمليات </th>
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
											$manager_name=get_table_filed("tbl_users",array("id"=>$id_magager),"fname");
											$user_id=get_table_filed("tbl_users",array("id"=>$user_id),"fname");
											$email=get_table_filed("tbl_config",array("config_key"=>"site_email"),"config_value");
											if($data->select_date==1){
                                            $start_date="غير محدد";
											}
											else {
												$start_date=$start_date	;
											}
											$status=$data->status	;
												switch($status){
													case 1:
													  $status="<span class='label label-sm label-danger' style='background-color:#e7505a !important'>قيد العمل</span>";
													  break;
													case 2:
													  $status="<span class='label label-sm label-success'>قيد الانتظار</span>";
													  break;
													  case 3:
													  $status="<span class='label label-sm label-success'>مستقبلى</span>";
													  break;
													  case 4:
													  $status="<span class='label label-sm label-success' style='background-color:#4099ff !important'>تم الانتهاء</span>";
													  break;
													default:
													  break; 
												}
                                        ?>
											<tr class="odd gradeX">
												<td>
													<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
														<input name="check[]" type="checkbox" class="checkboxes" required  value="<?=$data->id;?>" />
														<span></span>
													</label>
												</td>
												<td> <?=$data->code;?> </td>
												<td> <?=$data->name;?> </td>
												<td> <?=$status;?> </td>
												<td> <?=$data->creation_date;?> </td>
												<td> <?=$data->update_date;?> </td>
												<td> <?=$start_date;?> </td>
												<td> <?=$user_id;?> </td>
												<?php
												if( $this->session->userdata('clients_data')=="clients_data"){
												?>
												<td> <?=$manager_name;?> </td>
												<?php }?>
												<td>
													<div class="btn-group">
														<button class="btn btn-xs red dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> العمليات
															<i class="fa fa-angle-down"></i>
														</button>
														<ul class="dropdown-menu pull-left" role="menu">
															<li><a href="<?=$url?>admin/projects/files?project_id=4&id_project=<?=$data->id;?>">
															<i class="fa fa-file-pdf-o"></i> الملفات </a></li>
															<li><a href="<?=$url?>admin/projects/details?project_id=4&id_project=<?=$data->id;?>">
															<i class="fa fa-eye"></i> تفاصيل </a></li>
															<?php
														if($this->session->userdata('projects_edit')=="projects_edit"){
														?>
														<li><a href="<?=$url?>admin/projects/edit?project_id=4&id=<?=$data->id;?>"><i class="fa fa-pencil"></i> تعديل </a></li>
														<?php
														}
													 if($data->status!=4) {
														
														if($this->session->userdata('projects_delete')=="projects_delete"){
														?>
															<li>
															    <a class="deletebutton"><i class="fa fa-remove"></i> حذف </a>
															<input type="hidden" class="valuedelete" value="<?=$data->id;?>">
															</li>
														<?php 
														}
														}
														if($this->session->userdata('project_status')=="project_status"){
														?>
														<li><a href="<?=$url?>admin/projects/project_status?project_id=4&id_projects=<?=$data->id;?>"><i class="fa fa-pencil"></i>  حالة المشروع </a></li>
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
									<center><span class="caption-subject font-red bold uppercase">عفوا لاتوجد بيانات للعرض</span></center>
									<?php }?>
								<div class="row">
                                    <div class="col-md-5 col-sm-5">
									<br>
                                        <div class="dataTables_info" id="sample_1_2_info" role="status" aria-live="polite">
                                        <ul class="nav nav-pills">
                                            <li>
                                            <a href="javascript:;"> مجموع السجلات :
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
        window.location.assign("<?= DIR?>admin/projects/add?project_id=3");
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
	
$(".deletebutton").click(function(e) {
    var id=$(this).nextAll(".valuedelete").val();
    var b=confirm("حذف المشروع سوف يقوم بحذف كل مهامة");
    if(b==true){
    window.location.assign("<?=DIR?>admin/projects/delete?project_id=4&id_projects="+ id);
    }
    
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
	var b=confirm("حذف المشروع سوف يقوم بحذف كل مهامة");
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
