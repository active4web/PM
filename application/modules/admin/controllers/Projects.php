<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends MX_Controller
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
        redirect(base_url().'admin/projects/allprojects','refresh');
    }

    public function allprojects(){
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
        $pg_config['sql'] = $this->data->get_sql('tbl_projects','','id','DESC');
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/projects/allprojects", $data); 
	}
	
	public function current_projects(){
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
if($this->session->userdata('mytask_view')=="mytask_view"&&$this->session->userdata('current_project')=="current_project"){		
 	redirect(base_url().'admin/projects/current_myprojects','refresh');
}
else {
 $pg_config['sql'] = $this->data->get_sql('tbl_projects',array('status'=>'1'),'id','DESC');    
}
        $pg_config['per_page'] =20;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/projects/current_projects", $data); 
	}

	public function current_myprojects(){
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
		$id_user=$this->session->userdata("id_admin");
		$pg_config['sql'] = $this->data->get_sql('users_projects',array('status'=>'1','id_user'=>$id_user),'id','DESC'); 
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/projects/current_myprojects", $data); 
	}


	public function wait(){
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
        $pg_config['sql'] = $this->data->get_sql('tbl_projects',array('status'=>'2'),'id','DESC');
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/projects/wait", $data); 
	}
	public function future(){
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
        $pg_config['sql'] = $this->data->get_sql('tbl_projects',array('status'=>'3'),'id','DESC');
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/projects/future", $data); 
	}
	
	
	public function test(){
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
        $pg_config['sql'] = $this->data->get_sql('tbl_projects',array('status'=>'3'),'id','DESC');
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/projects/test", $data); 
	}	
	
	
	
	
	public function finished(){
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
		
		if($this->session->userdata('mytask_view')=="mytask_view"&&$this->session->userdata('finished_project')=="finished_project"){		
 	redirect(base_url().'admin/projects/finished_myprojects','refresh');
}
else {
 $pg_config['sql'] = $this->data->get_sql('tbl_projects',array('status'=>'4'),'id','DESC');    
}
        $pg_config['sql'] = $this->data->get_sql('tbl_projects',array('status'=>'4'),'id','DESC');
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/projects/finished", $data); 
	}
	
	
	
		public function finished_myprojects(){
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
			$id_user=$this->session->userdata("id_admin");
		 $pg_config['sql'] = $this->data->get_sql('users_projects',array('status'=>'4','id_user'=>$id_user),'id','DESC'); 
       $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/projects/finished_myprojects", $data); 
	}

    public function add(){

if($this->session->userdata('projects_add')=="projects_add"){
$this->load->view("admin/projects/add"); 
}
else {
redirect(base_url().'admin/','refresh');   
}
    }
	


    public function add_action(){
$creation_date= date("Y-m-d H:i:s");
$code=$this->gen_random_string();
$id_user=$this->session->userdata('id_admin');
	
        $name_project=$this->input->post('name_project');
		$desc_ar=$this->input->post('desc_ar');
		$select_date=$this->input->post('select_date');
        $start_time=$this->input->post('start_time');
        $status_project=$this->input->post('status_project');
        $status_executed=$this->input->post('status_executed');
		$manager_id=$this->input->post('manager_id');
		$client_name=$this->input->post('client_name');
		$client_phone=$this->input->post('client_phone');
		$services_type=$this->input->post('services_type');
		$project_id=$this->input->post('project_id');
		$duration_project_hrs=$this->input->post('duration_project_hrs');
	    $duration_project_daies=$this->input->post('duration_project_daies');
	    $typeproject_time=$this->input->post('typeproject_time');
	    $enddate=$this->input->post('enddate');
	    
	  /*  $columns_mmk=""; 
	    if(count($typeproject_time)>0){
	    $columns_mmk=$typeproject_time[0];
for($i=1; $i<count($typeproject_time); $i++){
    if($typeproject_time[$i]!=""&&$typeproject_time[$i]!=","){
    $columns_mmk=$columns_mmk.",".$typeproject_time[$i];
    }
}
}*/
		$columns = implode(",",$services_type);
for($i=0;$i<count($typeproject_time);$i++){
if($typeproject_time[$i] === "" ||$typeproject_time[$i]=== false ||$typeproject_time[$i]=== null){
$typeproject_time[$i] =0;
}
}
	    $columns_mmk = implode(",",$typeproject_time);
		$data['code'] = $code;
        $data['name'] = $name_project;
        $data['user_id'] = $id_user;
		$data['status'] = $status_executed;
		$data['status_project'] = $status_project;
		$data['type_id'] =$columns;
		$data['details'] = $desc_ar;
		$data['id_magager'] =$manager_id;
		$data['clients_name'] = $client_name;
		$data['clients_phone'] =$client_phone;
		$data['select_date'] = $select_date;
		$data['start_date'] =$start_time;
		$data['creation_date'] =$creation_date;
		$data['update_date'] = $creation_date;
		$data['finish_date'] = $enddate;
		$data['total_hrs_project'] =$duration_project_hrs;
		$data['total_daies_project'] =$duration_project_daies;
		$data['deps_total_hrs'] =$columns_mmk;
		$this->db->insert('tbl_projects',$data);
		$id = $this->db->insert_id();
		if($manager_id!=""){
		$task_notify['project_id']=$id;;
		$task_notify['notify']="يوجد تعديل فى  المشروعات";
		$task_notify['create_date']=date("Y-m-d H:i");
		$task_notify['id_user']=$manager_id;
		$task_notify['view']='0';
		$task_notify['key_id']=7;
		$this->db->insert("notification",$task_notify);
		}


		if($_FILES['img']['name']!=""){
            $img_name=$this->gen_random_string(); 
            $imagename = $img_name;
			$config['image_library'] = 'gd2';
            $config['upload_path'] = 'uploads/projects/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             =100000;
            $config['max_width']            =100000;
            $config['max_height']           =100000;
            $config['file_name'] = $imagename; 
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('img')){
               /*echo $this->upload->display_errors();
                print_r($config);
                die;*/
            }
            else {
            $url= $_FILES['img']['name'];
            $ext = explode(".",$url);
            $file_extension = end($ext);
			$config['source_image'] = 'uploads/projects/'.$imagename.".".$file_extension ;
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['quality'] = '90%';
			$config['width']     = 400;
			$config['height']   = 400;
			$this->image_lib->clear();
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
            $data = array('logo'=>$imagename.".".$file_extension);
            $this->data->edit_table_id('tbl_projects',array('id'=>$id),$data);
            }
		}
	
if($id!=""){	
send_email($id,"projects","add");
echo 1;
}
else {
echo 0;
}

    }
	
	public function json($status,$msg=[]){
		$data['status'] = $status;
		$data['msg'] = $msg;
		echo json_encode($data);
	}
	
	public function del_img(){
		$id = $this->input->post('id');
		$img = get_this('products_images',['id' => $id],'img');
		if ($img != "") {
		  unlink("uploads/site_setting/products_gallery/$img");
		}
		$this->db->delete('products_images', array('id' => $id));
		return $this->json(true,'تم الحذف');
  	}

    public function delete(){
        $id_products = $this->input->get('id_projects');
        $check=$this->input->post('check');
        $project_id = $this->input->get('project_id');

        if($id_products!=""){
		$img = get_this('tbl_projects',['id' => $id_products],'logo');
		if ($img != ""&&file_exists("uploads/projects/$img")) {
		unlink("uploads/projects/$img");
		}
		send_email($id_products,"projects","delete");
        $ret_value=$this->data->delete_table_row('tbl_projects',array('id'=>$id_products)); 
        $task_value=$this->data->delete_table_row('tbl_tasks',array('project_id'=>$id_products));
        $task_value=$this->data->delete_table_row('users_projects',array('id_projects'=>$id_products));
        
        }
     
        if(isset($check) && $check!=""){  
            $project_id = $this->input->post('project_id');
        $check=$this->input->post('check');
        $length=count($check);
        for($i=0;$i<$length;$i++){
			$img = get_this('tbl_projects',['id' =>$check[$i]],'logo');
			if ($img != ""&&file_exists("uploads/projects/$img")) {
			unlink("uploads/projects/$img");
			}
			send_email($check[$i],"projects","delete");
        $ret_value=$this->data->delete_table_row('tbl_projects',array('id'=>$check[$i]));
         $task_value=$this->data->delete_table_row('tbl_tasks',array('project_id'=>$check[$i])); 
          $task_value=$this->data->delete_table_row('users_projects',array('id_projects'=>$id_products));
        }
        }

		$this->session->set_flashdata('msg', 'تم الحذف بنجاح');
		$this->session->mark_as_flash('msg');
	
   	if($project_id==4){
		redirect(base_url().'admin/projects/future','refresh');
		}
	elseif($project_id==3){
		redirect(base_url().'admin/projects/finished','refresh');
		}	
elseif($project_id==2){
		redirect(base_url().'admin/projects/current_projects','refresh');
		}	
elseif($project_id==1){
		redirect(base_url().'admin/projects/wait','refresh');
		}	
    }

    function active(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("products",array("id"=>$id,"active" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("products",array("active" => "0"),array("id"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("products",array("active" => "1"),array("id"=>$id));
            echo "1";
        } 
    }

    public function edit(){
		if($this->session->userdata('projects_edit')=="projects_edit"){
        $id=$this->input->get('id');
        $data['data'] = $this->data->get_table_data('tbl_projects',array('id'=>$id));
		$this->load->view("admin/projects/edit",$data); 
		}
		else {
			redirect(base_url().'admin/','refresh');	
		}
    }

    function edit_action(){
        $id=$this->input->post('id');
		$update_date= date("Y-m-d H:i:s");
$id_user=$this->session->userdata('id_admin');

        $name_project=$this->input->post('name_project');
		$desc_ar=$this->input->post('desc_ar');
		$select_date=$this->input->post('select_date');
        $start_time=$this->input->post('start_time');
        $status_project=$this->input->post('status_project');
     $status_executed=$this->input->post('status_executed');
		$manager_id=$this->input->post('manager_id');
		$client_name=$this->input->post('client_name');
		$client_phone=$this->input->post('client_phone');
			$project_id=$this->input->post('project_id');
		$services_type=$this->input->post('services_type');
		$duration_project_hrs=$this->input->post('duration_project_hrs');
	    $duration_project_daies=$this->input->post('duration_project_daies');	
	  $typeproject_time=$this->input->post('typeproject_time');
	    $enddate=$this->input->post('enddate');
	      // $columns_mmk = implode(",",$typeproject_time);
	       for($i=0;$i<count($typeproject_time);$i++){
	 if($typeproject_time[$i] === "" ||$typeproject_time[$i]=== false ||$typeproject_time[$i]=== null){
	     $typeproject_time[$i] =0;
	 }
	       }
	       
$columns_mmk = implode(",",$typeproject_time);
		 $columns = implode(",",$services_type);
$user_project['status']=$status_executed;
$this->db->update("users_projects",$user_project,array('id_projects'=>$id));


		 $sql_old_task=get_table_data('tbl_projects',array('id'=>$id));
		 foreach($sql_old_task as $sql_old_task){
				 $creation_date= date("Y-m-d H:i:s");
			 $task_log['project_id']=$sql_old_task->id;
			 $task_log['name']=$sql_old_task->name;
			 $task_log['user_id']=$sql_old_task->user_id;
			 $task_log['id_magager']=$sql_old_task->id_magager;
			 $task_log['total_hrs']=$sql_old_task->total_hrs;
			 $task_log['finish_date']=$sql_old_task->finish_date;
			 $task_log['start_date']=$sql_old_task->start_date;
			 $task_log['status']=$sql_old_task->status;
			 $task_log['update_date']=date("Y-m-d H:i:s");
			 $this->db->insert("tbl_projects_log",$task_log);
			 /////////////////////////////////
			 if($sql_old_task->id_magager!=""){
				 $task_notify['project_id']=$sql_old_task->id;;
			 $task_notify['notify']="يوجد تعديل فى  المشروعات";
			 $task_notify['create_date']=date("Y-m-d H:i");
			 $task_notify['id_user']=$sql_old_task->id_magager;
			 $task_notify['view']='0';
			 $task_notify['key_id']=8;
			
			 }

		 }
 


        $data['name'] = $name_project;
        $data['user_id'] = $id_user;
		$data['type_id'] =$columns;
		$data['update_date'] = $update_date;
		$data['details'] = $desc_ar;
		$data['clients_name'] = $client_name;
		$data['clients_phone'] =$client_phone;
		$data['select_date'] = $select_date;
		$data['start_date'] =$start_time;
		$data['total_hrs_project'] =$duration_project_hrs;
		$data['total_daies_project'] =$duration_project_daies;
	    $data['deps_total_hrs'] =$columns_mmk;
	    $data['finish_date'] = $enddate;
$this->db->update('tbl_projects',$data,array("id"=>$id));
if($status_project!=""){
	$datastaus['status_project'] = $status_project;
	$this->db->update('tbl_projects',$datastaus,array("id"=>$id));
}
if($status_executed!=""){
	$dataexecuted['status'] = $status_executed;
	$this->db->update('tbl_projects',$dataexecuted,array("id"=>$id));
}
if($manager_id!=""){
	$datamanager['id_magager'] =$manager_id;
	$this->db->update('tbl_projects',$datamanager,array("id"=>$id));
}
    
		if($_FILES['img']['name']!=""){
            $img_name=$this->gen_random_string(); 
            $imagename = $img_name;
			$config['image_library'] = 'gd2';
            $config['upload_path'] = 'uploads/projects/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             =100000;
            $config['max_width']            =100000;
            $config['max_height']           =100000;
            $config['file_name'] = $imagename; 
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('img')){
               /*echo $this->upload->display_errors();
                print_r($config);
                die;*/
            }
            else {
            $url= $_FILES['img']['name'];
            $ext = explode(".",$url);
            $file_extension = end($ext);
			$config['source_image'] = 'uploads/projects/'.$imagename.".".$file_extension ;
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['quality'] = '90%';
			$config['width']     = 400;
			$config['height']   = 400;
			$this->image_lib->clear();
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
            $data = array('logo'=>$imagename.".".$file_extension);
            $this->data->edit_table_id('tbl_projects',array('id'=>$id),$data);
            }
		}
	
		$this->db->insert("notification",$task_notify);
		
$idnotification = $this->db->insert_id();
if($idnotification!=""){	
send_email($id,"projects","update");
echo 1;
}
else {
echo 0;
}
	}
	



    public function project_status(){
		if($this->session->userdata('project_status')=="project_status"){
        $id=$this->input->get('id_projects');
         $project_id=$this->input->get('project_id');
        
        $data['data'] = $this->data->get_table_data('tbl_projects',array('id'=>$id));
		$this->load->view("admin/projects/project_status",$data); 
		}
		else {
			redirect(base_url().'admin/','refresh');	
		}
    }



function chaneg_finished(){
$project_id=$this->input->get('project_id');
$update_date= date("Y-m-d H:i:s");
$id_user=$this->session->userdata('id_admin');
if($this->session->userdata('end_project')=="end_project"){
$user_project['status']='4';
$this->db->update("users_projects",$user_project,array('id_projects'=>$project_id));
$datastaus['update_date'] = $update_date;
$datastaus['status'] = '4';
$this->db->update('tbl_projects',$datastaus,array("id"=>$project_id));
send_email($project_id,"projects","update");

$task_notify['project_id']=$project_id;
$task_notify['key_id']=8;
$task_notify['notify']="يوجد تعديل فى  مشروع";
$task_notify['create_date']=date("Y-m-d H:i");
$task_notify['id_user']=$id_user;
$task_notify['view']='0';
$this->db->insert("notification",$task_notify);

$this->session->set_flashdata('msg', 'تم تغير الحالة بنجاح');
$this->session->mark_as_flash('msg');
redirect(base_url().'admin/projects/finished','refresh');
	}
else {redirect(base_url().'admin/','refresh');}
}




    function status_action(){
		$id=$this->input->post('id');
		$project_id=$this->input->post('project_id');
		$user_id=get_table_filed("tbl_projects",array("id"=>$id),"id_magager");
		$update_date= date("Y-m-d H:i:s");
$id_user=$this->session->userdata('id_admin');

if($this->session->userdata('project_status')=="project_status"){
		$status_project=$this->input->post('status_executed');
$user_project['status']=$status_project;
$this->db->update("users_projects",$user_project,array('id_projects'=>$id));

if($status_project!=""){
$datastaus['update_date'] = $update_date;
$datastaus['status'] = $status_project;
$this->db->update('tbl_projects',$datastaus,array("id"=>$id));
}


$task_notify['project_id']=$id;
$task_notify['key_id']=8;
$task_notify['notify']="يوجد تعديل فى  مشروع";
$task_notify['create_date']=date("Y-m-d H:i");
$task_notify['id_user']=$user_id;
$task_notify['view']='0';
$this->db->insert("notification",$task_notify);
 send_email($id,"projects","update");
echo 1;
	}
else {echo 0;}



}


	public function files(){
		if($this->session->userdata('files_projects_view')=="files_projects_view"){
        $id_project=$this->input->get('id_project');
        $pg_config['sql'] = $this->data->get_sql('tbl_project_files',array('project_id'=>$id_project,'type'=>'1'),'id','DESC');
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
		$this->load->view("admin/projects/files",$data); 
		}
		else {
			redirect(base_url().'admin/','refresh');	
		}
	}
	
		public function download_file(){
		if($this->session->userdata('files_projects_view')=="files_projects_view"){
        $id_project=$this->uri->segment(4);
        $file="";
        $file = get_this('tbl_project_files',['id' => $id_project],'file');
        if($file!=""){
           redirect(base_url()."uploads/projects/files/$file",'refresh');
        }
        
       else {	
           	$this->session->set_flashdata('msg', 'الملف تم حذفه ');
	$this->session->mark_as_flash('msg');
           redirect(base_url().'admin/','refresh');	
       }
		}
		else {
	$this->session->set_flashdata('msg', 'نأسف لاتملك صلاحية  مشاهدة الملف');
	$this->session->mark_as_flash('msg');
redirect(base_url().'admin/','refresh');	
		}
	}

	public function add_file(){
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
		//print_r($permission_array);
      $this->load->view("admin/projects/add_file"); 
    }
	
	

	public function file_action(){
		$creation_date= date("Y-m-d H:i:s");
		$id_user=$this->session->userdata('id_admin');
		$name_file=$this->input->post('name_file');
		$project_id=$this->input->post('id_project');
		$type=$this->input->post('type');
				if($this->session->userdata('files_add')=="files_add"){
				$data['name'] = $name_file;
				$data['create_date'] =$creation_date;
				$data['user_id'] = $id_user;
				$data['project_id'] = $project_id;
					$data['type'] = $type;
				$this->db->insert('tbl_project_files',$data);
				$id = $this->db->insert_id();

				if($_FILES['img']['name']!=""){
					$img_name=$this->gen_random_string(); 
					$imagename = $img_name;
					$config['image_library'] = 'gd2';
					$config['upload_path'] = 'uploads/projects/files/';
					$config['allowed_types']        = 'gif|jpg|jpeg|psd|xd|png|pdf|doc|xlsx|zip|rar|ppt|pptx|txt|docx|xls';
					$config['max_size']             =6000000;
					$config['max_width']            =6000000;
					$config['max_height']           =6000000;
					$config['file_name'] = $imagename; 
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('img')){
					   /*echo $this->upload->display_errors();
						print_r($config);
						die;*/
					}
					else {
					$url= $_FILES['img']['name'];
					$ext = explode(".",$url);
					$file_extension = end($ext);
				/*	$config['source_image'] = 'uploads/projects/files'.$imagename.".".$file_extension ;
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = TRUE;
					$config['quality'] = '90%';
					$config['width']     = 400;
					$config['height']   = 400;
					$this->image_lib->clear();
					$this->image_lib->initialize($config);
					$this->image_lib->resize();*/
					$data = array('file'=>$imagename.".".$file_extension);
					$this->data->edit_table_id('tbl_project_files',array('id'=>$id),$data);
					}
				}
				echo send_email($id,"files","add");
				$this->session->set_flashdata('msg',lang("done_success"));
				$this->session->mark_as_flash('msg');
		//$this->session->mark_as_temp('msg',100);
				redirect(base_url().'admin/projects/files?id_project='.$project_id,'refresh');
				}
				else {
					redirect(base_url().'admin/','refresh');	
				}
			}
		

	public function file_delete(){
		$id_projects = $this->input->get('id_project');
		$id_file = $this->input->get('id_file');
        $check=$this->input->post('check');

        if($id_file!=""){
		$img = get_this('tbl_project_files',['id' => $id_file],'file');
		if ($img != ""&&file_exists("uploads/projects/files/$img")) {
		unlink("uploads/projects/files/$img");
		}
		echo send_email($id_file,"files","delete");
        $ret_value=$this->data->delete_table_row('tbl_project_files',array('id'=>$id_file)); 
        }
        if(isset($check) && $check!=""){  
		$check=$this->input->post('check');
		$id_projects = $this->input->post('id_project');
	
        $length=count($check);
        for($i=0;$i<$length;$i++){
			send_email($check[$i],"files","delete");
			$img = get_this('tbl_project_files',['id' =>$check[$i]],'file');
			if ($img != ""&&file_exists("uploads/projects/files/$img")) {
			unlink("uploads/projects/files/$img");
			}
        $ret_value=$this->data->delete_table_row('tbl_project_files',array('id'=>$check[$i]));    
        }
        }
		$this->session->set_flashdata('msg',lang("done_success"));
		$this->session->mark_as_flash('msg');
		//$this->session->mark_as_temp('msg',100);
       redirect(base_url()."admin/projects/files?id_project=$id_projects",'refresh');
	}
	
	public function project_users(){
		//$id_status = $this->input->get('id_status');
			$id_project = $this->input->get('id_project');
	$data['result'] = $users_tasks = $this->db->select('user_id as ids')
						->group_by('ids')
						->get_where('tbl_tasks',array('project_id'=>$id_project,'user_id!='=>""))
						->result();			$data['data'] = $this->data->get_table_data('tbl_projects',array('id'=>$id_project));
		   $this->load->view("admin/task/project_users",$data); 
		}


		public function details(){
			$notifications_id=$this->input->get('notifications_id');
			if($notifications_id!=""){
				$ret_value=$this->data->delete_table_row('notification',array('id'=>$notifications_id)); 
			}
			$id_project = $this->input->get('id_project');
			$data['data'] = $this->data->get_table_data('tbl_projects',array('id'=>$id_project));
		   $this->load->view("admin/projects/details",$data); 
		}
		
		
		
		
public function teamwork(){
		$id_project=$this->input->get('id_project');

    $tables = "users_projects";
    $config = array();
    $config['base_url'] = base_url().'admin/projects/teamwork'; 
    	if($this->session->userdata('teamwork_project')=="teamwork_project"){
    $config['total_rows'] = $this->data->record_count($tables,array('id_projects'=>$id_project,'status'=>'1'),'','id','desc');
    	}
    
    $config['per_page'] =80;
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';   
    $config['last_link'] = '»»';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
    $config['first_link'] = '««';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['prev_link'] = '<';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = '>';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a>';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $config['suffix'] = '?' . http_build_query($_GET, '', "&");
  $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
    
    $this->pagination->initialize($config);
if($this->uri->segment(4)){
$page = ($this->uri->segment(4)) ;
}
else{
$page =0;
}

$rs = $this->db->get($tables);
if($rs->num_rows() == 0):
$data["results"] = array();
$data["links"] = array();
else:
 if($this->session->userdata('teamwork_project')=="teamwork_project"){   
$data["results"] = $this->data->view_all_data($tables, array('id_projects'=>$id_project,'status'=>'1'), $config["per_page"], $page,'id','desc');
}
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
endif;
 $this->load->view("admin/projects/teamwork", $data); 
  }



 public function add_teamwork(){
if($this->session->userdata('teamwork_project')=="teamwork_project"){
$this->load->view("admin/projects/add_teamwork"); 
}
else {
redirect(base_url().'admin/','refresh');   
}
    }
    
    
    
public function teamwork_action(){
$creation_date= date("Y-m-d H:i:s");
$services_type=$this->input->post('services_type');
$project_id=$this->input->post('project_id');

for($i=0; $i<count($services_type); $i++){
$data['id_user']=$services_type[$i];
$data['id_projects']=$project_id;
$data['count_task']=0;
$data['status']='1';
 $this->db->insert('users_projects',$data);
}

echo 1;

    }
	
	
	
	  public function delete_user(){
        $id_project = $this->input->get('id_project');
        $check=$this->input->post('check');
        $id_team = $this->input->get('id_team');

        if($id_project!=""){
        $ret_value=$this->db->update('users_projects',array("status"=>'0'),array('id'=>$id_team)); 
        }
     
        if(isset($check) && $check!=""){  
            $id_project = $this->input->post('id_project');
        $check=$this->input->post('check');
        $length=count($check);
        for($i=0;$i<$length;$i++){
		
        $ret_value=$this->db->update('users_projects',array("status"=>'0'),array('id'=>$check[$i]));
        
        }
        }

		$this->session->set_flashdata('msg', 'تم الحذف بنجاح');
		$this->session->mark_as_flash('msg');
 redirect(base_url()."admin/projects/teamwork?id_project=$id_project",'refresh');
	
    }
}
