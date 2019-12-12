<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->model('data','','true');
        $this->load->model('paging','','true');
        $this->load->library('upload');
        $this->load->helper(array('form', 'url','text'));
		$this->load->library('lib_pagination');
		          $this->lang->load('system_lang', get_lang() );

    }
	
	

    public function index(){
		redirect(base_url().'admin/services/services','refresh');
    }

    public function services(){
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
		if($this->session->userdata('company_serivces')=="company_serivces"){
		$where = "";
        $pg_config['sql'] = $this->data->get_sql('services_type',$where,'id','DESC');
        $pg_config['per_page'] = 30;
        $data = $this->lib_pagination->create_pagination($pg_config);
		$this->load->view("admin/services/services", $data); 
		}
		else {
			redirect(base_url().'admin/','refresh');
		}
    }
	
	public function add(){
	    	if($this->session->userdata('company_serivces')=="company_serivces"){
        $this->load->view("admin/services/add"); 
	    	}
	    	else {
	 redirect(base_url().'admin/','refresh');   	    
	    	}
    }

	public function details(){
		$id=$this->input->get('id');
		$data['services_type']=$this->db->get_where("services_type",array('id'=>$id))->result();
        $this->load->view("admin/services/details",$data); 
	}
	
    public function add_action(){
		if($this->session->userdata('company_serivces')=="company_serivces"){
        $title=$this->input->post('title');
         $type=$this->input->post('type');
		$data['name'] = $title;
		$data['type'] = $type;
		$data['user_id'] = $this->session->userdata('id_admin');
	     $this->db->insert('services_type',$data);
		$this->session->set_flashdata('msg', 'تم الاضافة بنجاح');

    echo 1;
	}
else {
//	redirect(base_url().'admin/','refresh');
echo 0;
}

}
public function edit_action(){
	$update_date=date("Y-m-d h:i:s");
	if($this->session->userdata('company_serivces')=="company_serivces"){
	$title=$this->input->post('title');
	$type=$this->input->post('type');
	$id=$this->input->post('id');
	$data_service['name'] = $title;
	if($type!=""){
	$data_service['type'] = $type;
	}
	$data_service['update_date'] = $update_date;

	$data['user_id'] = $this->session->userdata('id_admin');
	$data['id_service'] =$id;
	 $this->db->update('services_type',$data_service,array('id'=>$id));
	 $this->db->insert('services_type_logo',$data);
echo 1;
}
else {
echo 0;	
}
}

	

	
	public function delete(){
		if($this->session->userdata('company_serivces')=="company_serivces"){
        $id_notifications = $this->input->get('id_notifications');
        $check=$this->input->post('check');

        if($id_notifications!=""){
        $ret_value=$this->data->delete_table_row('services_type',array('id'=>$id_notifications)); 
        }
     
        if(isset($check) && $check!=""){  
        $check=$this->input->post('check');
        $length=count($check);
        for($i=0;$i<$length;$i++){
        $ret_value=$this->data->delete_table_row('services_type',array('id'=>$check[$i]));    
        }
        }
		$this->session->set_flashdata('msg', 'تم الحذف بنجاح');
		$this->session->mark_as_flash('msg');
	 //$this->session->mark_as_temp('msg', 800);
		redirect(base_url().'admin/services','refresh');
	}
	else {
		redirect(base_url().'admin/','refresh');	
	}

    }
	
	


	function check_view_service(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("services_type",array("id"=>$id,"view" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("services_type",array("view" => "0"),array("id"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("services_type",array("view" => "1"),array("id"=>$id));
            echo "1";
        } 
    }
}
