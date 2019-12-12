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
<title><?= lang("project_status");?></title>
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
if($this->input->get("project_id")==4){
?>

<li>
<a href="<?= $url . 'admin/projects/future'; ?>"><?= lang('fproject');?></a>
<i class="fa fa-circle"></i>
</li>
<?php }?>
<?php 
if($this->input->get("project_id")==3){
?>

<li>
<a href="<?= $url . 'admin/projects/finished'; ?>"><?= lang('endproject');?></a>
<i class="fa fa-circle"></i>
</li>
<?php }?>
						<li>
							<span><?= lang("project_status");?></span>
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
															<i class="fa fa-gift"></i> <?= lang("project_status");?></div>
													</div>

													<div class="portlet light bordered form-fit">
														<div class="portlet-title">
															<div class="caption"></div>
															<div class="actions"></div>
														</div>
														<div class="portlet-body form">
															<!-- BEGIN FORM-->
															
															<input type="hidden" id="idresult" value="0">
															<form id="myForm" action="<?php echo $url ?>admin/projects/status_action" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
															<input type="hidden" name="id" value="<?=$data->id;?>">
															 <input type="hidden" name="project_id" value="<?= $this->input->get("project_id");?>">
																<div class="form-body">



																<div class="form-group">
																			<div class="col-md-1"></div>
																			<div class="col-md-10">
																			<span class="help-block">   <?= lang("project_status");?>
																			<Span class="status_project"><?php
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
																			   echo $status;?></Span>
																			</span>
																			<select class="form-control" name="status_executed" style="height: auto;" id="status_executed">
																		    <option value=""><?= lang("select_pm"); ?></option>
																			<option value="1"><?= lang("cproject_status");?></option> n>
																	    	<option value="2"><?= lang("wproject_status");?></option>
																			<option value="3"><?= lang("fproject_status");?></option>n>
																			<option value="4"><?= lang("endproject_status");?></option>
																			</select>																					
																			</div>
																			<div class="col-md-1"></div>
																		</div>




																	<div class="form-actions">
																		<div class="row">
																			<div class="col-md-offset-3 col-md-9">
<button type="button" class="btn green mainubtton <?php if($status!=2){?>projectstatusbutton <?php } else {?>projectfinishbutton<?php }?>">
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
               $("#meeting_start").show();
            }
			else {
				$("#meeting_start").hide();	
			}
        });
});
</script>
<script type="text/javascript">
	//CKEDITOR.replace('description');
	var editor = CKEDITOR.replace( 'contents' );
	CKFinder.setupCKEditor( editor );
</script>
<script type="text/javascript">
    $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
</script>  
</body>
</html>
