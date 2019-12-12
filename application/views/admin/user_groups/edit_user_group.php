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
            <li class="breadcrumb-item"><a href="#">تعديل مجموعة الاعضاء:  <?php echo $group['name'];?></a>
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
                    <?php echo form_open_multipart(base_url().admin_dir() . '/user_groups/edit/'.$group['id']);?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            اسم المجموعة <span class="required">*</span>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="name" required="required" class="form-control" value="<?= set_value('name', $group['name']) ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            التصاريح <span class="required">*</span>
                        </label>
                        <div class="col-sm-10">
                            <?php
                            $group_permissions = @explode(',', $group['permissions']);
                            ?>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td width="20%">المشاريع</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-sm-4"><input type="checkbox" name="permissions[]" value="projects_add" <?php if(in_array('projects_add', $group_permissions))echo ' checked ';?> /> اضافة</div>
                                            <div class="col-sm-4"><input type="checkbox" name="permissions[]" value="projects_edit" <?php if(in_array('projects_edit', $group_permissions))echo ' checked ';?>  /> تعديل</div>
                                            <div class="col-sm-4"><input type="checkbox" name="permissions[]" value="projects_delete" <?php if(in_array('projects_delete', $group_permissions))echo ' checked ';?>  /> حذف</div>
                                        </div>
                                        <hr>
                                        <div><input type="checkbox" name="permissions[]" value="projects_approval" <?php if(in_array('projects_approval', $group_permissions))echo ' checked ';?>  /> اعتماد المشاريع</div>
                                        <div><input type="checkbox" name="permissions[]" value="projects_edit_delivery_date" <?php if(in_array('projects_edit_delivery_date', $group_permissions))echo ' checked ';?>  />  تحديد وقت استلام المشروع</div>
                                        <div><input type="checkbox" name="permissions[]" value="projects_his_only" <?php if(in_array('projects_his_only', $group_permissions))echo ' checked ';?>  />مشاهدة المشاريع المخصصة له فقط </div>
                                        <div><input type="checkbox" name="permissions[]" value="projects_view_manager" <?php if(in_array('projects_view_manager', $group_permissions))echo ' checked ';?>  /> مشاهدة اسم مدير المشروع</div>
                                        <div><input type="checkbox" name="permissions[]" value="projects_view_delivery_date" <?php if(in_array('projects_view_delivery_date', $group_permissions))echo ' checked ';?>  /> مشاهدة تاريخ تسليم المشروع</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="20%">المهام</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-sm-4"><input type="checkbox" name="permissions[]" value="tasks_add" <?php if(in_array('tasks_add', $group_permissions))echo ' checked ';?>  /> اضافة</div>
                                            <div class="col-sm-4"><input type="checkbox" name="permissions[]" value="tasks_edit" <?php if(in_array('tasks_edit', $group_permissions))echo ' checked ';?>  /> تعديل</div>
                                            <div class="col-sm-4"><input type="checkbox" name="permissions[]" value="tasks_delete" <?php if(in_array('tasks_delete', $group_permissions))echo ' checked ';?>  /> حذف</div>
                                        </div>
                                        <hr>
                                        <div><input type="checkbox" name="permissions[]" value="tasks_approval" <?php if(in_array('tasks_approval', $group_permissions))echo ' checked ';?>  /> تعميد المهام</div>
                                        <div><input type="checkbox" name="permissions[]" value="tasks_his_only" <?php if(in_array('tasks_his_only', $group_permissions))echo ' checked ';?>  /> مشاهدة المهام المخصصة له فقط</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="20%">الملفات</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-sm-6"><input type="checkbox" name="permissions[]" value="files_add" <?php if(in_array('files_add', $group_permissions))echo ' checked ';?>  /> اضافة</div>
                                            <div class="col-sm-6"><input type="checkbox" name="permissions[]" value="files_delete" <?php if(in_array('files_delete', $group_permissions))echo ' checked ';?>  /> حذف</div>
                                        </div>
                                        <hr>
                                        <div><input type="checkbox" name="permissions[]" value="files_projects_view" <?php if(in_array('files_projects_view', $group_permissions))echo ' checked ';?>  /> مشاهدة الملفات</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="20%">رسائل النقاش</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-sm-4"><input type="checkbox" name="permissions[]" value="discussions" <?php if(in_array('discussions', $group_permissions))echo ' checked ';?>  /> نعم</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="20%">رسائل التنبيه</td>
                                    <td>
                                        <div>
                                            <div><input type="checkbox" name="permissions[]" value="notification_project_status" <?php if(in_array('notification_project_status', $group_permissions))echo ' checked ';?>  />  استلام تنبيهات بتغير حالة المشروع</div>
                                            <div><input type="checkbox" name="permissions[]" value="notification_task_status" <?php if(in_array('notification_task_status', $group_permissions))echo ' checked ';?>  /> استلام تنبيهات بتغير حالة المهام</div>
                                            <div><input type="checkbox" name="permissions[]" value="notification_discussions" <?php if(in_array('notification_discussions', $group_permissions))echo ' checked ';?>  /> استلام تنبيهات برسائل النقاش</div>
                                            <div><input type="checkbox" name="permissions[]" value="notification_new_files" <?php if(in_array('notification_new_files', $group_permissions))echo ' checked ';?>  /> استلام تنبيهات برفع ملفات جديدة</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="20%">التحكم بالاعضاء</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-sm-4"><input type="checkbox" name="permissions[]" value="users_add" <?php if(in_array('users_add', $group_permissions))echo ' checked ';?>  /> اضافة</div>
                                            <div class="col-sm-4"><input type="checkbox" name="permissions[]" value="users_edit" <?php if(in_array('users_edit', $group_permissions))echo ' checked ';?>  /> تعديل</div>
                                            <div class="col-sm-4"><input type="checkbox" name="permissions[]" value="users_delete" <?php if(in_array('users_delete', $group_permissions))echo ' checked ';?>  /> حذف</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="20%">التحكم مجموعات الاعضاء</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-sm-4"><input type="checkbox" name="permissions[]" value="user_groups_edit" <?php if(in_array('user_groups_edit', $group_permissions))echo ' checked ';?>  /> نعم</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="20%">الاعدادات</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-sm-4"><input type="checkbox" name="permissions[]" value="settings" <?php if(in_array('settings', $group_permissions))echo ' checked ';?>  /> نعم</div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <hr />

                    <div class="form-group">
                        <div class="text-center col-xs-12">
                            <input type="submit" name="edit-user-group" class="btn btn-success" value="حفظ" />
                        </div>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</div>

