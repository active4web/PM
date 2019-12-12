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
            <li class="breadcrumb-item">
                <a href="<?php echo base_url().admin_dir();?>/project_details/tasks/<?php echo $project['id'];?>">تفاصيل المشروع(<?php echo $project['name'];?>)</a>
            </li>
            <li class="breadcrumb-item"><a href="#">تفاصيل المهمة(<?php echo $task['name'];?>)</a>
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
                    <?php echo form_open_multipart(base_url().admin_dir() . '/project_details/edit_task/'.$task['id']);?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            اسم المهمة <span class="required">*</span>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="name" required="required" class="name form-control" value="<?= set_value('name', $task['name']) ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            تاريخ تسليم المهمة
                        </label>
                        <div class="col-sm-10">
                            <input id="dropper-default" name="delivery_date" class="delivery_date form-control" type="text" value="<?= set_value('delivery_date', $task['delivery_date']) ?>" placeholder="Select date" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            الموظف المسؤول  <span class="required">*</span>
                        </label>
                        <div class="col-sm-10">
                            <select name="user_id" class="user_id form-control">
                                <?php foreach($employees as $employee): ?>
                                    <option value="<?php echo $employee['id'];?>" <?php if($employee['id'] == $task['user_id']) echo ' SELECTED="SELECTED" ';?>><?php echo $employee['name'];?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            مهمة رئيسية
                        </label>
                        <div class="col-sm-10">
                            <select name="main_task" class="form-control">
                                <option value="0">-----</option>
                                <?php foreach($main_tasks as $main_task): ?>
                                    <option value="<?php echo $main_task['id'];?>" <?php if($main_task['id'] == $task['main_task']) echo ' SELECTED="SELECTED" ';?>><?php echo $main_task['name'];?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <hr />
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            حالة المهمة
                        </label>
                        <div class="col-sm-10">
                            <select name="status" class="form-control">
                                <option value="1" <?php if($task['status'] == 1) echo ' SELECTED="SELECTED" ';?> >بالإنتظار</option>
                                <option value="2" <?php if($task['status'] == 2) echo ' SELECTED="SELECTED" ';?> >جاري العمل عليها</option>
                                <option value="3" <?php if($task['status'] == 3) echo ' SELECTED="SELECTED" ';?> >تم الإنتهاء منها</option>
                                <option value="4" <?php if($task['status'] == 4) echo ' SELECTED="SELECTED" ';?> >معتمدة</option>
                            </select>
                        </div>
                    </div>
                    <hr />

                    <div class="form-group">
                        <div class="text-center col-xs-12">
                            <input type="submit" name="edit-task" class="btn btn-success" value="حفظ" />
                        </div>
                    </div>
                <?php echo form_close();?>

    <script type="text/javascript">
        $("document").ready(function(){
            $("#dropper-default").dateDropper({
                dropWidth: 200,
                format: "d/m/Y",
                dropPrimaryColor: "#1abc9c",
                dropBorder: "1px solid #1abc9c"
            });
        });
    </script>