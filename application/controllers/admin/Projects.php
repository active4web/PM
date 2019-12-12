<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class projects extends Admin_Controller {

    public function __construct()
    {
         parent::__construct();

        $this->load->model('user_model');
        $this->load->model('project_model');

    }

    public function index()
    {
        $data = array();

        $cond=' status=0 ';

        if(in_array('projects_his_only', $this->user_info['permissions']))
        {

            $cond.=' AND user_id='.$this->user_info['id'] ;
        }
        elseif(in_array('tasks_his_only', $this->user_info['permissions']))
        {
            $projects_ids = $this->project_model->get_projects_ids_by_emp_user_id($this->user_info['id']);
            $projects_ids_coma = implode(',', $projects_ids );
            $cond.=' AND id IN ('.$projects_ids_coma.') ';
        }

        $this->project_model->_table_name = "projects";
        $data['projects'] = $this->project_model->get($cond);

        $data['subview'] = $this->load->view(admin_dir().'/projects/view_projects', $data, TRUE);
        $this->load->view(admin_dir().'/layout_main', $data);
    }

    public function archive()
    {
        $data = array();

        $cond=' status!=0 ';
        if(in_array('projects_his_only', $this->user_info['permissions']))
        {

            $cond.=' AND user_id='.$this->user_info['id'] ;
        }
        elseif(in_array('tasks_his_only', $this->user_info['permissions']))
        {
            $projects_ids = $this->project_model->get_projects_ids_by_emp_user_id($this->user_info['id']);
            $projects_ids_coma = implode(',', $projects_ids );
            $cond.=' AND id IN ('.$projects_ids_coma.') ';
        }

        $this->project_model->_table_name = "projects";
        $data['projects'] = $this->project_model->get($cond);

        $data['subview'] = $this->load->view(admin_dir().'/projects/view_projects_archive', $data, TRUE);
        $this->load->view(admin_dir().'/layout_main', $data);
    }


    public function add()
    {
        $data=array();

        if(!in_array('projects_add', $this->user_info['permissions']))
        {
            $data['subview'] = message_error("لا تمتلك صلاحيات لهذا الاجراء");
            $this->load->view(admin_dir().'/layout_main', $data);
            return;
        }

        $this->user_model->_table_name = "users";
        $managers = $this->user_model->get('group_id=2');
        $data['managers'] = $managers;

        if($this->input->post('add-project'))
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'الاسم', 'trim|required');

            if ($this->form_validation->run() == TRUE)
            {
                $inputs_array = array(
                    'name',
                    'user_id',
                    'notes'
                );
                $array_posts = $this->project_model->array_from_post($inputs_array);
                $array_posts['created_at']    = time();
                $array_posts['status']        = 0;

                if(in_array('projects_edit_delivery_date', $this->user_info['permissions']))
                {
                    $delivery_date = $this->input->post('delivery_date', true);
                    $array_posts['delivery_date'] = $delivery_date;
                }

                $this->project_model->_table_name = "projects";
                $project_id = $this->project_model->save($array_posts);

                if(in_array('files_add', $this->user_info['permissions']))
                {
                    // upload analysis file
                    $analysis_res = multi_upload_files('analysis_files', 'analysis');
                    if (is_array($analysis_res) && !empty($analysis_res)) {
                        $analysis_files_name = $this->input->post('analysis_files_name');
                        for ($i = 0; $i < count($analysis_res); $i++) {
                            $file_data = array(
                                'file' => $analysis_res[$i]['file_name'],
                                'name' => $this->security->xss_clean($analysis_files_name[$i]),
                                'project_id' => $project_id,
                                'type' => 'analysis',
                            );
                            $this->project_model->store_files($file_data);
                        }
                    }

                    // upload screen file
                    $screen_res = multi_upload_files('screen_files', 'screen');
                    if (is_array($screen_res) && !empty($screen_res)) {
                        $screen_files_name = $this->input->post('screen_files_name');
                        for ($i = 0; $i < count($screen_res); $i++) {
                            $file_data = array(
                                'file' => $screen_res[$i]['file_name'],
                                'name' => $screen_files_name[$i],
                                'project_id' => $project_id,
                                'type' => 'screen',
                            );
                            $this->project_model->store_files($file_data);
                        }
                    }

                    // upload design file
                    $design_res = multi_upload_files('design_files', 'design');
                    if (is_array($design_res) && !empty($design_res)) {
                        $design_files_name = $this->input->post('design_files_name');
                        for ($i = 0; $i < count($design_res); $i++) {
                            $file_data = array(
                                'file' => $design_res[$i]['file_name'],
                                'name' => $design_files_name[$i],
                                'project_id' => $project_id,
                                'type' => 'design',
                            );
                            $this->project_model->store_files($file_data);
                        }
                    }

                    // upload design_cut file
                    $design_cut_res = multi_upload_files('design_cut_files', 'design-cut');
                    if (is_array($design_cut_res) && !empty($design_cut_res)) {
                        $design_cut_files_name = $this->input->post('design_cut_files_name');
                        for ($i = 0; $i < count($design_cut_res); $i++) {
                            $file_data = array(
                                'file' => $design_cut_res[$i]['file_name'],
                                'name' => $design_cut_files_name[$i],
                                'project_id' => $project_id,
                                'type' => 'design_cut',
                            );
                            $this->project_model->store_files($file_data);
                        }
                    }

                }
                    // send email notification
                    $this->user_model->_table_name = "users";
                    $user_manager = $this->user_model->get_single('id=' . $array_posts['user_id']);
                    $this->load->library('email');
                    $this->load->library('my_email');
                    $this->my_email->init();
                    $subject = 'يوجد مشروع جديد';
                    $message = '';
                    $message .= '<h3>تنبيه بوجود مشروع جديد</h3>';
                    $message .= '<br> <br>';
                    $this->my_email->send_email(NULL, $user_manager['email'], $subject, $message);


                $message_type = "success";
                $message_text = 'تم اضافة المشروع بنجاح';
                set_message($message_type, $message_text);
                redirect(admin_dir().'/projects/edit/'.$project_id);
            }
        }

        $data['subview'] = $this->load->view(admin_dir().'/projects/add_project', $data, TRUE);
        $this->load->view(admin_dir().'/layout_main', $data);
    }

    public function edit($id)
    {
        if(!in_array('projects_edit', $this->user_info['permissions']))
        {
            $data['subview'] = message_error("لا تمتلك صلاحيات لهذا الاجراء");
            $this->load->view(admin_dir().'/layout_main', $data);
            return;
        }

        $id   = intval(abs($id));
        $data = array();

        $this->project_model->_table_name = "projects";
        $project = $this->project_model->get_single('id='.$id);
        $data['project'] = $project;

        $this->user_model->_table_name = "users";
        $managers = $this->user_model->get('group_id=2');
        $data['managers'] = $managers;

        // Get analysis files
        $analysis_files = $this->project_model->get_files($id, 'analysis');
        $data['analysis_files'] = $analysis_files;
        // Get screen files
        $screen_files = $this->project_model->get_files($id, 'screen');
        $data['screen_files'] = $screen_files;
        // Get design files
        $design_files = $this->project_model->get_files($id, 'design');
        $data['design_files'] = $design_files;
        // Get design_cut files
        $design_cut_files = $this->project_model->get_files($id, 'design_cut');
        $data['design_cut_files'] = $design_cut_files;

        if($this->input->post('edit-project'))
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'الاسم', 'trim|required');

            if ($this->form_validation->run() == TRUE)
            {
                $inputs_array = array(
                    'name',
                    'user_id',
                    'notes'
                );
                $array_posts = $this->project_model->array_from_post($inputs_array);

                if(in_array('projects_edit_delivery_date', $this->user_info['permissions']))
                {
                    $delivery_date = $this->input->post('delivery_date', true);
                    $array_posts['delivery_date'] = $delivery_date;
                }

                $this->project_model->_table_name = "projects";
                $project_id = $this->project_model->save($array_posts, $id);


                if(in_array('files_add', $this->user_info['permissions']))
                {
                    // upload analysis file
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

                    // upload screen file
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

                    // upload design file
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

                    // upload design_cut file
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

                    if( $_FILES['analysis_files']['name'][0] !=''
                        || $_FILES['screen_files']['name'][0] !=''
                        ||  $_FILES['design_files']['name'][0] !=''
                        || $_FILES['design_cut_files']['name'][0] !='')
                    {
                        // send email notification
                        $allow_users_ids = $this->project_model->get_allow_employees_ids_for_project($project_id);
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
                                $message .= '<h3>تنبيه برفع ملفات جديدة على المشروع ' . $array_posts['name'] . '</h3>';
                                $message .= '<br> <br>';
                                $this->my_email->send_email(NULL, $user_details['email'], $subject, $message);
                            }
                        }
                    }
                }

                $message_type = "success";
                $message_text = 'تم تعديل بيانات المشروع بنجاح';
                set_message($message_type, $message_text);
                redirect(admin_dir().'/projects/edit/'.$project_id);
            }
        }

        $data['subview'] = $this->load->view(admin_dir().'/projects/edit_project', $data, TRUE);
        $this->load->view(admin_dir().'/layout_main', $data);
    }

    public function delete($id)
    {
        if(!in_array('projects_delete', $this->user_info['permissions']))
        {
            $data['subview'] = message_error("لا تمتلك صلاحيات لهذا الاجراء");
            $this->load->view(admin_dir().'/layout_main', $data);
            return;
        }

        $id = intval(abs($id));

        $this->project_model->_table_name = "projects";
        // delete project files
        $project_files = $this->project_model->get_files($id);
        foreach($project_files as $files)
        {
            $this->project_model->delete_file($files['id']);
            @unlink('./assets/uploads/'.$files['file']);
        }

        // delete project discussions
        $this->load->model('discussion_model');
        $this->discussion_model->_table_name = "discussions";
        $project_discussions = $this->discussion_model->get('project_id='.$id);
        foreach($project_discussions as $discussion)
        {
            $this->discussion_model->delete($discussion['id']);
            @unlink('./assets/uploads/'.$discussion['attachment']);
        }

        // delete project tasks
        $this->load->model('task_model');
        $this->task_model->_table_name = "tasks";
        $project_tasks = $this->task_model->get('project_id='.$id);
        foreach($project_tasks as $task)
        {
            $this->task_model->delete($task['id']);
        }

        // delete project
        $this->project_model->delete($id);

        $message_type = "success";
        $message_text = "تم الحذف بنجاح";
        set_message($message_type, $message_text);
        redirect(admin_dir().'/projects');
    }
#**************************************************************************************#
    public function delete_file($file_id)
    {
        if(!in_array('files_delete', $this->user_info['permissions']))
        {
            $data['subview'] = message_error("لا تمتلك صلاحيات لهذا الاجراء");
            $this->load->view(admin_dir().'/layout_main', $data);
            return;
        }

        $file_id = intval(abs($file_id));

        $file = $this->project_model->get_file($file_id);
        @unlink('./assets/uploads/'.$file['file']);
        $this->project_model->delete_file($file_id);
        
        $message_type = "success";
        $message_text = "تم الحذف بنجاح";
        set_message($message_type, $message_text);
        redirect(admin_dir().'/projects/edit/'.$file['project_id']);
    }
}