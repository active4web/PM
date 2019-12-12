<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ajax extends Admin_Controller {

    public function add_task()
    {
        if( in_array('tasks_add', $this->user_info['permissions']) )
        {
            $this->load->model('task_model');

            $output = '';
            $message = '';
            $name = $this->security->xss_clean($this->input->post('name'));
            $delivery_date = $this->security->xss_clean($this->input->post('delivery_date'));
            $user_id = intval(abs($this->input->post('user_id')));
            $main_task = intval(abs($this->input->post('main_task')));
            $project_id = intval(abs($this->input->post('project_id')));
            $new_token = $this->security->get_csrf_hash();

            // store new task
            if($this->input->is_ajax_request())
            {
                if (empty($name))
                {
                    $output = 'error';
                    $message = 'يجب التأكد من ادخال اسم المهمة';
                }
                else
                {
                    $array_posts = array(
                        'name'=>$name,
                        'delivery_date'=>$delivery_date,
                        'user_id'=>$user_id,
                        'main_task'=>$main_task,
                        'project_id'=>$project_id,
                        'created_at'=>time()
                    );
                    $this->task_model->_table_name = "tasks";
                    $this->task_model->save($array_posts);
                    $output = 'success';
                    $message = 'تم اضافة المهمة بنجاح';

                    // send email notification
                    $this->load->model('user_model');
                    $this->user_model->_table_name = "users";
                    $user_emp = $this->user_model->get_single('id='.$array_posts['user_id']);
                    $this->load->library('email');
                    $this->load->library('my_email');
                    $this->my_email->init();
                    $subject = 'يوجد مهمة جديد';
                    $msg = '';
                    $msg.= '<h3>تنبيه بوجود مهمة جديد</h3>';
                    $msg.= '<br> <br>';
                    $this->my_email->send_email(NULL, $user_emp['email'], $subject, $msg);

                }

                echo json_encode(array('output'=>$output, 'message'=>$message, 'token'=>$new_token));
                exit();
            }
        }
    }
	public function update_task_status()
    {
        $output = '';
        $task_id = intval(abs($this->input->post('task_id')));
        $task_status = intval(abs($this->input->post('task_status')));
        $new_token = $this->security->get_csrf_hash();
        if($this->input->is_ajax_request())
        {
            $data_array = array('status'=>$task_status);

            $this->load->model('task_model');
            $this->task_model->_table_name = "tasks";
            $task_details =  $this->task_model->get_single('id='.$task_id);

            $this->load->model('project_model');
            $this->project_model->_table_name = "projects";
            $project_details =  $this->project_model->get_single('id='.$task_details['project_id']);

            if($task_details['status'] != $task_status)
            {
                if($task_status == 1) {
                    //$data_array['worked_at'] = '';
                    // $data_array['ended_at'] = '';
                }
                elseif($task_status == 2) {
                    $data_array['worked_at'] = time();
                    $data_array['ended_at'] = Null;
                }
                elseif($task_status == 3) {
                    $data_array['ended_at'] = time();
                }
                // update task
                $tasks = $this->task_model->save($data_array, $task_id);

                if($tasks)
                {
                    $output = 'success';

                        // send email notification
                        $this->load->model('user_model');
                        $this->user_model->_table_name = "users";
                        $user_emp = $this->user_model->get_single('id=' . $task_details['user_id']);
                        $user_manage = $this->user_model->get_single('id=' . $project_details['user_id']);
                        $user_emp_permission = $this->user_model->get_permissions($user_emp['group_id']);
                        $user_manage_permission = $this->user_model->get_permissions($user_manage['group_id']);

                        $this->load->library('email');
                        $this->load->library('my_email');
                        $this->my_email->init();
                        $subject = 'تم تغير حالة المهمة ';
                        $message = '';
                        $message .= '<h3>تنبيه بتغيير حالة المهة </h3>';
                        $message .= '<br>اسم المهمة: ' . $task_details['name'] . ' <br>';
                        $message .= '<br>اسم المشروع: ' . $project_details['name'] . ' <br>';

                    if(in_array('notification_task_status', $user_emp_permission))
                    {
                        $this->my_email->send_email(NULL, $user_emp['email'], $subject, $message);
                    }
                    if(in_array('notification_task_status', $user_manage_permission))
                    {
                        $this->my_email->send_email(NULL, $user_manage['email'], $subject, $message);
                    }
                }
                else
                    $output = 'Error';
            }

            echo json_encode(array('output'=>$output,'token'=>$new_token));
            exit();
        }
    }

    public function update_project_status()
    {
        if(!in_array('projects_approval', $this->user_info['permissions']) )
        {
            exit('error permission');
        }

        $output = '';
        $project_id = intval(abs($this->input->post('project_id')));
        $project_status = intval(abs($this->input->post('project_status')));
        $new_token = $this->security->get_csrf_hash();
        if($this->input->is_ajax_request())
        {
            $data_array = array('status'=>$project_status);

            $this->load->model('project_model');
            $this->project_model->_table_name = "projects";
            $project_details =  $this->project_model->get_single('id='.$project_id);

            if($project_details['status'] != $project_status)
            {
                $project = $this->project_model->save($data_array, $project_id);
                if($project)
                {
                    if($project_status == 1)
                    {
                        $dataArr = array('status'=>4);
                        $this->db->where('project_id='.$project_id.' AND  status IN (1,2,3) ')->update('tasks', $dataArr);
                    }
                    elseif($project_status == 2)
                    {
                        $dataArr = array('status'=>3);
                        $this->db->where('project_id='.$project_id.' AND status IN (1,2) ')->update('tasks', $dataArr);
                    }

                    $output = 'success';

                    // send email notification
                    $this->load->model('user_model');
                    $this->user_model->_table_name = "users";
                    $user_manage = $this->user_model->get_single('id=' . $project_details['user_id']);
                    $user_manage_permission = $this->user_model->get_permissions($user_manage['group_id']);

                    $this->load->library('email');
                    $this->load->library('my_email');
                    $this->my_email->init();
                    $subject = 'تم تغير حالة المشروع ';
                    $message = '';
                    $message .= '<h3>تنبيه بتغيير حالة المشروع </h3>';
                    $message .= '<br>اسم المشروع: ' . $project_details['name'] . ' <br>';

                    // send notinf to project manager
                    if(in_array('notification_project_status', $user_manage_permission))
                    {
                        $this->my_email->send_email(NULL, $user_manage['email'], $subject, $message);
                    }

                    // send notinf to users related project
                    $allow_users_ids = $this->project_model->get_allow_employees_ids_for_project($project_id);
                    for($i=0; $i<count($allow_users_ids); $i++)
                    {
                        $user_id = $allow_users_ids[$i];
                        $this->user_model->_table_name = "users";
                        $user_details = $this->user_model->get_single('id='.$user_id);
                        $user_permission = $this->user_model->get_permissions($user_details['group_id']);
                        if(in_array('notification_project_status', $user_permission))
                        {
                            $this->my_email->send_email(NULL, $user_details['email'], $subject, $message);
                        }
                    }

                }
                else
                    $output = 'Error'.$project_id;
            }

            echo json_encode(array('output'=>$output,'token'=>$new_token));
            exit();
        }
    }

    public function update_project_delivery_date()
    {
        if(!in_array('projects_edit', $this->user_info['permissions']) && in_array('projects_edit_delivery_date', $this->user_info['permissions']))
        {
            exit('error permission');
        }

        $output = '';
        $project_id = intval(abs($this->input->post('project_id')));
        $project_delivery_date = $this->security->xss_clean($this->input->post('project_delivery_date'));
        $new_token = $this->security->get_csrf_hash();
        if($this->input->is_ajax_request())
        {
            $data_array = array('delivery_date'=>$project_delivery_date);

            $this->load->model('project_model');
            $this->project_model->_table_name = "projects";
            $project_details =  $this->project_model->get_single('id='.$project_id);

            if($project_details['delivery_date'] != $project_delivery_date)
            {
                $project = $this->project_model->save($data_array, $project_id);
                if($project)
                {
                    $output = 'success';
                }
                else
                    $output = 'Error'.$project_id;
            }

            echo json_encode(array('output'=>$output,'token'=>$new_token));
            exit();
        }
    }

    public function update_project_name()
    {
        if(!in_array('projects_edit', $this->user_info['permissions']))
        {
            exit('error permission');
        }

        $output = '';
        $project_id = intval(abs($this->input->post('project_id')));
        $project_name = $this->security->xss_clean($this->input->post('project_name'));
        $new_token = $this->security->get_csrf_hash();
        if($this->input->is_ajax_request())
        {
            $data_array = array('name'=>$project_name);

            $this->load->model('project_model');
            $this->project_model->_table_name = "projects";
            $project_details =  $this->project_model->get_single('id='.$project_id);

            if($project_details['name'] != $project_name)
            {
                $project = $this->project_model->save($data_array, $project_id);
                if($project)
                {
                    $output = 'success';
                }
                else
                    $output = 'Error'.$project_id;
            }

            echo json_encode(array('output'=>$output,'token'=>$new_token));
            exit();
        }
    }

    public function update_project_notes()
    {
        if(!in_array('projects_edit', $this->user_info['permissions']))
        {
            exit('error permission');
        }

        $output = '';
        $project_id = intval(abs($this->input->post('project_id')));
        $project_notes = $this->security->xss_clean($this->input->post('project_notes'));
        $new_token = $this->security->get_csrf_hash();
        if($this->input->is_ajax_request())
        {
            $data_array = array('notes'=>$project_notes);

            $this->load->model('project_model');
            $this->project_model->_table_name = "projects";
            $project_details =  $this->project_model->get_single('id='.$project_id);

            if($project_details['notes'] != $project_notes)
            {
                $project = $this->project_model->save($data_array, $project_id);
                if($project)
                {
                    $output = 'success';
                }
                else
                    $output = 'Error'.$project_id;
            }

            echo json_encode(array('output'=>$output,'token'=>$new_token));
            exit();
        }
    }

}


?>