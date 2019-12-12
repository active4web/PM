<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class my_account extends Admin_Controller {

    public function __construct()
    {
         parent::__construct();

        $this->load->model('user_model');
    }

    public function index()
    {
        $id   = intval(abs($this->user_info['id']));
        $data = array();


        $this->user_model->_table_name = "users";
        $user = $this->user_model->get_single('id='.$id);
        $data['user'] = $user;

        if($this->input->post('edit-account'))
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'الاسم', 'trim|required');
            $this->form_validation->set_rules('email', 'البريد الالكتروني', 'trim|required|callback_validation_check_email['.$id.']');
            $this->form_validation->set_rules('password', 'كلمة المرور', 'trim|min_length[6]');
            $this->form_validation->set_rules('password_confirm', "تأكيد كلمة المرور", 'trim|min_length[6]|matches[password]');

            if ($this->form_validation->run() == TRUE)
            {
                $inputs_array = array(
                    'name',
                    'email'
                );

                $array_posts = $this->user_model->array_from_post($inputs_array);

                // upload avatar file
                if($_FILES['avatar']['name'] !='')
                {
                    $ext                     = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                    $config['upload_path']   = './assets/uploads/';
                    $config['allowed_types'] = config_item('allowed_files');
                    $config['max_size']      = (config_item('max_file_size')*1024);
                    $config['max_width']     = '0';
                    $config['max_height']    = '0';
                    $config['file_name']     = 'avatar-'.time().rand(000,999).'.'.$ext;

                    $this->load->library('upload', $config);
                    if($this->upload->do_upload('avatar'))
                    {
                        $filedata = $this->upload->data();
                        $array_posts['avatar'] = $filedata['file_name'];

                        @unlink('./assets/uploads/'.$user['avatar']);
                    }
                }
                $array_posts['activation_code'] = $this->user_model->hash(mt_rand(10000,99999).time().$array_posts['email']);
                if($this->input->post('password') != '' && $this->input->post('password') == $this->input->post('password_confirm') )
                {
                    $array_posts['password'] = $this->user_model->password_encrypt($this->input->post('password'));
                }

                $this->user_model->_table_name = "users";
                $user_id = $this->user_model->save($array_posts, $id);


                $message_type = "success";
                $message_text = 'تم تعديل بياناتي';
                set_message($message_type, $message_text);
                redirect(admin_dir().'/my_account/index/');
            }
        }

        $data['subview'] = $this->load->view(admin_dir().'/users/my_account', $data, TRUE);
        $this->load->view(admin_dir().'/layout_main', $data);
    }

#*******************************************************************#
    public function validation_check_email($email, $id=0)
    {
        $issetEmail = $this->user_model->isset_email($email, $id);
        if($issetEmail == TRUE)
        {
            $this->form_validation->set_message('validation_check_email', 'البريد الالكتروني مسجل من قبل');
            return FALSE;
        }
        return TRUE;
    }

}


?>