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
$curt='other_task';
$url=base_url();
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
<title> <?= lang("status");?> </title>
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
<li>
<a href="<?= $url?>admin/other/tasks"><?= lang("othertask");?></a>
<i class="fa fa-circle"></i>
</li>
<li>
<span><?= lang("status");?></span>
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
							<i class="fa fa-gift"></i><?= lang("status");?></div>
					</div>

					<div class="portlet light bordered form-fit">
						<div class="portlet-title">
							<div class="caption"></div>
							<div class="actions"></div>
						</div>
						<div class="portlet-body form">
						    	<input type="hidden" id="idresult" value="0">
				<form action="<?php echo $url ?>admin/other/status_action"  id="myForm" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
								<div class="form-body">
		
									
									
								
									
								
									

									<div class="form-group">
										<div class="col-md-1"></div>
										<div class="col-md-10">

		    <?php $status=get_table_filed("other_tasks",array("id"=>$this->input->get('id_status')),"status");?>
		    <div class="col-md-12" style="margin-bottom:10px;">
<div class="col-md-2">		        
<input type="radio" <?php if($status==0||$status==1||$status==2||$status==3){?> disabled <?php }?>  class="form-control" style="height:22px;" name="status" value="0" <?php if($status==0){?>checked<?php }?>> 
</div><div class="col-md-5"><?= lang("task_notwork");?>  	</div></div>

<div class="col-md-12" style="margin-bottom:10px;">
	   <div class="col-md-2">
		<input type="radio"  class="form-control" <?php if($status==2||$status==1){?> disabled <?php }?> style="height:22px;" name="status" value="1" <?php if($status==1){?>checked<?php }?>>
			</div><div class="col-md-5"><?= lang("task_working");?>
	</div></div>
	
	<div class="col-md-12" style="margin-bottom:10px;">
			 <div class="col-md-2">
		<input type="radio"  class="form-control" <?php if($status==2||$status==0){?> disabled <?php }?> style="height:22px;" name="status" value="2" <?php if($status==2){?>checked<?php }?>>
			</div><div class="col-md-5"><?= lang("task_end_working");?></div></div>
		
		<div class="col-md-12" style="margin-bottom:10px;">
		    <div class="col-md-2">
		<input type="radio"  class="form-control" <?php if($status==2||$status==0||$status==3){?> disabled <?php }?> style="height:22px;" name="status" value="3" <?php if($status==3){?>checked<?php }?>>
		
		</div><div class="col-md-5"><?= lang("Suspend");?></div></div>
						
										</div>
										<div class="col-md-1"></div>
									</div>
<input name="id_status" type="hidden"  value="<?=$this->input->get('id_status');?>" class="form-control" >


                                        <div class="form-actions">
										<div class="row">
											<div class="col-md-offset-3 col-md-9">
		<button type="button" class="btn green mainubtton <?php 	if($status!=2){?>taskstatusbutton <?php } else {?>taskfinishbutton<?php }?>"><i class="fa fa-check"></i> <?= lang("saved");?></button>

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
//CKEDITOR.replace('description');
var editor = CKEDITOR.replace( 'contents' );
CKFinder.setupCKEditor( editor );
</script>

</body>
</html>
