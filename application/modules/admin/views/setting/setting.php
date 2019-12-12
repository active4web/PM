<?php
//session_start();
ob_start();
if(!isset($_SESSION['admin_name'])||$_SESSION['admin_name']==""){ 
header("Location:".base_url()."admin/login"); 
}
else{
$id_admin=$_SESSION['id_admin'];
$admin_name=$_SESSION['admin_name'];
$last_login=$_SESSION['last_login'];
$curt='setting';
}
$site_info=$this->db->get_where('tbl_config',array('config_key'=>'site_email'))->result();
$site_info_name=$this->db->get_where('tbl_config',array('config_key'=>'site_name'))->result();
$site_info_logo=$this->db->get_where('tbl_config',array('config_key'=>'logo'))->result();
foreach($site_info as $site_info){
$site_email=$site_info->config_value;
}
foreach($site_info_logo as $site_info_logo){
	$logo_main=$site_info_logo->config_value;
	}
foreach($site_info_name as $site_info_name){
		$site_name=$site_info->config_value;
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
<title><?= lang("setting");?></title>
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
			<div class="page-content" style="min-height: 1261px;">
                    <!-- BEGIN PAGE HEAD-->
                    
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="<?=$url.'admin';?>"><?= lang("admin_panel");?></a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active"><?= lang("setting");?></span>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN PROFILE SIDEBAR -->
                            <div class="profile-sidebar">
                                <!-- PORTLET MAIN -->                                <!-- END PORTLET MAIN -->
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
                                                    <i class="fa fa-gift"></i><?= lang("setting");?></div>
                                            </div>
                                        <div class="portlet light bordered form-fit">
                                            <div class="portlet-title">
                                                <div class="caption"></div>
                                                <div class="actions"></div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="<?=$url;?>admin/update_setting" class="form-horizontal form-bordered"  method="post" enctype="multipart/form-data">
                                                    <div class="form-body">
                                                        
														<div class="form-group">
                                                            <div class="col-md-12" style="text-align:center">
																<div class="fileinput fileinput-new" data-provides="fileinput">
																	<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
																		<img src="<?=$url;?>uploads/site_setting/<?php echo $logo_main?>" alt="" />
																	</div>
																	<div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px;height: 150px;"> </div>
																	<div>
																		<span class="btn default btn-file">
																		<span class="fileinput-new"><?= lang("logo");?> </span>
																		<span class="fileinput-exists"><?= lang("change");?></span>
																		<input type="file" name="file"> </span>
																		<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> <?= lang("delete");?> </a>
																	</div>
																</div>
															</div>
                                                        </div>

                                                        <div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block"><?= lang("system_name");?></span>
								<input type="text" placeholder="<?= lang("system_name");?>" class="form-control" name="site_name" value="<?php echo $site_name?>">
                                                                
															</div>
															<div class="col-md-2"></div>
                                                        </div>
                                                      
														
													
														
														<div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block"><?= lang("system_email");?></span>
															<input type="text" placeholder="<?= lang("system_email");?>" class="form-control" name="sender_email" value="<?php echo $site_email?>">
                                                                <!--<span class="help-block"> This is inline help </span>-->
															</div>
															<div class="col-md-2"></div>
                                                        </div>
													
													
														
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn green">
                                                                <i class="fa fa-check"></i><?= lang("saved");?></button>
                                                                <button type="reset" class="btn default"><?= lang("cancel");?></button>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </form>
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
<?php 
if(isset($_SESSION['msg'])){
?>
<script>
$(document).ready(function(e) {
 toastr.success("<?php echo $_SESSION['msg']?>");
});
</script>
<?php }?>
</body></html>
