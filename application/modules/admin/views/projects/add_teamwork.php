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

$project_name=get_table_filed("tbl_projects",array("id"=>$this->input->get("id_project")),"name");
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
<title><?= lang("teamwork");?></title>
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
							<a href="<?=$url.'admin';?>"><?=lang('admin_panel');?></a>
							<i class="fa fa-circle"></i>
						</li>
					<li><?= $project_name; ?><i class="fa fa-circle"></i></li>
					<li><span class="active"><?= lang("teamwork");?></span></li>
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
															<i class="fa fa-gift"></i><?= lang("teamwork");?></div>
													</div>

													<div class="portlet light bordered form-fit">
														<div class="portlet-title">
															<div class="caption"></div>
															<div class="actions"></div>
														</div>
														<div class="portlet-body form">
															<!-- BEGIN FORM-->
															<input type="hidden" value="1" id="service_type">
															<form  id="myForm" class="form-horizontal form-bordered" >
															    <input type="hidden" name="project_id" value="<?= $this->input->get("id_project");?>">
																<div class="form-body">
										
																	
																


															

																		<div class="form-group">
																			<div class="col-md-1"></div>
																			<div class="col-md-10">
																		
																			<div class="row">
																			<?php
																			$services_type=get_table_data('tbl_users',array('view'=>'1','status'=>'1'),'','id','desc');
																			if(count($services_type)>0){
																				 foreach($services_type as $services_type){
																			?><div class="col-md-4 col-xs-12" style="margin-bottom:10px;text-align:justify">
																			<input type="checkbox" class="typeproject" name="services_type[]" value="<?=$services_type->id;?>">
																			<span style="padding-right:2px;"><?=$services_type->fname;?>&nbsp<?=$services_type->lname;?></span>
																			</div>
																				 <?php }?>
																			<?php }?>	
																			</div>																			
																			</div>
																			<div class="col-md-1"></div>
																		</div>



																	<div class="form-actions">
																		<div class="row">
																			<div class="col-md-offset-3 col-md-9">
																			<button type="button" class="mainbutton btn green teamwork_button">
																					<i class="fa fa-check"></i> <?= lang("saved");?></button>
																				<button type="button" class="btn default cancelbutton"><?= lang("delete");?></button>
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

</body>
</html>
