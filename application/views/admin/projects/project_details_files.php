<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

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
                <a class="nav-link" href="<?php echo base_url(admin_dir().'/project_details/tasks/'.$project['id'])?>" role="tab">المهام</a>
                <div class="slide"></div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(admin_dir().'/discussions/index/'.$project['id'])?>" role="tab">النقاش</a>
                <div class="slide"></div>
            </li>
            <li class="nav-item">
                <a class="nav-link active"  href="<?php echo base_url(admin_dir().'/project_details/files/'.$project['id'])?>" role="tab">الملفات</a>
                <div class="slide"></div>
            </li>
        </ul>

        <div class="tab-content card-block">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card card-border-inverse">
                        <div class="card-header">
                            <h3>ملفات تحليل المشروع</h3>
                        </div>
                        <div class="card-block">
                            <?php if(count($analysis_files) > 0):?>
                                <div class="row">
                                    <?php foreach($analysis_files as $file):?>
                                        <div class="col-sm-4 text-center">
                                            <div class="project-file-box">
                                                <?php if(in_array('files_delete', $this->user_info['permissions'])):?>
                                                    <div class="delete-icon"><a href="#" onclick="deletone('<?php echo base_url().admin_dir();?>/project_details/delete_file/<?=$project['id']?>/<?=$file['id']?>', 'هل انت متأكد من حذف الملف؟')" title="حذف الملف"><i class="fa fa-times"></i></a></div>
                                                <?php endif;?>
                                                <div class="file-icon">
                                                    <a target="_blank" href="<?php echo base_url();?>assets/uploads/<?php echo $file['file'];?>"><img src="<?php echo base_url();?>assets/images/download-icon.png" alt="" /></a>
                                                    <span><?php echo $file['name'];?></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach;?>
                                </div>
                            <?php endif;?>
                            <?php if(in_array('files_add', $this->user_info['permissions'])):?>
                                <?php echo form_open_multipart(base_url(admin_dir().'/project_details/add_files/'.$project['id']))?>
                                    <br>
                                    <h4>اضافة ملفات</h4>
                                    <div class="input-group file-row">
                                        <input type="file" name="analysis_files[]" class="form-control">
                                        <input type="text" name="analysis_files_name[]" placeholder="أسم الملف" class="form-control">
                                        <span class="btn btn-success file-btn-add-row fa fa-plus"><i class=""></i></span>
                                    </div>
                                    <input type="hidden" name="type" value="analysis_files"/>
                                    <input type="submit" class="btn btn-info" value="رفع الملفات" />
                                <?php echo form_close();?>
                            <?php endif;?>
                        </div>
                        <div class="card-footer">
                        </div>
                        <!-- end of card-footer -->
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card card-border-warning">
                        <div class="card-header">
                            <h3>صور الشاشات</h3>
                        </div>
                        <div class="card-block">
                            <?php if(count($screen_files) > 0):?>
                                <div class="row">
                                    <?php foreach($screen_files as $file):?>
                                        <div class="col-sm-4 text-center">
                                            <div class="project-file-box">
                                                <?php if(in_array('files_delete', $this->user_info['permissions'])):?>
                                                    <div class="delete-icon"><a href="#" onclick="deletone('<?php echo base_url().admin_dir();?>/project_details/delete_file/<?=$project['id']?>/<?=$file['id']?>', 'هل انت متأكد من حذف الملف؟')" title="حذف الملف"><i class="fa fa-times"></i></a></div>
                                                <?php endif;?>
                                                <div class="file-icon">
                                                    <a target="_blank" href="<?php echo base_url();?>assets/uploads/<?php echo $file['file'];?>"><img src="<?php echo base_url();?>assets/images/download-icon.png" alt="" /></a>
                                                    <span><?php echo $file['name'];?></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach;?>
                                </div>
                            <?php endif;?>

                            <?php if(in_array('files_add', $this->user_info['permissions'])):?>
                                <?php echo form_open_multipart(base_url(admin_dir().'/project_details/add_files/'.$project['id']))?>
                                <br>
                                <h4>اضافة ملفات</h4>
                                <div class="input-group file-row">
                                    <input type="file" name="screen_files[]" class="form-control">
                                    <input type="text" name="screen_files_name[]" placeholder="أسم الملف" class="form-control">
                                    <span class="btn btn-success file-btn-add-row fa fa-plus"><i class=""></i></span>
                                </div>
                                <input type="hidden" name="type" value="screen_files"/>
                                <input type="submit" class="btn btn-info" value="رفع الملفات" />
                                <?php echo form_close();?>
                            <?php endif;?>
                        </div>
                        <div class="card-footer">
                        </div>
                        <!-- end of card-footer -->
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card card-border-danger">
                        <div class="card-header">
                            <h3>ملفات التصميم المفتوحة</h3>
                        </div>
                        <div class="card-block">
                            <?php if(count($design_files) > 0):?>
                                <div class="row">
                                    <?php foreach($design_files as $file):?>
                                        <div class="col-sm-4 text-center">
                                            <div class="project-file-box">
                                                <?php if(in_array('files_delete', $this->user_info['permissions'])):?>
                                                    <div class="delete-icon"><a href="#" onclick="deletone('<?php echo base_url().admin_dir();?>/project_details/delete_file/<?=$project['id']?>/<?=$file['id']?>', 'هل انت متأكد من حذف الملف؟')" title="حذف الملف"><i class="fa fa-times"></i></a></div>
                                                <?php endif;?>
                                                <div class="file-icon">
                                                    <a target="_blank" href="<?php echo base_url();?>assets/uploads/<?php echo $file['file'];?>"><img src="<?php echo base_url();?>assets/images/download-icon.png" alt="" /></a>
                                                    <span><?php echo $file['name'];?></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach;?>
                                </div>
                            <?php endif;?>

                            <?php if(in_array('files_add', $this->user_info['permissions'])):?>
                                <?php echo form_open_multipart(base_url(admin_dir().'/project_details/add_files/'.$project['id']))?>
                                <br>
                                <h4>اضافة ملفات</h4>
                                <div class="input-group file-row">
                                    <input type="file" name="design_files[]" class="form-control">
                                    <input type="text" name="design_files_name[]" placeholder="أسم الملف" class="form-control">
                                    <span class="btn btn-success file-btn-add-row fa fa-plus"><i class=""></i></span>
                                </div>
                                <input type="hidden" name="type" value="design_files"/>
                                <input type="submit" class="btn btn-info" value="رفع الملفات" />
                                <?php echo form_close();?>
                            <?php endif;?>
                        </div>
                        <div class="card-footer">
                        </div>
                        <!-- end of card-footer -->
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card card-border-info">
                        <div class="card-header">
                            <h3>ملفات تقطيع التصميم</h3>
                        </div>
                        <div class="card-block">
                            <?php if(count($design_cut_files) > 0):?>
                                <div class="row">
                                    <?php foreach($design_cut_files as $file):?>
                                        <div class="col-sm-4 text-center">
                                            <div class="project-file-box">
                                                <?php if(in_array('files_delete', $this->user_info['permissions'])):?>
                                                <div class="delete-icon"><a href="#" onclick="deletone('<?php echo base_url().admin_dir();?>/project_details/delete_file/<?=$project['id']?>/<?=$file['id']?>', 'هل انت متأكد من حذف الملف؟')" title="حذف الملف"><i class="fa fa-times"></i></a></div>
                                                <?php endif;?>
                                                <div class="file-icon">
                                                    <a target="_blank" href="<?php echo base_url();?>assets/uploads/<?php echo $file['file'];?>"><img src="<?php echo base_url();?>assets/images/download-icon.png" alt="" /></a>
                                                    <span><?php echo $file['name'];?></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach;?>
                                </div>
                            <?php endif;?>

                            <?php if(in_array('files_add', $this->user_info['permissions'])):?>
                                <?php echo form_open_multipart(base_url(admin_dir().'/project_details/add_files/'.$project['id']))?>
                                <br>
                                <h4>اضافة ملفات</h4>
                                <div class="input-group file-row">
                                    <input type="file" name="design_cut_files[]" class="form-control">
                                    <input type="text" name="design_cut_files_name[]" placeholder="أسم الملف" class="form-control">
                                    <span class="btn btn-success file-btn-add-row fa fa-plus"><i class=""></i></span>
                                </div>
                                <input type="hidden" name="type" value="design_cut_files"/>
                                <input type="submit" class="btn btn-info" value="رفع الملفات" />
                                <?php echo form_close();?>
                            <?php endif;?>

                        </div>
                        <div class="card-footer">
                        </div>
                        <!-- end of card-footer -->
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("document").ready(function(){
        $('body').on('click','.file-btn-add-row',function(event){
            event.preventDefault();
            var el = $(this).closest('.file-row').clone().insertAfter($(this).closest('.file-row').last());
            el.find('.file-btn-add-row').removeClass('btn-success file-btn-add-row fa-plus').addClass('btn-danger file-btn-remove-row fa-minus');
            return false;
        });
        $('body').on('click','.file-btn-remove-row',function(event){
            event.preventDefault();
            var el = $(this).closest('.file-row').remove();
            return false;
        });
    });
</script>

