<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emails extends MX_Controller
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
        redirect(base_url().'admin/emails/emails_sending','refresh');
    }

    public function emails_sending(){
		$pg_config['sql'] = $this->data->get_sql('mail_system','','id','DESC');
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/emails/emails", $data); 
	}
	

	public function inbox_email(){
		$id_admin=$this->session->userdata('id_admin');
		$pg_config['sql'] = $this->data->get_sql('tbl_discussions',array("to_id"=>$id_admin,'reciver_view!='=>'2','reply_id'=>'0'),'id','DESC');
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/emails/inbox_email", $data); 
	}
	
	public function export_messages(){
		$id_admin=$this->session->userdata('id_admin');
		$pg_config['sql'] = $this->data->get_sql('tbl_discussions',array("from_id"=>$id_admin,'sender_view!='=>'2','reply_id'=>'0'),'id','DESC');
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/emails/export_messages", $data); 
	}
	
	
	
    public function add(){
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
      $this->load->view("admin/emails/add"); 
    }
	
	public function composed_email(){
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
      $this->load->view("admin/emails/composed_email"); 
    }
	
	
	

public function composed_action(){
$creation_date= date("Y-m-d H:i");
$email=$this->input->post('email');
$subject=$this->input->post('subject');
$content=$this->input->post('content');
$id_admin=$this->session->userdata('id_admin');
$id_replay=$this->input->post('id_replay');
$replay=$this->input->post('replay');
$type=$this->input->post('type');
$to_id=get_table_filed("tbl_users",array("email"=>$email),"id");
if($to_id!=""){
$data['title'] =$subject;
$data['content'] =$content;
$data['from_id'] =$id_admin;
$data['to_id'] = $to_id;
$data['creation_date'] = $creation_date;
if($replay==1){
	$data['reply_id'] =$id_replay;	
}
$this->db->insert("tbl_discussions",$data);
if($replay==1){
	$id_tab=$id_replay;
}
else {
	$id_tab= $this->db->insert_id();

}

     $files = $_FILES;
	$count = count($_FILES['file']['name']);
	if($_FILES['file']['name'][0]!=""){
   for($i=0; $i<$count; $i++){
   $_FILES['file']['name']= $files['file']['name'][$i];
   $_FILES['file']['type']= $files['file']['type'][$i];
   $_FILES['file']['tmp_name']= $files['file']['tmp_name'][$i];
   $_FILES['file']['error']= $files['file']['error'][$i];
   $_FILES['file']['size']= $files['file']['size'][$i];
   $img_name=$this->gen_random_string(); 
   $imagename = $img_name;
   $config['upload_path'] = 'uploads/emails/';
   $config['allowed_types']        = 'gif|jpg|png|pdf|doc|xlsx';
   $config['max_size']             =200000;
   $config['max_width']            =200000;
   $config['max_height']           =200000;
   $config['file_name'] = $imagename; 
   $this->load->library('upload', $config);
   $this->upload->initialize($config);
   if (!$this->upload->do_upload('file')){
   $error= $this->upload->display_errors();
   $this->session->set_flashdata('msg', 'يوجد خطاء فى ارسال الرسالة');
$this->session->mark_as_flash('msg');
$this->session->mark_as_temp('msg', 400);

   redirect("/admin/emails/inbox_email",'refresh');
	}else {
   $url=$files['file']['name'][$i];
   $ext = explode(".",$url);
   $file_extension = end($ext);
   $data = array('file'=>$imagename.".".$file_extension,'email_id'=>$id_tab,'date'=>$creation_date);
   $this->db->insert('email_file',$data);
   
   }
   }
	}
   $this->session->set_flashdata('msg', 'تمت الإضافة بنجاح');
   $this->session->mark_as_flash('msg');
   $this->session->mark_as_temp('msg', 400);
   if($replay==1){
	if($type==1){redirect(base_url().'/admin/emails/view_export_email?id='.$id_tab,'refresh');}
	else if($type==2){redirect(base_url().'/admin/emails/view_email?id='.$id_tab,'refresh');}
	
   }
   else {
redirect(base_url().'/admin/emails/inbox_email','refresh');   
   }

}
else {
	$this->session->set_flashdata('msg', 'البريد الالكترونى غير صحيح');
	$this->session->mark_as_flash('msg');
//	$this->session->mark_as_temp('msg', 400);
	redirect(base_url().'/admin/emails/composed_email','refresh');	
}
}

    public function add_action(){
$creation_date= date("Y-m-d H:i");
		if($this->session->userdata('emails_sending')=="emails_sending"){
		$service_type=$this->input->post('service_type');
		$manager_id=$this->input->post('manager_id');
		$email=$this->input->post('email');
		$data['email'] = $email;
        $data['id_user'] = $manager_id;
		$data['creation_date'] =$creation_date;
		$data['service_type'] = $service_type;
		$data['view'] = '1';
     $this->db->insert("mail_system",$data);
		$this->session->set_flashdata('msg', 'تمت الإضافة بنجاح');
		$this->session->mark_as_flash('msg');
		//$this->session->mark_as_temp('msg', 400);
		redirect(base_url().'admin/emails','refresh');
		}
		else {
			redirect(base_url().'admin/','refresh');	
		}
    }
public function delete(){
		$id_project = $this->input->get('id');
        $check=$this->input->post('check');
        if($id_project!=""){
$ret_value=$this->data->delete_table_row('mail_system',array('id'=>$id_project)); 
        }
        if(isset($check) && $check!=""){  
			$id_project = $this->input->post('id_project');
        $check=$this->input->post('check');
		$length=count($check);
        for($i=0;$i<$length;$i++){
        $ret_value=$this->data->delete_table_row('mail_system',array('id'=>$check[$i]));    
        }
        }
		$this->session->set_flashdata('msg', 'تم الحذف بنجاح');
		$this->session->mark_as_flash('msg');
		//$this->session->mark_as_temp('msg', 400);
redirect(base_url().'admin/emails','refresh');
    }

	public function delete_emial(){
		$id_project = $this->input->get('id');
        $check=$this->input->post('check');
        if($id_project!=""){
			$data['reciver_view']='2';
   $this->db->update('tbl_discussions',$data,array('id'=>$id_project)); 
        }
        if(isset($check) && $check!=""){  
			$id_project = $this->input->post('id_project');
        $check=$this->input->post('check');
		$length=count($check);
        for($i=0;$i<$length;$i++){
			$data['reciver_view']='2';
		$this->db->update('tbl_discussions',$data,array('id'=>$check[$i])); 
        }
        }
		$this->session->set_flashdata('msg', 'تم الحذف بنجاح');
		$this->session->mark_as_flash('msg');
		//$this->session->mark_as_temp('msg', 400);
redirect(base_url().'admin/emails/inbox_email','refresh');
    }
	

	public function deleteexport_emial(){
		$id_project = $this->input->get('id');
        $check=$this->input->post('check');
        if($id_project!=""){
			$data['sender_view']='2';
   $this->db->update('tbl_discussions',$data,array('id'=>$id_project)); 
        }
        if(isset($check) && $check!=""){  
			$id_project = $this->input->post('id_project');
        $check=$this->input->post('check');
		$length=count($check);
        for($i=0;$i<$length;$i++){
			$data['sender_view']='2';
		$this->db->update('tbl_discussions',$data,array('id'=>$check[$i])); 
        }
        }
		$this->session->set_flashdata('msg', 'تم الحذف بنجاح');
		$this->session->mark_as_flash('msg');
		//$this->session->mark_as_temp('msg', 400);
redirect(base_url().'admin/emails/export_messages','refresh');
    }
	
	

	public function view_email(){
		$id_status = $this->input->get('id');
		$data['messages'] =$this->db->order_by('id','desc')->get_where('tbl_discussions',array('id'=>$id_status,'reply_id'=>'0'))->result();
		$data['messages_files'] = $this->db->order_by('id','desc')->get_where('email_file',array('email_id'=>$id_status))->result();
		$this->load->view("admin/emails/view_email",$data); 
	}
	public function view_export_email(){
		$id_status = $this->input->get('id');
		$data['messages'] =$this->db->order_by('id','desc')->get_where('tbl_discussions',array('id'=>$id_status,'reply_id'=>'0'))->result();
		$data['messages_files'] = $this->db->order_by('id','desc')->get_where('email_file',array('email_id'=>$id_status))->result();
		$this->load->view("admin/emails/view_export_email",$data); 
	}

    function active(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("mail_system",array("id"=>$id,"view" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("mail_system",array("view" => "0"),array("id"=>$id));
         echo   json_encode("0");
        }
        if ($ser == 0) {
            $this->db->update("mail_system",array("view" => "1"),array("id"=>$id));
            echo json_encode("1");
        } 
    }

    public function edit(){
        $id=$this->input->get('id');
        $data['data'] = $this->data->get_table_data('mail_system',array('id'=>$id));
		$this->load->view("admin/emails/edit",$data); 
	
    }

    function edit_action(){
		$service_type=$this->input->post('service_type');
		$manager_id=$this->input->post('manager_id');
		$email=$this->input->post('name_task');
		$id=$this->input->post('id');
		$data['email'] = $email;
		if($service_type!=""){
		$data['service_type'] = $service_type;
		}
		if($manager_id!=""){
			$data['id_user'] = $manager_id;
		}
		 $this->db->update('mail_system',$data,array('id'=>$id));
		$this->session->set_flashdata('msg', 'تمت الإضافة بنجاح');
		$this->session->mark_as_flash('msg');
		//$this->session->mark_as_temp('msg', 400);
		redirect(base_url().'admin/emails','refresh');
		}
	
		public function sse(){
		$this->load->view("admin/emails/sse"); 
		}

	public function details(){
		$id_status = $this->input->get('id_status');
		$id_project = $this->input->get('id_project');
		$data['data'] = $this->data->get_table_data('tbl_tasks',array('id'=>$id_status));
		$data['notes'] = $this->db->order_by('id','desc')->get_where('projects_notes',array('id_task'=>$id_status,'id_replay'=>0))->result();
       $this->load->view("admin/task/details",$data); 
	}

	public function project_users(){
	//$id_status = $this->input->get('id_status');
		$id_project = $this->input->get('id_project');
		$data['result'] = $this->db->group_by("user_id")->get_where('tbl_tasks',array('project_id'=>$id_project,'user_id!='=>""))->result();
		$data['data'] = $this->data->get_table_data('tbl_projects',array('id'=>$id_project));
       $this->load->view("admin/task/project_users",$data); 
	}

	
}
