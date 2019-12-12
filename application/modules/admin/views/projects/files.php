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
$curt='allprojects';
}
$id_project=$this->input->get('id_project');
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
<title><?= lang("files");?></title>
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
							<a href="<?=$url.'admin';?>"><?= lang("admin_panel");?></a>
							<i class="fa fa-circle"></i>
						</li>
						
						<?php 
if($this->input->get("project_id")==2){
?>

<li>
<a href="<?= $url . 'admin/projects/current_projects'; ?>"><?= lang("cproject");?></a>
<i class="fa fa-circle"></i>
</li>
<?php }?>

<?php 
if($this->input->get("project_id")==1){
?>

<li>
<a href="<?= $url . 'admin/projects/wait'; ?>"><?= lang("wproject");?></a>
<i class="fa fa-circle"></i>
</li>
<?php }?>

<?php 
if($this->input->get("project_id")==4){
?>

<li>
<a href="<?= $url . 'admin/projects/future'; ?>"><?= lang("fproject");?></a>
<i class="fa fa-circle"></i>
</li>
<?php }?>
<?php 
if($this->input->get("project_id")==3){
?>

<li>
<a href="<?= $url . 'admin/projects/finished'; ?>"><?= lang("endproject");?></a>
<i class="fa fa-circle"></i>
</li>
<?php }?>
						
						<li>
							<span class="active"><?= lang("files");?></span>
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
										<span class="caption-subject bold uppercase"> <?= lang("files1");?></span>
									</div>
								</div>
								<span class="portlet-body">
									<div class="table-toolbar">
										<div class="row">
											<div class="col-md-12">
											    
												<?php if($result_amount>0){
													if($this->session->userdata('files_delete')=="files_delete"){
													?>
													<div class="btn-group">
														<button id="sample_editable_1_2_new" class="btn sbold red delbutton"> <?= lang("delete");?>
															<i class="fa fa-remove"></i>
														</button>
													</div>
													<?php }?>
												<?php }?>
												<?php 
													if($this->session->userdata('files_add')=="files_add"){
													?>
													<div class="btn-group">
													<button id="sample_editable_1_2_new" class="btn sbold green addbutton"> <?= lang("add");?>
														<i class="fa fa-plus"></i>
													</button>
													</div>
													<?php }?>
											</div>
										</div>
									</div>
									<?php if(!empty($results)){?>
									<form action="<?=$url?>admin/projects/file_delete" method="POST" id="form">
									<input type="hidden" value="<?=$id_project?>" name="id_project">
									
									<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1_2">
										<thead>
											<tr>
												<th>
													<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
														<input id="checkAll" type="checkbox" class="group-checkable" disabled data-set="#sample_1_2 .checkboxes" />
														<span></span>
													</label>
												</th>
												<th><?= lang("project_name");?></th>
												<th> <?= lang("file");?></th>
												<th><?= lang("file_title");?></th>
												<th> <?= lang("creation_date");?></th>
												<th><?= lang("adding");?></th>
												<th> <?= lang("operations");?> </th>
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
											</tr>
										</tfoot>
										<tbody>
                                        <?php
                                            foreach($results as $data) {
											$name=$data->name;
											$user_id=$data->user_id;
											$project_id=$data->project_id;
											$create_date=$data->create_date;
											$project_name=get_table_filed("tbl_projects",array("id"=>$project_id),"name");
											$user_fname=get_table_filed("tbl_users",array("id"=>$user_id),"fname");
											$user_lname=get_table_filed("tbl_users",array("id"=>$user_id),"lname");
											$userupload_name=$user_fname."&nbsp&nbsp".$user_lname;
                                        ?>
											<tr class="odd gradeX">
												<td>
													<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
														<input name="check[]" type="checkbox" class="checkboxes" value="<?=$data->id;?>" />
														<span></span>
													</label>
												</td>
												<td> <?=$project_name;?> </td>
												<?php
												if($this->session->userdata('files_projects_view')=="files_projects_view"){
												     $downlaodpdf=base_url()."admin/projects/download_file/".$data->id;
												}
												else {
												    $downlaodpdf="#";
												}
												?>
												<td><a href="<?=$downlaodpdf;?>" target="_blank" title="<?=$project_name;?>"> <i class="fa fa-pdf"></i> <?= lang("open_file")?></a></td>
												<td> <?=$name;?> </td>
												<td> <?=$create_date;?> </td>
												<td> <?=$userupload_name;?> </td>
												<td>
													<div class="btn-group">
														<button class="btn btn-xs red dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> <?= lang("operations")?>
															<i class="fa fa-angle-down"></i>
														</button>
														<ul class="dropdown-menu pull-left" role="menu">
														<?php
														if($this->session->userdata('files_delete')=="files_delete"){
														?>
			<li><a href="<?=$url?>admin/projects/file_delete?id_project=<?=$id_project?>&id_file=<?=$data->id;?>"><i class="fa fa-remove"></i> <?= lang("delete")?> </a></li>
														<?php 
														}
														?>
														</ul>
													</div>
												</td>
											</tr>
                                            <?php }?>
										</tbody>
									</table>
									</form>
									<?php 
											
									  } else{?>
									<center><span class="caption-subject font-red bold uppercase"><?= lang("nodata")?></span></center>
									<?php }?>
						<!-------------------------2 type=2------>
						
						
						
														<div class="portlet-title">
									<div class="caption font-dark">
										<i class="icon-settings font-dark"></i>
										<span class="caption-subject bold uppercase"><?= lang("files2");?></span>
									</div>
								</div>
								<span class="portlet-body">
									<div class="table-toolbar">
										<div class="row">
											<div class="col-md-12">
											    
												<?php
												
				$type_screen=$this->db->order_by("id","desc")->get_where("tbl_project_files",array("type"=>'2','project_id'=>$id_project))->result();

												if(count($type_screen)>0){
													if($this->session->userdata('files_delete')=="files_delete"){
													?>
													<div class="btn-group">
														<button id="sample_editable_1_2_new" class="btn sbold red delbutton2"> <?= lang("delete")?>
															<i class="fa fa-remove"></i>
														</button>
													</div>
													<?php }?>
												<?php }?>
												<?php 
													if($this->session->userdata('files_add')=="files_add"){
													?>
													<div class="btn-group">
													<button id="sample_editable_1_2_new" class="btn sbold green addbutton_screen"> <?= lang("add")?>
														<i class="fa fa-plus"></i>
													</button>
													</div>
													<?php }?>
											</div>
										</div>
									</div>
									<?php if(count($type_screen)>0){?>
									<form action="<?=$url?>admin/projects/file_delete" method="POST" id="form2">
									<input type="hidden" value="<?=$id_project?>" name="id_project">
									<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1_2">
										<thead>
											<tr>
												<th>
													<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
														<input id="checkAll2" type="checkbox" class="group-checkable" disabled data-set="#sample_1_2 .checkboxes" />
														<span></span>
													</label>
												</th>
												<th><?= lang("project_name");?></th>
												<th> <?= lang("file");?></th>
												<th><?= lang("file_title");?></th>
												<th> <?= lang("creation_date");?></th>
												<th><?= lang("adding");?></th>
												<th> <?= lang("operations");?> </th>
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
											</tr>
										</tfoot>
										<tbody>
                                        <?php
                                            foreach($type_screen as $data) {
											$name=$data->name;
											$user_id=$data->user_id;
											$project_id=$data->project_id;
											$create_date=$data->create_date;
											$project_name=get_table_filed("tbl_projects",array("id"=>$project_id),"name");
											$user_fname=get_table_filed("tbl_users",array("id"=>$user_id),"fname");
											$user_lname=get_table_filed("tbl_users",array("id"=>$user_id),"lname");
											$userupload_name=$user_fname."&nbsp&nbsp".$user_lname;
                                        ?>
											<tr class="odd gradeX">
												<td>
													<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
														<input name="check[]" type="checkbox" class="checkboxes" value="<?=$data->id;?>" />
														<span></span>
													</label>
												</td>
												<td> <?=$project_name;?> </td>
													<?php
												if($this->session->userdata('files_projects_view')=="files_projects_view"){
												     $downlaodpdf=base_url()."admin/projects/download_file/".$data->id;
												}
												else {
												    $downlaodpdf="#";
												}
												?>
												<td><a href="<?= $downlaodpdf;?>"  title="<?=$project_name;?>"> <i class="fa fa-pdf"></i> <?= lang("open_file")?></a></td>
												<td> <?=$name;?> </td>
												<td> <?=$create_date;?> </td>
												<td> <?=$userupload_name;?> </td>
												<td>
													<div class="btn-group">
														<button class="btn btn-xs red dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> <?= lang("operations")?>
															<i class="fa fa-angle-down"></i>
														</button>
														<ul class="dropdown-menu pull-left" role="menu">
														<?php
														if($this->session->userdata('files_delete')=="files_delete"){
														?>
			<li><a href="<?=$url?>admin/projects/file_delete?id_project=<?=$id_project?>&id_file=<?=$data->id;?>"><i class="fa fa-remove"></i> <?= lang("delete")?> </a></li>
														<?php 
														}
														?>
														</ul>
													</div>
												</td>
											</tr>
                                            <?php }?>
										</tbody>
									</table>
									</form>
									<?php 
											
									  } else{?>
									<center><span class="caption-subject font-red bold uppercase"><?= lang("nodata")?></span></center>
									<?php }?>
						
						
						
					<!-------------------------3 type=3------>
					
						<div class="portlet-title">
									<div class="caption font-dark">
										<i class="icon-settings font-dark"></i>
										<span class="caption-subject bold uppercase"><?= lang("files3");?></span>
									</div>
								</div>
								<span class="portlet-body">
									<div class="table-toolbar">
										<div class="row">
											<div class="col-md-12">
											    
												<?php
					$type_open=$this->db->order_by("id","desc")->get_where("tbl_project_files",array("type"=>'3','project_id'=>$id_project))->result();
												
												if(count($type_open)>0){
													if($this->session->userdata('files_delete')=="files_delete"){
													?>
													<div class="btn-group">
														<button id="sample_editable_1_2_new" class="btn sbold red delbutton3"> <?= lang("delete")?>
															<i class="fa fa-remove"></i>
														</button>
													</div>
													<?php }?>
												<?php }?>
												<?php 
													if($this->session->userdata('files_add')=="files_add"){
													?>
													<div class="btn-group">
													<button id="sample_editable_1_2_new" class="btn sbold green addbutton_open"> <?= lang("add")?>
														<i class="fa fa-plus"></i>
													</button>
													</div>
													<?php }?>
											</div>
										</div>
									</div>
									<?php if(count($type_open)>0){?>
									<form action="<?=$url?>admin/projects/file_delete" method="POST" id="form3">
									<input type="hidden" value="<?=$id_project?>" name="id_project">
									<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1_2">
										<thead>
											<tr>
												<th>
													<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
														<input id="checkAll3" type="checkbox" class="group-checkable" disabled  data-set="#sample_1_2 .checkboxes" />
														<span></span>
													</label>
												</th>
												<th><?= lang("project_name");?></th>
												<th> <?= lang("file");?></th>
												<th><?= lang("file_title");?></th>
												<th> <?= lang("creation_date");?></th>
												<th><?= lang("adding");?></th>
												<th> <?= lang("operations");?> </th>
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
											</tr>
										</tfoot>
										<tbody>
                                        <?php
                                            foreach($type_open as $data) {
											$name=$data->name;
											$user_id=$data->user_id;
											$project_id=$data->project_id;
											$create_date=$data->create_date;
											$project_name=get_table_filed("tbl_projects",array("id"=>$project_id),"name");
											$user_fname=get_table_filed("tbl_users",array("id"=>$user_id),"fname");
											$user_lname=get_table_filed("tbl_users",array("id"=>$user_id),"lname");
											$userupload_name=$user_fname."&nbsp&nbsp".$user_lname;
                                        ?>
											<tr class="odd gradeX">
												<td>
													<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
														<input name="check[]" type="checkbox" class="checkboxes" value="<?=$data->id;?>" />
														<span></span>
													</label>
												</td>
												<td> <?=$project_name;?> </td>
															<?php
												if($this->session->userdata('files_projects_view')=="files_projects_view"){
												     $downlaodpdf=base_url()."admin/projects/download_file/".$data->id;
												}
												else {
												    $downlaodpdf="#";
												}
												?>
												<td><a href="<?= $downlaodpdf?>" title="<?=$project_name;?>" target="_blank"> <i class="fa fa-pdf"></i> <?= lang("open_file")?></a></td>
												<td> <?=$name;?> </td>
												<td> <?=$create_date;?> </td>
												<td> <?=$userupload_name;?> </td>
												<td>
													<div class="btn-group">
														<button class="btn btn-xs red dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> <?= lang("operations")?>
															<i class="fa fa-angle-down"></i>
														</button>
														<ul class="dropdown-menu pull-left" role="menu">
														<?php
														if($this->session->userdata('files_delete')=="files_delete"){
														?>
			<li><a href="<?=$url?>admin/projects/file_delete?id_project=<?=$id_project?>&id_file=<?=$data->id;?>"><i class="fa fa-remove"></i> <?= lang("delete")?> </a></li>
														<?php 
														}
														?>
														</ul>
													</div>
												</td>
											</tr>
                                            <?php }?>
										</tbody>
									</table>
									</form>
									<?php 
											
									  } else{?>
									<center><span class="caption-subject font-red bold uppercase"><?= lang("nodata")?></span></center>
									<?php }?>


<!-------------------------4 type=4------>

	<div class="portlet-title">
									<div class="caption font-dark">
										<i class="icon-settings font-dark"></i>
										<span class="caption-subject bold uppercase"><?= lang("files4");?>
</span>
									</div>
								</div>
								<span class="portlet-body">
									<div class="table-toolbar">
										<div class="row">
											<div class="col-md-12">
											    
												<?php
				$type_cutting=$this->db->order_by("id","desc")->get_where("tbl_project_files",array("type"=>'4','project_id'=>$id_project))->result();
												if(count($type_cutting)>0){
													if($this->session->userdata('files_delete')=="files_delete"){
													?>
													<div class="btn-group">
														<button id="sample_editable_1_2_new" class="btn sbold red delbutton4"> <?= lang("delete")?>
															<i class="fa fa-remove"></i>
														</button>
													</div>
													<?php }?>
												<?php }?>
												<?php 
													if($this->session->userdata('files_add')=="files_add"){
													?>
													<div class="btn-group">
													<button id="sample_editable_1_2_new" class="btn sbold green addbutton_cutting"> <?= lang("add")?>
														<i class="fa fa-plus"></i>
													</button>
													</div>
													<?php }?>
											</div>
										</div>
									</div>
									<?php if(count($type_cutting)>0){?>
									<form action="<?=$url?>admin/projects/file_delete" method="POST" id="form4">
									<input type="hidden" value="<?=$id_project?>" name="id_project">
									<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1_2">
										<thead>
											<tr>
												<th>
													<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
														<input id="checkAll4" type="checkbox" class="group-checkable" disabled data-set="#sample_1_2 .checkboxes" />
														<span></span>
													</label>
												</th>
												<th><?= lang("project_name");?></th>
												<th> <?= lang("file");?></th>
												<th><?= lang("file_title");?></th>
												<th> <?= lang("creation_date");?></th>
												<th><?= lang("adding");?></th>
												<th> <?= lang("operations");?> </th>
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
											</tr>
										</tfoot>
										<tbody>
                                        <?php
                                            foreach($type_cutting as $data) {
											$name=$data->name;
											$user_id=$data->user_id;
											$project_id=$data->project_id;
											$create_date=$data->create_date;
											$project_name=get_table_filed("tbl_projects",array("id"=>$project_id),"name");
											$user_fname=get_table_filed("tbl_users",array("id"=>$user_id),"fname");
											$user_lname=get_table_filed("tbl_users",array("id"=>$user_id),"lname");
											$userupload_name=$user_fname."&nbsp&nbsp".$user_lname;
                                        ?>
											<tr class="odd gradeX">
												<td>
													<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
														<input name="check[]" type="checkbox" class="checkboxes" value="<?=$data->id;?>" />
														<span></span>
													</label>
												</td>
												<td> <?=$project_name;?> </td>
												
																	<?php
												if($this->session->userdata('files_projects_view')=="files_projects_view"){
												     $downlaodpdf=base_url()."admin/projects/download_file/".$data->id;
												}
												else {
												    $downlaodpdf="#";
												}
												?>
												<td><a href="<?=$downlaodpdf?>" target="_blank" title="<?=$project_name;?>"> <i class="fa fa-pdf"></i> <?= lang("open_file")?></a></td>
												<td> <?=$name;?> </td>
												<td> <?=$create_date;?> </td>
												<td> <?=$userupload_name;?> </td>
												<td>
													<div class="btn-group">
														<button class="btn btn-xs red dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> <?= lang("operations")?>
															<i class="fa fa-angle-down"></i>
														</button>
														<ul class="dropdown-menu pull-left" role="menu">
														<?php
														if($this->session->userdata('files_delete')=="files_delete"){
														?>
			<li><a href="<?=$url?>admin/projects/file_delete?id_project=<?=$id_project?>&id_file=<?=$data->id;?>"><i class="fa fa-remove"></i> <?= lang("delete")?> </a></li>
														<?php 
														}
														?>
														</ul>
													</div>
												</td>
											</tr>
                                            <?php }?>
										</tbody>
									</table>
									</form>
									<?php 
											
									  } else{?>
									<center><span class="caption-subject font-red bold uppercase"><?= lang("nodata")?></span></center>
									<?php }?>
	
						
						
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
        window.location.assign("<?= DIR?>admin/projects/add_file?project_id=<?= $this->input->get("project_id")?>&type=1&id_project=" +<?= $id_project; ?>);
    });
     $(".addbutton_screen").click(function(e) {
        window.location.assign("<?= DIR?>admin/projects/add_file?project_id=<?= $this->input->get("project_id")?>&type=2&id_project=" +<?= $id_project; ?>);
    });
     $(".addbutton_open").click(function(e) {
        window.location.assign("<?= DIR?>admin/projects/add_file?project_id=<?= $this->input->get("project_id")?>&type=3&id_project=" +<?= $id_project; ?>);
    });
     $(".addbutton_cutting").click(function(e) {
        window.location.assign("<?= DIR?>admin/projects/add_file?project_id=<?= $this->input->get("project_id")?>&type=4&id_project=" +<?= $id_project; ?>);
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


<script>
$(document).ready(function(e) {
    $("#checkAll2").change(function(){
		$("input[type=checkbox]").not("#checkAll2").each(function() {
            this.checked=!this.checked;
        });
	});
	$(".delbutton2").click(function(){
		if($('input[type=checkbox]:not("#checkAll2"):checked').length>0){
			$('#form2').unbind('submit').submit();//renable submit
		}
	    else{
			window.stop();
			//alert("<?=lang('row_one_alert');?>");
			toastr.warning("<?=lang('row_one_alert');?>");
	}
	});
});
</script>
<script>
$(document).ready(function(e) {
    $("#checkAll3").change(function(){
		$("input[type=checkbox]").not("#checkAll3").each(function() {
            this.checked=!this.checked;
        });
	});
	$(".delbutton3").click(function(){
		if($('input[type=checkbox]:not("#checkAll3"):checked').length>0){
			$('#form3').unbind('submit').submit();//renable submit
		}
	    else{
			window.stop();
			//alert("<?=lang('row_one_alert');?>");
			toastr.warning("<?=lang('row_one_alert');?>");
	}
	});
});
</script>
<script>
$(document).ready(function(e) {
    $("#checkAll4").change(function(){
		$("input[type=checkbox]").not("#checkAll4").each(function() {
            this.checked=!this.checked;
        });
	});
	$(".delbutton4").click(function(){
		if($('input[type=checkbox]:not("#checkAll4"):checked').length>0){
			$('#form4').unbind('submit').submit();//renable submit
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
</body>
</html>
