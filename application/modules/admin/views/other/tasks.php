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
}

?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" dir="<?=lang("rtl");?>">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8">
<title><?=lang("task");?></title>
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
							<a href="<?=$url.'admin';?>"><?= lang('admin_panel'); ?></a>
							<i class="fa fa-circle"></i>
						</li>
						
						<li>
							<span class="active"><?=lang("task");?></span>
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
										<span class="caption-subject bold uppercase"><?=lang("task");?> 
										</span>
									</div>
								</div>
								<span class="portlet-body">
									<div class="table-toolbar">
										<div class="row">
											<div class="col-md-6">
												<?php if($result_amount>0){
													if($this->session->userdata('delete_other_task')=="delete_other_task"){
													?>
													<div class="btn-group">
														<button id="sample_editable_1_2_new" class="btn sbold red delbutton_other"> <?=lang("delete");?> 
															<i class="fa fa-remove"></i>
														</button>
													</div>
													<?php }?>
												<?php }?>
												<?php 
													if($this->session->userdata('add_other_task')=="add_other_task"){
													?>
													<div class="btn-group">
													<button id="sample_editable_1_2_new" class="btn sbold green addbutton"> <?=lang("add");?> 
														<i class="fa fa-plus"></i>
													</button>
													</div>
													<?php }?>
													
																</div>
																
																				<?php 
													if($this->session->userdata('alltasks_user')=="alltasks_user"){
													?>
													
													<div class="col-md-5">
											<div class="btn-group">
											     <form action="<?=base_url()?>admin/other/tasks_user" target="_blank" id="myform">
											<select name="user_id" class="form-control" id="id_user" >
						<option value="0" selected><?= lang("select_user");?></option>
							<?php 
								$result = $users_tasks = $this->db->select('user_id as iduser')
						->group_by('iduser')
						->get_where('other_tasks')
						->result();
						
							 if(count($result)>0){
							     foreach($result as $users_projects){
							         $user_fname=get_table_filed("tbl_users",array("id"=>$users_projects->iduser),"fname");
							         $user_lname=get_table_filed("tbl_users",array("id"=>$users_projects->iduser),"lname");
							         $count_task=$this->db->get_where('other_tasks',array('user_id'=>$users_projects->iduser))->result();
											    ?>
						<option value="<?= $users_projects->iduser;?>"><?= $user_fname?>&nbsp<?= $user_lname?>&nbsp (<?= count($count_task)?>)</option>
							<?php }?>
							<?php }?>
											</select>
											<button id="sample_editable_1_2_new" class="btn sbold green fliter" type="button">	<i class="fa fa-search"></i> <?= lang("filter");?></button>
											</form>
													</div>
													</div>
													<?php }?>
												
										</div>
									</div>
									<?php if(!empty($results)){?>
									<form action="<?=$url?>admin/other/delete" method="POST" id="form">
									<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1_2">
										<thead>
											<tr>
												<th>
													<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
														<input id="checkAll" type="checkbox" class="group-checkable" data-set="#sample_1_2 .checkboxes" />
														<span></span>
													</label>
												</th>
											<th><i class="fa fa-sticky-note"></i><?= lang("task");?></th>
												<th><?= lang("period");?></th>
												<th><?= lang("overtime");?></th>
												<th><?= lang("total");?></th>
												<th><?= lang("dates");?></th>
												<th><?= lang("remaining");?></th>
												<th><?= lang("review_f");?></th>
												<th><?= lang("review_s");?></th>
												<th><?= lang("status");?></th>
												<th><?= lang("adding");?></th>
												<th><?= lang("operations");?> </th>
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
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
											</tr>
										</tfoot>
										<tbody>
										<?php
										$undefined=lang("undefined")			;
										$current_date=date("Y-m-d H:i");
                                            foreach($results as $data) {
											$name=$data->name;
											$user_id=$data->user_id;
											$total_hrs=$data->total_hrs;
											$select_date=$data->select_date;
											$start_date=$data->start_date;
											$select_enddate=$data->select_enddate;
											$finished_date=$data->finished_date;
											$status_review=$data->status_review;
											$status_review1=$data->status_review1;
											$review_date=$data->review_date;
											$review1_date=$data->review1_date;
if($start_date!=""&&$select_date==2&&$finished_date!=""&&$select_enddate==2&&(strtotime($finished_date)>=strtotime($current_date))){


												if(round((strtotime($finished_date)-strtotime($current_date))/(60*60*24))<1){
													$reaming_time=lang("day");
												}
                                         else {
										$reaming_time=ceil((strtotime($finished_date)-strtotime($current_date))/(60*60*24))."يوم";
										 }
										 $reaming_value=1;
										
										 
											}
											else if($start_date!=""&&$select_date==2&&$finished_date!=""&&$select_enddate==2&&(strtotime($finished_date)<strtotime($current_date))){
												$reaming_time="0".lang("day");;
												$reaming_value=2;
											}
											else if(($start_date==""||$select_date==1||$finished_date==""||$select_enddate==1)||(strtotime($finished_date)<=strtotime($current_date))){
												$reaming_time=lang("undefined");;
												$reaming_value=0;
											}
										//	$manager_name=get_table_filed("tbl_pr",array("id"=>$project_id),"fname");
											$user_name=get_table_filed("tbl_users",array("id"=>$user_id),"fname");
											$email=get_table_filed("tbl_config",array("config_key"=>"site_email"),"config_value");
											if($user_id!=""){
												$user_main_name=$user_name;
												}
												else {
													$user_main_name=lang("undefined");
												}

											if($data->select_date==1){
												$main_start=1;
											$start_date=lang("undefined");
											$finished_date=lang("undefined");
											}
											else {
												$start_date=$start_date	;
												$main_start=2;
												if($start_date==date("Y-m-d H:i")){
													$data_status['status']='1';
													$this->db->update('tbl_tasks',$data_status,array('id'=>$data->id));
												}
												$finished_date=$data->finished_date;
											}
											
												if($status_review==0){
													$main_review=1;
													$review_date=lang("undefined");
													}
													else {
													$main_review=2;
													if($status_review==1){$main_review=lang("notes");}
															else{$main_review="تم";}
															$review_date=$data->review_date."<br>".$main_review;
								}
											
	if($status_review==0){
$main_review=1;
$review_date="<span class='label label-sm label-danger'>$undefined</span>";
}
else {
$main_review=2;
if($status_review==1){$main_review=lang("notes");
$review_date="<span class='label label-sm label-Grey' style='color:#000; background-color:#eceef1'>".date("Y-m-d H:i",strtotime($data->review_date))."</span><br>".
"<span class='label label-sm label-Grey' style='color:#000; background-color:#eceef1'>".$main_review."</span>";
}
else{$main_review=lang("done");

$review_date="<span class='label label-sm label-Grey' style='background-color: #2276bf;color: #fff !important'>".date("Y-m-d H:i",strtotime($data->review_date))."</span><br>".
"<span class='label label-sm label-Grey' style='background-color: #2276bf;color: #fff !important'>".$main_review."</span>";
}
}											
											

if($status_review1==0){
$main_review1=1;
$review1_date="<span class='label label-sm label-danger'>$undefined</span>";
}

else {
$main_review1=2;
if($status_review1==1){$main_review1=lang("notes");;
$review1_date="<span class='label label-sm label-Grey'  style='color:#000; background-color:#eceef1'>".date("Y-m-d H:i",strtotime($data->review1_date))."</span><br>".
"<span class='label label-sm label-Grey' style='color:#000; background-color:#eceef1'>".$main_review1."</span>";
}
else{$main_review1=lang("done");
$review1_date="<span class='label label-sm label-Grey' style='background-color: #2276bf;color: #fff !important'>".date("Y-m-d H:i",strtotime($data->review1_date))."</span><br>".
"<span class='label label-sm label-Grey' style='background-color: #2276bf;color: #fff !important'>".$main_review1."</span>";
}
}

											$status=$data->status	;
									$working_wait=lang("working_wait");
										$working_progress=lang("working_progress");
										$working_end=lang("working_end");
										$working_review=lang("working_review");
										
											$status=$data->status	;
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
												
												$minutes=0;
												$total_hrs_m=($total_hrs*60);
				$query_hrs = $this->db->query("select  sum(total_hrs) as final_total_hrs from user_other_task_log where id_task=$data->id and enddate IS NOT NULL group by id_task");
				if(count($query_hrs->result())>0){
					foreach ($query_hrs->result() as $query_hrs)
					$minutes=$query_hrs->final_total_hrs;
					$intdiv=intdiv($minutes, 60).':'. ($minutes % 60);
					if($total_hrs_m>=$minutes){$final_reaming=$total_hrs_m-$minutes;
						$reaming=intdiv(($final_reaming), 60).':'. ($final_reaming % 60);}
						else {$final_reaming=$minutes-$total_hrs_m;
							$reaming="-".intdiv(($final_reaming), 60).':'. ($final_reaming % 60);}
					
				$total_muites="<span class='label label-sm label-success' >$intdiv</span><br>
				<span class='label label-sm label-success'>$reaming</span>
				";
				
				$minutes_compare=$minutes;
			}
			else {
				$reaming=intdiv((($total_hrs*60)-$minutes), 60).':'. ((($total_hrs*60)-$minutes) % 60);
				$minutes_compare=0;
					$total_muites="<span class='label label-sm label-success'>$undefined </span><br>
					<span class='label label-sm label-success' >$reaming</span>";;
						}
									

$start_date_act=get_table_filed("user_other_task_log",array("id_task"=>$data->id),"start_date");
$enddate_act=get_table_filed("user_other_task_log",array("id_task"=>$data->id),"enddate");
$total_hrs_act=get_table_filed("user_other_task_log",array("id_task"=>$data->id),"total_hrs");
$user_fname=get_table_filed("tbl_users",array("id"=>$data->user_id),"fname");
$user_lname=get_table_filed("tbl_users",array("id"=>$data->user_id),"lname");
$final_user_task=$user_fname." ".$user_lname;
?>
<tr class="odd gradeX" style="<?php if($reaming_value==2){?>background-color:#fff <?php } else if($reaming_value==1){ ?>background-color:#f3f5f9<?php }?>">												<td>
													<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
														<input name="check[]" type="checkbox" class="checkboxes" value="<?=$data->id;?>" />
														<span></span>
													</label>
												</td>
												<td><a href="#" title=" <?= $name;?>"  data-toggle="modal" data-target="#exampleModal" class="model_bag">
												     <i class="fa fa-sticky-note" style="margin-left:5px"></i>
												     <?=mb_substr($name,0,10);?></a> 
												       <input type="hidden" value="<?= $name; ?>" class="title_task">
												     <input type="hidden" value="<?= $total_hrs; ?>" class="hrs_task">
												     <input type="hidden" value="<?= $data->main_task; ?>" class="details_task">
												     <input type="hidden" value="<?= $final_user_task; ?>" class="user_task"> 
												          <input type="hidden" value="<?=$data->over_time_hrs;?>" class="over_time"> </td>
												     </td>
												<td> <?=$total_hrs;?> </td>
												<td> <?=$data->over_time_hrs;?></td>
												<td style="direction: ltr;"> <?=$total_muites;?>
												 </td>
												
													<td style="direction:ltr"><a href="#" title=" <?= $name;?>"  data-toggle="modal" data-target="#exampleModal_1" class="model_details">
												     <i class="icon-clock" style="margin-left:5px; font-size:24px"></i></a>
												     
												      <input type="hidden" value="<?= $name; ?>" class="title_task">
												     <input type="hidden" value="<?= $total_hrs; ?>" class="hrs_task">
												         <input type="hidden" value="<?php if($start_date_act!=""){echo date("Y-m-d H:i",strtotime($start_date_act));} else {echo $undefined;}?>" class="actual_start">
												       <input type="hidden" value="<?php if($enddate_act!=""){echo date("Y-m-d H:i",strtotime($enddate_act));} else {echo $undefined;}?>" class="actual_end">
												       <input type="hidden" value="<?php if($total_hrs_act!=""){echo $intdiv;} else {echo $undefined;}?>" class="actual_time">
												       
												      <input type="hidden" value="<?php if($main_start==2){echo date("Y-m-d H:i",strtotime($start_date));} else {echo $start_date;}?>" class="start_task">
												       <input type="hidden" value="<?php if($main_start==2){echo date("Y-m-d H:i",strtotime($finished_date));} else {echo $finished_date;}?> " class="end_task">
												       
												     <input type="hidden" value="<?= $final_user_task; ?>" class="user_task"> 
												      <input type="hidden" value="<?=$data->over_time_hrs;?>" class="over_time"> 

												     </td>
												
												<td> <?=$reaming_time;?> </td>
												
<td style="direction:ltr">
<?php
if($this->session->userdata('task_review')=="task_review" &&$status_review!=2&&$data->status==2){
?>
<a  href="<?=DIR?>admin/other/change_review?type=0&id_status=<?php echo $data->id;?>" title="<?= lang("review_f")?>">
<i class="fa fa-edit" title="<?= lang("review_f")?>"></i>
<?php } else {?>
<a  title="<?= lang("review_f")?>"	>
<?php }?>
<?php  if($main_review==2){ date("Y-m-d H:i",strtotime($review_date));}else { echo $review_date;}?></a>
</td>



<td style="direction:ltr">
<?php if($this->session->userdata('task_review1')=="task_review1" &&$status_review1!=2&&$data->status==2){	?>
<a  href="<?=DIR?>admin/other/change_review?type=1&id_status=<?php echo $data->id;?>" title="<?= lang("review_s")?>" >
<i class="fa fa-edit" title="<?= lang("review_s")?>"></i>
<?php } else if($status_review1==2&&$data->status==2) {?>
<a  title="<?= lang("review_s")?>"><?php } else {?>
<a  title="<?= lang("review_s")?>">
<?php }?>
<?php  if($main_review==2){date("Y-m-d H:i",strtotime($review1_date));} else {echo $review1_date;}?> 
</a>
</td>
												
										
												
												<td>
												<?php
												if($minutes_compare>($total_hrs*60)){
												if(($status_review1!=2||$status_review!=2)&&$data->status!=2){
												?>
<a  href="<?=DIR?>admin/other/change_status?id_status=<?php echo $data->id;?>" title=" <?= lang("status");?>" style="padding: 1px 0px;">
												<i class="fa fa-edit" title="<?= lang("status");?>"></i>
												<span><?php echo $status;?></span>
												<br>
                                              <span class='label label-sm label-danger'><?= lang("delay");?></span>
												</a>
												<?php } else if($status_review1==2&&$status_review==2&&$data->status==2){?>
													<span><?php echo $status;?></span>
												<br>
                                              <span class='label label-sm label-danger'><?= lang("delay");?></span>
												<?php }  else if(($status_review1!=2||$status_review!=2)&&$data->status==2){?>
													<a  title="تغير الحالة" style="padding: 1px 0px;background-color:#fff">
												<span><?php echo $status;?></span>
												<br>
												<span class='label label-sm label-danger'><?= lang("delay");?></span>
												</a>
												<?php }?>
												<?php }else {?>
												<?php
		                 if(($status_review1!=2||$status_review!=2)&&$data->status!=2){
														?>
												<a  href="<?=DIR?>admin/other/change_status?id_status=<?php echo $data->id;?>" title="<?= lang("status");?>" style="padding: 1px 0px;">
												<i class="fa fa-edit" title="<?= lang("status");?> "></i>
												<?php } else {?>
													<a  title="<?= lang("status");?>" style="padding: 1px 0px;background-color:#fff">
												<?php }?>
												<span><?php echo $status;?></span>
											<?php	 if($data->status==2){ ?>
												<span class='label label-sm label-success'  style="background-color: #2276bf;color: #fff !important;"><?= lang("achievement");?></span>
												<?php }?>
												</a>
												<?php }?>
												</td>
												
																							
	<?php 	if($this->session->userdata('alltasks_user')=="alltasks_user"){ ?>
				<td> <a href="<?= base_url()?>admin/other/tasks_user?user_id=<?= $user_id; ?> ?>"><?=$user_main_name;?></a></td>
												<?php } else {?>
	<td> <a href="#"><?=$user_main_name;?></a></td>
												<?php }?>
												

									
												
												
														<td>
													<div class="btn-group">
														<button class="btn btn-xs red dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> <?= lang("operations")?>
															<i class="fa fa-angle-down"></i>
														</button>
														<ul class="dropdown-menu pull-left" role="menu">
															<!--<li><a href="javascript:;"><i class="fa fa-eye"></i> Details </a></li>-->
															<?php if($this->session->userdata('user_statistics')=="user_statistics"){	?>
														<!--	<li><a href="<?= DIR?>admin/task/user_statistics?id=<?=$data->id?>"><i class="fa fa-eye"></i><?= lang("task_statics");?></a></li>-->
															<?php }	if($this->session->userdata('review_statistics')=="review_statistics"){?>

															<li><a href="<?= DIR?>admin/other/review_statistics?id=<?=$data->id?>"><i class="fa fa-eye"></i> <?=lang("review_statistics")?></a></li>
															<?php }?>
															<?php
														if($this->session->userdata('task_details')=="task_details"){
														?>
															<li><a href="<?=$url?>admin/other/details?id_status=<?=$data->id;?>"><i class="fa fa-eye"></i>  <?= lang("details")?> </a></li>
														<?php }?>
															<?php if($data->status!=2) {?>
													<?php
														if($this->session->userdata('edit_other_task')=="edit_other_task"&&($status_review1==0||$status_review==0)&&$data->status==0){
														?>
														<li><a href="<?=$url?>admin/other/edit?id_status=<?=$data->id;?>"><i class="fa fa-pencil"></i>  <?= lang("update")?> </a></li>
														<li><a href="<?=$url?>admin/other/start_date?id_status=<?=$data->id;?>"><i class="fa fa-calendar"></i>  <?= lang("start_date")?>  </a></li>
														<?php
														}
														if($this->session->userdata('delete_other_task')=="delete_other_task"&&($status_review1==0||$status_review==0)&&$data->status==0){
														?>
															<li><a href="<?=$url?>admin/other/delete?id_status=<?=$data->id;?>"><i class="fa fa-remove"></i>  <?= lang("delete")?> </a></li>
														<?php 
														}
														?>
															<?php
															if($this->session->userdata('start_time')=="start_time"&&$status_review1==0&&$status_review==0&&$data->status==0){
														?>
															<li><a href="<?=$url?>admin/other/start_time?id_status=<?=$data->id;?>"><i class="fa fa-remove"></i> <?= lang("start_date");?>  </a></li>
														<?php 
														}
														?>
														</ul>
													</div>
												</td>
											</tr>
                                            <?php  }}?>
										</tbody>
									</table>
									</form>
									<?php 
											
									  } else{?>
									<center><span class="caption-subject font-red bold uppercase"><?= lang("nodata");?> </span></center>
									<?php }?>
								<div class="row">
								    
								    	<div class="col-md-12" style="margin-top:20px">
													
														<button id="sample_editable_1_2_new" class="btn sbold GREY allbutton"><?= lang("all");?>
													</button>
												
													<button id="sample_editable_1_2_new" class="btn sbold GREY waitbutton">  <?= lang("working_wait");?> 
													</button>
													
													<button id="sample_editable_1_2_new" class="btn sbold GREY workedbuuton"> <?= lang("working_progress");?> 
													</button>
													<button id="sample_editable_1_2_new" class="btn sbold GREY reviewbutton"><?= lang("working_review");?> 
													</button>
													<button id="sample_editable_1_2_new" class="btn sbold GREY errorbutton"><?= lang("working_error");?> 
													</button>
												
													<button id="sample_editable_1_2_new" class="btn sbold GREY finishedbuuton"><?= lang("done");?> 
													</button>
											</div>
								    
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
        window.location.assign("<?= DIR?>admin/other/add?type=1");
    });

    $(".errorbutton").click(function(e) {
        window.location.assign("<?= DIR?>admin/other/tasks_error");
    });

    $(".workedbuuton").click(function(e) {
        window.location.assign("<?= DIR?>admin/other/tasks_working");
    });
    $(".finishedbuuton").click(function(e) {
        window.location.assign("<?= DIR?>admin/other/tasks_finished?id_project");
    });

    $(".allbutton").click(function(e) {
        window.location.assign("<?= DIR?>admin/other/tasks?id_project");
    });

	$(".reviewbutton").click(function(e) {
        window.location.assign("<?= DIR?>admin/other/tasks_wait_review?id_project");
    });
	$(".waitbutton").click(function(e) {
        window.location.assign("<?= DIR?>admin/other/tasks_wait?id_project");
    });
	
	
	$(".delbutton").click(function(e) {
        window.location.assign("delete");
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
	$(".delbutton_other").click(function(){
		if($('input[type=checkbox]:not("#checkAll"):checked').length>0){
			$('#form').unbind('submit').submit();//renable submit
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



<script>
$(document).ready(function(e) {
$(".edit").click(function(e) {
var id = $(this).data("id");
var data={id:id};
			$.ajax({
				url: '<?php echo base_url("admin/services/check_view_service") ?>',
                type: 'POST',
                data: data,				
                success: function( data ) {
                	if (data == "1") {
					// alert(data);
                		$(".code_actvation-"+id).html("<span class='label label-sm label-success'> مفعل</span>");
                	}
                	if (data == "0") {
                		$(".code_actvation-"+id).html("<span class='label label-sm label-danger'>غير مفعل</span>");
                	}
				}
         });
	});
});
</script>
</body>
</html>
