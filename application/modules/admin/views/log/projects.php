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
$curt='log';
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
<title> <?=lang("trakproject");?></title>
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
							<a href="<?=$url.'admin';?>"> <?=lang("admin_panel");?></a>
							<i class="fa fa-circle"></i>
						</li>
						
						<li>
							<span class="active"> <?=lang("trakproject");?></span>
						</li>
					</ul>
					<!-- END PAGE BREADCRUMB -->

					<!-- Start Table Data -->
					<div class="row">
						<div class="col-md-12">
							<!-- BEGIN EXAMPLE TABLE PORTLET-->
							<div class="portlet light bordered">
								<div class="portlet-title">
								
								</div>
								<span class="portlet-body">
									<div class="table-toolbar">
										<div class="row">
											
										</div>
									</div>
									<?php if(!empty($results)){?>
									<form action="" method="POST" id="form">
									<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1_2">
										<thead>
											<tr>
												
												
												<th><?=lang("project");?> </th>
												<th><?=lang("pm");?> </th>
												<th><?=lang("update_date");?></th>
												<th><?=lang("update_date");?> </th>
												<th><?=lang("status");?></th>
												<th> <?=lang("start_date");?></th>
												<th>  <?=lang("end_date");?></th>
												<th><?=lang("total_hrs");?></th>
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
											
											</tr>
										</tfoot>
										<tbody>
										<?php
										$current_date=date("Y-m-d H:i");
                                            foreach($results as $data) {
											$name=$data->name;
											$user_id=$data->user_id;
											$status=$data->status;
											$project_id=$data->project_id;
											$update_date=$data->update_date;
											$id_magager=$data->id_magager;
											$total_hrs=$data->total_hrs;
											$finish_date=$data->finish_date;
											$start_date=$data->start_date;
										
											$user_name=get_table_filed("tbl_users",array("id"=>$user_id),"fname");
											$manager_name=get_table_filed("tbl_users",array("id"=>$id_magager),"fname");
											if($user_id!=""){
												$user_main_name=$user_name;
												}
												else {
													$user_main_name=lang("undefined");
												}

												if($id_magager!=""){
													$manager_name=$manager_name;
													}
													else {
														$manager_name=lang("undefined");
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
											<tr class="odd gradeX" >
												
												<td><?=mb_substr($name,0,20);?></td>
												<td> <?=$manager_name;?> </td>
												<td> <?=$update_date;?> </td>
												<td> <?=$user_main_name;?> </td>
												<td> <?=$status;?> </td>
												<td> <?=$start_date;?> </td>
												<td> <?=$finish_date;?> </td>
												<td> <?=$total_hrs;?> </td>

											
												
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
                                            <a href="javascript:;"> <?= lang("total");?> :
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
</body>
</html>
