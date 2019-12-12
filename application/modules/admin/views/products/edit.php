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
$curt='products';
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
<title>تعديل منتج</title>
<?php include ("design/inc/header.php");?>
<style>
.thumbnail a>img, .thumbnail>img {
    height: 110px !important;
}
</style>
</head>
<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md">
	<!-- BEGIN HEADER -->
	<?php include ("design/inc/topbar.php");?>
		<script type="text/javascript" src="<?=$url?>design/ckeditor/ckeditor.js"></script>
		<script type="text/javascript" src="<?=$url?>design/ckfinder/ckfinder.js"></script>
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
							<a href="<?=$url.'admin/products/show/';?>">منتجات</a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<span class="active">تعديل منتج</span>
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
															<i class="fa fa-gift"></i> تعديل منتج </div>

													</div>

													<div class="portlet light bordered form-fit">
														<div class="portlet-title">
															<div class="caption"></div>
															<div class="actions"></div>
														</div>
														<?php
															foreach($data as $result){
																$id = $result->id;
																$name_ar = $result->name_ar;
																$name_en = $result->name_en;
																$desc_ar = $result->desc_ar;
																$desc_en = $result->desc_en;
																$img = $result->img;
																$default_price = $result->default_price;
															}
															$products_images = get_table('products_images',['product_id' =>$id]);
														?>
														<div class="portlet-body form">
															<!-- BEGIN FORM-->
															<form action="<?php echo $url?>admin/products/edit_action" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
																<div class="form-body">
																
																	<div class="form-group">
																	<div class="col-md-2"></div>
																	<div class="col-md-10">
																		<div class="fileinput fileinput-new" data-provides="fileinput">
																						<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
																						<img src="<?=$url;?>uploads/site_setting/products/<?php echo $img?>" alt="" />
																						</div>
																						<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
																						<div>
																							<span class="btn default btn-file">
																								<span class="fileinput-new">الصورة الرئيسية للمنتج</span>
																								<span class="fileinput-exists">تغيير</span>
																								<input type="file" name="img"> </span>
																							<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> حذف </a>
																						</div>
																					</div>
																		</div>
																	</div>
																	
																	<div class="form-group">
																	<div class="col-md-2"></div>
																	<div class="col-md-10">
																		<div class="fileinput fileinput-new" data-provides="fileinput">
																		<span class="btn default">
																			<span class="fileinput-new">مجموعة صور للمنتج</span>
																			<input type="file" name="files[]" multiple="multiple">
																		</span>
																		<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> حذف </a>
																		</div>
																		<br><br>
																		<?php
																		//Columns must be a factor of 12 (1,2,3,4,6,12)
																		$numOfCols = 6;
																		$rowCount = 0;
																		$bootstrapColWidth = 12 / $numOfCols;
																		?>
																		<div class="row">
																		<?php foreach($products_images as $images){?>
																			<div class="col-md-<?php echo $bootstrapColWidth; ?>" id="imgs_<?=$images->id;?>" class="imgs_<?=$images->id;?>">
																				<div class="thumbnail">
																					<img src="<?=$url;?>uploads/site_setting/products_gallery/<?=$images->img?>" width="100%" alt="<?=$images->img?>">
																					<a class="btn btn-danger" onClick="dell_img('<?=$images->id?>');"> <i class="fa fa-close"></i> </a>
																				</div>
																			</div>
																		<?php 
																		$rowCount++;
																		if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
																		}
																		?>
																		</div>
																		</div>
																	</div>
																	
																	
																
																	<div class="form-group">
																		<div class="col-md-2"></div>
																		<div class="col-md-10">
																			<input value="<?=$name_ar;?>" name="name_ar" type="text" placeholder="إسم المنتج عربي" class="form-control" required>
																			<input type="hidden" name="id" value="<?=$id;?>">
																			<span class="help-block"> إسم المنتج عربي </span>
																		</div>
																	</div>
																	<div class="form-group">
																		<div class="col-md-2"></div>
																		<div class="col-md-10">
																			<textarea name="desc_ar" id="contents"><?=$desc_ar;?></textarea>
																			<!-- <?php //echo $this->ckeditor->editor("description","description");?> -->
																			<span class="help-block"> الوصف عربي </span>
																		</div>
																	</div>
																	
																	<div class="form-group">
																		<div class="col-md-2"></div>
																		<div class="col-md-10">
																			<input value="<?=$name_en;?>" name="name_en" type="text" placeholder="إسم المنتج إنجليزي" class="form-control" required>
																			<span class="help-block"> إسم المنتج إنجليزي </span>
																		</div>
																	</div>
																	<div class="form-group">
																		<div class="col-md-2"></div>
																		<div class="col-md-10">
																			<textarea name="desc_en" id="contents_en"><?=$desc_en;?></textarea>
																			<!-- <?php //echo $this->ckeditor->editor("description","description");?> -->
																			<span class="help-block"> الوصف إنجليزي </span>
																		</div>
																	</div>
																	
																	<div class="form-group">
																		<div class="col-md-2"></div>
																		<div class="col-md-10">
																			<input value="<?=$default_price;?>" name="default_price" type="text" placeholder="سعر المنتج بالسوق" class="form-control" required>
																			<span class="help-block"> سعر المنتج بالسوق </span>
																		</div>
																	</div>
																	
																	<div class="form-actions">
																		<div class="row">
																			<div class="col-md-offset-3 col-md-9">
																				<button type="submit" class="btn green">
																					<i class="fa fa-check"></i> حفظ </button>
																				<button type="button" class="btn default cancelbutton">إلغاء</button>
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
    $(".cancelbutton").click(function(e) {
        window.location.assign("show");
    });
});
</script>
<script type="text/javascript">
	//CKEDITOR.replace('description');
	var editor = CKEDITOR.replace( 'contents' );
	var editor = CKEDITOR.replace( 'contents_en' );
	CKFinder.setupCKEditor( editor );
</script>
<script type="text/javascript">
function dell_img(id){
	$.ajax({
	url: '<?=base_url();?>admin/products/del_img', // returns "[1,2,3,4,5,6]"
	type: "POST",
	data:{id:id},
	dataType: 'json', // jQuery will parse the response as JSON
	success: function (data) {
		console.log(data);
		//alert('#imgs_'+id);
		toastr.warning(data.msg);
		$('#imgs_'+id).hide(500);
		}
	});
}
</script>
</body>
</html>