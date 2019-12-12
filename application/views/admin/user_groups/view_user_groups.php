<div class="card">
    <div class="card-header">
        <h5>مجموعات الاعضاء</h5>
    </div>
    <div class="text-center"><a href="<?=base_url().admin_dir()?>/user_groups/add" class="btn btn-warning">اضافة مجموعة جديدة</a></div>
    <div class="card-block">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th class="text-center" width="50">#</th>
                    <th class="text-center"> المجموعة</th>
                    <th class="text-center" width="80">تعديل</th>
                    <th class="text-center" width="80">حذف</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($user_groups as $row):?>
                <tr>
                    <th ><?php echo $row['id'];?></th>
                    <td><?php echo $row['name'];?></td>
                    <td>
                        <a href="<?php echo base_url().admin_dir();?>/user_groups/edit/<?php echo $row['id'];?>" class="btn btn-primary"><i class="fa fa-edit"></i> </a>
                    </td>
                    <td>
                        <a href="#" onclick="deletone('<?php echo base_url().admin_dir();?>/user_groups/delete/<?=$row['id']?>')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>