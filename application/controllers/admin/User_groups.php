<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_groups extends Admin_Controller {

    public function __construct()
    {
         parent::__construct();

        $this->load->model('user_model');
        $this->load->model('user_group_model');

        if(!in_array('user_groups_edit', $this->user_info['permissions']))
        {
            $data['subview'] = message_error("عفوا لا تمتلك صلاحيات لهذا الاجراء");
            $this->load->view(admin_dir().'/layout_main', $data);
            return;
        }
    }

    public function index()
    {
        $data = array();

        $this->user_group_model->_table_name = "user_groups";
        $data['user_groups'] = $this->user_group_model->get();

        $data['subview'] = $this->load->view(admin_dir().'/user_groups/view_user_groups', $data, TRUE);
        $this->load->view(admin_dir().'/layout_main', $data);
    }

    public function add()
    {
        $data=array();

        if($this->input->post('add-user-group'))
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'الاسم', 'trim|required');

            if ($this->form_validation->run() == TRUE)
            {
                $inputs_array = array(
                    'name'
                );
                $array_posts = $this->user_model->array_from_post($inputs_array);
                $array_posts['permissions'] = @implode(',', $this->input->post('permissions'));

                $this->user_group_model->_table_name = "user_groups";
                $group_id = $this->user_group_model->save($array_posts);

                $message_type = "success";
                $message_text = 'تم اضافة مجموعة الاعضاء بنجاح';
                set_message($message_type, $message_text);
                redirect(admin_dir().'/user_groups/edit/'.$group_id);
            }
        }

        $data['subview'] = $this->load->view(admin_dir().'/user_groups/add_user_group', $data, TRUE);
        $this->load->view(admin_dir().'/layout_main', $data);
    }

    public function edit($id)
    {
        $id   = intval(abs($id));
        $data = array();

        $this->user_group_model->_table_name = "user_groups";
        $group = $this->user_group_model->get_single('id='.$id);
        $data['group'] = $group;


        if($this->input->post('edit-user-group'))
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'الاسم', 'trim|required');

            if ($this->form_validation->run() == TRUE)
            {
                $inputs_array = array(
                    'name'
                );
                $array_posts = $this->user_group_model->array_from_post($inputs_array);
                $array_posts['permissions'] = @implode(',', $this->input->post('permissions'));

                $group_id = $this->user_group_model->save($array_posts, $id);

                $message_type = "success";
                $message_text = 'تم تعديل مجموعة الاعضاء بنجاح';
                set_message($message_type, $message_text);
                redirect(admin_dir().'/user_groups/edit/'.$group_id);
            }
        }

        $data['subview'] = $this->load->view(admin_dir().'/user_groups/edit_user_group', $data, TRUE);
        $this->load->view(admin_dir().'/layout_main', $data);
    }

    public function delete($id)
    {
        $id = intval(abs($id));

        $this->user_group_model->_table_name = "user_groups";
        $group = $this->user_group_model->get_single('id='.$id);

        $this->user_group_model->delete($id);

        $message_type = "success";
        $message_text = "تم الحذف بنجاح";
        set_message($message_type, $message_text);
        redirect(admin_dir().'/user_groups');
    }

}
