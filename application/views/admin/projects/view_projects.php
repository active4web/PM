<div class="card">
    <div class="card-header">
        <h5>المشاريع</h5>
    </div>

    <?php if(in_array('projects_add', $this->user_info['permissions'])):?>
    <div class="text-center"><a href="<?=base_url().admin_dir()?>/projects/add" class="btn btn-info">اضافة مشروع جديد</a></div>
        <br />
    <?php endif;?>

    <div class="card-block">
        <?php echo form_open(base_url().admin_dir() . '/projects/index/');?>
        <div class="table-responsive dt-responsive">
            <table id="dom-jqry" class="table table-striped table-bordered nowrap ">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">اسم المشروع</th>

                    <?php if(in_array('projects_view_delivery_date', $this->user_info['permissions'])):?>
                        <th class="text-center">تاريخ التسليم</th>
                    <?php endif;?>

                    <?php if(in_array('projects_view_manager', $this->user_info['permissions'])):?>
                        <th class="text-center">مدير المشروع</th>
                    <?php endif;?>

                    <th class="text-center">عرض المشروع</th>

                    <?php if(in_array('projects_approval', $this->user_info['permissions'])):?>
                        <th class="text-center">حالة المشروع</th>
                    <?php endif;?>

                    <?php if(in_array('projects_edit', $this->user_info['permissions'])):?>
                    <th class="text-center" width="80">تعديل</th>
                    <?php endif;?>
                    <?php if(in_array('projects_delete', $this->user_info['permissions'])):?>
                    <th class="text-center" width="80">حذف</th>
                    <?php endif;?>
                </tr>
                </thead>
                <tbody>
                <?php foreach($projects as $project):?>
                <tr>
                    <th ><?php echo $project['id'];?></th>
                    <td><?php echo $project['name'];?></td>

                    <?php if(in_array('projects_view_delivery_date', $this->user_info['permissions'])):?>
                        <td><?php echo $project['delivery_date'];?></td>
                    <?php endif;?>

                    <?php if(in_array('projects_view_manager', $this->user_info['permissions'])):?>
                        <td>
                            <?php
                            $this->user_model->_table_name = 'users';
                            $manager = $this->user_model->get_single('id='.$project['user_id']);
                            echo $manager['name'];
                            ?>
                        </td>
                    <?php endif;?>

                    <td class="text-center"><a class="btn btn-warning" href="<?php echo base_url(admin_dir().'/project_details/tasks/'.$project['id'])?>">عرض المشروع</a></td>

                    <?php if(in_array('projects_approval', $this->user_info['permissions'])):?>
                        <td>
                            <div class="project-status text-center ">
                                <span class="text-success result"></span>
                                <input type="hidden" class="project_id" name="project_id" value="<?php echo $project['id']; ?>" />
                                <select class="status" name="status">
                                    <option value="0" <?php if($project['status'] == 0)echo' SELECTED ';?>>جاري العمل</option>
                                    <option value="1" <?php if($project['status'] == 1)echo' SELECTED ';?>>تم الانتهاء</option>
                                    <option value="2" <?php if($project['status'] == 2)echo' SELECTED ';?>>ملغي</option>
                                </select>
                            </div>
                        </td>
                    <?php endif;?>

                    <?php if(in_array('projects_edit', $this->user_info['permissions'])):?>
                    <td>
                        <a href="<?php echo base_url().admin_dir();?>/projects/edit/<?php echo $project['id'];?>" class="btn btn-primary"><i class="fa fa-edit"></i> </a>
                    </td>
                    <?php endif;?>
                    <?php if(in_array('projects_delete', $this->user_info['permissions'])):?>
                    <td>
                        <a href="#" onclick="deletone('<?php echo base_url().admin_dir();?>/projects/delete/<?=$project['id']?>')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
                    <?php endif;?>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <?php form_close();?>
    </div>
</div>

<?php if(in_array('projects_approval', $this->user_info['permissions'])):?>
<script type="text/javascript">
    $(document).ready(function(){
        $(".status").on('change', function(){
            var el = $(this).closest('.project-status');
            var project_id = el.find('.project_id').val();
            var project_status = el.find('.status').val();
            var tokenValue = $("input[name='<?php echo $this->security->get_csrf_token_name(); ?>']");
            $.ajax
            ({
                type: "POST",
                url: RMM.url+"ajax/update_project_status",
                data: { project_id: project_id, project_status:project_status, '<?php echo $this->security->get_csrf_token_name(); ?>' : tokenValue.val() },
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
<?php endif;?>