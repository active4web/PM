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
$curt='tasks';
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
<title><?= lang("task");?></title>
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
							<a href="<?=$url.'admin';?>"><?= lang('admin_panel'); ?> </a>
							<i class="fa fa-circle"></i>
						</li>
												
<?php
$id_projects=$this->input->get("id_project");
$status=get_table_filed("tbl_projects",array("id"=>$id_projects),"status");
if($status==1){
?>
<li>
<a href="<?= $url . 'admin/projects/current_projects'; ?>"><?= lang("cproject");?></a>
<i class="fa fa-circle"></i>
</li>
<?php }?>
<?php 
if($status==4){
?>

<li>
<a href="<?= $url . 'admin/projects/finished'; ?>"><?= lang("endproject");?></a>
<i class="fa fa-circle"></i>
</li>
<?php }?>
						<li>
							<span class="active"><?= lang("task");?></span>
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
										<span class="caption-subject bold uppercase"><?= lang("task");?>
										<span style="margin-right:10px"><i class="icon-notebook"></i>
										<?php
											$user_id=$this->session->userdata('id_admin');
										$id_projects=$this->input->get("id_project");
											$id_worker=$this->input->get('user_id');
											
											if($this->session->userdata('alltasks_user')=="alltasks_user"){
										$main_data=$this->db->get_where("tbl_tasks",array('project_id'=>$id_projects,'user_id'=>$id_worker))->result();
											}
										$result_amount=count($main_data);
										$logo_projects=get_table_filed("tbl_projects",array("id"=>$id_projects),"logo");

										$select_tasks=get_table_data('tbl_tasks',array('project_id'=>$id_projects),1,'start_date','asc');
										$email_send=get_table_filed("tbl_projects",array("id"=>$id_projects),"name");
										
											$worker_fname=get_table_filed("tbl_users",array("id"=>$id_worker),"fname");
											$worker_lname=get_table_filed("tbl_users",array("id"=>$id_worker),"lname");
											$group_id=get_table_filed("tbl_users",array("id"=>$id_worker),"group_id");
											$dep_id=get_table_filed("tbl_users",array("id"=>$id_worker),"dep_id");
											$worker_type=get_table_filed("tbl_user_groups",array("id"=>$group_id),"name");
											$worker_desc=get_table_filed("services_type",array("id"=>$dep_id),"name");
											$worker_name=$worker_fname."&nbsp".$worker_lname;
										?>
										</span>
										<span style="margin-right:10px;direction:rtl;">
										
								   <?php if($logo_projects !=""){?>
								   <img src="<?=DIR?>uploads/projects/<?=$logo_projects?>" style="width:50px;height:50px;border-radius:50%;">
									<?php }else {?>
                                 
								  <img src="<?=DIR?>uploads/projects/avatar.png" style="width:50px;height:50px;">
								 <?php }  ?>
										</span>
										<span style="margin-right:10px;direction:rtl;"><i class="fa fa-user"></i>
									<?= lang('pm'); ?> :
										<?php
										$hrs_lang=lang("hrs");
										$day_lang=lang("day");
										$finish_date_task="";
										$start_date_task="";
										$id_projects=$this->input->get("id_project");
										
										$id_magager=get_table_filed("tbl_projects",array("id"=>$id_projects),"id_magager");
									$status=get_table_filed("tbl_projects",array("id"=>$id_projects),"status");
										$start_date_project=get_table_filed("tbl_projects",array("id"=>$id_projects),"creation_date");
										$update_date_project=get_table_filed("tbl_projects",array("id"=>$id_projects),"update_date");
										$start_date_pro=get_table_filed("tbl_projects",array("id"=>$id_projects),"start_date");
										$end_date_proj=get_table_filed("tbl_projects",array("id"=>$id_projects),"finish_date");
                                        $total_daies_project=get_table_filed("tbl_projects",array("id"=>$id_projects),"total_daies_project");
                                        $total_hrs_project=get_table_filed("tbl_projects",array("id"=>$id_projects),"total_hrs_project");
										 //echo "ffff".$start_date_project;

                                        if(count($select_tasks)>0){
									/*	$sql_finished_date=get_table_data('tbl_tasks',array('project_id'=>$id_projects,'finished_date!='=>""),1,'finished_date','desc');
										$sql_start_date=get_table_data('tbl_tasks',array('project_id'=>$id_projects,'select_date'=>'2'),1,'start_date','asc');
									
									
									if(count($sql_finished_date)>0){
									    	foreach($sql_finished_date as $sql_finished_date)
											$data_finishsql['finish_date']=$sql_finished_date->finished_date;
									    $finish_date_task=$sql_finished_date->finished_date;
									    	$this->db->update("tbl_projects",$data_finishsql,array('id'=>$id_projects));
									}
									    
									    
										if(count($sql_start_date)>0){
										    foreach($sql_start_date as $sql_start_date)
											$data_startsql['task_start_date']=$sql_start_date->start_date;
											$this->db->update("tbl_projects",$data_startsql,array('id'=>$id_projects));
										   $start_date_task=$sql_start_date->start_date;
										}*/
										
										
										}
										$fname=get_table_filed("tbl_users",array("id"=>$id_magager),"fname");
										$lname=get_table_filed("tbl_users",array("id"=>$id_magager),"lname");
										
										$working_progress=lang("working_progress");
										$working_wait=lang("working_wait");
										$project_Future=lang("project_Future");
										$project_end=lang("project_end");
										switch($status){
													case 1:
													  $status="<span class='label label-sm label-danger' style='background-color:#e7505a !important'>$working_progress </span>";
													  break;
													case 2:
													  $status="<span class='label label-sm label-success'>$working_wait </span>";
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
												
										echo $fname."&nbsp".$lname;
										?></span>
										<?php #endregion
									//	if(count($select_tasks)>0){
										?>
										
										<span style="margin-right:10px;direction:rtl;"><i class="fa fa-calendar"></i><?= lang("project duration");?>
										 :
										<?php

									//$query = $this->db->query("select  sum(total_hrs) as total_hrs from tbl_tasks where project_id=$id_projects group by project_id");
									//foreach ($query->result() as $row)
										//{
										//echo $row->total_hrs."&nbsp $hrs_lang  &nbsp&nbsp".ceil(($row->total_hrs/8))."&nbsp $day_lang &nbsp&nbsp";
										    // }
										    if($total_hrs_project!=""){
										     echo $total_hrs_project."&nbsp $hrs_lang";
										    }
										    else {
										echo lang("undefined");
										}
										?>
										</span>
										

			<span style="margin-right:10px;direction:rtl;"><i class="fa fa-calendar"></i><?= lang("project duration");?>:
										<?php
										
										if($total_daies_project!=""){
										    
							/* $total_hrs_project=(strtotime($finish_date_task)- strtotime($start_date_task))/(60*60);
							$total_daies=ceil($total_hrs_project/24);
							echo $total_daies."&nbspيوم &nbsp&nbsp";*/
							
							echo $total_daies_project."&nbsp $day_lang";
										}
										else {

										echo lang("undefined");
										}
										?>
										</span>

<span style="margin-right:10px;direction:rtl;"><i class="fa fa-calendar"></i>
										  <?= lang("creation_date");?>:
										<?php
									echo date("Y-m-d",strtotime($start_date_project));
										?>
										</span>
										<span style="margin-right:10px;direction:rtl;"><i class="fa fa-calendar"></i>
									<?= lang("update_date");?>

										<?php
									if($update_date_project!=""){echo date("Y-m-d",strtotime($update_date_project));}
										?>
										</span>
										<?php if(count($select_tasks)>0){?>

											<span style="margin-right:10px;direction:rtl;"><i class="fa fa-calendar"></i>
										  <?= lang("start_date");?>
										<?php
									if($start_date_pro!=""){echo date("Y-m-d",strtotime($start_date_pro));}
									else {

										echo lang("undefined");
									}
										?>
										</span>

										<span style="margin-right:10px;direction:rtl;"> <i class="fa fa-calendar"></i>
									<?= lang("end_date");?>
										<?php
									if($end_date_proj!=""){echo date("Y-m-d",strtotime($end_date_proj));}
									else {

										echo lang("undefined");
									}
										?>
										</span>
										<?php }?>
										<span style="margin-right:10px;direction:rtl;"><i class="icon-note"></i>
										<?= lang('status'); ?> 
										<?php
									echo $status;
										?>
										</span>

										<?php
										if($this->session->userdata('files_projects_view')=="files_projects_view"){
										?>
										<span style="margin-right:10px;direction:rtl;">
									<a href="<?=DIR?>admin/projects/files?id_project=<?php echo $id_projects;?>"> <i class="fa fa-file-pdf-o"></i><?= lang('files'); ?></a>
										</span>
										<?php }?>
										<?php
										if($this->session->userdata('project_users')=="project_users"){
										?>
										<span style="margin-right:10px;direction:rtl;">
									<a href="<?=DIR?>admin/task/project_users?id_project=<?php echo $id_projects;?>"> <i class="fa fa-users"></i> <?= lang('team'); ?> </a>
										</span>
										<?php }?>
										
											<?php
											if($this->session->userdata('chat')=="chat"){
										?>
										<span style="margin-right:10px;direction:rtl;">
									<a href="<?=DIR?>admin/chat?id_project=<?php echo $id_projects;?>" target="new"> <i class="fa fa-comments-o"></i> <?= lang("chat");?> </a>
										</span>
										<?php }?>
										
	<hr style="    margin:5px 0;">
							<h3 style="font-size:13px;color: #e7505a;"><?= lang("department");?>:</h3>
							<?php
							$type_id=get_table_filed("tbl_projects",array("id"=>$id_projects),"type_id");
							$deps_total_hrs=get_table_filed("tbl_projects",array("id"=>$id_projects),"deps_total_hrs");
						$type_id=explode(",",$type_id);
	$main_arr=explode(",",$deps_total_hrs);
$reaming_total_dep="";
	if($this->session->userdata('Project_Statistics')=="Project_Statistics"){
?>
<div class="row" style="margin:0px">
					<?php
					
					for($i=0; $i<count($type_id); $i++){
					    $service_name=get_table_filed("services_type",array("id"=>$type_id[$i]),"name");
					      $service_id=get_table_filed("services_type",array("id"=>$type_id[$i]),"id");
					  
					    $dep_progress=round(get_sub("user_task_log","total_hrs",array("id_project"=>$id_projects,'id_service'=>$service_id,'status'=>'2'))/60,2);
					    
					    if(count($main_arr)>0){ if($main_arr[$i]>0){$reaming_total_depceil=($main_arr[$i]-$dep_progress);}else {$reaming_total_depceil=($dep_progress);} }
                           ?>
							<div class="col-md-<?php if(count($type_id)>2){?>4<?php } else {?>6<?php }?> col-xs-12" style="float:left;direction: ltr; padding-right:2px;padding-left:2px;">
							    <span><i class="fa fa-external-link" style="margin-right:0px;"></i></span>
							    <span style="font-size:10px;color: #2276bf;font-weight: bold;"><?= $service_name;?></span>
							    <?php if(count($main_arr)>0){ ?>
							    <span style="font-size:11px;font-weight:600;text-transform:capitalize;">
							        All: </span><span style="text-transform:capitalize;color: #d00606;font-size:11px;">(<?= $main_arr[$i]."hrs";?>)</span><?php }?>
							        <?php if($dep_progress!=""){?>
							         <span style="font-size:11px;font-weight:600;text-transform:capitalize;">Used:</span>
							         <span style="text-transform:capitalize;color: #d00606;font-size:11px;">(<?= $dep_progress."hrs";?>)</span>
							         <?php }if($reaming_total_depceil!=""){ ?>
							         <span style="font-size:11px;font-weight:600;text-transform:capitalize;">Remaining:</span>
							         <span style="text-transform:capitalize;color: #d00606;font-size:11px;">(<?= $reaming_total_depceil."hrs";?>)</span>
							          <?php }?>
							           <?php if($reaming_total_dep<0){?>
							        <span class="label label-sm label-danger"  style="margin:0px 3px;"><?= "&nbsp;".lang("delay");?></span><?php }?>
							        </div>	
								<?php }?>
								</div>
								
								<?php }  else {?>
<div class="row"  style="margin:0px">
					<?php
					for($i=0; $i<count($type_id); $i++){
					    $service_name=get_table_filed("services_type",array("id"=>$type_id[$i]),"name");
					      $service_id=get_table_filed("services_type",array("id"=>$type_id[$i]),"id");
					      
					    $dep_progress=round(get_sub("user_task_log","total_hrs",array("id_project"=>$id_projects,'id_user'=>$id_admin,'id_service'=>$service_id,'status'=>'2'))/60,2);
  if(count($main_arr)>0){ if($main_arr[$i]>0){$reaming_total_depceil=($main_arr[$i]-$dep_progress);}else {$reaming_total_depceil=($dep_progress);} }
                           ?>
							<div class="col-md-<?php if(count($type_id)>2){?>4<?php } else {?>6<?php }?> col-xs-12" style="float:left;direction: ltr; padding-right:2px;padding-left:2px;">
							    <span><i class="fa fa-external-link" style="margin-right:0px;"></i></span>
							    <span style="font-size:10px;color: #2276bf;font-weight: bold;"><?= $service_name;?></span>
							    <?php if(count($main_arr)>0){ ?>
							    <span style="font-size:11px;font-weight:600;text-transform:capitalize;">
							        All: </span><span style="text-transform:capitalize;color: #d00606;font-size:11px;">(<?= $main_arr[$i]."hrs";?>)</span><?php }?>
							        <?php if($dep_progress!=""){?>
							         <span style="font-size:11px;font-weight:600;text-transform:capitalize;">Used:</span>
							         <span style="text-transform:capitalize;color: #d00606;font-size:11px;">(<?= $dep_progress."hrs";?>)</span>
							         <?php }if($reaming_total_dep!=""&&$dep_progress!=""){ ?>
							         <span style="font-size:11px;font-weight:600;text-transform:capitalize;">Remaining:</span>
							         <span style="text-transform:capitalize;color: #d00606;font-size:11px;">(<?= $reaming_total_dep."hrs";?>)</span>
							          <?php }?>
							           <?php if($reaming_total_dep<0){?>
							        <span class="label label-sm label-danger"  style="margin:0px 3px;"><?= "&nbsp;".lang("delay");?></span><?php }?>
							        </div>	
								<?php }?>
								</div>								
								
								<?php }?>
								<!-------------///////////////////////
								////////////////////////////////////--------
								//////////////////////Start total project time///////////////-------------->
								<?php 
							$sub_total_hrs=ceil (get_sub("user_task_log","total_hrs",array("id_project"=>$id_projects,'status'=>'2'))/60);
								?>
						<div class="row" style="margin:0px;">
								<hr style="margin:5px 0;">
							<h3 style="font-size:13px;color: #e7505a;">
							    <span><i class="fa fa-clock-o" style="margin-right:5px;"></i></span><?= lang("project duration total");?>:
							    
							     <?php if($total_hrs_project!=""){
							     $reaming_total=round($total_hrs_project-$sub_total_hrs,2);
							     ?>
							    <span style="font-size:12px;font-weight:bold;text-transform:capitalize;color: #757575;">
							        (<?= lang("deps_hrs_num");?>:<?= $total_hrs_project."&nbsp;$hrs_lang";?>)
							        (<?= lang("Progress");?>:<?= $sub_total_hrs."&nbsp;$hrs_lang";?>)
							        (<?= lang("remaining");?>:<?= $reaming_total."&nbsp;$hrs_lang";?> <?php if($reaming_total<0){?>
							        <span class="label label-sm label-danger"  style="margin:0px 3px;"><?= "&nbsp;".lang("delay");?></span><?php }?>)
							      </span><?php }?>
							    </h3>
							
							
							        
										</div>
										<!------------------>

									</div>
								</div>
								<span class="portlet-body">
									<div class="table-toolbar">
										<div class="row" style="margin:0px;">
										    <?php
										    	$statusp=get_table_filed("tbl_projects",array("id"=>$id_projects),"status");
										    	if($statusp!=4){
										    ?>
											<div class="col-md-6" style="">
												<?php if($result_amount>0){
													if($this->session->userdata('multitasks_delete')=="multitasks_delete"){
													?>
													<div class="btn-group" style="vertical-align: unset;margin-top:10px">
														<button id="sample_editable_1_2_new" class="btn sbold red delbutton_task"><?= lang('delete'); ?>  
															<i class="fa fa-remove"></i>
														</button>
													</div>
													<?php }?>
												<?php }?>
												<?php 
													if($this->session->userdata('tasks_add')=="tasks_add"){
													?>
													<div class="btn-group" style="vertical-align: unset;margin-top:10px">
													<button id="sample_editable_1_2_new" class="btn sbold green addbutton"> <?= lang('add'); ?> 
														<i class="fa fa-plus"></i>
													</button>
													</div><?php }?>
													<?php
													if($this->session->userdata('tasks_view')=="tasks_view"){
													?>
													<div class="btn-group" style="vertical-align: unset;margin-top:10px">
													<button id="sample_editable_1_2_new" class="btn sbold green all_monthly_tasks"> <?= lang('Monthly_tasks'); ?> 
														<i class="fa fa-search"></i>
													</button>
													</div>
													<?php } else {?>
													<div class="btn-group" style="vertical-align: unset;margin-top:10px">
													<button id="sample_editable_1_2_new" class="btn sbold green my_monthly_tasks"> <?= lang('Monthly_tasks'); ?> 
														<i class="fa fa-search"></i>
													</button>
													</div>
													<?php }?>
														</div>
														<?php }?>
												
	<?php if(!$this->session->userdata('tasks_view')&&$this->session->userdata('tasks_view')==""){
	 $count_task=get_table_filed("users_projects",array('id_projects'=>$id_projects,'id_user'=>$this->session->userdata('id_admin')),"count_task");
//	$p_total_hrs=get_table_filed("users_projects",array('id_projects'=>$id_projects,'id_user'=>$this->session->userdata('id_admin')),"total_hrs");
//	$actual_time=get_table_filed("users_projects",array('id_projects'=>$id_projects,'id_user'=>$this->session->userdata('id_admin')),"actual_time");
	$over_time_hrs=get_table_filed("users_projects",array('id_projects'=>$id_projects,'id_user'=>$this->session->userdata('id_admin')),"over_time_hrs");
	?>
		
						
								<?php if($count_task!=""){?>
								<div class="col-md-5">
							<h3 style="font-size:13px;color: #7d7d7d;">
							   <?= lang("total_task");?>:
							    <span style="font-size:12px;font-weight:bold;text-transform:capitalize;color: #d00606;">
							        (<?= $count_task;?>)</span>
							    </h3>
							</div>	
							<?php }?>
								<?php if($over_time_hrs!=""){?>
								<div class="col-md-5">
							<h3 style="font-size:13px;color: #7d7d7d;">
							   <?= lang("overtime");?>:
							    <span style="font-size:12px;font-weight:bold;text-transform:capitalize;color: #d00606;">
							        (<?= $over_time_hrs."&nbsp;$hrs_lang";?>)</span>
							    </h3>
							</div>	
							<?php }?>
							
	
<?php } else if($this->session->userdata('alltasks_user')=="alltasks_user"){?>

<div class="col-md-6">
<div class="btn-group" style="width:100%;margin-top:10px">
<form action="<?=base_url()?>admin/task/tasks_user" target="_blank" id="myform">
<input type="hidden" value="<?= $id_projects ?>" id="id_project" name="id_project">
<select name="user_id" class="form-control" id="id_user" >
<option value="0" selected><?= lang("select_user");?></option>
<?php $users_projects=$this->db->get_where("users_projects",array('id_projects'=>$id_projects,'status'=>'1'))->result();
if(count($users_projects)>0){
foreach($users_projects as $users_projects){
$user_fname=get_table_filed("tbl_users",array("id"=>$users_projects->id_user),"fname");
$user_lname=get_table_filed("tbl_users",array("id"=>$users_projects->id_user),"lname");
?>
<option value="<?= $users_projects->id_user;?>"><?= $user_fname?>&nbsp<?= $user_lname?>&nbsp (<?= $users_projects->count_task;?>)</option>
<?php }?>
<?php }?>
</select>
<button id="sample_editable_1_2_new" class="btn sbold green fliter" type="button">	<i class="fa fa-search"></i><?= lang("filter");?></button>
</form>
</div>
</div>
<?php }?>
</div>	

<div class="row"  style="margin:0px">
	    	<?php 
	    	$id_worker=$this->input->get('user_id');
	    	$id_project=$this->input->get('id_project');
$array=array('user_id'=>$id_worker,'project_id'=>$id_project,'real_date>='=>date("Y-m-01"),'real_date<='=>date("Y-m-t"),'status'=>'2');
	 $count_task=$this->db->get_where("tbl_tasks",$array)->result();
$p_total_hrs="";
$query = $this->db->query("select sum(total_hrs) as total_hrs from tbl_tasks where 'user_id'=$id_worker&'project_id'=$id_project&'status'='2'&'real_date'>=date('Y-m-01') and 'real_date'<=date('Y-m-t')");

foreach ($query->result() as $row){$p_total_hrs= $row->total_hrs; }
$over_time_hrs="";
$query1 = $this->db->query("select sum(over_time_hrs) as over_time_hrs from tbl_tasks where 'user_id'=$id_worker&'project_id'=$id_project&'status'='2'&'real_date'>=date('Y-m-01') and 'real_date'<=date('Y-m-t')");
foreach ($query1->result() as $row1){$over_time_hrs= $row1->over_time_hrs; }
	?>
		
						
								<?php if(count($count_task)!=0){?>
								<div class="col-md-5">
							<h3 style="font-size:13px;color: #7d7d7d;">
							   <?= lang("total_task");?>:
							    <span style="font-size:12px;font-weight:bold;text-transform:capitalize;color: #d00606;">
							        (<?= count($count_task);?>)</span>
							    </h3>
							</div>	
							<?php }?>
								<?php if($over_time_hrs!=""){?>
								<div class="col-md-5">
							<h3 style="font-size:13px;color: #7d7d7d;">
							   <?= lang("overtime");?>:
							    <span style="font-size:12px;font-weight:bold;text-transform:capitalize;color: #d00606;">
							        (<?= $over_time_hrs."&nbsp;$hrs_lang";?>)</span>
							    </h3>
							</div>	
							<?php }?>
	    
	</div>	
								
								
									<?php if(!empty($results)){?>
									<form action="<?=$url?>admin/task/delete" method="POST" id="form">
									<input type="hidden" value="<?= $id_projects?>" name="id_project">
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
											</tr>
										</tfoot>
										<tbody>
										<?php
											$undefined=lang("undefined");	
										$current_date=date("Y-m-d H:i");
                                            foreach($results as $data) {
											$project_id=$data->project_id;
											$name=$data->name;
											$user_id=$data->user_id;
											$total_hrs=$data->total_hrs;
											$select_date=$data->select_date;
											$code=$data->code;
											$start_date=$data->start_date;
											$select_enddate=$data->select_enddate;
											$finished_date=$data->finished_date;
											$status_review=$data->status_review;
											$status_review1=$data->status_review1;
											$review_date=$data->review_date;
											$review1_date=$data->review1_date;
if($start_date!=""&&$select_date==2&&$finished_date!=""&&$select_enddate==2&&(strtotime($finished_date)>=strtotime($current_date))){


												if(round((strtotime($finished_date)-strtotime($current_date))/(60*60*24))<1){
													$reaming_time=lang("today");
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
												$reaming_time=lang("undefined");	
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
											
											
$undefined=lang("undefined");		

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
if($status_review1==1){$main_review1=lang("notes");
$review1_date="<span class='label label-sm label-Grey'  style='color:#000; background-color:#eceef1'>".date("Y-m-d H:i",strtotime($data->review1_date))."</span><br>".
"<span class='label label-sm label-Grey' style='color:#000; background-color:#eceef1'>".$main_review1."</span>";
}
else{$main_review1=lang("done");
$review1_date="<span class='label label-sm label-Grey' style='background-color: #2276bf;color: #fff !important'>".date("Y-m-d H:i",strtotime($data->review1_date))."</span><br>".
"<span class='label label-sm label-Grey' style='background-color: #2276bf;color: #fff !important'>".$main_review1."</span>";
}
}
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
				$query_hrs = $this->db->query("select  sum(total_hrs) as final_total_hrs from user_task_log where id_task=$data->id and enddate IS NOT NULL group by id_task");
				if(count($query_hrs->result())>0){
					foreach ($query_hrs->result() as $query_hrs)
					$minutes=$query_hrs->final_total_hrs;
					//$intdiv="(".$minutes.")".intdiv($minutes, 60).':'. ($minutes % 60);
					$intdiv=intdiv($minutes, 60).':'. ($minutes % 60);
					if($total_hrs_m>=$minutes){$final_reaming=$total_hrs_m-$minutes;
						$reaming=intdiv(($final_reaming), 60).':'. ($final_reaming % 60);}
						else {$final_reaming=$minutes-$total_hrs_m;
							$reaming="-".intdiv(($final_reaming), 60).':'. ($final_reaming % 60);}
					
				$total_muites="<span class='label label-sm label-success'>$intdiv</span><br>
				<span class='label label-sm label-success'>$reaming</span>
				";
				
				$minutes_compare=$minutes;
			}
			else {
				$reaming=intdiv((($total_hrs*60)-$minutes), 60).':'. ((($total_hrs*60)-$minutes) % 60);
				$minutes_compare=0;
					$total_muites="<span class='label label-sm label-success'>$undefined</span><br>
					<span class='label label-sm label-success' >$reaming</span>";;
						}	
						
$start_date_act=get_table_filed("user_task_log",array("id_task"=>$data->id),"start_date");
$enddate_act=get_table_filed("user_task_log",array("id_task"=>$data->id),"enddate");
$total_hrs_act=get_table_filed("user_task_log",array("id_task"=>$data->id),"total_hrs");
$user_fname=get_table_filed("tbl_users",array("id"=>$data->user_id),"fname");
$user_lname=get_table_filed("tbl_users",array("id"=>$data->user_id),"lname");
$final_user_task=$user_fname." ".$user_lname;

?>

<tr class="odd gradeX" style="<?php if($reaming_value==2){?>background-color:#fff <?php } else if($reaming_value==1){ ?>background-color:#f3f5f9<?php }?>">
												<td>
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
												      <input type="hidden" value="<?=$data->over_time_hrs;?>" class="over_time"> 
												       <input type="hidden" value="<?= $this->session->userdata("fullname_user"); ?>" class="star"> </td>
												    
												<td> <?=$total_hrs;?> </td>
											 <td> <?=$data->over_time_hrs;?> </td>

												<td  style="direction:ltr"> <?=$total_muites;?> </td>
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
<a  href="<?=DIR?>admin/task/change_review?type=0&id_project=<?php echo $project_id;?>&id_status=<?php echo $data->id;?>" title="<?= lang("review_f")?>">
<i class="fa fa-edit" title="<?= lang("review_f")?>"></i>
<?php } else {?>
<a  title="<?= lang("review_f")?>"	>
<?php }?>
<?php  if($main_review==2){ date("Y-m-d H:i",strtotime($review_date));}else { echo $review_date;}?></a>
</td>
												 
												 
												 
												 <td style="direction:ltr">
<?php if($this->session->userdata('task_review1')=="task_review1" &&$status_review1!=2&&$data->status==2){	?>
<a  href="<?=DIR?>admin/task/change_review?type=1&id_project=<?php echo $project_id;?>&id_status=<?php echo $data->id;?>" title="<?= lang("review_s")?>" >
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
<a  href="<?=DIR?>admin/task/change_status?id_project=<?=$project_id;?>&id_status=<?php echo $data->id;?>" title=" <?= lang("status");?>" style="padding: 1px 0px;">
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
												<a  href="<?=DIR?>admin/task/change_status?id_project=<?=$project_id;?>&id_status=<?php echo $data->id;?>" title="<?= lang("status");?>" style="padding: 1px 0px;">
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

												<td>
													<div class="btn-group">
														<button class="btn btn-xs red dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> <?= lang("operations")?>
															<i class="fa fa-angle-down"></i>
														</button>
														<ul class="dropdown-menu pull-left" role="menu">
															<!--<li><a href="javascript:;"><i class="fa fa-eye"></i> Details </a></li>-->
															<?php if($this->session->userdata('user_statistics')=="user_statistics"){	?>
															<li><a href="<?= DIR?>admin/task/user_statistics?id_project=<?=$project_id?>&id=<?=$data->id?>"><i class="fa fa-eye"></i><?= lang("task_statics");?></a></li>
															<?php }	if($this->session->userdata('review_statistics')=="review_statistics"){?>

															<li><a href="<?= DIR?>admin/task/review_statistics?id_project=<?=$project_id?>&id=<?=$data->id?>"><i class="fa fa-eye"></i> <?=lang("review_statistics")?></a></li>
															<?php }?>
															<?php
														if($this->session->userdata('task_details')=="task_details"){
														?>
															<li><a href="<?=$url?>admin/task/details?id_project=<?= $id_projects?>&id_status=<?=$data->id;?>"><i class="fa fa-eye"></i>  <?= lang("details")?> </a></li>
														<?php }?>
															<?php if($data->status!=2) {?>
													<?php
														if($this->session->userdata('tasks_edit')=="tasks_edit"&&($status_review1==0||$status_review==0)&&$data->status==0){
														?>
														<li><a href="<?=$url?>admin/task/edit?id_project=<?= $id_projects?>&id_status=<?=$data->id;?>"><i class="fa fa-pencil"></i>  <?= lang("update")?> </a></li>
														<li><a href="<?=$url?>admin/task/start_date?id_project=<?= $id_projects?>&id_status=<?=$data->id;?>"><i class="fa fa-calendar"></i>  <?= lang("start_date")?>  </a></li>
														<?php
														}
														if($this->session->userdata('tasks_delete')=="tasks_delete"&&($status_review1==0||$status_review==0)&&$data->status==0){
														?>
															<li><a href="<?=$url?>admin/task/delete?id_project=<?= $id_projects?>&id_status=<?=$data->id;?>"><i class="fa fa-remove"></i>  <?= lang("delete")?> </a></li>
														<?php 
														}
														?>
															<?php
															if($this->session->userdata('start_time')=="start_time"&&$status_review1==0&&$status_review==0&&$data->status==0){
														?>
															<li><a href="<?=$url?>admin/task/start_time?id_project=<?= $id_projects?>&id_status=<?=$data->id;?>"><i class="fa fa-remove"></i> <?= lang("start_date");?>  </a></li>
														<?php 
														}
														?>
														</ul>
													</div>
												</td>
											</tr>


                                            <?php }}?>
										</tbody>
									</table>
									</form>
									<?php 
											
									  } else{?>
									<center><span class="caption-subject font-red bold uppercase"><?= lang("nodata");?></span></center>
									<?php }?>
								<div class="row">
								     <?php
										    	$statusp=get_table_filed("tbl_projects",array("id"=>$id_projects),"status");
										    	if($statusp!=4){
										    ?>
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
													
														<button id="sample_editable_1_2_new" class="btn sbold GREY type_current"><?= lang("task_type_current");?> 
													</button>
												
													<button id="sample_editable_1_2_new" class="btn sbold GREY button_other"><?= lang("task_button_other");?> 
													</button>
													<br>
													<button id="sample_editable_1_2_new" class="btn sbold green  button_new_status"><?= lang("task_type_new");?> 
													</button>
												<button id="sample_editable_1_2_new" class="btn sbold green button_note_status"><?= lang("task_type_note");?> 
													</button>
													
									<?php
									
									if($this->session->userdata('end_project')=="end_project"){?>
 <a href="<?=DIR?>admin/projects/chaneg_finished?project_id=<?=$id_projects?>"><button id="sample_editable_1_2_new" class="btn sbold red"> <?= lang("end_project");?></button></a>
<?php }?>
											</div>
											<?php }?>
                                    <div class="col-md-5 col-sm-5">
									<br>
                                        <div class="dataTables_info" id="sample_1_2_info" role="status" aria-live="polite">
                                        <ul class="nav nav-pills">
                                            <li>
                                            <a href="javascript:;">  <?= lang("total");?> :
                                                <span class="badge badge-success pull-right"> <?php echo $result_amount; ?> </span>
                                            </a>
                                            </li>
                                        </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-sm-7">
                                        <div style="text-align: right;" class="dataTables_paginate paging_bootstrap_full_number" id="sample_1_2_paginate">
                                           <ul class="pagination" style="visibility: visible;margin:auto">
            <?php foreach($links as $link){?><?php echo $link;?><?php } ?>

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
	
	$(".project_all_task").click(function(e) {
        window.location.assign("<?= DIR?>admin/task/tasks?id_project="+<?=$this->input->get('id_project');?>);
    });
    $(".addbutton").click(function(e) {
        window.location.assign("<?= DIR?>admin/task/add?id_project="+<?=$this->input->get('id_project');?>);
    });

    $(".errorbutton").click(function(e) {
        window.location.assign("<?= DIR?>admin/task/user_tasks_error?id_project="+<?=$this->input->get('id_project');?>+"&user_id="+<?=$this->input->get('user_id');?>);
    });

    $(".workedbuuton").click(function(e) {
        window.location.assign("<?= DIR?>admin/task/user_tasks_working?id_project="+<?=$this->input->get('id_project');?>+"&user_id="+<?=$this->input->get('user_id');?>);
    });
    $(".finishedbuuton").click(function(e) {
        window.location.assign("<?= DIR?>admin/task/user_tasks_finished?id_project="+<?=$this->input->get('id_project');?>+"&user_id="+<?=$this->input->get('user_id');?>);
    });

    $(".allbutton").click(function(e) {
        window.location.assign("<?= DIR?>admin/task/tasks_user?id_project="+<?=$this->input->get('id_project');?>+"&user_id="+<?=$this->input->get('user_id');?>);
    });

	$(".reviewbutton").click(function(e) {
        window.location.assign("<?= DIR?>admin/task/user_tasks_wait_review?id_project="+<?=$this->input->get('id_project');?>+"&user_id="+<?=$this->input->get('user_id');?>);
    });
	$(".waitbutton").click(function(e) {
        window.location.assign("<?= DIR?>admin/task/user_tasks_wait?id_project="+<?=$this->input->get('id_project');?>+"&user_id="+<?=$this->input->get('user_id');?>);
    });
	
	$(".my_monthly_tasks").click(function(e) {
        window.location.assign("<?= DIR?>admin/task/user_monthly_tasks?task_type="+<?=$this->input->get('type_task');?>+"&user_id="+<?=$this->input->get('user_id');?>+"&id_project="+<?=$this->input->get('id_project');?>);
    });
    	$(".all_monthly_tasks").click(function(e) {
        window.location.assign("<?= DIR?>admin/task/user_monthly_tasks?task_type="+<?=$this->input->get('type_task');?>+"&user_id="+<?=$this->input->get('user_id');?>+"&id_project="+<?=$this->input->get('id_project');?>);
    });
    
    	$(".button_note_status").click(function(e) {
        window.location.assign("<?= DIR?>admin/task/user_status_task?user_id="+<?=$this->input->get('user_id');?>+"&type_task="+<?=$this->input->get('type_task');?>+"&status_task=2&id_project="+<?=$this->input->get('id_project');?>);
    });
    	$(".button_new_status").click(function(e) {
        window.location.assign("<?= DIR?>admin/task/user_status_task?user_id="+<?=$this->input->get('user_id');?>+"&type_task="+<?=$this->input->get('type_task');?>+"&status_task=1&id_project="+<?=$this->input->get('id_project');?>);
    });
    	$(".type_current").click(function(e) {
        window.location.assign("<?= DIR?>admin/task/user_tasks_type?user_id="+<?=$this->input->get('user_id');?>+"&type=1&id_project="+<?=$this->input->get('id_project');?>);
    });
    
    $(".button_other").click(function(e) {
        window.location.assign("<?= DIR?>admin/task/user_tasks_type?user_id="+<?=$this->input->get('user_id');?>+"&type=2&id_project="+<?=$this->input->get('id_project');?>);
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
	$(".delbutton_task").click(function(){
		if($('input[type=checkbox]:not("#checkAll"):checked').length>0){
var b=confirm("هل متاكد من حذف مجموعة من المهام");
if(b==true){
			$('#form').unbind('submit').submit();//renable submit
}
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




