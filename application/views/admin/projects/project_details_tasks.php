<?php echo message_box('success'); ?>

<div class="page-header card">
    <div class="card-block">
        <h5 class="m-b-10">المشاريع</h5>
        <ul class="breadcrumb-title b-t-default p-t-10">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url().admin_dir();?>"> <i class="fa fa-home"></i> </a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?php echo base_url().admin_dir();?>/projects">المشاريع</a>
            </li>
            <li class="breadcrumb-item"><a href="#">تفاصيل المشروع(<?php echo $project['name'];?>)</a>
            </li>
        </ul>
    </div>
</div>

<?php echo form_open();?>
<?php echo form_close();?>
<div class="card">
    <div class="card-header">
        <h5>تفاصيل المشروع: (<?php echo $project['name'];?>)</h5>
        <div class="table-responsive dt-responsive">
        <table class="table text-center"  id="example-1">
            <tr>
                <td width="33%" class="label label-danger">
                    <span>أسم المشروع</span>
                    <br/>

                    <?php if(in_array('projects_edit', $this->user_info['permissions'])):?>
                    <i class="fa fa-edit fa-lg edit-name-mark" style="cursor: pointer; margin-left: 15px;"></i>
                    <?php endif;?>

                    <strong class="project-text-name"><?php echo $project['name'];?></strong>

                    <?php if(in_array('projects_edit', $this->user_info['permissions'])):?>
                        <div class="form-group edit-name" style="display: none;">
                            <br/>
                            <input type="text" name="project_name" value="<?php echo $project['name'];?>" class="project_name form-control">
                            <br>
                            <span class="btn btn-success btn-save-name bt-sm">تعديل</span>
                        </div>
                    <?php endif;?>
                </td>

                <?php if(in_array('projects_view_delivery_date', $this->user_info['permissions'])):?>
                    <td width="33%" class="label label-warning">
                        <span>تاريخ التسليم</span>
                        <br/>

                        <?php if(in_array('projects_edit', $this->user_info['permissions']) && in_array('projects_edit_delivery_date', $this->user_info['permissions'])):?>
                            <i class="fa fa-edit fa-lg edit-date-mark" style="cursor: pointer; margin-left: 15px;"></i>
                        <?php endif;?>

                        <strong class="project-text-date"><?php echo $project['delivery_date'];?></strong>

                        <?php if(in_array('projects_edit', $this->user_info['permissions']) && in_array('projects_edit_delivery_date', $this->user_info['permissions'])):?>
                            <div class="form-group edit-date" style="display: none;">
                                <br/>
                                <input type="text" id="dropper-default" readonly name="project_delivery_date" value="<?php echo $project['delivery_date'];?>" class="project_delivery_date form-control">
                                <br>
                                <span class="btn btn-success btn-save-date bt-sm">تعديل</span>
                            </div>
                        <?php endif;?>

                    </td>
                    <td  width="33%" class="label label-info">
                        <span>عدد الايام المتبقية</span>
                        <br/>
                        <?php if($project['status'] == 1):?>
                            <strong>منتهي</strong>
                        <?php elseif($project['status'] == 2):?>
                            <strong>ملغي</strong>
                        <?php else:?>
                            <strong><?php echo get_days_count_down($project['delivery_date']); ?> يوم</strong>
                        <?php endif;?>
                    </td>
                <?php endif;?>
            </tr>
        </table>
        </div>
        <div class="alert alert-warning alert text-center">
            <?php if(in_array('projects_edit', $this->user_info['permissions']) ):?>
                <i class="fa fa-edit fa-lg edit-notes-mark" style="cursor: pointer; margin: 0 15px;"></i>
                <br>
            <?php endif;?>

            <p class="project-text-notes"><?php echo $project['notes'];?></p>

            <?php if(in_array('projects_edit', $this->user_info['permissions'])):?>
                <div class="form-group edit-notes" style="display: none;">
                    <br/>
                    <textarea cols="60" rows="2" name="project_notes" class="project_notes form-control"><?php echo stripslashes($project['notes']);?></textarea>
                    <br>
                    <span class="btn btn-success btn-save-notes bt-sm">تعديل</span>
                </div>
            <?php endif;?>
        </div>
    </div>

    <div class="card-block">
        <ul class="nav nav-tabs md-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo base_url(admin_dir().'/project_details/tasks/'.$project['id'])?>" role="tab">المهام</a>
                <div class="slide"></div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(admin_dir().'/discussions/index/'.$project['id'])?>" role="tab">النقاش</a>
                <div class="slide"></div>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="<?php echo base_url(admin_dir().'/project_details/files/'.$project['id'])?>" role="tab">الملفات</a>
                <div class="slide"></div>
            </li>
        </ul>

        <div class="tab-content card-block">
            <?php if(in_array('tasks_add', $this->user_info['permissions'])):?>
            <div class="text-center">
                <button type="button" class="btn btn-default waves-effect" data-toggle="modal" data-target="#default-Modal">اضافة مهمة جديدة</button>
            </div>
            <br/>
            <?php endif;?>

            <div class="table-responsive dt-responsive">
                <table id="dom-jqry" class="table table-bordered nowrap ">
                    <thead>
                    <tr>
                        <th class="text-center" width="80">ID</th>
                        <th class="text-center">اسم المهمة</th>
                        <th class="text-center">الموظف المسؤل</th>
                        <th class="text-center">تاريخ التسليم</th>
                        <th class="text-center">تاريخ المهمة</th>
                        <th class="text-center">الوقت المتبقي</th>
                        <th class="text-center">الحالة</th>
                        <?php if(in_array('tasks_edit', $this->user_info['permissions'])):?>
                        <th class="text-center" width="80">تعديل</th>
                        <?php endif;?>
                        <?php if(in_array('tasks_delete', $this->user_info['permissions'])):?>
                        <th class="text-center" width="80">حذف</th>
                        <?php endif;?>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach($main_tasks as $task):?>
                    <?php
                    $sub_tasks = $this->task_model->get('main_task='.$task['id'].' '.$tasks_where);
                    ?>

                    <tr <?php if( in_array($this->user_info['group_id'], array('1','2')) && $this->user_info['id'] == $task['user_id'])echo' class="label-info" '; ?>>
                        <td ><?php echo $task['id'];?></td>
                        <td ><?php echo $task['name'];?></td>
                        <td>
                            <?php
                            $this->user_model->_table_name = 'users';
                            $user = $this->user_model->get_single('id='.$task['user_id']);
                            echo $user['name'];
                            ?>
                        </td>
                        <td><?php echo $task['delivery_date'];?></td>
                        <td>
                            <div> انشاء المهمة:<b> <?php echo get_date($task['created_at']);?></b></div>
                            <?php if($task['worked_at'] !=''):?>
                                <div>بداية العمل: <b><?php echo get_date($task['worked_at']);?></b></div>
                            <?php endif;?>
                            <?php if($task['ended_at'] !=''):?>
                                <div>الانتهاء من العمل: <b><?php echo get_date($task['ended_at']);?></b></div>
                            <?php endif;?>
                        </td>
                        <td>
                            <?php if(in_array($task['status'], array(3,4)) && $task['ended_at'] !=''):?>
                                <strong class="label label-success"><?php echo get_days_count_down($task['delivery_date'], date('d/m/Y', $task['ended_at'])); ?> يوم </strong>
                            <?php else:?>
                                <strong class="label label-danger"><?php echo get_days_count_down($task['delivery_date']); ?> يوم </strong>
                            <?php endif;?>
                        </td>
                        <td>
                            <div class="task-status">
                                <input type="hidden" name="task_id" class="task_id" value="<?php echo $task['id'];?>" />
                                <?php  if($task['status'] == 1):?>
                                    <button class="btn btn-warning btn-update-status" data-value="2"><span class="txt">بالانتظار</span> <i class="result text-success"></i></button>
                                <?php elseif ($task['status'] == 2):?>
                                    <button class="btn btn-warning btn-update-status" data-value="3"><span class="txt">جاري العمل عليها</span> <i class="result text-success"></i></button>
                                <?php elseif ($task['status'] == 3):?>
                                    <?php if(in_array('tasks_approval', $this->user_info['permissions'])):?>
                                        <button class="btn btn-warning btn-update-status" data-value="4"><span class="txt">تم الانتهاء منها</span> <i class="result text-success"></i></button>
                                    <?php else:?>
                                        <button class="btn btn-warning" ><span class="txt">تم الانتهاء منها</span> </button>
                                    <?php endif;?>
                                <?php elseif ($task['status'] == 4):?>
                                    <button class="btn btn-warning" >معتمدة </button>
                                <?php endif;?>
                            </div>
                        </td>
                        <?php if(in_array('tasks_edit', $this->user_info['permissions'])):?>
                            <td><a href="<?php echo base_url().admin_dir();?>/project_details/edit_task/<?php echo $task['id'];?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> </a></td>
                        <?php endif;?>
                        <?php if(in_array('tasks_delete', $this->user_info['permissions'])):?>
                            <td><a href="#" onclick="deletone('<?php echo base_url().admin_dir();?>/project_details/delete_task/<?=$task['id']?>')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
                        <?php endif;?>
                    </tr>
                    <?php if(count($sub_tasks)>0):?>

                        <?php foreach($sub_tasks as $sub_task):?>
                            <tr <?php if( in_array($this->user_info['group_id'], array('1','2')) && $this->user_info['id'] == $sub_task['user_id'])echo'  class="label-info" '; ?>>
                                <td ><?php echo $sub_task['id'];?></td>
                                <td><span style="display: inline-block; margin-right: 50px;"><i class="text-danger ti-back-left"></i></span><?php echo $sub_task['name'];?></td>
                                <td>
                                    <?php
                                    $this->user_model->_table_name = 'users';
                                    $user = $this->user_model->get_single('id='.$sub_task['user_id']);
                                    echo $user['name'];
                                    ?>
                                </td>
                                <td><?php echo $sub_task['delivery_date'];?></td>
                                <td>
                                    <div> انشاء المهمة:<b> <?php echo get_date($sub_task['created_at']);?></b></div>
                                    <?php if($sub_task['worked_at'] !=''):?>
                                        <div>بداية العمل: <b><?php echo get_date($sub_task['worked_at']);?></b></div>
                                    <?php endif;?>
                                    <?php if($sub_task['ended_at'] !=''):?>
                                        <div>الانتهاء من العمل: <b><?php echo get_date($sub_task['ended_at']);?></b></div>
                                    <?php endif;?>
                                </td>
                                <td>
                                    <?php if(in_array($sub_task['status'], array(3,4)) && $sub_task['ended_at'] !=''):?>
                                        <strong class="label label-success"><?php echo get_days_count_down($sub_task['delivery_date'], date('d/m/Y', $sub_task['ended_at'])); ?> يوم </strong>
                                    <?php else:?>
                                        <strong class="label label-danger"><?php echo get_days_count_down($sub_task['delivery_date']); ?> يوم </strong>
                                    <?php endif;?>
                                </td>
                                <td>
                                    <div class="task-status">
                                        <input type="hidden" name="task_id" class="task_id" value="<?php echo $sub_task['id'];?>" />
                                        <?php  if($sub_task['status'] == 1):?>
                                            <button class="btn btn-warning btn-update-status" data-value="2"><span class="txt">بالانتظار</span> <i class="result text-success"></i></button>
                                        <?php elseif ($sub_task['status'] == 2):?>
                                            <button class="btn btn-warning btn-update-status" data-value="3"><span class="txt">جاري العمل عليها</span> <i class="result text-success"></i></button>
                                        <?php elseif ($sub_task['status'] == 3):?>
                                            <?php if(in_array('tasks_approval', $this->user_info['permissions'])):?>
                                                <button class="btn btn-warning btn-update-status" data-value="4"><span class="txt">تم الانتهاء منها</span> <i class="result text-success"></i></button>
                                            <?php else:?>
                                                <button class="btn btn-warning" ><span class="txt">تم الانتهاء منها</span> </button>
                                            <?php endif;?>
                                        <?php elseif ($sub_task['status'] == 4):?>
                                            <button class="btn btn-warning" >معتمدة </button>
                                        <?php endif;?>
                                    </div>
                                </td>
                                <?php if(in_array('tasks_edit', $this->user_info['permissions'])):?>
                                    <td><a href="<?php echo base_url().admin_dir();?>/project_details/edit_task/<?php echo $sub_task['id'];?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> </a></td>
                                <?php endif;?>
                                <?php if(in_array('tasks_delete', $this->user_info['permissions'])):?>
                                    <td><a href="#" onclick="deletone('<?php echo base_url().admin_dir();?>/project_details/delete_task/<?=$sub_task['id']?>')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
                                <?php endif;?>
                            </tr>
                        <?php endforeach;?>
                    <?php endif;?>

                <?php endforeach;?>
                </tbody>
            </table>
        </div>
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>" />
        <?php $this->load->view('admin/projects/project_details_tasks_add'); ?>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $(".btn-update-status").on('click', function(){
            var el = $(this).closest('.task-status');
            var task_id=el.find('.task_id').val();
            var task_status=$(this).data("value");
            var tokenValue = $("input[name='<?php echo $this->security->get_csrf_token_name(); ?>']");
            //console.log('task_id:'+task_id+' | task_status:'+task_status);
            $.ajax
            ({
                type: "POST",
                url: RMM.url+"ajax/update_task_status",
                data: { task_id: task_id, task_status:task_status, '<?php echo $this->security->get_csrf_token_name(); ?>' : tokenValue.val() },
                dataType: "json",
                cache: false,
                beforeSend: function(){
                    el.find(".result").html('<img src="<?php echo base_url('/assets/images/loading-small.gif');?>" />');
                },
                success: function(data, textStatus, jqXHR)
                {
                    tokenValue.val(data.token);
                    el.find(".result").html('');
                    if(data.output == "success")
                    {
                        if(task_status == 2)
                        {
                            el.find(".txt").text('جاري العمل عليها');
                            el.find('.btn-update-status').data("value", 3);
                        }
                        else if(task_status == 3)
                        {
                            el.find(".txt").text('تم الانتهاء منها');
                            <?php if(in_array('tasks_approval', $this->user_info['permissions'])):?>
                            el.find('.btn-update-status').data("value", 4);
                            <?php endif;?>
                        }
                        else if(task_status == 4)
                        {
                            el.find(".txt").text('معتمدة');
                        }

                        el.find(".result").addClass('fa fa-check').delay(3000).queue(function(){
                            $(this).removeClass("fa fa-check").dequeue();
                        });
                    }
                    else
                    {
                        el.find(".result").text(data.output).delay("slow").queue(function(){
                            $(this).text("").dequeue();
                        });
                    }
                }
            });

        });
    });
</script>

<?php if(in_array('projects_edit', $this->user_info['permissions'])):?>
<script type="text/javascript">
        $(document).ready(function(){
            $('.edit-name-mark').click(function () {
                $('.edit-name').toggle();
            });

            $('.btn-save-name').click(function () {
                var project_id = '<?php echo $project['id'];?>';
                var project_name = $('.project_name').val();
                var tokenValue = $("input[name='<?php echo $this->security->get_csrf_token_name(); ?>']");
                $.ajax
                ({
                    type: "POST",
                    url: RMM.url+"ajax/update_project_name",
                    data: { project_id: project_id, project_name:project_name, '<?php echo $this->security->get_csrf_token_name(); ?>' : tokenValue.val() },
                    dataType: "json",
                    cache: false,
                    success: function(data, textStatus, jqXHR)
                    {
                        tokenValue.val(data.token);
                        if(data.output == "success")
                        {
                            $('.project-text-name').text(project_name);
                            $('.edit-name').css({'display':'none'});
                        }
                    }
                });
            });

        });
</script>
<?php endif;?>

<?php if(in_array('projects_edit', $this->user_info['permissions']) && in_array('projects_edit_delivery_date', $this->user_info['permissions'])):?>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.edit-date-mark').click(function () {
                $('.edit-date').toggle();
            });

            $('.btn-save-date').click(function () {
                var project_id = '<?php echo $project['id'];?>';
                var project_delivery_date = $('.project_delivery_date').val();
                var tokenValue = $("input[name='<?php echo $this->security->get_csrf_token_name(); ?>']");
                $.ajax
                ({
                    type: "POST",
                    url: RMM.url+"ajax/update_project_delivery_date",
                    data: { project_id: project_id, project_delivery_date:project_delivery_date, '<?php echo $this->security->get_csrf_token_name(); ?>' : tokenValue.val() },
                    dataType: "json",
                    cache: false,
                    success: function(data, textStatus, jqXHR)
                    {
                        tokenValue.val(data.token);
                        if(data.output == "success")
                        {
                            $('.project-text-date').text(project_delivery_date);
                            $('.edit-date').css({'display':'none'});

                        }
                    }
                });
            });


        });

        $("#dropper-default").dateDropper( {
            dropWidth: 200,
            format: "d/m/Y",
            dropPrimaryColor: "#1abc9c",
            dropBorder: "1px solid #1abc9c"
        });
    </script>
<?php endif;?>

<?php if(in_array('projects_edit', $this->user_info['permissions'])):?>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.edit-notes-mark').click(function () {
                $('.edit-notes').toggle();
            });

            $('.btn-save-notes').click(function () {
                var project_id = '<?php echo $project['id'];?>';
                var project_notes = $('.project_notes').val();
                var tokenValue = $("input[name='<?php echo $this->security->get_csrf_token_name(); ?>']");
                $.ajax
                ({
                    type: "POST",
                    url: RMM.url+"ajax/update_project_notes",
                    data: { project_id: project_id, project_notes:project_notes, '<?php echo $this->security->get_csrf_token_name(); ?>' : tokenValue.val() },
                    dataType: "json",
                    cache: false,
                    success: function(data, textStatus, jqXHR)
                    {
                        tokenValue.val(data.token);
                        if(data.output == "success")
                        {
                            $('.project-text-notes').text(project_notes);
                            $('.edit-notes').css({'display':'none'});
                        }
                    }
                });
            });

        });
    </script>
<?php endif;?>
