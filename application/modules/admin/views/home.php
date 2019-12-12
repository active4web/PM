<?php
//session_start();
ob_start();
if(!isset($_SESSION['id_admin'])||$_SESSION['id_admin']==""){ 
header("Location:".base_url()."admin/login"); 
}
else{
$id_admin=$_SESSION['id_admin'];
$admin_name=$_SESSION['admin_name'];
$last_login=$_SESSION['last_login'];
$curt='home';
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
<title><?= lang("title");?></title>
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
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                      
                        <!-- END PAGE TITLE -->
                    </div>
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                    <!--<ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">Dashboard</span>
                        </li>
                    </ul>-->
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">

                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                             <?php 
if($this->session->userdata('future_project')=="future_project"){
 ?> 						    
<a href="<?=DIR?>admin/projects/future"> <?php } else {?>
<a class="message_premmions">
    <?php }?>   

                            <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-green-sharp">
                                            <span data-counter="counterup" data-value="<?=count($future);?>"></span>
                                        </h3>
                                        <small><?=lang("fproject");?></small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-note"></i>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
 <?php 
if($this->session->userdata('wait_project')=="wait_project"){
 ?> 						    
<a href="<?=DIR?>admin/projects/wait"> <?php } else {?><a class="message_premmions"><?php }?>                             
                            <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-red-haze">
                                            <span data-counter="counterup" data-value="<?=count($awaiting);;?>"></span>
                                        </h3>
                                     <small><?=lang("wproject");?></small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-note"></i>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>

<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
<?php 
if($this->session->userdata('current_project')=="current_project"){
 ?> 						    
<a href="<?=DIR?>admin/projects/current_projects"> <?php } else {?><a class="message_premmions"><?php }?>                            
                            <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-purple-soft">
                                            <span data-counter="counterup" data-value="<?=count($current);?>"></span>
                                        </h3>
                                   <small><?= lang("cproject");?></small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-note"></i>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                       
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
 <?php 
if($this->session->userdata('finished_project')=="finished_project"){
 ?> 						    
<a href="<?=DIR?>admin/projects/finished"> <?php } else {?><a class="message_premmions">
						        <?php }?>
                            <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-blue-sharp">
                                            <span data-counter="counterup" data-value="<?=count($completed);;?>"></span>
                                        </h3>
                                        <small><?=lang("endproject");?> </small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-note"></i>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                        
                        
                        	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
<a href="<?=DIR?>admin/other/tasks">   
 <?php 
if($this->session->userdata('view_allother_task')=="view_allother_task"||$this->session->userdata('add_other_task')=="add_other_task"){
 ?> 						    
<a href="<?=DIR?>admin/other/tasks"> <?php } else {?><a class="message_premmions"><?php }?>    
 <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-blue-sharp">
                                            <span data-counter="counterup" data-value="<?=count($other_tasks);?>"></span>
                                        </h3>
                                       <small><?=lang("othertask");?> </small>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-tasks"></i>
                                    </div>
                                </div>
                            </div>
                            
                            </a>   
                        </div>
                        
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
                <!-- END CONTENT BODY -->
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
