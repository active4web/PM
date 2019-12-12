<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class discussions extends Admin_Controller {

    public function __construct()
    {
         parent::__construct();

        $this->load->model('discussion_model');
        $this->load->model('user_model');
        $this->load->model('project_model');
    }



    public function index($project_id)
    {
        $this->create($project_id);
    }
    public function create($project_id)
    {
        $project_id = intval(abs($project_id));
        $data = array();

        $this->project_model->_table_name = 'projects';
        $project = $this->project_model->get_single('id='.$project_id);
        $data['project'] = $project;

        // check permissions
        $allow_users_ids = $this->project_model->get_allow_employees_ids_for_project($project_id);
        $data['allow_users_ids'] = $allow_users_ids;
        $allow_users_ids_coma = implode(',', $allow_users_ids);

        if(!in_array('discussions', $this->user_info['permissions']))
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

        $this->discussion_model->_table_name = "discussions";
        $discussions_list = $this->discussion_model->get('project_id='.$project_id.' AND ( from_id='.$this->user_info['id'].' OR ( CONCAT(",",to_id,",") LIKE "%,'.$this->user_info['id'].',%" ) ) ','','',' id DESC ');
        $data['discussions_list'] = $discussions_list;


        $this->user_model->_table_name = "users";
        $receivers = $this->user_model->get(' ( group_id=1 OR id='.$project['user_id'].' OR id IN('.$allow_users_ids_coma.')  )  AND id !='.$this->user_info['id'].' ');
        $data['receivers'] = $receivers;

        if($this->input->post('send-discussion'))
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('content', 'نص المناقشة', 'trim|required');
            if ($this->form_validation->run() == TRUE)
            {
                $to_ids_array = $this->input->post('user_id', true);
                $to_ids_array_coma = implode(',', $to_ids_array);

                $array_posts = array(
                    'title' => $this->input->post('title', true),
                    'content' => $this->input->post('content', true),
                    'from_id' => $this->user_info['id'],
                    'to_id' => $to_ids_array_coma,
                    'time' => time(),
                    'project_id' => $project_id,
                    'views' => 0,
                );
                // upload attachment file
                $attachment_file = upload_file('attachment', 'discussion-attach');
                if(is_array($attachment_file) && !empty($attachment_file))
                {
                    $array_posts['attachment'] = $attachment_file['file_name'];
                }

                $this->discussion_model->_table_name = "discussions";
                $discussion_id = $this->discussion_model->save($array_posts);
                if($discussion_id)
                {
                    // send email notification
                    $this->user_model->_table_name = "users";
                    for ($i=0; $i<count($to_ids_array); $i++)
                    {
                        $user_details = $this->user_model->get_single('id=' . $to_ids_array[$i]);
                        $user_permission = $this->user_model->get_permissions($user_details['group_id']);
                        if(in_array('notification_discussions', $user_permission))
                        {
                            $this->load->library('email');
                            $this->load->library('my_email');
                            $this->my_email->init();
                            $subject = 'يوجد رسالة نفاش جديدة';
                            $message = '';
                            $message .= '<h3>يوجد لديك رسالة نقاش جديدة </h3>';
                            $message .= '<br> <br>';
                            $this->my_email->send_email(NULL, $user_details['email'], $subject, $message);
                        }
                    }
                }

                $message_type = "success";
                $message_text = 'تم ارسال الرسالة بنجاح';
                set_message($message_type, $message_text);
                redirect(admin_dir().'/discussions/index/'.$project_id);
            }
        }

        $data['subview'] = $this->load->view(admin_dir().'/discussions/discussions', $data, TRUE);
        $this->load->view(admin_dir().'/layout_main', $data);

    }


}