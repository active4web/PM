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
                <a class="nav-link" href="<?php echo base_url(admin_dir().'/project_details/tasks/'.$project['id'])?>" role="tab">المهام</a>
                <div class="slide"></div>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo base_url(admin_dir().'/discussions/index/'.$project['id'])?>" role="tab">النقاش</a>
                <div class="slide"></div>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="<?php echo base_url(admin_dir().'/project_details/files/'.$project['id'])?>" role="tab">الملفات</a>
                <div class="slide"></div>
            </li>
        </ul>

        <div class="tab-content card-block">

            <?php if(validation_errors() !='')echo message_error(validation_errors());?>
            <?php echo form_open_multipart(base_url(admin_dir().'/discussions/create/'.$project['id']));?>
            <div class="card">
                <div class="card-block">
                    <div class="form-group">
                        <textarea name="content" cols="60" rows="4" placeholder="محتوي المناقشة" required class="content form-control"><?= set_value('content') ?></textarea>
                    </div>
                    <hr/>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            المستلم
                        </label>
                        <div class="col-sm-10">
                            <select name="user_id[]" class="form-control" multiple required>
                                <?php foreach($receivers as $row):?>
                                    <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <hr/>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            المرفقات
                        </label>
                        <div class="col-sm-10">
                            <input type="file" name="attachment" class="form-control">
                        </div>
                    </div>
                    <hr />

                    <div class="form-group">
                        <div class="text-center col-xs-12">
                            <input type="submit" name="send-discussion" class="btn btn-success" value="ارسال" />
                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_close();?>

            <div class="discussions-list">
                <?php foreach($discussions_list as $row): ?>
                <div class="discussion-row">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="avatar">
                                <?php
                                    $user_from = $this->user_model->get_single('id='.$row['from_id']);
                                    if(isset($user_from['id'])):
                                ?>
                                    <?php if(isset($user_from['avatar']) && $user_from['avatar']!=''):?>
                                        <img src="<?php echo base_url(); ?>assets/uploads/<?php echo $user_from['avatar']; ?>" class="img-radius" alt="<?php echo $user_from['name']; ?>">
                                    <?php else:?>
                                        <img src="<?php echo base_url(); ?>assets/images/default_avatar.jpg" class="img-radius" alt="<?php echo $user_from['name']; ?>">
                                    <?php endif;?>
                                    <h3><?php echo $user_from['name']; ?></h3>
                                <?php endif;?>
                        </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="content"><?=$row['content']?></div>
                            <div class="date"><?=get_date($row['time']);?></div>
                            <?php if($row['attachment'] !=''):?>
                            <div class="attach">
                                المرفقات
                                <a target="_blank" href="<?php echo base_url();?>assets/uploads/<?php echo $row['attachment'];?>"><img src="<?php echo base_url();?>assets/images/download-icon.png" alt="" /></a>
                            </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
 </div>
