<?php
//session_start();
ob_start();
if (!isset($_SESSION['admin_name']) || $_SESSION['admin_name'] == "") {
header("Location:" . base_url() . "admin/login");
} else {
$id_admin = $_SESSION['id_admin'];
$admin_name = $_SESSION['admin_name'];
$last_login = $_SESSION['last_login'];
$curt = 'other_task';
$url=base_url();
}
foreach($data as $data)
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
<title>تعديل تاريخ البداية </title>
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
<a href="<?=$url?>admin/other/tasks">المهام</a>
<i class="fa fa-circle"></i>
</li>
<li>
<span>تعديل تاريخ البداية</span>
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
<i class="fa fa-gift"></i>تعديل تاريخ البداية</div>
</div>

<div class="portlet light bordered form-fit">
<div class="portlet-title">
<div class="caption"></div>
<div class="actions"></div>
</div>
<div class="portlet-body form">
<!-- BEGIN FORM-->
<form action="<?php echo $url ?>admin/other/start_date_action" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$data->id?>">

<div class="form-body">

<div class="form-group">
<div class="col-md-1"></div>
<div class="col-md-10">
<span class="help-block">اسم المهمة</span>
<input name="name_task" disabled value="<?=$data->name?>" type="text" placeholder="اسم المهمة" class="form-control" required>
</div>
<div class="col-md-1"></div>
</div>

<div class="form-group">
<div class="col-md-1"></div>
<div class="col-md-10">
<span class="help-block">عدد الساعات</span>
<input name="name_task" disabled value="<?=$data->total_hrs?>" type="text" placeholder="عدد الساعات" class="form-control" required>
</div>
<div class="col-md-1"></div>
</div>




<div class="form-group">
<div class="col-md-1"></div>
<div class="col-md-10">
<span class="help-block">تاريخ  البداية</span>
<input type="radio"  class="form-control" style="height:22px;" name="select_date" value="1" <?php if($data->select_date==1){?> checked <?php }?>> غير معلوم الان
<input type="radio"  class="form-control" style="height:22px;" name="select_date" value="2" <?php if($data->select_date==2){?> checked <?php }?> >تحديد وقت البداية
<input name="start_time"  <?php if($data->select_date==1){?> value="<?=date("Y-m-d H:i");?>" <?php }else {?>value="<?php echo $data->start_date;?>"
<?php }?>
 style="direction: ltr;width: 100%; <?php if($data->select_date==1){?> display:none <?php }?>" size="18" id="meeting_start" type="text"  class="form_datetime form-control editable editable-click" >
</div>
<div class="col-md-1"></div>
</div>

<div class="form-group">
<div class="col-md-1"></div>
<div class="col-md-10">
<span class="help-block">تاريخ  النهاية</span>
<input type="radio"  class="form-control" style="height:22px;" name="select_enddate" value="1" <?php if($data->select_enddate==1){?> checked <?php }?>> حسابه اوتو
<input type="radio"  class="form-control" style="height:22px;" name="select_enddate" value="2" <?php if($data->select_enddate==2){?> checked <?php }?> >تحديد وقت النهاية
<input name="enddate"  <?php if($data->select_enddate==1){?> value="<?=date("Y-m-d H:i");?>" <?php }else {?>value="<?php echo $data->finished_date;?>"
<?php }?>
 style="direction: ltr;width: 100%; <?php if($data->select_enddate==1){?> display:none <?php }?>" size="18" id="enddate" type="text"  class="form_datetime form-control editable editable-click" >
</div>
<div class="col-md-1"></div>
</div>
<input name="id_status" type="hidden"  value="<?=$this->input->get('id_status');?>" class="form-control" >
<div class="form-actions">
<div class="row">
<div class="col-md-offset-3 col-md-9">
<button type="submit" class="btn green">
<i class="fa fa-check"></i> حفظ</button>
<button type="button" class="btn default cancelbutton">إلغاء</button>
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



var radioValue = $("input[name='select_enddate']:checked").val();
if(radioValue==2){
$("#enddate").show();
}
else {
$("#enddate").hide();	
}


});
});
</script>
<script type="text/javascript">
    $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
</script>  
</body>
</html>
