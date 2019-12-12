<div class="card">
    <div class="card-header">
        <h5>العضويات</h5>
    </div>

    <?php if(in_array('users_add', $this->user_info['permissions'])) :?>
    <div class="text-center"><a href="<?=base_url().admin_dir()?>/users/add" class="btn btn-warning">اضافة عضوية جديدة</a></div>
    <?php endif;?>

    <div class="card-block">
        <div class="table-responsive dt-responsive">
            <table id="dom-jqry" class="table table-striped table-bordered nowrap text-center">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">الاسم</th>
                    <th class="text-center">البريد الالكتروني</th>
                    <th class="text-center">نوع العضوية</th>

                    <?php if(in_array('users_edit', $this->user_info['permissions'])) :?>
                    <th class="text-center" width="80">تعديل</th>
                    <?php endif;?>
                    <?php if(in_array('users_delete', $this->user_info['permissions'])) :?>
                    <th class="text-center" width="80">حذف</th>
                    <?php endif;?>
                </tr>
                </thead>
                <tbody>
                <?php foreach($users as $user):?>
                <tr>
                    <th ><?php echo $user['id'];?></th>
                    <td><?php echo $user['name'];?></td>
                    <td><?php echo $user['email'];?></td>
                    <td>
                        <?php
                        $group = $this->user_model->get_user_group($user['group_id']);
                        echo $group['name'];
                        ?>
                    </td>
                    <?php if(in_array('users_edit', $this->user_info['permissions'])) :?>
                    <td>
                        <a href="<?php echo base_url().admin_dir();?>/users/edit/<?php echo $user['id'];?>" class="btn btn-primary"><i class="fa fa-edit"></i> </a>
                    </td>
                    <?php endif;?>
                    <?php if(in_array('users_delete', $this->user_info['permissions'])) :?>
                    <td>
                        <a href="#" onclick="deletone('<?php echo base_url().admin_dir();?>/users/delete/<?=$user['id']?>')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
                    <?php endif;?>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>