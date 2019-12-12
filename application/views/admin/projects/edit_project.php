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
            <li class="breadcrumb-item"><a href="#">تعديل المشروع: <?php echo $project['name'];?></a>
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
                    <?php echo form_open_multipart(base_url().admin_dir() . '/projects/edit/'.$project['id']);?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            اسم المشروع <span class="required">*</span>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="name" required="required" class="form-control" value="<?= set_value('name', $project['name']) ?>" />
                        </div>
                    </div>
                    <?php if(in_array('projects_edit_delivery_date', $this->user_info['permissions'])):?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            تاريخ التسليم المتوقع
                        </label>
                        <div class="col-sm-10">
                            <input id="dropper-default" name="delivery_date" class="form-control" type="text" value="<?= set_value('delivery_date', $project['delivery_date']) ?>" placeholder="Select date" readonly="readonly">
                        </div>
                    </div>
                    <?php endif;?>
                    <hr />
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            تحليل المشروع
                        </label>
                        <div class="col-sm-10">
                            <?php if(count($analysis_files) > 0):?>
                                <div class="row">
                                    <?php foreach($analysis_files as $file):?>
                                        <div class="col-sm-2 text-center">
                                            <div class="project-file-box">
                                                <?php if(in_array('files_delete', $this->user_info['permissions'])):?>
                                                <div class="delete-icon"><a href="#" onclick="deletone('<?php echo base_url().admin_dir();?>/projects/delete_file/<?=$file['id']?>', 'هل انت متأكد من حذف الملف؟')" title="حذف الملف"><i class="fa fa-times"></i></a></div>
                                                <?php endif;?>
                                                <div class="file-icon">
                                                    <a target="_blank" href="<?php echo base_url();?>assets/uploads/<?php echo $file['file'];?>"><img src="<?php echo base_url();?>assets/images/download-icon.png" alt="" /></a>
                                                    <span><?=$file['name']?></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach;?>
                                </div>
                                <br />
                            <?php endif;?>

                            <?php if(in_array('files_add', $this->user_info['permissions'])):?>
                            <div class="input-group file-row">
                                <input type="file" name="analysis_files[]" class="form-control">
                                <input type="text" name="analysis_files_name[]" placeholder="أسم الملف" class="form-control">
                                <span class="btn btn-success file-btn-add-row fa fa-plus"><i class=""></i></span>
                            </div>
                            <?php endif;?>
                        </div>
                    </div>
                    <hr />
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            صور الشاشات
                        </label>
                        <div class="col-sm-10">
                            <?php if(count($screen_files) > 0):?>
                                <div class="row">
                                    <?php foreach($screen_files as $file):?>
                                        <div class="col-sm-2 text-center">
                                            <div class="project-file-box">
                                                <?php if(in_array('files_delete', $this->user_info['permissions'])):?>
                                                    <div class="delete-icon"><a href="#" onclick="deletone('<?php echo base_url().admin_dir();?>/projects/delete_file/<?=$file['id']?>', 'هل انت متأكد من حذف الملف؟')" title="حذف الملف"><i class="fa fa-times"></i></a></div>
                                                <?php endif;?>
                                                <div class="file-icon">
                                                    <a target="_blank" href="<?php echo base_url();?>assets/uploads/<?php echo $file['file'];?>"><img src="<?php echo base_url();?>assets/images/download-icon.png" alt="" /></a>
                                                    <span><?=$file['name']?></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach;?>
                                </div>
                                <br />
                            <?php endif;?>

                            <?php if(in_array('files_add', $this->user_info['permissions'])):?>
                            <div class="input-group file-row">
                                <input type="file" name="screen_files[]" class="form-control">
                                <input type="text" name="screen_files_name[]" placeholder="أسم الملف" class="form-control">
                                <span class="btn btn-success file-btn-add-row fa fa-plus"><i class=""></i></span>
                            </div>
                            <?php endif;?>
                        </div>
                    </div>
                    <hr />
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            ملفات التصميم المفتوحة
                        </label>
                        <div class="col-sm-10">
                            <?php if(count($design_files) > 0):?>
                                <div class="row">
                                    <?php foreach($design_files as $file):?>
                                        <div class="col-sm-2 text-center">
                                            <div class="project-file-box">
                                                <?php if(in_array('files_delete', $this->user_info['permissions'])):?>
                                                    <div class="delete-icon"><a href="#" onclick="deletone('<?php echo base_url().admin_dir();?>/projects/delete_file/<?=$file['id']?>', 'هل انت متأكد من حذف الملف؟')" title="حذف الملف"><i class="fa fa-times"></i></a></div>
                                                <?php endif;?>
                                                <div class="file-icon">
                                                    <a target="_blank" href="<?php echo base_url();?>assets/uploads/<?php echo $file['file'];?>"><img src="<?php echo base_url();?>assets/images/download-icon.png" alt="" /></a>
                                                    <span><?=$file['name']?></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach;?>
                                </div>
                                <br />
                            <?php endif;?>

                            <?php if(in_array('files_add', $this->user_info['permissions'])):?>
                            <div class="input-group file-row">
                                <input type="file" name="design_files[]" class="form-control">
                                <input type="text" name="design_files_name[]" placeholder="أسم الملف" class="form-control">
                                <span class="btn btn-success file-btn-add-row fa fa-plus"><i class=""></i></span>
                            </div>
                            <?php endif;?>
                        </div>
                    </div>
                    <hr />
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            ملفات تقطيع التصميم
                        </label>
                        <div class="col-sm-10">
                            <?php if(count($design_cut_files) > 0):?>
                                <div class="row">
                                    <?php foreach($design_cut_files as $file):?>
                                        <div class="col-sm-2 text-center">
                                            <div class="project-file-box">
                                                <?php if(in_array('files_delete', $this->user_info['permissions'])):?>
                                                    <div class="delete-icon"><a href="#" onclick="deletone('<?php echo base_url().admin_dir();?>/projects/delete_file/<?=$file['id']?>', 'هل انت متأكد من حذف الملف؟')" title="حذف الملف"><i class="fa fa-times"></i></a></div>
                                                <?php endif;?>
                                                <div class="file-icon">
                                                    <a target="_blank" href="<?php echo base_url();?>assets/uploads/<?php echo $file['file'];?>"><img src="<?php echo base_url();?>assets/images/download-icon.png" alt="" /></a>
                                                    <span><?=$file['name']?></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach;?>
                                </div>
                                <br />
                            <?php endif;?>

                            <?php if(in_array('files_add', $this->user_info['permissions'])):?>
                            <div class="input-group file-row">
                                <input type="file" name="design_cut_files[]" class="form-control">
                                <input type="text" name="design_cut_files_name[]" placeholder="أسم الملف" class="form-control">
                                <span class="btn btn-success file-btn-add-row fa fa-plus"><i class=""></i></span>
                            </div>
                            <?php endif;?>
                        </div>
                    </div>
                    <hr />
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            ملاحظات <span class="required">*</span>
                        </label>
                        <div class="col-sm-10">
                            <textarea name="notes" class="form-control" rows="3" cols="100"><?= set_value('notes', $project['notes']) ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            مدير المشروع المسئول <span class="required">*</span>
                        </label>
                        <div class="col-sm-10">
                            <select name="user_id" class="form-control">
                                <?php foreach($managers as $manager): ?>
                                    <option value="<?php echo $manager['id'];?>" <?php if($manager['id'] == $project['user_id'])echo ' SELECTED="SELECTED" ';?> ><?php echo $manager['name'];?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <hr />

                    <div class="form-group">
                        <div class="text-center col-xs-12">
                            <input type="submit" name="edit-project" class="btn btn-success" value="حفظ" />
                        </div>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">


    $("document").ready(function(){

        // $('.file-btn-add-row').click(function(event){
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

        $("#dropper-default").dateDropper( {
            dropWidth: 200,
            format: "d/m/Y",
            dropPrimaryColor: "#1abc9c",
            dropBorder: "1px solid #1abc9c"
        });
    });



</script>

