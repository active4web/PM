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
$reciver_email="";
foreach($data as $result)

if(count($send_email)>0){
foreach($send_email as $send_email){
$reciver_email= $send_email->email;
}
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
<title><?= lang("update");?></title>
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
                        <a href="<?=$url.'admin/teamwork';?>"><?= lang("teamwork");?></a>
                        <i class="fa fa-circle"></i>
						</li>
                        <li>
                            <span class="active"><?= lang("update");?></span>
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
                                <form action="" id="myForm" class="form-horizontal form-bordered"  method="post" enctype="multipart/form-data">
                                                  <input type="hidden" name="id" value="<?= $result->id;?>">
												    <div class="form-body">
														<div class="form-group">
														<div class="col-md-3" style="text-align:center"></div>
                                                            <div class="col-md-6" style="text-align:center">
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
															<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
																						<img src="<?=$url;?>uploads/teamwork/<?php echo $result->avatar?>" alt="" />
																						</div>
																			<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
																			<div>
																				<span class="btn default btn-file">
																					<span class="fileinput-new">صورة الفرد</span>
																					<span class="fileinput-exists">تغير</span>
																					<input type="file" name="file"> </span>
																				<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">حذف </a>
																			</div>
																		</div>
															</div>
															<div class="col-md-3" style="text-align:center"></div>
                                                        </div>
                                                        <div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block"><?= lang("fname");?></span>
                                                                <input type="text" id="fname" value="<?= $result->fname;?>" required placeholder="<?= lang("fname");?>" class="form-control" name="fname">
                                                                <!--<span class="help-block"> This is inline help </span>-->
															</div>
															<div class="col-md-2"></div>
                                                        </div>
                                                        <div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block"><?= lang("sname");?></span>
                                                                <input type="text" id="sname"  required value="<?= $result->sname;?>" placeholder="<?= lang("sname");?>" class="form-control" name="sname">
                                                                <!--<span class="help-block"> This is inline help </span>-->
															</div>
															<div class="col-md-2"></div>
                                                        </div>
														<div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block"><?= lang("lname");?></span>
                                                                <input type="text" id="lname" required value="<?= $result->lname;?>" placeholder="<?= lang("lname");?>" class="form-control" name="lname">
                                                                <!--<span class="help-block"> This is inline help </span>-->
															</div>
															<div class="col-md-2"></div>
                                                        </div>

														<div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block"><?= lang("email");?></span>
                                                                <input type="text" id="email" required value="<?= $result->email;?>" placeholder="<?= lang("email");?>" class="form-control" name="email">
                                                                <!--<span class="help-block"> This is inline help </span>-->
															</div>
															<div class="col-md-2"></div>
                                                        </div>

														<div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block"><?= lang("mail_sent");?></span>
                                                                <input type="text" id="send_email" value="<?= $reciver_email;?>" required placeholder="<?= lang("mail_sent");?>" class="form-control" name="send_email">
                                                                <!--<span class="help-block"> This is inline help </span>-->
															</div>
															<div class="col-md-2"></div>
                                                        </div>

														<div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block"> <?= lang("job_title");?>
															<?php
													$bb=get_table_filed('tbl_user_groups',array('id'=>$result->group_id),'name');
													if($bb!=""){echo "($bb)";}
													?>
															</span>
															<select class="form-control" name="group_id" style="padding:2px 12px;height:40px">
															<option value=""><?= lang("select_job_title");?></option>
															<?php
															$main_data=get_table_data("tbl_user_groups",array('view'=>'1') , '', 'id','desc');
															if(count($main_data)>0){
																foreach($main_data as $main_data){
															?>
                                                                <option value="<?=$main_data->id?>"><?php if($lang == 'arabic'){ echo $main_data->name ;?><?php } else {?><?=$main_data->name_eng?><?php }?></option>
																<?php } }else {?>
                                                               <option value="0"><?= lang("nodata");?></option>
																<?php }?>
                                                                <!--<option value="1">Admin</option>
                                                                <option value="2">Editor</option>-->
                                                            </select>
															</div>
															<div class="col-md-2"></div>
                                                        </div>
														

														<div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block"><?= lang("specialization");?>
															
															<?php
													$bb_service=get_table_filed('services_type',array('id'=>$result->dep_id),'name');
													if($bb_service!=""){echo "($bb_service)";}
													?>
															</span>
															<select class="form-control" name="dep_id"  style="padding:2px 12px;height:40px">
															<option value=""><?= lang("select_specialization");?></option>
															<?php
															$main_service=get_table_data("services_type",array('view'=>'1') , '', 'id','desc');
															if(count($main_service)>0){
																foreach($main_service as $main_service){
															?>
                                                                <option value="<?=$main_service->id?>"><?=$main_service->name?></option>
																<?php } }else {?>
                                                               <option value="0"><?= lang("nodata");?> </option>
																<?php }?>
                                                                <!-- <option value="2">Editor</option>-->
                                                            </select>
															</div>
															<div class="col-md-2"></div>
                                                        </div>
												
												
												
                                                        
												
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
<button type="button" class="mainbutton btn green teamworkbutton">
                                                                <i class="fa fa-check"></i><?= lang("saved");?></button>
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
