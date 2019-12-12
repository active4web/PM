<?php echo message_box('success'); ?>

<div class="page-header card">
    <div class="card-block">
        <h5 class="m-b-10">الاعدادات العامة</h5>
        <ul class="breadcrumb-title b-t-default p-t-10">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url().admin_dir();?>"> <i class="fa fa-home"></i> </a>
            </li>
            <li class="breadcrumb-item"><a href="#">الاعدادات العامة</a>
            </li>
        </ul>
    </div>
</div>

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-block">
                    <?php echo form_open(base_url().admin_dir() . '/settings/index');?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            عنوان الموقع <span class="required">*</span>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="site_title" required="required" class="form-control col-xs-12" value="<?= config_item('site_title') ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            أسم الموقع <span class="required">*</span>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="site_name" required="required" class="form-control col-xs-12" value="<?= config_item('site_name') ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            ايميل الموقع
                        </label>
                        <div class="col-sm-10">
                            <input type="email" name="site_email" class="form-control col-xs-12" value="<?= config_item('site_email') ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            وصف الموقع <span class="required">*</span>
                        </label>
                        <div class="col-sm-10">
                            <textarea cols="80" rows="3" name="site_description" required="required" class="form-control  col-xs-12"><?= config_item('site_description') ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            الكلمات الدلالية <span class="required">*</span>
                        </label>
                        <div class="col-sm-10">
                            <textarea cols="80" rows="3" name="site_keywords" required="required" class="form-control  col-xs-12"><?= config_item('site_keywords') ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="text-center col-xs-12">
                            <input type="submit" name="save-general" class="btn btn-success" value="حفظ" />
                        </div>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</div>

