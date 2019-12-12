<?php
$url=base_url();
$site_name=@$_SESSION['site_name'];
$site_favicon=@$_SESSION['site_favicon'];
header("Content-Type: text/html; charset=utf-8");

global $lang;
if( isset($this->session->get_userdata('lang')['lang']) ){
	$lang = $this->session->get_userdata('lang')['lang'];
	}else{
	$lang = 'arabic';
	}
	
?>
<?php ( $lang == 'arabic' )?$main_title="نظام ادارة المشاريع": 
$main_title="Project Management System" ; ?>


        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="<?= $main_title;?>" name="description" />
        <meta content="Wisyst" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?=$url;?>design/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$url;?>design/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
                  <link href="<?=$url;?>design/assets/global/css/DroidKufiRegular.css" media="all" rel="stylesheet" type="text/css" />

        <?php if( $lang == 'arabic'){?>

        <link href="<?=$url;?>design/assets/global/plugins/bootstrap/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$url;?>design/assets/global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css" rel="stylesheet" type="text/css" />
        <?php } else {?>
        <link href="<?=$url;?>design/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
       <link href="<?=$url;?>design/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <?php }?>
        <!-- END GLOBAL MANDATORY STYLES -->
		
		<!-- BEGIN colorpicker -->
        <link href="<?=$url;?>design/assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css" rel="stylesheet" type="text/css" />
        <link href="<?=$url;?>design/assets/global/plugins/jquery-minicolors/jquery.minicolors.css" rel="stylesheet" type="text/css" />
        <!-- END colorpicker -->
		
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?=$url;?>design/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />
        <link href="<?=$url;?>design/assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$url;?>design/assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" type="text/css" />
        <link href="<?=$url;?>design/assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?=$url;?>design/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$url;?>design/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?=$url;?>design/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?=$url;?>design/assets/global/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
		
		<!-- Date -->
		<link href="<?=$url;?>design/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$url;?>design/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$url;?>design/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$url;?>design/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$url;?>design/assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
		<!-- Date -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?=$url;?>design/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$url;?>design/assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="<?=$url;?>design/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$url;?>design/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />

        <link href="<?=$url;?>design/assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$url;?>design/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$url;?>design/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <?php
        if( $lang == 'arabic'){
        ?>
        <link href="<?=$url;?>design/assets/global/css/components-md-rtl.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?=$url;?>design/assets/global/css/plugins-md-rtl.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?=$url;?>design/assets/layouts/layout4/css/layout-rtl.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$url;?>design/assets/layouts/layout4/css/themes/default-rtl.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?=$url;?>design/assets/layouts/layout4/css/custom-rtl.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$url;?>design/assets/pages/css/login-rtl.min.css" rel="stylesheet" type="text/css" />
        <?php } else {?>
        <link href="<?=$url;?>design/assets/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?=$url;?>design/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?=$url;?>design/assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=$url;?>design/assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?=$url;?>design/assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$url;?>design/assets/pages/css/login.min.css" rel="stylesheet" type="text/css" />        
        
        <?php }?>
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?=$url;?>design/assets/global/css/custom.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
		<?php
		$logo=$this->session->userdata('site_favicon');
		?>
        <link rel="shortcut icon" href="<?=$url;?>uploads/site_setting/icon.png" type="image/x-icon" />
        
      <!--  <script>
 document.addEventListener('contextmenu', function(e) {
  e.preventDefault();
});
            
        </script>--->