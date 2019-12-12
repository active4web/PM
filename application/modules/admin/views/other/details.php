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
$curt='other_task';
}
foreach($data as $result)
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
<title><?= lang("details");?></title>
<?php include ("design/inc/header.php");?>
<style>
.mt-comments .mt-comment {
    background-color: #e9e9e9;
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
							<a href="<?=$url.'admin';?>"><?= lang('admin_panel'); ?></a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<a href="<?= $url ?>admin/other/tasks"><?= lang("task");?></a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<span class="active"><?= lang("details");?></span>
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
															<i class="fa fa-gift"></i><?= lang("task_details");?></div>

													</div>

													<div class="portlet light bordered form-fit">
														<div class="portlet-title">
															<div class="caption"></div>
															<div class="actions"></div>
														</div>
														<?php
														$undefined=lang("undefined")			;
															
																$id = $result->id;
																$name = $result->name;
																$user_id = $result->user_id;
																$add_id = $result->add_id;
																$manager_id = $result->manager_id;
																$main_task = $result->main_task;
																$start_date = $result->start_date;
																$review_date = $result->review_date;
																$review1_date = $result->review1_date;
																$finished_date = $result->finished_date;
																$status = $result->status;
																$status_review = $result->status_review;
																$status_review1 = $result->status_review1;
																$total_hrs = $result->total_hrs;
																$select_date = $result->select_date;
																$userid_review = $result->userid_review;
																$userid_review1 = $result->userid_review1;

																$user_fadd=get_table_filed("tbl_users",array("id"=>$add_id),"fname");
																$user_ladd=get_table_filed("tbl_users",array("id"=>$add_id),"lname");


																$user_fname=get_table_filed("tbl_users",array("id"=>$user_id),"fname");
																$user_lname=get_table_filed("tbl_users",array("id"=>$user_id),"lname");

																$manager_name=get_table_filed("tbl_users",array("id"=>$manager_id),"fname");
																$manager_lname=get_table_filed("tbl_users",array("id"=>$manager_id),"lname");

																$teamleader=get_table_filed("tbl_users",array("id"=>$userid_review),"fname");
																$leader_lname=get_table_filed("tbl_users",array("id"=>$userid_review),"lname");

																$query_hrs = $this->db->query("select  sum(total_hrs) as final_total_hrs from user_other_task_log where id_task=$result->id and enddate IS NOT NULL group by id_task");
																if(count($query_hrs->result())>0){
																	foreach ($query_hrs->result() as $query_hrs)
																	$minutes=$query_hrs->final_total_hrs;
																	$intdiv="(".$minutes.")".intdiv($minutes, 60).':'. ($minutes % 60);
																$total_muites="<span class='label label-sm label-danger' style='background-color:#e7505a !important'>$intdiv</span>";
																$minutes_compare=$minutes;
															}
															else {
																$minutes_compare=0;
																	$total_muites="<span class='label label-sm label-success'>$undefined</span>";;
																		}


                                          	    $working_wait=lang("working_wait");
										$working_progress=lang("working_progress");
										$working_end=lang("working_end");
										$working_review=lang("working_review");
											$status=$result->status	;
											
												switch($status){
													case 0:
													  $status="<span class='label label-sm label-danger'> $working_wait</span>";
													  break;
													case 1:
													  $status="<span class='label label-sm label-success'>$working_progress </span>";
													  break;
													  case 2:
													  $status="<span class='label label-sm label-success' style='background-color: #2276bf;color: #fff !important;'>$working_end </span>";
													  break;
													default:
													  break; 
												}
														?>
														<div class="portlet-body form">
															<!-- BEGIN FORM-->
													
																			<div class="portlet box yellow">
																			
																				<div class="portlet-title">
																					<div class="caption" style="color:#000;">
																						<i class="fa fa-gift" style="color:#000;"></i>  <?=$name?></div>
																					<div class="tools">
																						<a href="javascript:;" class="collapse"> </a>
																					</div>
																				</div>
																				<div class="portlet-body">
																					<div class="row">
																						<div class="col-md-3 col-sm-3 col-xs-3">
																							<ul class="nav nav-tabs tabs-left">
																							
																								<li class="active">
																									<a href="#tab_6_1" data-toggle="tab"><?= lang("description_task");?> </a>
																								</li>
																								
																								<li>
																									<a href="#tab_6_3" data-toggle="tab"><?= lang("task_name");?></a>
																								</li>
																								<li>
																									<a href="#tab_6_4" data-toggle="tab"><?= lang("start_date");?></a>
																								</li>
																								<li>
																									<a href="#tab_6_5" data-toggle="tab"><?= lang("end_date");?></a>
																								</li>
																								<li>
																									<a href="#tab_6_6" data-toggle="tab"><?= lang("total_hrs");?></a>
																								</li>
																								<li>
																									<a href="#tab_6_7" data-toggle="tab"><?= lang("task_teamleader");?></a>
																								</li>
																								<li>
																									<a href="#tab_6_8" data-toggle="tab"><?= lang("task_pm");?></a>
																								</li>
																								<li>
																									<a href="#tab_6_9" data-toggle="tab"> <?= lang("review_f");?></a>
																								</li>
																								<li>
																									<a href="#tab_6_10" data-toggle="tab"><?= lang("review_s");?></a>
																								</li>
																								<li>
																									<a href="#tab_6_11" data-toggle="tab"><?= lang("task_notes");?></a>
																								</li>
																								<li>
																									<a href="#tab_6_12" data-toggle="tab"><?= lang("details");?></a>
																								</li>
																							</ul>
																						</div>
																						<div class="col-md-9 col-sm-9 col-xs-9">
																							<div class="tab-content">
																								<div class="tab-pane active" id="tab_6_1">
																									<div class="portlet-body">
																										<div class="table-responsive">
																											<table class="table table-bordered">
																												<tbody>
																												<tr>
																														<th>  <?= lang("actual_time");?> </th>
																														<td> <?=$total_hrs ?> </td>
																													</tr>
																												<tr>
																														<th> <?= lang("actual_time");?> </th>
																														<td> <?=$total_muites;?> </td>
																													</tr>
																													<tr>
																													<th><?= lang("status");?></th>
											<th>
											<?php
											if($minutes_compare>($total_hrs*60)){
											?>
											<span class='label label-sm label-danger'>يوجد تاخير</span>

											<?php }else {?>
											<?php
											if(($status_review1!=2||$status_review!=2)&&$result->status!=2){
											?>
											<a  href="<?=DIR?>admin/other/change_status?id_status=<?php echo $result->id;?>" title="تغير الحالة" style="padding: 1px 0px;">
											<i class="fa fa-edit" title="تغير الحالة"></i>
											<?php } else {?>
											<a  title="تغير الحالة" style="padding: 1px 0px;background-color:#fff">
											<?php }?>
											<span><?php echo $status;?></span>
											</a>
											<?php }?>
											</th></tr>
																												<tr>
																														<th> <?= lang("task_name");?> </th>
																														<td> <?=$name;?> </td>
																													</tr>
																													<tr>
																														<th>  <?= lang("provider");?>  </th>
																							<td> <?=$user_fname."&nbsp&nbsp".$user_lname;?> </td>
																													</tr>
																													<tr>
																														<th>  <?= lang("provider");?> </th>
																							<td> <?=$user_fadd."&nbsp&nbsp".$user_ladd;?> </td>
																													</tr>
																													
																													<tr>
																														<th> مدير  المشروع </th>
																									<td> <?=$manager_name."&nbsp;".$manager_lname?> </td>
																													</tr>
																												
																													<tr>
																														<th><?= lang("start_date");?> داية </th>
																														<td> <?php
																														if($select_date==1){
																															echo $start_date=lang("undefined");
																														}
																														else {
																															echo $start_date=$start_date	;
																														}
																														?></td>
																													</tr>
																													<tr>
																														<th> <?= lang("end_date");?> </th>
																														<td> <?php
																														if($select_date==1){
																															echo lang("undefined");
																														}
																														else {
																															echo $finished_date	;
																														}
																														?> </td>
																													</tr>
																													<tr>
																														<th> <?= lang("task_freview_date"); ?> </th>
																														<td> <?=$review_date?> </td>
																													</tr>
																													<tr>
																														<th>  <?= lang("task_sreview_date"); ?> </th>
																														<td> <?=$review1_date?> </td>
																													</tr>
																													
																									<tr>
																									<th><?= lang("task_statistics");?></th>
																				<td> <a href="<?= DIR?>admin/other/user_statistics?id=<?=$id?>"><?= lang("task_statistics");?></a> </td>
																									</tr>
																									<tr>
																									<th><?= lang("review_statistics");?></th>
																	<td>  <a href="<?= DIR?>admin/other/review_statistics?id=<?=$id?>"><?= lang("review_statistics");?></a></td>
																									</tr>
																												</tbody>
																											</table>
																										</div>
																									</div>
																								</div>
																							
																								<div class="tab-pane fade" id="tab_6_3">
																									<div class="portlet-body">
																										<div class="table-responsive">
																											<table class="table table-bordered">
																												<thead>
																													<th> <?= lang("task_name");?> </th>
																												</thead>
																												<tbody>
																													<tr>
																														<td> <?=$name?> </td>
																													</tr>
																												</tbody>
																											</table>
																											
																										</div>
																									</div>
																								</div>
																								<div class="tab-pane fade" id="tab_6_4">
																									<div class="portlet-body">
																										<div class="table-responsive">
																											<table class="table table-bordered">
																												<thead>
																													<th> <?= lang("start_date");?></th>
																												</thead>
																												<tbody>
																													<tr><td> 
																														<?php
																														if($select_date==1){
																															echo $start_date=lang("undefined");
																														}
																														else {
																															echo $start_date=$start_date	;
																														}
																														?>
																														</td>
																													</tr>
																												</tbody>
																											</table>
																										</div>
																									</div>
																								</div>

																								<div class="tab-pane fade" id="tab_6_5">
																									<div class="portlet-body">
																										<div class="table-responsive">
																											<table class="table table-bordered">
																												<thead>
																													<th> <?= lang("end_date");?> </th>
																												</thead>
																												<tbody>
																													<tr>
																														<td><?php
																														if($select_date==1){
																															echo lang("undefined");
																														}
																														else {
																															echo $finished_date	;
																														}
																														?> </td>
																													</tr>
																												</tbody>
																											</table>
																											
																										</div>
																									</div>
																								</div>

																								<div class="tab-pane fade" id="tab_6_6">
																									<div class="portlet-body">
																										<div class="table-responsive">
																											<table class="table table-bordered">
																												<thead>
																													<th> <?= lang("total_hrs");?> </th>
																												</thead>
																												<tbody>
																													<tr>
																														<td> <?=$total_hrs ?> </td>
																													</tr>
																												</tbody>
																											</table>
																											
																										</div>
																									</div>
																								</div>


																								<div class="tab-pane fade" id="tab_6_7">
																									<div class="portlet-body">
																										<div class="table-responsive">
																											<table class="table table-bordered">
																												<thead>
																													<th><?= lang("task_teamleader");?> </th>
																												</thead>
																												<tbody>
																													<tr>
																														<td> <?=$teamleader."&nbsp;".$leader_lname?> </td>
																													</tr>
																												</tbody>
																											</table>
																											
																										</div>
																									</div>
																								</div>

																								<div class="tab-pane fade" id="tab_6_8">
																									<div class="portlet-body">
																										<div class="table-responsive">
																											<table class="table table-bordered">
																												<thead>
																													<th> <?= lang("task_pm");?> </th>
																												</thead>
																												<tbody>
																													<tr>
																														<td><?=$manager_name."&nbsp;".$manager_lname?> </td>
																													</tr>
																												</tbody>
																											</table>
																											
																										</div>
																									</div>
																								</div>

																								<div class="tab-pane fade" id="tab_6_9">
																									<div class="portlet-body">
																										<div class="table-responsive">
																											<table class="table table-bordered">
																												<thead>
																													<th><?= lang("review_f");?></th>
																												</thead>
																												<tbody>
																													<tr>
																														<td> <?=$review_date?> </td>
																													</tr>
																												</tbody>
																											</table>
																											
																										</div>
																									</div>
																								</div>

																								<div class="tab-pane fade" id="tab_6_10">
																									<div class="portlet-body">
																										<div class="table-responsive">
																											<table class="table table-bordered">
																												<thead>
																													<th> <?= lang("review_s");?> </th>
																												</thead>
																												<tbody>
																													<tr>
																														<td> <?=$review1_date?> </td>
																													</tr>
																												</tbody>
																											</table>
																											
																										</div>
																									</div>
																								</div>


																								<div class="tab-pane fade" id="tab_6_11">
																									<div class="portlet-body">
																										<div class="table-responsive">
																											<table class="table table-bordered">
																												
																												<tbody>
																												<thead>
																										<th> <?= lang("details");?>  </th>
																										<th>   <?= lang("sender");?> </th>
																										<th> <?= lang("date");?>  </th>
																													<?php if($status!=2){?>
																										<th> <?= lang("replay");?>  </th>
																													<?php }?>
																												</thead>
																												<?php foreach($notes as $notes){?>
																								<tr>
																									<td> <?=$notes->notes;?></td>
																									<td> <?php echo get_this('tbl_users',['id'=>$notes->id_sender],'fname');?></td>

																									<td> <?=$notes->create_date;?></td>
																									<?php if($status!=2){?>
																									<td> <a href="<?=DIR?>admin/other/notes_reply?id_status=<?php echo $id;?>&id_messg=<?php echo $notes->id?>"><i class="fa fa-mail-reply"></i></a></td>
																									<?php }?>
<?php 
$reply_sql=$this->db->order_by("id","desc")->get_where('othertasks_notes',array('id_replay'=>$notes->id))->result();
if(count($reply_sql)>0){
	foreach($reply_sql as $reply_sql){
?>

<thead>
<th> <?= lang("sender");?> : <?php echo get_this('tbl_users',['id'=>$reply_sql->id_sender],'fname');?></th>
<th colspan="3"> <?=$reply_sql->notes;?>  </th>
</thead>																											
<?php } }?>


																								</tr>
																							<?php }?>
																												</tbody>
																											</table>
																											
																										</div>
																									</div>
																								</div>

																								<div class="tab-pane fade" id="tab_6_12">
																									<div class="portlet-body">
																										<div class="table-responsive">
																											<table class="table table-bordered">
																												<thead>
																													<th>  <?= lang("task_details");?> </th>
																												</thead>
																												<tbody>
																													<tr>
																														<td> <?=$main_task?> </td>
																													</tr>
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
