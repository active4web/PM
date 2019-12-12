<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class project_details extends Admin_Controller {

    public function __construct()
    {
         parent::__construct();

        $this->load->model('task_model');
        $this->load->model('user_model');
        $this->load->model('project_model');
    }

    public function index($project_id)
    {
        $this->tasks($project_id);
    }

    public function tasks($project_id)
    {
        $project_id = intval(abs($project_id));
        $data = array();

        $this->project_model->_table_name = 'projects';
        $project = $this->project_model->get_single('id='.$project_id);
        $data['project'] = $project;

        $allow_users_ids = $this->project_model->get_allow_employees_ids_for_project($project_id);
        $data['allow_users_ids'] = $allow_users_ids;

        $tasks_where = '';
        // check if allow to add task
        $data['allow_manage_tasks'] = FALSE;

        if( in_array('tasks_add', $this->user_info['permissions']) || in_array('tasks_edit', $this->user_info['permissions']))
        {
            $data['allow_manage_tasks'] = TRUE;

            $this->user_model->_table_name = "users";
            $employees = $this->user_model->get();
            $data['employees'] = $employees;
        }
        elseif(in_array('projects_his_only', $this->user_info['permissions']) && $this->user_info['id'] != $project['user_id'])
        {
            $data['subview'] = message_error("لا تمتلك صلاحيات خاصة بهذا المشروع");
            $this->load->view(admin_dir().'/layout_main', $data);
            return;
        }
        elseif(in_array('tasks_his_only', $this->user_info['permissions']) && !in_array($this->user_info['id'] ,$allow_users_ids))
        {
            $data['subview'] = message_error("لا تمتلك صلاحيات خاصة بهذا المشروع");
            $this->load->view(admin_dir().'/layout_main', $data);
            return;
        }

        if(in_array('tasks_his_only', $this->user_info['permissions']))
        {
           $tasks_where.= ' AND user_id ='.$this->user_info['id'].' ';
        }
        $data['tasks_where'] = $tasks_where;

        $this->task_model->_table_name = 'tasks';
        $main_tasks = $this->task_model->get('project_id='.$project['id'].' AND main_task=0 '.$tasks_where);
        $data['main_tasks'] = $main_tasks;


        $data['subview'] = $this->load->view(admin_dir().'/projects/project_details_tasks', $data, TRUE);
        $this->load->view(admin_dir().'/layout_main', $data);
    }

    public function edit_task($id)
    {
        $id   = intval(abs($id));
        $data = array();

        $this->task_model->_table_name = "tasks";
        $task = $this->task_model->get_single('id='.$id);
        $data['task'] = $task;

        $this->project_model->_table_name = "projects";
        $project= $this->project_model->get_single('id='.$task['project_id']);
        $data['project'] = $project;

        if(
            !in_array('tasks_edit', $this->user_info['permissions'])
            || ($this->user_info['id'] != $project['user_id'] && in_array('projects_his_only', $this->user_info['permissions']) )
        )
        {
            $data['subview'] = message_error("لا تمتلك صلاحيات لهذا الاجراء");
            $this->load->view(admin_dir().'/layout_main', $data);
            return;
        }


        $this->user_model->_table_name = "users";
        $employees = $this->user_model->get();
        $data['employees'] = $employees;

        $main_tasks = $this->task_model->get('project_id='.$project['id'].' AND main_task=0');
        $data['main_tasks'] = $main_tasks;

        if($this->input->post('edit-task'))
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'الاسم', 'trim|required');

            if ($this->form_validation->run() == TRUE)
            {
                $inputs_array = array(
                    'name',
                    'delivery_date',
                    'user_id',
                    'main_task',
                    'status'
                );
                $array_posts = $this->task_model->array_from_post($inputs_array);

                $status = $array_posts['status'];
                if($status != $task['status'])
                {
                    if($status == 1) {
                        $array_posts['worked_at'] = Null;
                        $array_posts['ended_at'] = Null;
                    }
                    elseif($status == 2) {
                        $array_posts['worked_at'] = time();
                        $array_posts['ended_at'] = Null;
                    }
                    elseif($status == 3) {
                        $array_posts['ended_at'] = time();
                    }
                }

                $this->task_model->_table_name = "tasks";
                $task_id = $this->task_model->save($array_posts, $id);

                $message_type = "success";
                $message_text = 'تم تعديل بيانات المهمة بنجاح';
                set_message($message_type, $message_text);
                redirect(admin_dir().'/project_details/edit_task/'.$task_id);
            }
        }

        $data['subview'] = $this->load->view(admin_dir().'/projects/project_details_tasks_edit', $data, TRUE);
        $this->load->view(admin_dir().'/layout_main', $data);
    }

    public function delete_task($id)
    {
        $id = intval(abs($id));

        $this->task_model->_table_name = "tasks";
        $task = $this->task_model->get_single('id='.$id);

        $this->project_model->_table_name = "projects";
        $project= $this->project_model->get_single('id='.$task['project_id']);
        $data['project'] = $project;

        //if( $this->user_info['group_id'] != 1 && $this->user_info['id'] != $project['user_id'] )
        if(
            !in_array('tasks_delete', $this->user_info['permissions'])
            || ($this->user_info['id'] != $project['user_id'] && in_array('projects_his_only', $this->user_info['permissions']) )
        )
        {
            $data['subview'] = message_error("لا تمتلك صلاحيات لهذا الاجراء");
            $this->load->view(admin_dir().'/layout_main', $data);
            return;
        }

        $sub_tasks = $this->task_model->get('main_task='.$task['id']);
        foreach($sub_tasks as $row)
        {
            $this->task_model->delete($row['id']);
        }

        $this->task_model->delete($task['id']);

        $message_type = "success";
        $message_text = "تم الحذف بنجاح";
        set_message($message_type, $message_text);
        redirect(admin_dir().'/project_details/tasks/'.$task['project_id']);
    }

#***************************************************************************#
    public function files($project_id)
    {
        $project_id = intval(abs($project_id));
        $data = array();

        $this->project_model->_table_name = 'projects';
        $project = $this->project_model->get_single('id='.$project_id);
        $data['project'] = $project;

        // check permissions
        $allow_users_ids = $this->project_model->get_allow_employees_ids_for_project($project_id);
        $data['allow_users_ids'] = $allow_users_ids;

        if(!in_array('files_projects_view', $this->user_info['permissions']))
        {
            $data['subview'] = message_error("لا تمتلك صلاحيات لهذا الاجراء");
            $this->load->view(admin_dir().'/layout_main', $data);
            return;
        }
        elseif(in_array('projects_his_only', $this->user_info['permissions']) && $this->user_info['id'] != $project['user_id'])
        {
            $data['subview'] = message_error("لا تمتلك صلاحيات خاصة بهذا المشروع");
            $this->load->view(admin_dir().'/layout_main', $data);
            return;
        }
        elseif(in_array('tasks_his_only', $this->user_info['permissions']) && !in_array($this->user_info['id'] ,$allow_users_ids))
        {
            $data['subview'] = message_error("لا تمتلك صلاحيات خاصة بهذا المشروع");
            $this->load->view(admin_dir().'/layout_main', $data);
            return;
        }

        // project files
        // Get analysis files
        $analysis_files = $this->project_model->get_files($project_id, 'analysis');
        $data['analysis_files'] = $analysis_files;
        // Get screen files
        $screen_files = $this->project_model->get_files($project_id, 'screen');
        $data['screen_files'] = $screen_files;
        // Get design files
        $design_files = $this->project_model->get_files($project_id, 'design');
        $data['design_files'] = $design_files;
        // Get design_cut files
        $design_cut_files = $this->project_model->get_files($project_id, 'design_cut');
        $data['design_cut_files'] = $design_cut_files;

        $data['subview'] = $this->load->view(admin_dir().'/projects/project_details_files', $data, TRUE);
        $this->load->view(admin_dir().'/layout_main', $data);
    }

    public function add_files($project_id)
    {
        $project_id = intval(abs($project_id));
        $data = array();

        if(!in_array('files_add', $this->user_info['permissions']))
        {
            $data['subview'] = message_error("لا تمتلك صلاحيات لهذا الاجراء");
            $this->load->view(admin_dir().'/layout_main', $data);
            return;
        }

        $this->project_model->_table_name = 'projects';
        $project = $this->project_model->get_single('id='.$project_id);
        $data['project'] = $project;

        // check permissions
        $allow_users_ids = $this->project_model->get_allow_employees_ids_for_project($project_id);
        $data['allow_users_ids'] = $allow_users_ids;

        if(!in_array('files_projects_view', $this->user_info['permissions']))
        {
            $data['subview'] = message_error("لا تمتلك صلاحيات لهذا الاجراء");
            $this->load->view(admin_dir().'/layout_main', $data);
            return;
        }
        elseif(in_array('projects_his_only', $this->user_info['permissions']) && $this->user_info['id'] != $project['user_id'])
        {
            $data['subview'] = message_error("لا تمتلك صلاحيات خاصة بهذا المشروع");
            $this->load->view(admin_dir().'/layout_main', $data);
            return;
        }
        elseif(in_array('tasks_his_only', $this->user_info['permissions']) && !in_array($this->user_info['id'] ,$allow_users_ids))
        {
            $data['subview'] = message_error("لا تمتلك صلاحيات خاصة بهذا المشروع");
            $this->load->view(admin_dir().'/layout_main', $data);
            return;
        }

        // upload analysis file
        if($this->input->post('type') == 'analysis_files' && !empty($_FILES['analysis_files']['name'][0]))
        {
            $analysis_res = multi_upload_files('analysis_files', 'analysis');
            if(is_array($analysis_res) && !empty($analysis_res))
            {
                $analysis_files_name = $this->input->post('analysis_files_name');
                for($i=0; $i<count($analysis_res); $i++)
                {
                    $file_data = array(
                        'file' => $analysis_res[$i]['file_name'],
                        'name' => $this->security->xss_clean($analysis_files_name[$i]),
                        'project_id' => $project_id,
                        'type' => 'analysis',
                    );
                    $this->project_model->store_files($file_data);
                }
            }

            $message_type = "success";
            $message_text = "تم رفع الملفات بنجاح";
            set_message($message_type, $message_text);
            redirect(admin_dir().'/project_details/files/'.$project_id);
        }

        if( $_FILES['analysis_files']['name'][0] !=''
            || $_FILES['screen_files']['name'][0] !=''
            ||  $_FILES['design_files']['name'][0] !=''
            || $_FILES['design_cut_files']['name'][0] !='')
        {
            // send email notification
            for($i=0; $i<count($allow_users_ids); $i++)
            {
                $user_id = $allow_users_ids[$i];
                $this->user_model->_table_name = "users";
                $user_details = $this->user_model->get_single('id='.$user_id);
                $user_permission = $this->user_model->get_permissions($user_details['group_id']);
                if(in_array('notification_new_files', $user_permission))
                {
                    $this->load->library('email');
                    $this->load->library('my_email');
                    $this->my_email->init();
                    $subject = 'تم رفع ملفات جديدة بالمشروع';
                    $message = '';
                    $message .= '<h3>تنبيه برفع ملفات جديدة على المشروع ' . $project['name'] . '</h3>';
                    $message .= '<br> <br>';
                    $this->my_email->send_email(NULL, $user_details['email'], $subject, $message);
                }
            }
        }

        // upload screen file
        if($this->input->post('type') == 'screen_files' && !empty($_FILES['screen_files']['name'][0]))
        {
            $screen_res = multi_upload_files('screen_files', 'screen');
            if(is_array($screen_res) && !empty($screen_res))
            {
                $screen_files_name = $this->input->post('screen_files_name');
                for($i=0; $i<count($screen_res); $i++)
                {
                    $file_data = array(
                        'file' => $screen_res[$i]['file_name'],
                        'name' => $screen_files_name[$i],
                        'project_id' => $project_id,
                        'type' => 'screen',
                    );
                    $this->project_model->store_files($file_data);
                }
            }

            $message_type = "success";
            $message_text = "تم رفع الملفات بنجاح";
            set_message($message_type, $message_text);
            redirect(admin_dir().'/project_details/files/'.$project_id);
        }
        // upload design file
        if($this->input->post('type') == 'design_files' && !empty($_FILES['design_files']['name'][0]))
        {
            $design_res = multi_upload_files('design_files', 'design');
            if(is_array($design_res) && !empty($design_res))
            {
                $design_files_name = $this->input->post('design_files_name');
                for($i=0; $i<count($design_res); $i++)
                {
                    $file_data = array(
                        'file' => $design_res[$i]['file_name'],
                        'name' => $design_files_name[$i],
                        'project_id' => $project_id,
                        'type' => 'design',
                    );
                    $this->project_model->store_files($file_data);
                }
            }

            $message_type = "success";
            $message_text = "تم رفع الملفات بنجاح";
            set_message($message_type, $message_text);
            redirect(admin_dir().'/project_details/files/'.$project_id);
        }
        // upload design_cut file
        if($this->input->post('type') == 'design_cut_files' && !empty($_FILES['design_cut_files']['name'][0]))
        {
            $design_cut_res = multi_upload_files('design_cut_files', 'design-cut');
            if(is_array($design_cut_res) && !empty($design_cut_res))
            {
                $design_cut_files_name = $this->input->post('design_cut_files_name');
                for($i=0; $i<count($design_cut_res); $i++)
                {
                    $file_data = array(
                        'file' => $design_cut_res[$i]['file_name'],
                        'name' => $design_cut_files_name[$i],
                        'project_id' => $project_id,
                        'type' => 'design_cut',
                    );
                    $this->project_model->store_files($file_data);
                }
            }

            $message_type = "success";
            $message_text = "تم رفع الملفات بنجاح";
            set_message($message_type, $message_text);
            redirect(admin_dir().'/project_details/files/'.$project_id);
        }
        else
            {
            $message_type = "error";
            $message_text = "يجب التأكد من اختيار الملف";
            set_message($message_type, $message_text);
            redirect(admin_dir().'/project_details/files/'.$project_id);
        }

    }

    public function delete_file($project_id, $file_id)
    {
        $project_id = intval(abs($project_id));
        $file_id    = intval(abs($file_id));
        $data = array();

        if(!in_array('files_delete', $this->user_info['permissions']))
        {
            $data['subview'] = message_error("لا تمتلك صلاحيات لهذا الاجراء");
            $this->load->view(admin_dir().'/layout_main', $data);
            return;
        }

        $this->project_model->_table_name = 'projects';
        $project = $this->project_model->get_single('id='.$project_id);
        $data['project'] = $project;

        // check permissions
        $allow_users_ids = $this->project_model->get_allow_employees_ids_for_project($project_id);
        $data['allow_users_ids'] = $allow_users_ids;

        if(!in_array('files_projects_view', $this->user_info['permissions']))
        {
            $data['subview'] = message_error("لا تمتلك صلاحيات لهذا الاجراء");
            $this->load->view(admin_dir().'/layout_main', $data);
            return;
        }
        elseif(in_array('projects_his_only', $this->user_info['permissions']) && $this->user_info['id'] != $project['user_id'])
        {
            $data['subview'] = message_error("لا تمتلك صلاحيات خاصة بهذا المشروع");
            $this->load->view(admin_dir().'/layout_main', $data);
            return;
        }
        elseif(in_array('tasks_his_only', $this->user_info['permissions']) && !in_array($this->user_info['id'] ,$allow_users_ids))
        {
            $data['subview'] = message_error("لا تمتلك صلاحيات خاصة بهذا المشروع");
            $this->load->view(admin_dir().'/layout_main', $data);
            return;
        }

        $file = $this->project_model->get_file($file_id);
        if($file)
        {
            @unlink('./assets/uploads/'.$file['file']);
            $this->project_model->delete_file($file_id);

            $message_type = "success";
            $message_text = "تم الحذف بنجاح";
            set_message($message_type, $message_text);
            redirect(admin_dir().'/project_details/files/'.$project_id);
        }
        else
            redirect(admin_dir().'/project_details/files/'.$project_id);

    }
}