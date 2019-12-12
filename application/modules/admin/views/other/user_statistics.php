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
						<li>
							<a href="<?= $url ?>admin/other/tasks">المهام</a>
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
									<i class="icon-notebook font-dark"></i>
										<span class="caption-subject bold uppercase">احصائيات المراجعة
									
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
													  $status="<span class='label label-sm label-danger' style='background-color:#e7505a !important'> لم تبدا</span>";
													  break;
													case 1:
													  $status="<span class='label label-sm label-success'>جارى العمل عليها</span>";
													  break;
													  case 2:
													  $status="<span class='label label-sm label-success'>تم الانتهاء</span>";
													  break;
													  case 3:
													  $status="<span class='label label-sm label-success'>معلقة</span>";
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
