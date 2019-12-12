<?php
$this->load->view('admin/layout/headinclude');
?>
<body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="loader-bar"></div>
        </div>
    </div>

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

        <?php $this->load->view('admin/layout/header');?>
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <?php $this->load->view('admin/layout/menu');?>
                </div>
                <div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        <!-- Main-body start -->
                        <div class="main-body">
                            <div class="page-wrapper">
                                <?php echo $subview ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php
$this->load->view('admin/layout/footer');
?>