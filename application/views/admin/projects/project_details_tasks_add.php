<?php if($allow_manage_tasks == TRUE):?>
    <style>
        .dd-w, .sp-container {
            z-index: 999999999999 !important;
        }
    </style>
    <!-- Modal static-->
    <div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">اضافة مهمة جديدة</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php echo form_open();?>
                <div class="modal-body">
                    <div id="response-result"></div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            اسم المهمة <span class="required">*</span>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="name" required="required" class="name form-control" value="<?= set_value('name') ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            تاريخ تسليم المهمة
                        </label>
                        <div class="col-sm-10">
                            <input id="dropper-default" name="delivery_date" class="delivery_date form-control" type="text" value="<?= set_value('delivery_date') ?>" placeholder="Select date" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            الموظف المسؤول  <span class="required">*</span>
                        </label>
                        <div class="col-sm-10">
                            <select name="user_id" class="user_id form-control">
                                <?php foreach($employees as $employee): ?>
                                    <option value="<?php echo $employee['id'];?>"><?php echo $employee['name'];?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">
                            مهمة رئيسية
                        </label>
                        <div class="col-sm-10">
                            <select name="main_task" class="main_task form-control">
                                <option value="0">-----</option>
                                <?php foreach($main_tasks as $task): ?>
                                    <option value="<?php echo $task['id'];?>"><?php echo $task['name'];?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                    <button type="button" class="add-task btn btn-primary waves-effect waves-light ">حفظ</button>

                </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $("document").ready(function(){
            $("#dropper-default").dateDropper({
                dropWidth: 200,
                format: "d/m/Y",
                dropPrimaryColor: "#1abc9c",
                dropBorder: "1px solid #1abc9c"
            });
        });

        $(document).ready(function(){
            $(".add-task").on('click', function(){

                var name=$('.name').val();
                var delivery_date=$('.delivery_date').val();
                var user_id=$('.user_id').val();
                var main_task=$('.main_task').val();
                var project_id='<?php echo $project['id'];?>';
                var tokenValue = $("input[name='<?php echo $this->security->get_csrf_token_name(); ?>']");
                //console.log('task_id:'+task_id+' | task_status:'+task_status);
                $.ajax
                ({
                    type: "POST",
                    url: RMM.url+"ajax/add_task",
                    data: { name: name, delivery_date: delivery_date, user_id: user_id, main_task: main_task,project_id: project_id, '<?php echo $this->security->get_csrf_token_name(); ?>' : tokenValue.val() },
                    dataType: "json",
                    cache: false,
                    beforeSend: function(){
                        $("#response-result").html('<img src="<?php echo base_url('/assets/images/loading-small.gif');?>" />');
                    },
                    success: function(data, textStatus, jqXHR)
                    {
                        tokenValue.val(data.token);
                        $("#response-result").html('');
                        if(data.output == "success")
                        {
                            $("#response-result").html('<div class="alert alert-success">'+ data.message +' </div>');
                            location.reload();
                        }
                        else
                        {
                            $("#response-result").html('<div class="alert alert-danger">'+ data.message +' </div>');
                        }
                    }
                });

            });
        });

    </script>
<?php endif;?>