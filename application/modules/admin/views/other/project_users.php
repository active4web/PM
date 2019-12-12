<?php
//session_start();
ob_start();
if(!isset($_SESSION['admin_name'])||$_SESSION['admin_name']==""){ 
header("Location:".$url."admin/login"); 
}
else{
$id_admin=$_SESSION['id_admin'];
$admin_name=$_SESSION['admin_name'];
$last_login=$_SESSION['last_login'];
$curt='tasks';
}
foreach($data as $result_project)
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
<title>فريق العمل</title>
<?php include ("design/inc/header.php");?>
<style>
.mt-comments .mt-comment {
background-color: darkgoldenrod;
height: 75px;
}
</style>
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
<div class="page-content" style="min-height: 1261px;">
<!-- BEGIN PAGE HEAD-->

<!-- END PAGE HEAD-->
<!-- BEGIN PAGE BREADCRUMB -->
<ul class="page-breadcrumb breadcrumb">
<li>
<a href="<?=$url.'admin';?>">لوحة التحكم</a>
<i class="fa fa-circle"></i>
</li>
<li>
<a href="<?= $url . 'admin/task/tasks?id_project='.$this->input->get('id_project');?>">المهام</a>
<i class="fa fa-circle"></i>
</li>
<li>
<span class="active">فريق العمل</span>
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
			<i class="fa fa-gift"></i> فريق العمل</div>

	</div>

	<div class="portlet light bordered form-fit">
		<div class="portlet-title">
			<div class="caption"></div>
			<div class="actions"></div>
		</div>
		<div class="portlet-body form">
			<!-- BEGIN FORM-->
							<div class="portlet box yellow">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-gift"></i>  <?=$result_project->name;?></div>
									<div class="tools">
										<a href="javascript:;" class="collapse"> </a>
									</div>
								</div>
								<div class="portlet-body">
									<div class="row">
						
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="tab-content">
												<div class="tab-pane active" id="tab_6_1">
													<div class="portlet-body">
														<div class="table-responsive">
															<table class="table table-bordered">
															<tbody>
															<tr>
															<td>الاسم</td>
															<td>البريد الالكترونى</td>
															<td>المسمى الوظيفيى</td>
															<td>التخصص</td>
															</tr>
															</tbody>
																<tbody>

																<?php #endregion
																if(count($result)>0){
																foreach($result as $result){
																	$user_id=$result->user_id;
																	$teamleader=get_table_filed("tbl_users",array("id"=>$user_id),"fname");
																	$manager_lname=get_table_filed("tbl_users",array("id"=>$user_id),"lname");
																	$email=get_table_filed("tbl_users",array("id"=>$user_id),"email");
																	$group_id=get_table_filed("tbl_users",array("id"=>$user_id),"group_id");
																	$group_name=get_table_filed("tbl_user_groups",array("id"=>$group_id),"name");
																	$dep_id=get_table_filed("tbl_users",array("id"=>$user_id),"dep_id");
																	$dep_name=get_table_filed("services_type",array("id"=>$dep_id),"name");
																?>
																<tr>
																		<td> <?=$teamleader."&nbsp&nbsp;".$manager_lname;?> </td>
																		<td> <?=$email;?> </td>
																		<td> <?=$group_name;?> </td>
																		<td> <?=$dep_name;?> </td>

																	</tr>
																<?php }
																}
																else {
																?>
			<tr><td colspan="5">نأسف لعدم وجود محتوى</td></tr>
																<?php }?>
																</tbody>
															</table>
														</div>
													</div>
												</div>
												

											</div>
										</div>
									</div>
								</div>
							</div>
						












						
						</div>
						<div class="col-md-1"></div>
					</div>
			</div>
			<!-- END FORM-->
			</div>
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
<?php include ("design/inc/footer.php");?>
<!-- END FOOTER -->

<?php include ("design/inc/footer_js.php");?>
<script>
$(document).ready(function(e) {
$(".cancelbutton").click(function(e) {
window.location.assign("show");
});
});
</script>
</body>
</html>
