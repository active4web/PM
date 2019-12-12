<?php
$url=base_url();
ob_start();
if(!isset($_SESSION['admin_name'])||$_SESSION['admin_name']==""){ 
header("Location:$url"."admin/login"); 
}
else{
$id_admin=$_SESSION['id_admin'];
$admin_name=$_SESSION['admin_name'];
$last_login=$_SESSION['last_login'];
$curt='teamwork';
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
<title><?= lang("add");?></title>
<?php include ("design/inc/header.php");?>
</head>
<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md">
		<!-- BEGIN HEADER -->
        <?php include ("design/inc/topbar.php");?>
		<script type="text/javascript" src="<?=$url?>design/ckeditor/ckeditor.js"></script>
		<script type="text/javascript" src="<?=$url?>design/ckfinder/ckfinder.js"></script>

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
							<a href="<?=$url.'admin';?>"><?=lang('admin_panel');?></a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
                        <a href="<?=$url.'admin/teamwork/permissions';?>"><?= lang("permissions");?></a>
                        <i class="fa fa-circle"></i>
						</li>
                        <li>
                            <span class="active"><?= lang("add");?></span>
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
                                                    <i class="fa fa-gift"></i> <?= lang("add");?></div>
                                            </div>
                                        <div class="portlet light bordered form-fit">
                                            <div class="portlet-title">
                                                <div class="caption"></div>
                                                <div class="actions"></div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <input type="hidden" id="idresult" value="0">
                                                  <input type="hidden" id="service_type" value="1">
                                <form action="<?=$url;?>admin/teamwork/permission_action" id="myForm" class="form-horizontal form-bordered"  method="post" enctype="multipart/form-data">
                                                    <div class="form-body">
														
                                                        <div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block">الأسم</span>
                                                                <input type="text" id="txt" required placeholder="الأسم" class="form-control" name="name">
                                                                <!--<span class="help-block"> This is inline help </span>-->
															</div>
															<div class="col-md-2"></div>
                                                        </div>
                                                        <div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block">Name</span>
                                                                <input type="text" id="txt" required placeholder="Name" class="form-control" name="name_en">
                                                                <!--<span class="help-block"> This is inline help </span>-->
															</div>
															<div class="col-md-2"></div>
                                                        </div>
														
														<div class="form-group">
																			<div class="col-md-1"></div>
																			<div class="col-md-10">
																			<span class="help-block"><?= lang("permissions");?></span>
																			<div class="row">
																			<?php
																			$services_type=get_table_data('permissions',array('view'=>'1','type'=>'1'),'','id','desc');
																			if(count($services_type)>0){
																				 foreach($services_type as $services_type){
																			?><div class="col-md-3 col-xs-12" style="margin-bottom:10px;text-align:<?php if($lang == 'arabic'){ ?>right<?php }else {?>left <?php }?>">
																			<input type="checkbox" name="permissions[]" value="<?=$services_type->name;?>">
																			<span style="padding-right:2px;text-align:right;font-size:11px"><?php if($lang == 'arabic'){echo $services_type->title;}else {echo $services_type->title_eng;}?></span>
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
																			<span class="help-block"><?= lang("email_permissions");?></span>
																			<div class="row">
																			<?php
																			$email_type=get_table_data('permissions',array('view'=>'1','type'=>'0'),'','id','desc');
																			if(count($email_type)>0){
																				 foreach($email_type as $email_type){
																			?><div class="col-md-4 col-xs-12" style="margin-bottom:10px;text-align:justify">
																			<input type="checkbox" name="permissions_email[]" value="<?=$email_type->name;?>">
																			<span style="padding-right:2px;"><?=$email_type->title_eng;?></span>
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
<button type="button" class="btn green mainubtton  permissionsstatusbutton"><i class="fa fa-check"></i> <?= lang("saved");?></button>

<button type="button" class="btn default cancelbutton"><?= lang("cancel");?></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
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
<?php 
if(isset($_SESSION['msg'])){
?>
<script>
$(document).ready(function(e) {
 toastr.success("<?php echo $_SESSION['msg']?>");
});
</script>
<?php }?>


<script>
$(document).ready(function(e) {
$(".cancelbutton").click(function(e) {
window.history.back();
});
});
</script>
</body></html>
