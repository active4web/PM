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
$curt='team_work';
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
<title>تعديل بيانات عميل</title>
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
							<a href="<?=$url.'admin';?>">لوحة التحكم</a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<a href="<?=$url.'admin/customers/show/';?>">العملاء</a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<span class="active">تعديل بيانات عميل</span>
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
                                                    <i class="fa fa-gift"></i><?=lang('add_admins');?></div>
                                            </div>
                                        <div class="portlet light bordered form-fit">
                                            <div class="portlet-title">
                                                <div class="caption"></div>
                                                <div class="actions"></div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
												<?php
													foreach($data as $result){
														$id = $result->id;
														$username = $result->username;
														$password = $result->password;
														$email = $result->email;
														$phone = $result->phone;
														$img = $result->img;
														$points = $result->points;
														$status = $result->status;
														$invitation_count = $result->invitation_count;
													}
													if($img!=""){
														if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/customers/'.$img)){
															$imge = base_url('uploads/customers/'.$img);
														}else{
															$imge = base_url('uploads/customers/avatar.png');
														}
													}else{
														$imge = base_url('uploads/customers/avatar.png');
													}
													
													switch($status){
													case '0':
													  $status="<span class='label label-sm label-danger'>غير مفعل</span>";
													  break;
													case '1':
													  $status="<span class='label label-sm label-success'>مفعل</span>";
													  break;
													default:
													  break; 
												}
												?>
                                                <form action="<?=$url;?>admin/customers/edit_action" class="form-horizontal form-bordered"  method="post" enctype="multipart/form-data">
												<?php if ($this->session->flashdata('message')) { ?>
													 <?=$this->session->flashdata('message');?>
												<?php } ?>
												<input type="hidden" name="id" value="<?=$id;?>" id="id>
                                                    <div class="form-body">
														<div class="form-group">
														<div class="col-md-3" style="text-align:center"></div>
                                                            <div class="col-md-6" style="text-align:center">
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
																			<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
																				<img src="<?=$imge;?>" alt="" /> </div>
																			<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
																			<div>
																				<span class="btn default btn-file">
																					<span class="fileinput-new">الصورة الشخصية</span>
																					<span class="fileinput-exists">تغيير</span>
																					<input type="file" name="img"> </span>
																				<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> حذف </a>
																			</div>
																		</div>
															</div>
															<div class="col-md-3" style="text-align:center"></div>
                                                        </div>
														
														<div class="form-group">
														<div class="col-md-2"><span class="help-block">إسم العميل</span></div>
                                                            <div class="col-md-8">
                                                                <input value="<?=$username;?>" type="text" placeholder="إسم العميل" class="form-control" name="username">
															</div>
															<div class="col-md-2"></div>
                                                        </div>
														
														<div class="form-group">
														<div class="col-md-2"><span class="help-block">كلمة المرور</span></div>
                                                            <div class="col-md-8">
                                                                <input value="" type="password" placeholder="كلمة المرور" class="form-control" name="password">
															</div>
															<div class="col-md-2"></div>
                                                        </div>
														
														<div class="form-group">
														<div class="col-md-2"><span class="help-block">البريد الإلكتروني</span></div>
                                                            <div class="col-md-8">
                                                                <input value="<?=$email;?>" type="text" placeholder="البريد الإلكتروني" class="form-control" name="email" id="email">
                                                                <div class="alert alert-danger" id="confirm2" style="display:none">
																	<strong>خطأ!</strong>عفوا البريد الإلكتروني موجود من قبل
																</div>
															</div>
															<div class="col-md-2"></div>
                                                        </div>
														
														<div class="form-group">
														<div class="col-md-2"><span class="help-block">التليفون</span></div>
                                                            <div class="col-md-8">
                                                                <input value="<?=$phone;?>" type="text" placeholder="التليفون" class="form-control" name="phone" id="phone">
                                                                <div class="alert alert-danger" id="confirm" style="display:none">
																	<strong> خطأ! </strong> عفوا رقم التليفون موجود من قبل
																</div>
															</div>
															<div class="col-md-2"></div>
                                                        </div>
														
														<div class="form-group">
														<div class="col-md-2"><span class="help-block">عدد النقاط المتاحة</span></div>
                                                            <div class="col-md-8">
                                                                <input value="<?=$points;?>" type="text" placeholder="عدد النقاط المتاحة" class="form-control" name="points">
															</div>
															<div class="col-md-2"></div>
                                                        </div>
														
														<div class="form-group">
														<div class="col-md-2"><span class="help-block">عدد الدعوات المتاحة</span></div>
                                                            <div class="col-md-8">
                                                                <input value="<?=$invitation_count;?>" type="text" placeholder="عدد الدعوات المتاحة" class="form-control" name="invitation_count">
															</div>
															<div class="col-md-2"></div>
                                                        </div>
														
                                                        <div class="form-group">
														<div class="col-md-2"><span class="help-block">الحالة</span></div>
                                                            <div class="col-md-8">
                                                                <a  data-id="<?=$id;?>" class="btn btn-xs purple table-icon edit" title="change status" style="padding: 1px 0px;">
																<i class="fa fa-edit" title="edit status"></i>
																<span class="code_actvation-<?=$id;?>"><?php echo $status;?></span></a>
															</div>
															<div class="col-md-2"></div>
                                                        </div>
														
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button id="cvcx" type="submit" class="btn green">
                                                                <i class="fa fa-check"></i>تعديل</button>
                                                                <button type="reset" class="btn default">إلغاء</button>
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
<script>
$(document).ready(function(e) {
$(".edit").click(function(e) {
var id = $(this).data("id");
//alert(id);
var data={id:id};
			$.ajax({
				url: '<?php echo base_url("admin/customers/check_status") ?>',
                type: 'POST',
                data: data,				
                success: function( data ) {
                	if (data == "1") {
					// alert(data);
                		$(".code_actvation-"+id).html("<span class='label label-sm label-success'>مفعل</span>");
                	}
                	if (data == "0") {
                		$(".code_actvation-"+id).html("<span class='label label-sm label-danger'>غير مفعل</span>");
                	}
				}
         });
	});
});
</script>
<script type="text/javascript">
	$('#phone').focusout(function(e){
	var phone = $('#phone').val();
	e.preventDefault();
	//alert(data);
	$.ajax({
		url: '<?php echo base_url()?>admin/customers/check_phone',
		type: 'POST',
		dataType: 'json',
		data: {phone: phone},
		success: function(data) {
			///alert(data);
			console.log(data.msg);
			if(data.msg==1){ 
				$("#confirm").show();
				//$('#phone').val('<?=$phone;?>');
				$('#cvcx').prop("type", "button");
			}else{
				$("#confirm").hide();
				$('#cvcx').prop("type", "submit");
			}
		}
	});
});
</script>
<script type="text/javascript">
	$('#email').focusout(function(e){
	var email = $('#email').val();
	e.preventDefault();
	//alert(data);
	$.ajax({
		url: '<?php echo base_url()?>admin/customers/check_email',
		type: 'POST',
		dataType: 'json',
		data: {email: email},
		success: function(data) {
			///alert(data);
			console.log(data.msg);
			if(data.msg==1){ 
				$("#confirm2").show();
				//$('#email').val('<?=$email;?>');
				$('#cvcx').prop("type", "button");
			}else{
				$("#confirm2").hide();
				$('#cvcx').prop("type", "submit");
			}
		}
	});
});
</script>
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
