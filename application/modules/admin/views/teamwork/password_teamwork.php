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
$curt='';
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
<title>كلمة السر</title>
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
                    <!-- BEGIN PAGE BREADCRUMB -->
               <ul class="page-breadcrumb breadcrumb">
                        <li>
							<a href="<?=$url.'admin';?>"><?=lang('admin_panel');?></a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
                        <a href="<?=$url.'admin/teamwork';?>">فريق العمل</a>
                        <i class="fa fa-circle"></i>
						</li>
                        <li>
                            <span class="active">تعديل  كلمة السر</span>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN PROFILE SIDEBAR -->
                            <div class="profile-sidebar">
                                <!-- PORTLET MAIN -->                                <!-- END PORTLET MAIN -->
                                <!-- PORTLET MAIN -->

                                <!-- END PORTLET MAIN -->
                            </div>
                            <!-- END BEGIN PROFILE SIDEBAR -->
                            <!-- BEGIN PROFILE CONTENT -->
                            <div class="profile-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="portlet light bordered">
                                            <div class="tabbable-line">
                                              
                                               
                                            </div>
                                            <?php
                $id_admin=$this->session->userdata('id_admin');
                //@$_SESSION['site_favicon']
                                            foreach($data as $data_admin)
                                            ?>
                                            <div class="portlet-body">
                                                <div class="tab-content">
                                                    <!-- PERSONAL INFO TAB -->
													<?php #endregion
													
													?>
                                                

                                                    <!-- END CHANGE AVATAR TAB -->
                                                    <!-- CHANGE PASSWORD TAB -->
                                                    <div >
                                                           <input type="hidden" id="idrep" value="1">
                                                              <input type="hidden" id="idold" value="1">
                                                        <form action="<?=$url;?>admin/teamwork/editpassword" id="form" method="post">
                                                            <input type="hidden" name="iduser" value="<?= $data_admin->id?>">
                                                            <div class="form-group">
                                                            <label class="control-label">كلمة المرور الحالية</label>
                                                            <input type="password" name="oldpassword" id="newpass" class="form-control">
                                                            <div class="alert alert-danger" id="oldpa" style="display:none">
                                                            <strong>خطأ!</strong> كلمة المرور الحالية غير صحيحة.</div>
                                                            </div>
                                                            <div class="form-group">
                                                            <label class="control-label">كلمة المرور الجديدة</label>
                                                            <input type="password" name="newpassword" id="pass" class="form-control"> </div>
                                                            <div class="form-group">
                                                            <label class="control-label">أعد كتابة كلمة المرور الجديدة</label>
                                                            <input type="password" name="confirmpassword" id="retpass" class="form-control"> 
                                                            <div class="alert alert-danger" id="confirm" style="display:none">
                                                            <strong>خطأ!</strong>كلمة المرور غير متطابقة.</div>
                                                            </div>
                                                            <div class="margin-top-10">
                                                            <input type="button" value="حفظ" class="mainbutton btn green" id="cvcx">
                                                            <input type="reset" value="مسح" class="btn default">
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- END CHANGE PASSWORD TAB -->
                                                    <!-- PRIVACY SETTINGS TAB -->
                                                    <!-- END PRIVACY SETTINGS TAB -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END PROFILE CONTENT -->
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
            </div>
		</div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <?php include ("design/inc/footer.php");?>
        <!-- END FOOTER -->

        <?php include ("design/inc/footer_js.php");?>
<?php 
if(isset($_SESSION['msg'])){
?>
<script>
$(document).ready(function(e) {
 toastr.success("<?php echo $_SESSION['msg']?>");
});
</script>
<?php }?>
<script type="text/javascript">
        $('#retpass').focusout(function(e){
	        $(".n_error").hide();
		    e.preventDefault();
		    var data=$("#form").serialize();
		  //  alert(data);
            $.ajax({
                url: '<?php echo base_url()?>admin/teamwork/check_password',
                type: 'POST',
                dataType: 'json',
                data:data,
                success: function( data ) {
			 //  alert(data);
                    if(data==1){ 
                        toastr.error("كلمة المرور غير متطابقة");
                        $("#idrep").val(1);
                    }
			        else {$("#idrep").val(2);}
		        }

            });
        });
    </script>





    <script type="text/javascript">
        $('#newpass').focusout(function(e){
	        $(".n_error").hide();
		    e.preventDefault();
		    var data=$("#form").serialize();
		    //alert(data);
            $.ajax({
                url: '<?php echo base_url()?>admin/teamwork/old_password',
                type: 'POST',
                dataType: 'json',
                data:data,
                success: function( data ) {
			    //alert(data);
                    if(data==1){$("#oldpa").hide(); $("#idold").val(2);;}
			        else {$("#oldpa").show(); $("#idold").val(1);;}
		        }

            });
        });
    </script>

</body></html>
