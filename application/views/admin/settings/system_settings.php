<?php echo message_box('success'); ?>

<div class="page-header card">
    <div class="card-block">
        <h5 class="m-b-10">اعدادات النظام</h5>
        <ul class="breadcrumb-title b-t-default p-t-10">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url().admin_dir();?>"> <i class="fa fa-home"></i> </a>
            </li>
            <li class="breadcrumb-item"><a href="#">اعدادات النظام</a>
            </li>
        </ul>
    </div>
</div>

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-block">
                    <?php echo form_open(base_url().admin_dir() . '/settings/system');?>
                    <div class="form-group">
                        <label class="col-form-label col-md-3 col-sm-3 col-xs-12">
                            Time Zone
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="timezone" class="form-control col-xs-12">
                                <?php foreach($timezones as $timezone => $description):?>
                                    <option value="<?=$timezone?>" <?=(config_item('timezone') == $timezone ? ' selected="selected"' : '') ?>><?=$description?></option>
                                <?endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-md-3 col-sm-3 col-xs-12">
                            المفات المسموح بها
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea name="allowed_files" cols="80" rows="2" class="form-control col-xs-12"><?=config_item('allowed_files')?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label col-md-3 col-sm-3 col-xs-12">
                            أقصي حجم للملفات (MB)
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="number" name="max_file_size" class="form-control col-xs-12" value="<?=config_item('max_file_size')?>" />
                        </div>
                    </div>

                    <hr />

                    <div class="form-group">
                        <div class="text-center col-xs-12">
                            <input type="submit" name="save-system" class="btn btn-success" value="حفظ" />
                        </div>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</div>