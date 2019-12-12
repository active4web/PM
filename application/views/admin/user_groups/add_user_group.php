<?php echo message_box('success'); ?>

<div class="page-header card">
    <div class="card-block">
        <h5 class="m-b-10">مجموعات الاعضاء</h5>
        <ul class="breadcrumb-title b-t-default p-t-10">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url().admin_dir();?>"> <i class="fa fa-home"></i> </a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?php echo base_url().admin_dir();?>/user_groups">  مجموعات الاعضاء</a>
            </li>
            <li class="breadcrumb-item"><a href="#">اضافة مجموعة جديدة</a>
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
                    <?php echo form_open_multipart(base_url().admin_dir() . '/user_groups/add');?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            اسم المجموعة <span class="required">*</span>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="name" required="required" class="form-control" value="<?= set_value('name') ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            التصاريح <span class="required">*</span>
                        </label>
                        <div class="col-sm-10">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td width="20%">المشاريع</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-sm-4"><input type="checkbox" name="permissions[]" value="projects_add" /> اضافة</div>
                                            <div class="col-sm-4"><input type="checkbox" name="permissions[]" value="projects_edit" /> تعديل</div>
                                            <div class="col-sm-4"><input type="checkbox" name="permissions[]" value="projects_delete" /> حذف</div>
                                        </div>
                                        <hr>
                                        <div><input type="checkbox" name="permissions[]" value="projects_approval" /> اعتماد المشاريع</div>
                                        <div><input type="checkbox" name="permissions[]" value="projects_edit_delivery_date" />  تحديد وقت استلام المشروع</div>
                                        <div><input type="checkbox" name="permissions[]" value="projects_his_only" />مشاهدة المشاريع المخصصة له فقط </div>
                                        <div><input type="checkbox" name="permissions[]" value="projects_view_manager" /> مشاهدة اسم مدير المشروع</div>
                                        <div><input type="checkbox" name="permissions[]" value="projects_view_delivery_date" /> مشاهدة تاريخ تسليم المشروع</div>
                                </td>
                                </tr>
                                <tr>
                                    <td width="20%">المهام</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-sm-4"><input type="checkbox" name="permissions[]" value="tasks_add" /> اضافة</div>
                                            <div class="col-sm-4"><input type="checkbox" name="permissions[]" value="tasks_edit" /> تعديل</div>
                                            <div class="col-sm-4"><input type="checkbox" name="permissions[]" value="tasks_delete" /> حذف</div>
                                        </div>
                                        <hr>
                                        <div><input type="checkbox" name="permissions[]" value="tasks_approval" /> تعميد المهام</div>
                                        <div><input type="checkbox" name="permissions[]" value="tasks_his_only" /> مشاهدة المهام المخصصة له فقط</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="20%">الملفات</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-sm-6"><input type="checkbox" name="permissions[]" value="files_add" /> اضافة</div>
                                            <div class="col-sm-6"><input type="checkbox" name="permissions[]" value="files_delete" /> حذف</div>
                                        </div>
                                        <hr>
                                        <div><input type="checkbox" name="permissions[]" value="files_projects_view" /> مشاهدة الملفات</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="20%">رسائل النقاش</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-sm-4"><input type="checkbox" name="permissions[]" value="discussions" /> نعم</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="20%">رسائل التنبيه</td>
                                    <td>
                                        <div>
                                            <div><input type="checkbox" name="permissions[]" value="notification_project_status" />  استلام تنبيهات بتغير حالة المشروع</div>
                                            <div><input type="checkbox" name="permissions[]" value="notification_task_status" /> استلام تنبيهات بتغير حالة المهام</div>
                                            <div><input type="checkbox" name="permissions[]" value="notification_discussions" /> استلام تنبيهات برسائل النقاش</div>
                                            <div><input type="checkbox" name="permissions[]" value="notification_new_files" /> استلام تنبيهات برفع ملفات جديدة</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="20%">التحكم بالاعضاء</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-sm-4"><input type="checkbox" name="permissions[]" value="users_add" /> اضافة</div>
                                            <div class="col-sm-4"><input type="checkbox" name="permissions[]" value="users_edit" /> تعديل</div>
                                            <div class="col-sm-4"><input type="checkbox" name="permissions[]" value="users_delete" /> حذف</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="20%">التحكم مجموعات الاعضاء</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-sm-4"><input type="checkbox" name="permissions[]" value="user_groups_edit" /> نعم</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="20%">الاعدادات</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-sm-4"><input type="checkbox" name="permissions[]" value="settings"  /> نعم</div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <hr />

                    <div class="form-group">
                        <div class="text-center col-xs-12">
                            <input type="submit" name="add-user-group" class="btn btn-success" value="حفظ" />
                        </div>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</div>

