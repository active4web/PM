


<script  src="<?php echo base_url(); ?>assets/admin/bower_components/popper.js/js/popper.min.js"></script>
<script  src="<?php echo base_url(); ?>assets/admin/bower_components/bootstrap/js/bootstrap.min.js"></script>
<!-- jquery slimscroll js -->
<script  src="<?php echo base_url(); ?>assets/admin/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
<!-- modernizr js -->
<script  src="<?php echo base_url(); ?>assets/admin/bower_components/modernizr/js/modernizr.js"></script>
<script  src="<?php echo base_url(); ?>assets/admin/bower_components/modernizr/js/css-scrollbars.js"></script>
<!-- data-table js -->
<script src="<?php echo base_url(); ?>assets/admin/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/pages/data-table/js/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/pages/data-table/js/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/pages/data-table/js/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<!-- Syntax highlighter prism js -->
<script  src="<?php echo base_url(); ?>assets/admin/pages/prism/custom-prism.js"></script>
<!-- Bootstrap date-time-picker js -->
<script  src="<?php echo base_url(); ?>assets/admin/pages/advance-elements/moment-with-locales.min.js"></script>
<script  src="<?php echo base_url(); ?>assets/admin/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script  src="<?php echo base_url(); ?>assets/admin/pages/advance-elements/bootstrap-datetimepicker.min.js"></script>
<!-- Date-range picker js -->
<script  src="<?php echo base_url(); ?>assets/admin/bower_components/bootstrap-daterangepicker/js/daterangepicker.js"></script>
<!-- Date-dropper js -->
<script  src="<?php echo base_url(); ?>assets/admin/bower_components/datedropper/js/datedropper.min.js"></script>
<!-- Custom js -->
<script src="<?php echo base_url(); ?>assets/admin/pages/data-table/js/data-table-custom.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/pcoded.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/vertical/menu/menu-rtl.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script  src="<?php echo base_url(); ?>assets/admin/js/script.js"></script>
<script  src="<?php echo base_url(); ?>assets/admin/js/toastr.min.js"></script>

<script type="text/javascript">
    var RMM = {
        url: '<?php echo base_url()?><?php echo admin_dir()?>/',
        token: '<?php echo $this->security->get_csrf_hash();?>'
    };
</script>

<script type="text/javascript">
    deletone = function(url,msg=null){
        if(msg != null){
            var conf = confirm(msg);
        }else{
            var conf = confirm("هل انت متأكد من الحذف؟");
        }

        if(conf)
            document.location = (url);
    }

    checked = false;
    function checkedAll (idName) {
        if (checked == false){checked = true}else{checked = false}
        for (var i = 0; i < document.getElementById(idName).elements.length; i++) {
            document.getElementById(idName).elements[i].checked = checked;
        }
    }
</script>
</body>
</html>