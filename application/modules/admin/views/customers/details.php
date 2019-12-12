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
$curt='cu_details';
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
<title>تفاصيل عميل</title>
<?php include ("design/inc/header.php");?>
<style>
.mt-comments .mt-comment {
    background-color: darkgoldenrod;
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
							<a href="<?=$url.'admin';?>">لوحة التحكم</a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<a href="<?=$url.'admin/customers/show/';?>">العملاء</a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<span class="active">تفاصيل العميل</span>
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
															<i class="fa fa-gift"></i> تفاصيل العميل </div>

													</div>

													<div class="portlet light bordered form-fit">
														<div class="portlet-title">
															<div class="caption"></div>
															<div class="actions"></div>
														</div>
														<?php
															foreach($data as $result){
																$id = $result->id;
																$username = $result->username;
																$email = $result->email;
																$phone = $result->phone;
																$img = $result->img;
																$points = $result->points;
																$activation_code = $result->activation_code;
																$invitation_code = $result->invitation_code;
																$invitation_count = $result->invitation_count;
																$alarm_near = $result->alarm_near;
																$alarm_finished = $result->alarm_finished;
																$social_name = $result->social_name;
																$creation_date = $result->creation_date;
															}
															if($alarm_near!=0){$near = "نعم";}else{$near = "لا";}
															if($alarm_finished!=0){$finished = "نعم";}else{$finished = "لا";}
															//$imgee = base_url()."uploads/customers/".$img;
															if($img!=""){
															if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/customers/'.$img)){
																$imge = base_url('uploads/customers/'.$img);
															}else{
																$imge = base_url('uploads/customers/avatar.png');
															}
															}else{
																$imge = base_url('uploads/customers/avatar.png');
															}
														?>
														<div class="portlet-body form">
															<!-- BEGIN FORM-->
															<div class="form-horizontal form-bordered">
																<input type="hidden" name="id" value="<?=$id;?>">
																<div class="form-body">
																	<div class="form-group">
																		<div class="col-md-1"></div>
																		<div class="col-md-10">
																			<div class="mt-comments">
																				<div class="mt-comment">
																					<div class="mt-comment-img">
																						<img src="<?=$imge?>" width="50px" height="50px" /> </div>
																					<div class="mt-comment-body">
																						<div class="mt-comment-info">
																							<span class="mt-comment-author"><?=$username;?></span>
																							<span class="mt-comment-date"><?=$creation_date;?></span>
																						</div>
																					</div>
																				</div>
																			</div>
																			<br>
																			<div class="portlet box yellow">
																				<div class="portlet-title">
																					<div class="caption">
																						<i class="fa fa-gift"></i> تفاصيل العميل </div>
																					<div class="tools">
																						<a href="javascript:;" class="collapse"> </a>
																					</div>
																				</div>
																				<div class="portlet-body">
																					<div class="row">
																						<div class="col-md-3 col-sm-3 col-xs-3">
																							<ul class="nav nav-tabs tabs-left">
																								<li class="active">
																									<a href="#tab_6_1" data-toggle="tab"> بيانات العميل </a>
																								</li>
																								<li>
																									<a href="#tab_6_2" data-toggle="tab"> المزدات المشارك بها </a>
																								</li>
																								<li>
																									<a href="#tab_6_3" data-toggle="tab"> المزادات الفائز بها </a>
																								</li>
																								<li>
																									<a href="#tab_6_4" data-toggle="tab"> شراء نقاط </a>
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
																														<th> الإسم </th>
																														<td> <?=$username;?> </td>
																													</tr>
																													<tr>
																														<th> البريد الإلكتروني </th>
																														<td> <?=$email;?> </td>
																													</tr>
																													<tr>
																														<th> التليفون </th>
																														<td> <?=$phone;?> </td>
																													</tr>
																													<tr>
																														<th> كود التفعيل </th>
																														<td> <?=$activation_code;?> </td>
																													</tr>
																													<tr>
																														<th> كود الدعوة </th>
																														<td> <?=$invitation_code;?> </td>
																													</tr>
																													<tr>
																														<th> عدد النقاط المتاحة </th>
																														<td> <?=$points;?> </td>
																													</tr>
																													<tr>
																														<th> عدد الدعوات المتاحة </th>
																														<td> <?=$invitation_count;?> </td>
																													</tr>
																													<tr>
																														<th> التنبيه بقرب إنتهاء مزاد </th>
																														<td> <?=$near;?> </td>
																													</tr>
																													<tr>
																														<th> التنبيه بإنتهاء مزاد </th>
																														<td> <?=$finished;?> </td>
																													</tr>
																													<tr>
																														<th> تسجيل عن طريق مواقع التواصل </th>
																														<td> <?=$social_name;?> </td>
																													</tr>
																													<tr>
																														<th> تاريخ الإشتراك </th>
																														<td> <?=$creation_date;?> </td>
																													</tr>
																												</tbody>
																											</table>
																										</div>
																									</div>
																								</div>
																								<div class="tab-pane fade" id="tab_6_2">
																									<?php //print_r($values);?>
																									<div class="portlet-body">
																										<div class="table-responsive">
																											<?php if($values){?>
																											<table class="table table-bordered">
																												<thead>
																													<th> المزاد </th>
																													<th> وقت البدء </th>
																													<th> وقت الإنتهاء </th>
																												</thead>
																												<tbody>
																												<?php 
																												foreach($values as $val){
																												$product_id = get_this('mazad',['id'=>$val->ids],'product_id');
																												$mazad = $this->data->get_table_data('mazad',array('id'=>$val->ids));
																												//print_r($mazad);
																												?>
																													<tr>
																														<td> <a href="<?=base_url()."admin/mazadat/details?id=".$val->ids;?>" target="_blank"><?php echo get_this('products',['id'=>$product_id],'name_ar');?></a> </td>
																														<td> <?=$mazad[0]->start_time;?> </td>
																														<td> <?=$mazad[0]->end_time;?> </td>
																													</tr>
																												<?php }?>
																												</tbody>
																											</table>
																											<?php }else{?>
																												عفوا لاتوجد مزادات مشارك بها
																											<?php }?>
																										</div>
																									</div>
																								</div>
																								<div class="tab-pane fade" id="tab_6_3">
																									<div class="portlet-body">
																										<div class="table-responsive">
																											<?php if($winner){?>
																											<table class="table table-bordered">
																												<thead>
																													<th> المزاد </th>
																													<th> وقت البدء </th>
																													<th> وقت الإنتهاء </th>
																													<th> تاريخ الإضافة </th>
																													<th> السعر </th>
																												</thead>
																												<tbody>
																												<?php
																												//print_r($winner);
																												foreach($winner as $win){
																												$product_id = get_this('mazad',['id'=>$win->mazad_id],'product_id');
																												$mazad = $this->data->get_table_data('mazad',array('id'=>$win->mazad_id));
																												?>
																													<tr>
																														<td> <a href="<?=base_url()."admin/mazadat/details?id=".$win->mazad_id;?>" target="_blank"><?php echo get_this('products',['id'=>$product_id],'name_ar');?></a> </td>
																														<td> <?=$mazad[0]->start_time;?> </td>
																														<td> <?=$mazad[0]->end_time;?> </td>
																														<td> <?=$win->creation_date;?> </td>
																														<td> <?=$win->price;?> </td>
																													</tr>
																												<?php }?>
																												</tbody>
																											</table>
																											<?php }else{?>
																												عفوا لاتوجد مزادات فائز بها
																											<?php }?>
																										</div>
																									</div>
																								</div>
																								<div class="tab-pane fade" id="tab_6_4">
																									<div class="portlet-body">
																										<div class="table-responsive">
																											<?php if($transactions){?>
																											<table class="table table-bordered">
																												<thead>
																													<th> رقم العملية </th>
																													<th> إسم الباقة عربي </th>
																													<th> إسم الباقة إنجليزي </th>
																													<th> السعر </th>
																													<th> عدد النقاط </th>
																													<th> التاريخ </th>
																												</thead>
																												<tbody>
																												<?php
																												//print_r($winner);
																												foreach($transactions as $transaction){
																												?>
																													<tr>
																														<td> <?=$transaction->process_number;?> </td>
																														<td> <?=$transaction->title_ar;?> </td>
																														<td> <?=$transaction->title_en;?> </td>
																														<td> <?=$transaction->amount;?> </td>
																														<td> <?=$transaction->points;?> </td>
																														<td> <?=$transaction->creation_date;?> </td>
																													</tr>
																												<?php }?>
																												</tbody>
																											</table>
																											<?php }else{?>
																												عفوا لاتوجد اي عمليات خاصة بشراء نقاط
																											<?php }?>
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