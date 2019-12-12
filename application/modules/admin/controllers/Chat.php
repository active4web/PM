<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Chat extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('ci_pusher');
		$this->load->model('chat_model');
		$this->load->library('CKEditor');
        $this->load->library('CKFinder');
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../css/ckfinder/'); 
    }
	public function index(){
	    
		$data['active_members'] = $this->chat_model->get_all_online('idle');
		$data['myprofile'] = $this->chat_model->get_by_id($this->session->userdata('id_admin'));
		$this->load->view('chat',$data);
	}
	public function special_chat()
	{
		$id_my=$this->session->userdata('id_admin');
		$userid=$this->input->get('user');
		$data['active_members'] = $this->chat_model->get_all_online_user('idle',$userid);
		$data['myprofile'] = $this->chat_model->get_by_id($this->session->userdata('id_admin'));
		$this->load->view('special_chat',$data);
	}
	
	public function add_mess(){
		//$pusher = $this->ci_pusher->get_pusher();
		$ses_id=$this->input->post("ses_id");
		$message=$this->input->post("message");
		$id_project=$this->input->post("id_project");
		$data['content'] = $message;
		$data['key_config'] =$ses_id;
		$data['key_view'] = '0';
		$data['date'] = date('Y-m-d H:i');
		$data['id_from'] = $ses_id;
		$data['type'] = '1';
		$data['id_project'] =$id_project;
		$this->db->insert("chat",$data);
	}

	public function add_mess_user(){
		//$pusher = $this->ci_pusher->get_pusher();
		$ses_id=$this->input->post("ses_id");
		$id_project=$this->input->post("id_project");
		$userd=$this->input->post("userd");
		$id_my=$this->session->userdata('id_admin');
		$message=$this->input->post("message");
		$data['content'] = $message;
		$data['key_config'] =$ses_id;
		$data['key_view'] = '0';
		$data['date'] = date('Y-m-d H:i');
		$data['type'] = '0';
		$data['id_project'] =$id_project;
		
		if($ses_id==$userd){
			$data['id_from'] = $userd;
			$data['id_to'] = $id_my;
		}
			else {
				$data['id_from'] =$id_my;
			$data['id_to'] =  $userd;
			}

		$this->db->insert("chat",$data);
	}

	
	public function chatsend(){
		$pusher = $this->ci_pusher->get_pusher();
		$data['message'] = $_POST['message'];
		$data['date'] = date('H:i A');
		$data['id'] = $this->session->userdata('id_admin');
		$data['username'] = $this->session->userdata('fullname_user');
		
		$event = $pusher->trigger('chatglobal', 'my_event', $data);
	}


	public function update_user(){
		$username = $_POST['username'];
		$email    = $_POST['email'];
		$password = $_POST['password'];
		if($password == ""){
			$data = array(
				'username' => $username,
				'email'    => $email,
			);
		}else{
			$data = array(
				'username' => $username,
				'email'    => $email,
				'password' => $password,
			);
		}
		$this->chat_model->update($this->session->userdata('id'),$data);
	}
}
