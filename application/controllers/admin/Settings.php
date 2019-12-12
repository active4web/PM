<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class settings extends Admin_Controller {

    public function __construct()
    {
         parent::__construct();

         $this->load->model('settings_model');
    }

	public function index()
    {
        $data=array();

        if(!in_array('settings', $this->user_info['permissions']))
        {
            $data['subview'] = message_error("عفوا لا تمتلك صلاحيات لهذا الاجراء");
            $this->load->view(admin_dir().'/layout_main', $data);
            return;
        }


        if($this->input->post('save-general'))
        {
            $inputs_array = array(
                    'site_title',
                    'site_name',
                    'site_email',
                    'site_description',
                    'site_keywords',
                    'site_status',
                    'site_close_msg',
            );

            $array_posts = $this->settings_model->array_from_post($inputs_array);
            foreach ($array_posts as $key => $value)
            {
                $check_exists = $this->db->where('config_key', $key)->get('config');
                if ($check_exists->num_rows() == 0)
                {
                    $this->db->insert('config', array("config_key" => $key, "config_value" => $value));
                }
                else
                {
                    $data_array = array('config_value' => $value);
                    $this->db->where('config_key', $key)->update('config', $data_array);
                }
            }

            $message_type = "success";
            $message_text = "تم التعديل بنجاح";
            set_message($message_type, $message_text);
            redirect(admin_dir().'/settings/index');
        }

        $data['subview'] = $this->load->view(admin_dir().'/settings/general_settings', $data, TRUE);
        $this->load->view(admin_dir().'/layout_main', $data);
    }

    public function system()
    {
       $data=array();

        if(!in_array('settings', $this->user_info['permissions']))
        {
            $data['subview'] = message_error("عفوا لا تمتلك صلاحيات لهذا الاجراء");
            $this->load->view(admin_dir().'/layout_main', $data);
            return;
        }

       $data['timezones'] = $this->settings_model->timezones();

       if($this->input->post('save-system'))
       {
           $inputs_array = array(
                    'timezone',
                    'allowed_files',
                    'max_file_size'
            );

            $array_posts = $this->settings_model->array_from_post($inputs_array);
            foreach ($array_posts as $key => $value)
            {
                $check_exists = $this->db->where('config_key', $key)->get('config');
                if ($check_exists->num_rows() == 0)
                {
                    $this->db->insert('config', array("config_key" => $key, "config_value" => $value));
                }
                else
                {
                    $data_array = array('config_value' => $value);
                    $this->db->where('config_key', $key)->update('config', $data_array);
                }

            }

            $message_type = "success";
            $message_text = "تم التعديل بنجاح";
            set_message($message_type, $message_text);
            redirect(admin_dir().'/settings/system');
       }

       $data['subview'] = $this->load->view(admin_dir().'/settings/system_settings', $data, TRUE);
       $this->load->view(admin_dir().'/layout_main', $data);
    }

    public function email_settings()
    {
       $data=array();

        if(!in_array('settings', $this->user_info['permissions']))
        {
            $data['subview'] = message_error("عفوا لا تمتلك صلاحيات لهذا الاجراء");
            $this->load->view(admin_dir().'/layout_main', $data);
            return;
        }

       if($this->input->post('save-email-settings'))
       {
           $inputs_array = array(
                    'sender_email',
                    'email_protocol',
                    'smtp_host',
                    'smtp_port',
                    'email_encryption',
                    'smtp_user',
                    'smtp_password',
            );

            $array_posts = $this->settings_model->array_from_post($inputs_array);
            foreach ($array_posts as $key => $value)
            {
                $check_exists = $this->db->where('config_key', $key)->get('config');
                if ($check_exists->num_rows() == 0)
                {
                    $this->db->insert('config', array("config_key" => $key, "config_value" => $value));
                }
                else
                {
                    $data_array = array('config_value' => $value);
                    $this->db->where('config_key', $key)->update('config', $data_array);
                }
            }

            $message_type = "success";
            $message_text = "تم التعديل بنجاح";
            set_message($message_type, $message_text);
            redirect(admin_dir().'/settings/email_settings');
       }

       $data['subview'] = $this->load->view(admin_dir().'/settings/email_settings', $data, TRUE);
       $this->load->view(admin_dir().'/layout_main', $data);
    }

}
?>