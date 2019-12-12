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
            <li class="breadcrumb-item"><a href="#">تعديل العضو <?php echo $user['name'];?></a>
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
                    <?php echo form_open_multipart(base_url().admin_dir() . '/users/edit/'.$user['id']);?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            الاسم <span class="required">*</span>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="name" required="required" class="form-control" value="<?= set_value('name', $user['name']) ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            البريد الالكتروني <span class="required">*</span>
                        </label>
                        <div class="col-sm-10">
                            <input type="email" name="email" required="required" class="form-control" value="<?= set_value('email', $user['email']) ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            كلمة المرور
                        </label>
                        <div class="col-sm-10">
                            <input type="password" name="password" class="form-control" value="<?= set_value('password') ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            تأكيد كلمة المرور
                        </label>
                        <div class="col-sm-10">
                            <input type="password" name="password_confirm"  class="form-control" value="<?= set_value('password_comfirm') ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="avatar" class="col-form-label col-sm-2">
                            صورة العضو
                        </label>
                        <div class="col-sm-10">
                            <div class="img-box">
                                <?php if(isset($user) && $user['avatar'] !=''):?>
                                    <img src="<?=base_url()?>assets/uploads/<?php echo $user['avatar'];?>" alt="<?php echo $user['name'];?>" />
                                <?php else: ?>
                                    <i class="fa fa-image fa-2x icon"></i>
                                <?php endif;?>
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
                                    <option value="<?php echo $group['id'];?>" <?php if($user['group_id'] == $group['id'])echo ' selected="SELECTED" ';?> ><?php echo $group['name'];?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <hr />

                    <div class="form-group">
                        <div class="text-center col-xs-12">
                            <input type="submit" name="edit-user" class="btn btn-success" value="حفظ" />
                        </div>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</div>

