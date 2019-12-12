<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends MX_Controller
{
	
    public function __construct()
    {
        parent::__construct();
        	$this->lang->load('system_lang', get_lang() );
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->model('data','','true');
        $this->load->model('paging','','true');
        $this->load->library('upload');
        $this->load->helper(array('form', 'url','text'));
        $this->load->library('lib_pagination'); 
    }
	
	
    public function index(){
		redirect(base_url().'admin/notification/mynotifications','refresh');
    }

    public function mynotifications(){

		$user_id=$this->session->userdata('id_admin');
        $pg_config['sql'] = $this->data->get_sql('notification',array('id_user'=>$user_id,'view'=>'0'),'id','DESC');
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/notifications/mynotifications", $data); 
    }
	
	
	public function delete(){
        $id_notifications = $this->input->get('id_notifications');
        $check=$this->input->post('check');
        if($id_notifications!=""){
        $ret_value=$this->data->delete_table_row('notification',array('id'=>$id_notifications)); 
        }
        
                if(isset($check) && $check!=""){  
        $check=$this->input->post('check');
        $length=count($check);
        for($i=0;$i<$length;$i++){

        $ret_value=$this->data->delete_table_row('notification',array('id'=>$check[$i]));    
        }
        }
        
        $this->session->set_flashdata('msg', 'تم الحذف بنجاح');
        redirect(base_url().'admin/notification','refresh');
    }

}
