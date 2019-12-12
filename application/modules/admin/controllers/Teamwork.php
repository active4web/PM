<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teamwork extends MX_Controller
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
		redirect(base_url().'admin/teamwork/teamwork','refresh');
    }

    public function teamwork(){
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
		if($this->session->userdata('teamwork')=="teamwork"){
        $pg_config['sql'] = $this->data->get_sql('tbl_users',array('status'=>'1'),'id','DESC');
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
		$this->load->view("admin/teamwork/teamwork", $data); 
		}
		else {
			redirect(base_url().'admin/','refresh');
		}
    }

    public function permissions(){
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
		if($this->session->userdata('permissions')=="permissions"){
        $pg_config['sql'] = $this->data->get_sql('tbl_user_groups','','id','DESC');
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
		$this->load->view("admin/teamwork/permissions", $data); 
		}
		else {
			redirect(base_url().'admin/','refresh');
		}
    }
	
	

    public function add_permission(){
        
        	if($this->session->userdata('users_add')=="users_add"){
        $this->load->view("admin/teamwork/add_permission"); 
        	}
        	else {
        	    redirect(base_url().'admin/','refresh');
        	}
	}
	
	
	public function permission_action(){
		
		$name=$this->input->post('name');
		$name_en=$this->input->post('name_en');
		$permissions=$this->input->post('permissions');
		$permissions_email=$this->input->post('permissions_email');
		$permissions = implode(",",$permissions);
		if($permissions_email!=""){
		$permissions_email = implode(",",$permissions_email);
		}
		$creation_date= date("Y-m-d H:i:s");
		
		$data['name'] = $name;
		$data['name_eng'] = $name_en;
        $data['permissions'] = $permissions;
        $data['create_date'] =$creation_date;
        $data['update_date'] = $creation_date;
		$data['key'] = $this->gen_random_string();
		$data['permissions_mail'] = $permissions_email;
		  $this->db->insert('tbl_user_groups',$data);
        $id = $this->db->insert_id();
if($id!=""){
echo 1;
}
else {
echo 0;
}
	}


	public function edit_permission(){
		if($this->session->userdata('permissions')=="permissions"){
			$id=$this->input->get('id');
			$data['data'] = $this->data->get_table_data('tbl_user_groups',array('id'=>$id));
			$this->load->view("admin/teamwork/edit_permission",$data); 
			}
			else {
				redirect(base_url().'admin/','refresh');	
			}
	}
	public function edit_permission_action(){
		$id=$this->input->post('id');
		$name=$this->input->post('name');
			$name_en=$this->input->post('name_en');
		$permissions=$this->input->post('permissions');
		$permissions_email=$this->input->post('permissions_email');
		$permissions = implode(",",$permissions);
			if($permissions_email!=""){
		$permissions_email = implode(",",$permissions_email);
			}
		$creation_date= date("Y-m-d H:i:s");
		$data['name_eng'] = $name_en;
		$data['name'] = $name;
        $data['permissions'] = $permissions;
        $data['update_date'] = $creation_date;
		$data['permissions_mail'] = $permissions_email;
		  $this->db->update('tbl_user_groups',$data,array('id'=>$id));

if($id!=""){
echo 1;
}
else {
echo 0;
}
	}


	public function delete_permission(){
        $id_blog = $this->input->get('id_type');
        $check=$this->input->post('check');

        if($id_blog!=""){
			$data = array('status'=>'0');
        $ret_value=$this->data->delete_table_row('tbl_user_groups',array('id'=>$id_blog)); 
        }
     
        if(isset($check) && $check!=""){  
        $check=$this->input->post('check');
        $length=count($check);
        for($i=0;$i<$length;$i++){
			$data = array('status'=>'0');
        $ret_value=$this->data->delete_table_row('tbl_user_groups',array('id'=>$check[$i]));    
        }
        }

        $this->session->set_flashdata('msg', lang("done_success"));
        redirect(base_url().'admin/teamwork/permissions','refresh');
    }

    function check_view_permission(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("tbl_user_groups",array("id"=>$id,"view" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("tbl_user_groups",array("view" => "0"),array("id"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("tbl_user_groups",array("view" => "1"),array("id"=>$id));
            echo "1";
        } 
    }




    public function add_teamwork(){
                	if($this->session->userdata('users_add')=="users_add"){
        
        $this->load->view("admin/teamwork/add_teamwork"); 
                	}
        	else {
        	    redirect(base_url().'admin/','refresh');
        	}
        	
    }

    public function product_action(){
		
		
		$fname=$this->input->post('fname');
		$sname=$this->input->post('sname');
        $lname=$this->input->post('lname');
        $email=$this->input->post('email');
		$send_email=$this->input->post('send_email');
		$group_id=$this->input->post('group_id');
		$dep_id=$this->input->post('dep_id');
		$password=$this->input->post('password');

		$user_key=get_table_filed("tbl_user_groups",array("id"=>$group_id),"key");
		$created_time=date("Y-m-d H:i:s");
        $data['fname'] = $fname;
        $data['sname'] = $sname;
        $data['lname'] = $lname;
        $data['email'] = $email;
		$data['password'] = md5($password);
		$data['txt_key'] = $password;
        $data['group_id'] = $group_id;
		$data['created_time'] = $created_time;
		$data['update_date'] = $created_time;
		$data['dep_id'] = $dep_id;
	$data['user_key'] = $user_key;
		$this->db->insert('tbl_users',$data);
		
		$id = $this->db->insert_id();
		$permission_array_user=get_table_filed("tbl_user_groups",array("id"=>35),"permissions_mail");
		$permission_array_user=explode(",",$permission_array_user);
		if(count($permission_array_user)>1){
		for($i=0; $i<count($permission_array_user); $i++){
		$this->session->set_userdata(array($permission_array_user[$i].$id => $permission_array_user[$i]));
		$data_send['email'] = $send_email;
		$data_send['id_user'] = $id;
		$data_send['service_type'] = $this->session->userdata($permission_array_user[$i].$id);
		$this->db->insert('mail_system',$data_send);
		}
		}
		
if($_FILES['file']['name']){
            $img_name=$this->gen_random_string(); 
            $imagename = $img_name;
            $config['upload_path'] = 'uploads/teamwork/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             =100000;
            $config['max_width']            =100000;
            $config['max_height']           =100000;
            $config['file_name'] = $imagename; 
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('file')){
                //echo $this->upload->display_errors();
               
            }
            else {
            $url= $_FILES['file']['name'];
            $ext = explode(".",$url);
            $file_extension = end($ext);
            $data = array('avatar'=>$imagename.".".$file_extension);
            $this->data->edit_table_id('tbl_users',array('id'=>$id),$data);
            }
		}
		if($id!=""){
		 send_email($id,"user","add");
		  echo 1;
		}
		else {
		     echo 0;
		}

    }

    public function delete_teamwork(){
        $id_blog = $this->input->get('id_type');
        $check=$this->input->post('check');

        if($id_blog!=""){
			$data = array('status'=>'0');
            $this->data->edit_table_id('tbl_users',array('id'=>$id_blog),$data);
        $ret_value=$this->data->delete_table_row('mail_system',array('id_user'=>$id_blog)); 
        }
     
        if(isset($check) && $check!=""){  
        $check=$this->input->post('check');
        $length=count($check);
        for($i=0;$i<$length;$i++){
			$data = array('status'=>'0');
			$this->data->edit_table_id('tbl_users',array('id'=>$check[$i]),$data);	
        $ret_value=$this->data->delete_table_row('mail_system',array('id_user'=>$check[$i]));    
        }
        }

        $this->session->set_flashdata('msg',lang("done_success"));
        redirect(base_url().'admin/teamwork/teamwork','refresh');
    }

    function check_view_teamwork(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("tbl_users",array("id"=>$id,"view" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("tbl_users",array("view" => "0"),array("id"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("tbl_users",array("view" => "1"),array("id"=>$id));
            echo "1";
        } 
    }

    public function update_teamwork(){
        $id=$this->input->get('id_type');
		$data['data'] = $this->data->get_table_data('tbl_users',array('id'=>$id));
		$data['send_email'] = $this->data->get_table_data('mail_system',array('id_user'=>$id));
        $this->load->view("admin/teamwork/update_teamwork",$data); 
    }
    public function password_teamwork(){
        $id=$this->input->get('id_type');
		$data['data'] = $this->data->get_table_data('tbl_users',array('id'=>$id));
        $this->load->view("admin/teamwork/password_teamwork",$data); 
    }


      public function check_password(){
      $password=$this->input->post('newpassword');
$repassword=$this->input->post('confirmpassword');
if($password!=$repassword){$exit="1";}
else if($password==""&&$repassword==""){$exit="1";}
else {$exit="0";}
echo json_encode($exit);

      }
      public function old_password(){
        $id_admin=$this->input->post('iduser');
        $password=$this->input->post('oldpassword');
$count_pass=$this->db->get_where('tbl_users',array('id'=>$id_admin,'password'=>md5($password)))->result();
 if(count($count_pass)>0){$exit="1";}
 else if(count($count_pass)==0){$exit="2";}
  if($password==""){$exit="3";}
  echo json_encode($exit);
        }


public function editpassword(){
          $id_admin=$this->input->post('iduser');
          $newpassword=$this->input->post('newpassword');
          $data['password'] = md5($newpassword);
          $re=$this->db->update('tbl_users',$data,array('id'=>$id_admin));
echo 1;
 }
          

    function edit_action(){
		$id = $this->input->post('id');
		$fname=$this->input->post('fname');
		$sname=$this->input->post('sname');
        $lname=$this->input->post('lname');
        $email=$this->input->post('email');
		$send_email=$this->input->post('send_email');
		$group_id=$this->input->post('group_id');
		$dep_id=$this->input->post('dep_id');
		$password=$this->input->post('password');
		$created_time=date("Y-m-d H:i:s");
		
        $data['fname'] = $fname;
        $data['sname'] = $sname;
        $data['lname'] = $lname;
        $data['email'] = $email;        
		$data['update_date'] = $created_time;
		$this->db->update('tbl_users',$data,array('id'=>$id));
		if($group_id!=""){
			$data_group['group_id'] = $group_id;
			$this->db->update('tbl_users',$data_group,array('id'=>$id));
		}
			if($dep_id!=""){
				$data_dep['dep_id'] = $dep_id;
				$this->db->update('tbl_users',$data_dep,array('id'=>$id));
			}

	$send_email_id=get_table_filed("mail_system",array('id_user'=>$id),"email");
		if($send_email_id!=""){
		$data_send['email'] = $send_email;
		$this->db->update('mail_system',$data_send,array('id_user'=>$id));
		}
		else {
		    	$data_send['email'] = $send_email;
		    	$data_send['id_user'] = $id;
		    	$data_send['service_type'] = "task";
		  		$this->db->insert('mail_system',$data_send);
  
		}

        if($_FILES['file']['name']!=""){
            $img_name=$this->gen_random_string(); 
            $imagename = $img_name;
            $config['upload_path'] = 'uploads/teamwork/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             =100000;
            $config['max_width']            =100000;
            $config['max_height']           =100000;
            $config['file_name'] = $imagename; 
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('file')){
                echo $this->upload->display_errors();
               
            }
            else {
            $url= $_FILES['file']['name'];
            $ext = explode(".",$url);
            $file_extension = end($ext);
            $data_img = array('avatar'=>$imagename.".".$file_extension);
            $this->db->update('tbl_users',$data_img,array('id'=>$id));
            }
		}

if($id!=""){	
send_email($id,"user","edit");
echo 1;
}
else {
echo 0;
}

	}
	
	
    public function checkmail(){
        $email=$this->input->post('email');
$send_email_id=get_table_filed("tbl_users",array('email'=>$email),"id");
	if($send_email_id!=""){	
		  echo 1;
		}
		else {
		     echo 0;
		}
    }	
	
/*********************************************************************** *////

}
