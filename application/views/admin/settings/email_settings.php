<?php echo message_box('success'); ?>

<div class="page-header card">
    <div class="card-block">
        <h5 class="m-b-10">اعدادات المراسلة</h5>
        <ul class="breadcrumb-title b-t-default p-t-10">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url().admin_dir();?>"> <i class="fa fa-home"></i> </a>
            </li>
            <li class="breadcrumb-item"><a href="#">اعدادات المراسلة</a>
            </li>
        </ul>
    </div>
</div>

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-block">
                <?php echo form_open(base_url().admin_dir() . '/settings/email_settings');?>
                    <div class="form-group">
                        <label class="col-form-label col-md-3 col-sm-3 col-xs-12">
                            ايميل الراسل <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="email" name="sender_email" required="required" class="form-control col-xs-12" value="<?= config_item('sender_email') ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-md-3 col-sm-3 col-xs-12">
                            Email Protocol
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="email_protocol" class="form-control col-xs-12" required="required">
                                <option value="php_mail" <?= (config_item('email_protocol') == "php_mail" ? ' selected="selected"' : '') ?>>PHP Mail</option>
                                <option value="smtp" <?= (config_item('email_protocol') == "smtp" ? ' selected="selected"' : '') ?>>SMTP</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-md-3 col-sm-3 col-xs-12">
                            SMTP HOST
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="smtp_host" class="form-control col-xs-12" value="<?= config_item('smtp_host') ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-md-3 col-sm-3 col-xs-12">
                            SMTP PORT
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="smtp_port" class="form-control col-xs-12" value="<?= config_item('smtp_port') ?>" />
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-form-label col-md-3 col-sm-3 col-xs-12">
                            Email Encryption
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="email_encryption" class="form-control col-xs-12">
                                <option>None</option>
                                <option value="ssl" <?= (config_item('email_encryption') == "ssl" ? ' selected="selected"' : '') ?>>SSL</option>
                                <option value="tls" <?= (config_item('email_encryption') == "tls" ? ' selected="selected"' : '') ?>>TLS</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-md-3 col-sm-3 col-xs-12">
                            SMTP USER
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="smtp_user" class="form-control col-xs-12" value="<?= config_item('smtp_user') ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-md-3 col-sm-3 col-xs-12">
                            SMTP PASSWORD
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="smtp_password" class="form-control col-xs-12" value="<?= config_item('smtp_password') ?>" />
                        </div>
                    </div>

                    <hr />

                    <div class="form-group">
                        <div class="text-center col-xs-12">
                            <input type="submit" name="save-email-settings" class="btn btn-success" value="حفظ" />
                        </div>
                    </div>

                <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</div>