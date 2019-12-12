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

<div class="card">
    <div class="card-header">
        <h5>تفاصيل المشروع: (<?php echo $project['name'];?>)</h5>
        <table class="table text-center">
            <tr>
                <td width="33%" class="label label-danger">
                    <span>أسم المشروع</span>
                    <br/>
                    <strong><?php echo $project['name'];?></strong>
                </td>
                <td width="33%" class="label label-warning">
                    <span>تاريخ التسليم</span>
                    <br/>
                    <strong><?php echo $project['delivery_date'];?></strong>
                </td>
                <td  width="33%" class="label label-info">
                    <span>عدد الايام المتبقية</span>
                    <br/>
                    <strong><?php echo get_days_count_down($project['delivery_date']); ?> يوم</strong>
                </td>
            </tr>
        </table>
    </div>

    <div class="card-block">
        <ul class="nav nav-tabs md-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo base_url(admin_dir().'/project_details/tasks/'.$project['id'])?>" role="tab">المهام</a>
                <div class="slide"></div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(admin_dir().'/project_details/discussions/'.$project['id'])?>" role="tab">النقاش</a>
                <div class="slide"></div>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="<?php echo base_url(admin_dir().'/project_details/files/'.$project['id'])?>" role="tab">الملفات</a>
                <div class="slide"></div>
            </li>
        </ul>

        <div class="tab-content card-block">
            <?php if($allow_manage_tasks == true):?>
            <div class="text-center">
                <button type="button" class="btn btn-default waves-effect" data-toggle="modal" data-target="#default-Modal">اضافة مهمة جديدة</button>
            </div>
            <br/>
            <?php endif;?>

            <?php foreach($main_tasks as $task):?>
            <?php
            $sub_tasks = $this->task_model->get('main_task='.$task['id'].' '.$tasks_where);
            ?>
                <div class="card card-border-info">
                    <div class="card-header">
                        <h3><?php echo $task['name'];?></h3>
                        <span class="label label-default f-left">تاريخ التسليم <?php echo $task['delivery_date'];?> </span>
                    </div>
                    <div class="card-block">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="task-detail">
                                    <div>
                                        <strong>الموظف المسئول: </strong>
                                        <strong class="label label-warning">
                                            <?php
                                            $this->user_model->_table_name = 'users';
                                            $user = $this->user_model->get_single('id='.$task['user_id']);
                                            echo $user['name'];
                                            ?>
                                        </strong>
                                    </div>
                                    <hr />
                                    <div>تاريخ انشاء المهمة: <b><?php echo get_date($task['created_at']);?></b></div>
                                    <?php if($task['worked_at'] !=''):?>
                                        <div>تاريخ بداية العمل: <b><?php echo get_date($task['worked_at']);?></b></div>
                                    <?php endif;?>
                                    <?php if($task['ended_at'] !=''):?>
                                        <div>تاريخ الانتهاء من العمل: <b><?php echo get_date($task['ended_at']);?></b></div>
                                    <?php endif;?>
                                </div>
                                <hr />
                                <p class="task-due"><strong>متبقي : </strong><strong class="label label-danger"><?php echo get_days_count_down($task['delivery_date']); ?> يوم </strong></p>
                            </div>
                            <!-- end of col-sm-8 -->
                        </div>
                        <!-- end of row -->
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-8">
                                <input type="hidden" name="task_id" class="task_id" value="<?php echo $task['id'];?>" />
                                <select name="status" class="status corm-control">
                                    <option value="1" <?php if($task['status'] == 1)echo' SELECTED="SELECTED" ';?> >بالإنتظار</option>
                                    <option value="2" <?php if($task['status'] == 2)echo' SELECTED="SELECTED" ';?> >جاري العمل عليها</option>
                                    <option value="3" <?php if($task['status'] == 3)echo' SELECTED="SELECTED" ';?> >تم الانتهاء منها</option>
                                    <?php if(in_array( $this->user_info['group_id'], array(1,2) )):?>
                                        <option value="4" <?php if($task['status'] == 4)echo' SELECTED="SELECTED" ';?> >معتمدة</option>
                                    <?php endif;?>
                                </select>
                                <i class="result text-success"></i>
                                <input type="submit" class="btn-update btn btn-sm btn-success" value="حفظ" />
                            </div>
                            <div class="col-sm-4">
                                <?php if($allow_manage_tasks):?>
                                <div class="text-left" style="padding: 10px;">
                                    <a href="<?php echo base_url().admin_dir();?>/project_details/edit_task/<?php echo $task['id'];?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> </a>
                                    <a href="#" onclick="deletone('<?php echo base_url().admin_dir();?>/project_details/delete_task/<?=$task['id']?>')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                </div>
                                <?php endif;?>
                            </div>
                        </div>

                    </div>
                    <!-- end of card-footer -->


                    <?php if(count($sub_tasks)>0):?>
                    <div class="card-block">
                        <hr />
                        <div class="row">
                            <?php foreach($sub_tasks as $sub_task):?>
                            <div class="col-sm-6">
                                <div class="card card-border-inverse">
                                    <div class="card-header">
                                        <h3><?php echo $sub_task['name'];?></h3>
                                        <span class="label label-default f-left">تاريخ التسليم <?php echo $sub_task['delivery_date'];?> </span>
                                    </div>
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="task-detail">
                                                    <div>
                                                        <strong>الموظف المسئول: </strong>
                                                        <strong class="label label-warning">
                                                            <?php
                                                            $this->user_model->_table_name = 'users';
                                                            $user = $this->user_model->get_single('id='.$sub_task['user_id']);
                                                            echo $user['name'];
                                                            ?>
                                                        </strong>
                                                    </div>
                                                    <hr />
                                                    <div>تاريخ انشاء المهمة: <b><?php echo get_date($sub_task['created_at']);?></b></div>
                                                    <?php if($sub_task['worked_at'] !=''):?>
                                                        <div>تاريخ بداية العمل: <b><?php echo get_date($sub_task['worked_at']);?></b></div>
                                                    <?php endif;?>
                                                    <?php if($sub_task['ended_at'] !=''):?>
                                                        <div>تاريخ الانتهاء من العمل: <b><?php echo get_date($sub_task['ended_at']);?></b></div>
                                                    <?php endif;?>
                                                </div>
                                                <hr />
                                                <p class="task-due"><strong>متبقي : </strong><strong class="label label-danger"><?php echo get_days_count_down($sub_task['delivery_date']); ?> يوم </strong></p>
                                            </div>
                                            <!-- end of col-sm-8 -->
                                        </div>
                                        <!-- end of row -->
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <input type="hidden" class="task_id" name="task_id" value="<?php echo $sub_task['id'];?>" />
                                                <select name="status" class="status corm-control">
                                                    <option value="1" <?php if($sub_task['status'] == 1)echo' SELECTED="SELECTED" ';?> >بالإنتظار</option>
                                                    <option value="2" <?php if($sub_task['status'] == 2)echo' SELECTED="SELECTED" ';?> >جاري العمل عليها</option>
                                                    <option value="3" <?php if($sub_task['status'] == 3)echo' SELECTED="SELECTED" ';?> >تم الانتهاء منها</option>
                                                    <?php if(in_array( $this->user_info['group_id'], array(1,2) )):?>
                                                        <option value="4" <?php if($sub_task['status'] == 4)echo' SELECTED="SELECTED" ';?> >معتمدة</option>
                                                    <?php endif;?>
                                                </select>
                                                <i class="result text-success"></i>
                                                <input type="submit" class="btn-update btn btn-sm btn-success" value="حفظ" />
                                            </div>
                                            <div class="col-sm-5">
                                                <?php if($allow_manage_tasks):?>
                                                <div class="text-left" style="padding: 10px;">
                                                    <a href="<?php echo base_url().admin_dir();?>/project_details/edit_task/<?php echo $sub_task['id'];?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> </a>
                                                    <a href="#" onclick="deletone('<?php echo base_url().admin_dir();?>/project_details/delete_task/<?=$sub_task['id']?>')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                                </div>
                                                <?php endif;?>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- end of card-footer -->
                                </div>
                            </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                    <?php endif;?>
                </div>
            <?php endforeach;?>


            <?php $this->load->view('admin/projects/project_details_tasks_add'); ?>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        $(".btn-update").on('click', function(){
            var el = $(this).closest('.card-footer');
            var task_id=el.find('.task_id').val();
            var task_status=el.find('.status').val();
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
