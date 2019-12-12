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
<html lang="en" dir="<?= lang("rtl");?>">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8">
<title><?= lang("profile");?></title>
<?php include ("design/inc/header.php");?>
<style>
/* The container */
.cont {
    width:100px;
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size:14px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default radio button */
.cont input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom radio button */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
  border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.cont:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.cont input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.cont input:checked ~ .checkmark:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.cont .checkmark:after {
 	top: 9px;
	left: 9px;
	width: 8px;
	height: 8px;
	border-radius: 50%;
	background: white;
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
                    <!-- BEGIN PAGE BREADCRUMB -->
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
							<a href="<?=$url.'admin';?>"><?= lang("admin_panel");?></a>
							<i class="fa fa-circle"></i>
						</li>
                        <li>
                            <span><?= lang("profile");?></span>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
							<span class="active"><?= lang("update");?></span>
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
                                                <div class="caption caption-md">
                                                    <i class="icon-globe theme-font hide"></i>
                                                    <span class="caption-subject font-blue-madison bold uppercase"><?= lang("account_data");?></span>
                                                </div>
                                                <ul class="nav nav-tabs">
												<?php #endregion
													if($this->session->userdata('edit_allprofile')=="edit_allprofile"){
													?>
                                                    <li class="active">
                                                        <a href="#tab_1_1" data-toggle="tab"><?= lang("personal_data");?></a>
                                                    </li>
													<li>
                                                        <a href="#tab_1_2" data-toggle="tab"> <?= lang("profile_picture");?></a>
                                                    </li>
													<?php } else if($this->session->userdata('edit_profile')=="edit_profile"){
														
														?>
														<li class="active">
                                                        <a href="#tab_1_2" data-toggle="tab"> <?= lang("profile_picture");?></a>
                                                    </li>

													<?php }?>
                                                    
                                                    <li>
                                                        <a href="#tab_1_3" data-toggle="tab"><?= lang("change_password");?></a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab_1_4" data-toggle="tab"><?= lang("mean_lang");?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <?php
                $id_admin=$this->session->userdata('id_admin');
                //@$_SESSION['site_favicon']
                                            foreach($data_admin as $data_admin)
                                            ?>
                                            <div class="portlet-body">
                                                <div class="tab-content">
                                                    <!-- PERSONAL INFO TAB -->
													<?php #endregion
													if($this->session->userdata('edit_allprofile')=="edit_allprofile"){
													$email_sending=get_table_filed("mail_system",array("id_user"=>$id_admin),"email");
													?>
                                                    <div class="tab-pane active" id="tab_1_1">
                                                        <form role="form" action="<?=$url;?>admin/update_profile" method="post">
															<div class="form-group">
                                                                <label class="control-label"><?= lang("fname");?> </label>
                                                                <input type="text" placeholder="<?= lang("fname");?>" value="<?php echo $data_admin->fname;?>" class="form-control" name="fname"> 
															</div>
                                                            <div class="form-group">
                                                                <label class="control-label"><?= lang("sname");?></label>
                                                                <input type="text" placeholder="<?= lang("sname");?>" value="<?php echo $data_admin->sname;?>" class="form-control" name="sname"> 
															</div>
                                                            <div class="form-group">
                                                                <label class="control-label"><?= lang("fname");?> </label>
                                                                <input type="text" placeholder="<?= lang("fname");?>" value="<?php echo $data_admin->lname;?>" class="form-control" name="lname"> </div>
                                                      
                                           
                                                            <div class="form-group">
                                                                <label class="control-label"><?= lang("email");?></label>
                                                                <input type="text" name="email" value="<?php echo $data_admin->email;?>" placeholder="<?= lang("email");?>" class="form-control"> </div>

																<div class="form-group">
                                                                <label class="control-label"><?= lang("mail_sent");?></label>
                                                                <input type="text" name="email_sending" value="<?php echo $email_sending;?>" placeholder="<?= lang("mail_sent");?>" class="form-control"> </div>


                                                            <div class="margiv-top-10">
                                                            <input type="submit" value="<?= lang("saved");?>" class="btn green">
                                                            </div>
                                                        </form>
                                                    </div>
													<div class="tab-pane" id="tab_1_2">

													<?php }  else if($this->session->userdata('edit_profile')=="edit_profile"){?>
                                                    <div class="tab-pane active" id="tab_1_2">
													<?php }?>
                                                        <form action="<?=$url;?>admin/profileimg" method="post" enctype="multipart/form-data">
                                                            <div class="form-group">
                                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                        <img src="<?=$url;?>uploads/site_setting/admin_panel/<?=$this->session->userdata('avatar')?>" alt=""> </div>
                                                                    <div>
                                                                        <span class="btn default btn-file">
                                                                            <span class="fileinput-new"> <?= lang("img");?>  </span>
                                                                            <span class="fileinput-exists"> <?= lang("change");?> </span>
                                                                            <input type="file" name="file"> </span>
                                                                        <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput">  <?= lang("delete");?>  </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="margin-top-10">
                                                            <input type="submit" value="<?= lang("saved");?>" class="btn green">
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- END CHANGE AVATAR TAB -->
                                                    <!-- CHANGE PASSWORD TAB -->
                                                    <div class="tab-pane" id="tab_1_3">
                                                        <form action="<?=$url;?>admin/editpassword" id="form" method="post">
                                                            <div class="form-group">
                                                            <label class="control-label"><?= lang("cre_pass");?></label>
                                                            <input type="password" name="oldpassword" id="newpass" class="form-control">
                                                            <div class="alert alert-danger" id="oldpa" style="display:none">
                                                            <strong><?= lang("error");?>!</strong>  <?= lang("error_pass");?> .</div>
                                                            </div>
                                                            <div class="form-group">
                                                            <label class="control-label"><?= lang("new_pass");?></label>
                                                            <input type="password" name="newpassword" id="pass" class="form-control"> </div>
                                                            <div class="form-group">
                                                            <label class="control-label"><?= lang("confirm_new_pass");?></label>
                                                            <input type="password" name="confirmpassword" id="retpass" class="form-control"> 
                                                            <div class="alert alert-danger" id="confirm" style="display:none">
                                                            <strong><?= lang("error");?>!</strong><?= lang("error_confirm_new_pass");?>.</div>
                                                            </div>
                                                            <div class="margin-top-10">
                                                            <input type="button" value="<?= lang("saved");?>" class="btn green" id="cvcx">
                                                            <input type="reset" value="<?= lang("cancel");?>" class="btn default">
                                                            </div>
                                                        </form>
                                                    </div>
                                                      <div class="tab-pane" id="tab_1_4">
                                                        <form action="<?=$url;?>admin/editlang" id="form" method="post">
                                                          <label><?= lang("mylang");?></label>
                                                          
                                                          
<?

if($this->session->userdata('lang')){echo $this->session->userdata('lang');}
	$lang_type =get_table_filed('tbl_users',array('id'=>$this->session->userdata('id_admin')),"lang_type");
	if($lang_type==1){
?>

<div class="form-group">
<label class="cont">
<input type="radio" checked="checked" name="radio" value="1">عربى
<span class="checkmark"></span>
</label>   
</div>
<div class="form-group">
<label class="cont">
<input type="radio" name="radio" value="0">انجليزى
<span class="checkmark"></span>
</label>     
</div>
           <?php } else {?>    
           
           <div class="form-group">
<label class="cont">
<input type="radio"  name="radio" value="1">Arabic
<span class="checkmark"></span>
</label>   
</div>
<div class="form-group">
<label class="cont">
<input type="radio" name="radio" checked="checked"  value="0">Einglish
<span class="checkmark"></span>
</label>     
</div>

<?php }?>
           <div class="form-group">
           <div class="margin-top-10">
                                                            <input type="submit" value="<?= lang("saved");?>" class="btn green">
                                                            <input type="reset" value="<?= lang("cancel");?>" class="btn default">
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
		    //alert(data);
            $.ajax({
                url: '<?php echo base_url()?>admin/check_password',
                type: 'POST',
                dataType: 'json',
                data:data,
                success: function( data ) {
			    ///alert(data);
                    if(data==1){ $("#confirm").show();$('#cvcx').prop("type", "button");}
			        else {$("#confirm").hide();$('#cvcx').prop("type", "submit");}
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
                url: '<?php echo base_url()?>admin/old_password',
                type: 'POST',
                dataType: 'json',
                data:data,
                success: function( data ) {
			    //alert(data);
                    if(data==1){$("#oldpa").hide();$('#cvcx').prop("type", "submit");}
			        else {$("#oldpa").show();$('#cvcx').prop("type", "button");}
		        }

            });
        });
    </script>

</body></html>
