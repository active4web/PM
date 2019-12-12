<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->lang->load('system_lang', get_lang() );
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->model('data','','true');
        $this->load->library('upload');
        $this->load->helper(array('form', 'url','text'));
        $this->load->library('lib_pagination');
        $this->load->library('CKEditor');
        $this->load->library('CKFinder');
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../../design/ckfinder/');
		$this->load->library('image_lib');	
		$this->load->library('email');	
    }
    public function gen_random_string()
    {
        $chars ="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";//length:36
        $final_rand='';
        for($i=0;$i<4; $i++) {
            $final_rand .= $chars[ rand(0,strlen($chars)-1)];
        }
        return $final_rand;
    }

    public function index(){
        redirect(base_url().'admin/log/projects','refresh');
    }

    public function projects(){

		$user_id=$this->session->userdata('id_admin');
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
		
		if($this->session->userdata('log')=="log"||$this->session->userdata('log_projects')=="log_projects"){
			$pg_config['sql'] = $this->data->get_sql('tbl_projects_log','','id','DESC');
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
		$this->load->view("admin/log/projects", $data); 
		}
	}
	public function services(){
		$user_id=$this->session->userdata('id_admin');
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
		if($this->session->userdata('log')=="log"||$this->session->userdata('log_services')=="log_services"){
			$pg_config['sql'] = $this->data->get_sql('services_type_logo','','id','DESC');
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
		$this->load->view("admin/log/services", $data); 
		}
	}
	
	

    public function tasks(){
		$user_id=$this->session->userdata('id_admin');
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
		if($this->session->userdata('log')=="log"||$this->session->userdata('log_task')=="log_task"){
			$pg_config['sql'] = $this->data->get_sql('tbl_tasks_log','','id','DESC');
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
		$this->load->view("admin/log/tasks", $data); 
		}
	}

	public function othertasks(){
		$user_id=$this->session->userdata('id_admin');
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
		if($this->session->userdata('log')=="log"||$this->session->userdata('log_othertasks')=="log_othertasks"){
			$pg_config['sql'] = $this->data->get_sql('tbl_othertasks_log','','id','DESC');
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
		$this->load->view("admin/log/othertasks", $data); 
		}
	}
    
    
	
}
