<?php if(isset($admin_projects) && count($admin_projects) > 0):?>
    <div class="card">
        <div class="card-header">
            <h5>المشاريع المفتوحة</h5>
        </div>
        <div class="card-block">
            <div class="table-responsive dt-responsive">
                <table id="dom-jqry" class="table table-striped table-bordered nowrap text-center">
                    <thead>
                    <tr>
                        <th class="text-center" width="100">ID</th>
                        <th class="text-center">اسم المشروع</th>
                        <th class="text-center">تاريخ التسليم</th>
                        <th class="text-center" width="150">عرض المشروع</th>
                        <?php if($this->user_info['group_id'] == 1):?>
                            <th class="text-center" width="80">تعديل</th>
                            <th class="text-center" width="80">حذف</th>
                        <?php endif;?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($admin_projects as $project):?>
                        <tr>
                            <td><?php echo $project['id'];?></td>
                            <td><?php echo $project['name'];?></td>
                            <td><?php echo $project['delivery_date'];?></td>
                            <td><a class="btn btn-warning" href="<?php echo base_url(admin_dir().'/project_details/tasks/'.$project['id'])?>">عرض المشروع</a></td>
                            <?php if($this->user_info['group_id'] == 1):?>
                                <td>
                                    <a href="<?php echo base_url().admin_dir();?>/projects/edit/<?php echo $project['id'];?>" class="btn btn-primary"><i class="fa fa-edit"></i> </a>
                                </td>
                                <td>
                                    <a href="#" onclick="deletone('<?php echo base_url().admin_dir();?>/projects/delete/<?=$project['id']?>')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                </td>
                            <?php endif;?>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if(isset($projects) && count($projects) > 0):?>
    <div class="card">
        <div class="card-header">
            <h5>المشاريع التابعه لك</h5>
        </div>
        <div class="card-block">
            <div class="table-responsive dt-responsive">
            <table id="dom-jqry" class="table table-striped table-bordered nowrap text-center">
                    <thead>
                    <tr>
                        <th class="text-center" width="100">ID</th>
                        <th class="text-center">اسم المشروع</th>
                        <th class="text-center">تاريخ التسليم</th>
                        <th class="text-center" width="150">عرض المشروع</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($projects as $project):?>
                        <tr>
                            <td><?php echo $project['id'];?></td>
                            <td><?php echo $project['name'];?></td>
                            <td><?php echo $project['delivery_date'];?></td>
                            <td><a class="btn btn-warning" href="<?php echo base_url(admin_dir().'/project_details/tasks/'.$project['id'])?>">عرض المشروع</a></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>


<?php if(isset($progress_tasks) && count($progress_tasks) > 0):?>
    <div class="card">
        <div class="card-header">
            <h5>المهام التابعة لك التي يتم العمل عليها </h5>
        </div>
        <div class="card-block">
            <div class="table-responsive dt-responsive">
                <table id="dom-jqry" class="table table-striped table-bordered text-center">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">المهمة</th>
                        <th class="text-center">المشروع التابعة له</th>
                        <th class="text-center">تاريخ انشاء المهمة</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($progress_tasks as $task):?>
                        <tr>
                            <th ><?php echo $task['id'];?></th>
                            <td><?php echo $task['name'];?></td>
                            <td>
                                <?php
                                $project_info = $this->project_model->get_single('id='.$task['project_id']);
                                ?>
                                <a href="<?php echo base_url(admin_dir().'/project_details/tasks/'.$project_info['id'])?>">
                                    <?php echo $project_info['name'];?>
                                </a>
                            </td>
                            <td><?php echo get_date($task['created_at']);?></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if(isset($waiting_tasks) && count($waiting_tasks) > 0):?>
    <div class="card">
        <div class="card-header">
            <h5>أقرب 5 مهام تابعة لك بانتظار العمل عليها</h5>
        </div>
        <div class="card-block">
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">المهمة</th>
                        <th class="text-center">المشروع التابعة له</th>
                        <th class="text-center">تاريخ انشاء المهمة</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($waiting_tasks as $task):?>
                        <tr>
                            <th ><?php echo $task['id'];?></th>
                            <td><?php echo $task['name'];?></td>
                            <td>
                                <?php
                                $project_info = $this->project_model->get_single('id='.$task['project_id']);
                                ?>
                                <a href="<?php echo base_url(admin_dir().'/project_details/tasks/'.$project_info['id'])?>">
                                    <?php echo $project_info['name'];?>
                                </a>
                            </td>
                            <td><?php echo get_date($task['created_at']);?></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>

