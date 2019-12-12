<?php echo message_box('success'); ?>

<div class="page-header card">
    <div class="card-block">
        <h5 class="m-b-10">العضويات</h5>
        <ul class="breadcrumb-title b-t-default p-t-10">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url().admin_dir();?>"> <i class="fa fa-home"></i> </a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?php echo base_url().admin_dir();?>/users">  العضويات</a>
            </li>
            <li class="breadcrumb-item"><a href="#">اضافة عضو جديد</a>
            </li>
        </ul>
    </div>
</div>

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-block">
                    <?php if(validation_errors() !='')echo message_error(validation_errors());?>
                    <?php echo form_open_multipart(base_url().admin_dir() . '/users/add');?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            الاسم <span class="required">*</span>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="name" required="required" class="form-control" value="<?= set_value('name') ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            البريد الالكتروني <span class="required">*</span>
                        </label>
                        <div class="col-sm-10">
                            <input type="email" name="email" required="required" class="form-control" value="<?= set_value('email') ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            كلمة المرور <span class="required">*</span>
                        </label>
                        <div class="col-sm-10">
                            <input type="password" name="password" required="required" class="form-control" value="<?= set_value('password') ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            تأكيد كلمة المرور <span class="required">*</span>
                        </label>
                        <div class="col-sm-10">
                            <input type="password" name="password_confirm" required="required" class="form-control" value="<?= set_value('password_comfirm') ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="avatar" class="col-form-label col-sm-2">
                            صورة العضو
                        </label>
                        <div class="col-sm-10">
                            <div class="img-box">
                                <i class="fa fa-image fa-2x icon"></i>
                            </div>
                            <input type="file" name="avatar" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            مجموعة العضو <span class="required">*</span>
                        </label>
                        <div class="col-sm-10">
                           <select name="group_id" class="form-control">
                               <?php foreach($groups as $group): ?>
                                   <option value="<?php echo $group['id'];?>"><?php echo $group['name'];?></option>
                               <?php endforeach; ?>
                           </select>
                        </div>
                    </div>

                    <hr />

                    <div class="form-group">
                        <div class="text-center col-xs-12">
                            <input type="submit" name="add-user" class="btn btn-success" value="حفظ" />
                        </div>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</div>

