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
$curt='tasks';
}

?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" dir="rtl">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8">
<title>احصائيات المراجعة</title>
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
						<?php
$id_projects=$this->input->get("id_project");
$status=get_table_filed("tbl_projects",array("id"=>$id_projects),"status");
if($status==1){
?>
<li>
<a href="<?= $url . 'admin/projects/current_projects'; ?>">المشاريع الحالية</a>
<i class="fa fa-circle"></i>
</li>
<?php }?>
<?php 
if($status==4){
?>
<li>
<a href="<?= $url . 'admin/projects/finished'; ?>">المشاريع المنتهية</a>
<i class="fa fa-circle"></i>
</li>
<?php }?>						
						<li>
							<a href="<?= $url . 'admin/task/tasks?id_project='. $this->input->get("id_project");;?>">المهام</a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<span class="active">احصائيات المراجعة</span>
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
										<span class="caption-subject bold uppercase">احصائيات المراجعة
										<span style="margin-right:10px"><i class="icon-notebook"></i>
										<?php
										$id_projects=$this->input->get("id_project");
										$logo_projects=get_table_filed("tbl_projects",array("id"=>$id_projects),"logo");

										$select_tasks=get_table_data('tbl_tasks',array('project_id'=>$id_projects),1,'start_date','asc');
										$email_send=get_table_filed("tbl_projects",array("id"=>$id_projects),"name");
										echo $email_send;
										?>
										</span>
										<span style="margin-right:10px;direction:rtl;">
										
								   <?php if($logo_projects !=""){?>
								   <img src="<?=DIR?>uploads/projects/<?=$logo_projects?>" style="width:50px;height:50px;border-radius:50%;">
									<?php }else {?>
                                 
								  <img src="<?=DIR?>uploads/projects/avatar.png" style="width:50px;height:50px;">
								  \ <?php }  ?>
										</span>
										<span style="margin-right:10px;direction:rtl;"><i class="fa fa-user"></i>
										مدير المشروع :
										<?php
										$id_projects=$this->input->get("id_project");
										$id_magager=get_table_filed("tbl_projects",array("id"=>$id_projects),"id_magager");
										$status=get_table_filed("tbl_projects",array("id"=>$id_projects),"status");
										$start_date_project=get_table_filed("tbl_projects",array("id"=>$id_projects),"start_date");
										$update_date_project=get_table_filed("tbl_projects",array("id"=>$id_projects),"update_date");

                                        if(count($select_tasks)>0){
										$sql_finished_date=get_table_data('tbl_tasks',array('project_id'=>$id_projects,'finished_date!='=>""),1,'finished_date','desc');
										$sql_start_date=get_table_data('tbl_tasks',array('project_id'=>$id_projects,'select_date'=>'2'),1,'start_date','asc');
										foreach($sql_finished_date as $sql_finished_date)
											$data_sql['finish_date']=$sql_finished_date->finished_date;
											foreach($sql_start_date as $sql_start_date)
											$data_sql['task_start_date']=$sql_start_date->start_date;
											$this->db->update("tbl_projects",$data_sql,array('id'=>$id_projects));
										$finish_date_task=$sql_finished_date->finished_date;
										$start_date_task=$sql_start_date->start_date;
										}
										$fname=get_table_filed("tbl_users",array("id"=>$id_magager),"fname");
										$lname=get_table_filed("tbl_users",array("id"=>$id_magager),"lname");
										
										switch($status){
													case 1:
													  $status="<span class='label label-sm label-danger' style='background-color:#e7505a !important'>قيد العمل</span>";
													  break;
													case 2:
													  $status="<span class='label label-sm label-success'>قيد الانتظار</span>";
													  break;
													  case 3:
													  $status="<span class='label label-sm label-success'>مستقبلى</span>";
													  break;
													  case 4:
													  $status="<span class='label label-sm label-success' style='background-color:#4099ff !important'>تم الانتهاء</span>";
													  break;
													default:
													  break; 
												}
										echo $fname."&nbsp".$lname;
										?></span>
										<?php #endregion
										if(count($select_tasks)>0){
										?>
										<span style="margin-right:10px;direction:rtl;"><i class="fa fa-calendar"></i>
										مدة التنفيذ:
										<?php

									$query = $this->db->query("select  sum(total_hrs) as total_hrs from tbl_tasks where project_id=$id_projects group by project_id");

									foreach ($query->result() as $row)
										{
										echo $row->total_hrs."&nbspساعة &nbsp&nbsp".ceil(($row->total_hrs/8))."&nbspيوم &nbsp&nbsp";
										     }
										?>
										</span>


										<span style="margin-right:10px;direction:rtl;"><i class="fa fa-calendar"></i>
										مدة المشروع الفعلى:
										<?php
										if($finish_date_task!=""&&$start_date_task!=""){
							$total_hrs_project=(strtotime($finish_date_task)- strtotime($start_date_task))/(60*60);
							$total_daies=ceil($total_hrs_project/24);
							echo ceil($total_hrs_project)."&nbspساعة &nbsp&nbsp".$total_daies."&nbspيوم &nbsp&nbsp";
										}
										else {

											echo "غير معلومة";
										}
										?>
										</span>

											<?php }?>
										<span style="margin-right:10px;direction:rtl;"><i class="fa fa-calendar"></i>
										تاريخ الانشاء:
										<?php
									if($start_date_project!=""){echo date("Y-m-d H:i",strtotime($start_date_project));}
										?>
										</span>
										<span style="margin-right:10px;direction:rtl;"><i class="fa fa-calendar"></i>
										تاريخ التعديل

										<?php
									if($update_date_project!=""){echo date("Y-m-d H:i",strtotime($update_date_project));}
										?>
										</span>
										<?php if(count($select_tasks)>0){?>

											<span style="margin-right:10px;direction:rtl;"><i class="fa fa-calendar"></i>
										تاريخ البداء
										<?php
									if($start_date_task!=""){echo date("Y-m-d H:i",strtotime($start_date_task));}
									else {

										echo "غير معلومة";
									}
										?>
										</span>

										<span style="margin-right:10px;direction:rtl;"> <i class="fa fa-calendar"></i>
										تاريخ الانتهاء
										<?php
									if($finish_date_task!=""){echo date("Y-m-d H:i",strtotime($finish_date_task));}
									else {

										echo "غير معلومة";
									}
										?>
										</span>
										<?php }?>
										<span style="margin-right:10px;direction:rtl;"><i class="icon-note"></i>
										الحالة
										<?php
									echo $status;
										?>
										</span>
										<?php
										if($this->session->userdata('files_projects_view')=="files_projects_view"){
										?>
										<span style="margin-right:10px;direction:rtl;">
									<a href="<?=DIR?>admin/projects/files?id_project=<?php echo $id_projects;?>"> <i class="fa fa-file-pdf-o"></i>ملفات المشروع</a>
										</span>
										<?php }?>
										<?php
										if($this->session->userdata('project_users')=="project_users"){
										?>
										<span style="margin-right:10px;direction:rtl;">
									<a href="<?=DIR?>admin/task/project_users?id_project=<?php echo $id_projects;?>"> <i class="fa fa-users"></i>فريق عمل المشروع </a>
										</span>
										<?php }?>
										
									</div>
								</div>
								<span class="portlet-body">
									<div class="table-toolbar">
										<div class="row">
										
										</div>
									</div>
									<?php if(count($data)>0){?>
									<form action="<?=$url?>admin/task/delete" method="POST" id="form">
									<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1_2">
										<thead>
											<tr>
										
												<th> تاريخ البداية</th>
												<th> تاريخ النهاية</th>
												<th>المدة</th>
												<th>الموظف</th>
												<th>الحالة</th>
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
											</tr>
										</tfoot>
										<tbody>
										<?php
                                            foreach($data as $data) {
											$id_user=$data->id_user;
											$status=$data->status;
											
											$status=$data->status	;
												switch($status){
													case 0:
													  $status="<span class='label label-sm label-danger' style='background-color:#e7505a !important'>لما تبدا</span>";
													  break;
													case 1:
													  $status="<span class='label label-sm label-success'>جارى العمل عليها</span>";
													  break;
													  case 2:
													  $status="<span class='label label-sm label-success'>تم الانتهاء</span>";
													  break;
													default:
													  break; 
												}
												
												$fname=get_table_filed("tbl_users",array("id"=>$id_user),"fname");
												$lname=get_table_filed("tbl_users",array("id"=>$id_user),"lname");

?>
											<tr class="odd gradeX">
												<td> <?=$data->start_date;?> </td>
												<td> <?=$data->enddate;?> </td>
												<td> <?=$data->total_hrs;?> </td>
												<td> <?=$fname."&nbsp&nbsp".$lname;?> </td>
												<td> <?=$status;?> </td>

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
        window.location.assign("<?= DIR?>admin/task/add?id_project="+<?=$this->input->get('id_project');?>);
    });

    $(".errorbutton").click(function(e) {
        window.location.assign("<?= DIR?>admin/task/tasks_error?id_project="+<?=$this->input->get('id_project');?>);
    });

    $(".workedbuuton").click(function(e) {
        window.location.assign("<?= DIR?>admin/task/tasks_working?id_project="+<?=$this->input->get('id_project');?>);
    });
    $(".finishedbuuton").click(function(e) {
        window.location.assign("<?= DIR?>admin/task/tasks_finished?id_project="+<?=$this->input->get('id_project');?>);
    });

    $(".allbutton").click(function(e) {
        window.location.assign("<?= DIR?>admin/task/tasks?id_project="+<?=$this->input->get('id_project');?>);
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
	$(".delbutton").click(function(){
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
