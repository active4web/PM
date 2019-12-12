<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends MX_Controller
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
        redirect(base_url().'admin/task/tasks','refresh');
    }
    public function sse(){
		
		
		$this->load->view("admin/task/sse"); 
        //redirect(base_url().'admin/task/tasks','refresh');
    }
  /*  public function tasks(){
		$id_project=$this->input->get('id_project');
		$notifications_id=$this->input->get('notifications_id');
		if($notifications_id!=""){
			$ret_value=$this->data->delete_table_row('notification',array('id'=>$notifications_id)); 
		}
		$user_id=$this->session->userdata('id_admin');
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
		
		
		if($this->session->userdata('tasks_view')=="tasks_view"){
		$pg_config['sql'] = $this->data->get_sql('tbl_tasks',array('project_id'=>$id_project),'id','DESC');
		}
		else {
		$pg_config['sql'] = $this->data->get_sql('tbl_tasks',array('project_id'=>$id_project,'user_id'=>$user_id),'id','DESC');
		}
        $pg_config['per_page'] = 100;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/task/tasks", $data); 
	}*/
	
	
	
	public function tasks(){
		$id_project=$this->input->get('id_project');
			$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
		
		$usersprojects=$this->db->get_where("users_projects",array('id_projects'=>$id_project))->result();
		if(count($usersprojects)>0){
		foreach($usersprojects as $usersprojects){
$id_user=$usersprojects->id_user;
$count_task=get_table_filed("users_projects",array('id_projects'=>$id_project,'id_user'=>$id_user),"count_task");
$total_task=$this->db->get_where("tbl_tasks",array('project_id'=>$id_project,'user_id'=>$id_user))->result();
    
    $total_minu=0;
    if($total_task!=$count_task){
	$this->db->select_sum('total_hrs');
    $this->db->from('tbl_tasks');
    $this->db->where('project_id',$id_project);
     $this->db->where('user_id',$id_user);
    $query_day= $this->db->get();
    $total_hrs= $query_day->row()->total_hrs;
    
    	$this->db->select_sum('over_time_hrs');
    $this->db->from('tbl_tasks');
    $this->db->where('project_id',$id_project);
     $this->db->where('user_id',$id_user);
    $query_day= $this->db->get();
    $over_time_hrs= $query_day->row()->over_time_hrs;
    
    

 foreach($total_task as $totaltask){
    $total_minu=get_table_filed("user_task_log",array('id_task'=>$totaltask->id,'id_user'=>$id_user),"total_hrs")+$total_minu;
    }
    $final_hrs=round($total_minu/60);
    $data_user['count_task']=count($total_task);
    $data_user['total_hrs']=$total_hrs;
    $data_user['actual_time']=$final_hrs;
     $data_user['over_time_hrs']=$over_time_hrs;
     
    $this->db->update('users_projects',$data_user,array('id_projects'=>$id_project,'id_user'=>$id_user));
    }
		    }
		}
		
		$notifications_id=$this->input->get('notifications_id');
		if($notifications_id!=""){
			$ret_value=$this->data->delete_table_row('notification',array('id'=>$notifications_id)); 
		}
		$user_id=$this->session->userdata('id_admin');
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
    $tables = "tbl_tasks";
    $config = array();
    $config['base_url'] = base_url().'admin/task/tasks'; 
    	if($this->session->userdata('tasks_view')=="tasks_view"){
    $config['total_rows'] = $this->data->record_count($tables,array('project_id'=>$id_project),'','id','desc');
    	}
    	else {
    $config['total_rows'] = $this->data->record_count($tables,array('project_id'=>$id_project,'user_id'=>$user_id),'','id','desc');	    
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
 	if($this->session->userdata('tasks_view')=="tasks_view"){   
$data["results"] = $this->data->view_all_data($tables, array('project_id'=>$id_project), $config["per_page"], $page,'id','desc');
}
 else{
$data["results"] = $this->data->view_all_data($tables, array('project_id'=>$id_project,'user_id'=>$user_id), $config["per_page"], $page,'id','desc');
     
 }
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
endif;
 $this->load->view("admin/task/tasks", $data); 
  }

public function test_date(){
    /*$sql_finished_date=get_table_data('tbl_tasks');
    foreach($sql_finished_date as $sql_finished_date){
        $id=$sql_finished_date->id;
        $real_startdate=date("Y-m-d",strtotime($sql_finished_date->real_startdate));
        $this->db->update("tbl_tasks",array("real_date"=>$real_startdate),array("id"=>$id));
    }*/
    echo date("Y-m-t");
    echo date("Y-m-01");
}





public function user_monthly_tasks(){
		$id_project=$this->input->get('id_project');
		$task_type=$this->input->get('task_type');	
		$id_worker=$this->input->get('user_id');
		$user_id=$this->session->userdata('id_admin');
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
    $tables = "tbl_tasks";
    $config = array();
    $monthly_date=date("Y-m-d");
    $config['base_url'] = base_url().'admin/task/user_monthly_tasks'; 
    	if($this->session->userdata('alltasks_user')=="alltasks_user"){
if($task_type!=""){
$config['total_rows'] = $this->data->record_count($tables,array('user_id'=>$id_worker,'task_type'=>$task_type,'project_id'=>$id_project,'real_date>='=>date("Y-m-01"),'real_date<='=>date("Y-m-t"),'status'=>'2'),'','id','desc');
}   
else {
$config['total_rows'] = $this->data->record_count($tables,array('user_id'=>$id_worker,'project_id'=>$id_project,'real_date>='=>date("Y-m-01"),'real_date<='=>date("Y-m-t"),'status'=>'2'),'','id','desc');
}
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
if($this->session->userdata('alltasks_user')=="alltasks_user"){   
    if($task_type!=""){
$data["results"] = $this->data->view_all_data($tables, array('user_id'=>$id_worker,'task_type'=>$task_type,'project_id'=>$id_project,'status'=>'2','real_date>='=>date("Y-m-01"),'real_date<='=>date("Y-m-t")), $config["per_page"], $page,'id','desc');        
    }
    else {
$data["results"] = $this->data->view_all_data($tables, array('user_id'=>$id_worker,'project_id'=>$id_project,'status'=>'2','real_date>='=>date("Y-m-01"),'real_date<='=>date("Y-m-t")), $config["per_page"], $page,'id','desc');
}
}

$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
endif;
 $this->load->view("admin/task/user_monthly_tasks", $data); 
  }


public function monthly_tasks(){
		$id_project=$this->input->get('id_project');
		$task_type=$this->input->get('task_type');	
		$user_id=$this->session->userdata('id_admin');
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
    $tables = "tbl_tasks";
    $config = array();
    $monthly_date=date("Y-m-d");
    $config['base_url'] = base_url().'admin/task/monthly_tasks'; 
    	if($this->session->userdata('tasks_view')=="tasks_view"){
if($task_type!=""){
$config['total_rows'] = $this->data->record_count($tables,array('task_type'=>$task_type,'project_id'=>$id_project,'real_date>='=>date("Y-m-01"),'real_date<='=>date("Y-m-t"),'status'=>'2'),'','id','desc');
}   
else {
$config['total_rows'] = $this->data->record_count($tables,array('project_id'=>$id_project,'real_date>='=>date("Y-m-01"),'real_date<='=>date("Y-m-t"),'status'=>'2'),'','id','desc');
}
}
else {
if($task_type!=""){
$config['total_rows'] = $this->data->record_count($tables,array('task_type'=>$task_type,'project_id'=>$id_project,'real_date>='=>date("Y-m-01"),'real_date<='=>date("Y-m-t"),'status'=>'2','user_id'=>$user_id),'','id','desc');
}   
else {  	    
$config['total_rows'] = $this->data->record_count($tables,array('project_id'=>$id_project,'real_date>='=>date("Y-m-01"),'real_date<='=>date("Y-m-t"),'status'=>'2','user_id'=>$user_id),'','id','desc');	    
}
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
if($this->session->userdata('tasks_view')=="tasks_view"){   
    if($task_type!=""){
$data["results"] = $this->data->view_all_data($tables, array('task_type'=>$task_type,'project_id'=>$id_project,'status'=>'2','real_date>='=>date("Y-m-01"),'real_date<='=>date("Y-m-t")), $config["per_page"], $page,'id','desc');        
    }
    else {
$data["results"] = $this->data->view_all_data($tables, array('project_id'=>$id_project,'status'=>'2','real_date>='=>date("Y-m-01"),'real_date<='=>date("Y-m-t")), $config["per_page"], $page,'id','desc');
}
}
 else{
if($task_type!=""){
 $data["results"] = $this->data->view_all_data($tables, array('task_type'=>$task_type,'project_id'=>$id_project,'status'=>'2','real_date>='=>date("Y-m-01"),'real_date<='=>date("Y-m-t"),'user_id'=>$user_id), $config["per_page"], $page,'id','desc');       
    }
    else {
$data["results"] = $this->data->view_all_data($tables, array('project_id'=>$id_project,'status'=>'2','real_date>='=>date("Y-m-01"),'real_date<='=>date("Y-m-t"),'user_id'=>$user_id), $config["per_page"], $page,'id','desc');
    }    
 }
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
endif;
 $this->load->view("admin/task/monthly_tasks", $data); 
  }
  
  
  
  
   public function user_tasks_type(){
      	$id_worker=$this->input->get('user_id');
      $monthly=$this->input->get('monthly');
      $type=$this->input->get('type');
		$id_project=$this->input->get('id_project');
		$user_id=$this->session->userdata('id_admin');
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
    $tables = "tbl_tasks";
    $config = array();
   
    $config['base_url'] = base_url().'admin/task/user_tasks_type'; 
    	if($this->session->userdata('alltasks_user')=="alltasks_user"){
if($monthly=="true"){
$config['total_rows'] = $this->data->record_count($tables,array('user_id'=>$id_worker,'project_id'=>$id_project,'task_type'=>$type,'status'=>'2','real_date>='=>date("Y-m-01"),'real_date<='=>date("Y-m-t")),'','id','desc');	        
    	    }
    	    else {
$config['total_rows'] = $this->data->record_count($tables,array('user_id'=>$id_worker,'project_id'=>$id_project,'task_type'=>$type,'status'=>'2'),'','id','desc');    	        
    	    }
    
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
 	if($this->session->userdata('alltasks_user')=="alltasks_user"){   
 	    if($monthly=="true"){
 	        
$data["results"] = $this->data->view_all_data($tables, array('user_id'=>$id_worker,'project_id'=>$id_project,'task_type'=>$type,'status'=>'2','real_date>='=>date("Y-m-01"),'real_date<='=>date("Y-m-t")), $config["per_page"], $page,'id','desc'); 	        
    }
    
    else {
$data["results"] = $this->data->view_all_data($tables, array('user_id'=>$id_worker,'project_id'=>$id_project,'task_type'=>$type,'status'=>'2'), $config["per_page"], $page,'id','desc');
}
}

$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
endif;
 $this->load->view("admin/task/user_tasks_type", $data); 
  }


  
  public function tasks_type(){
      
      $monthly=$this->input->get('monthly');
      $type=$this->input->get('type');
		$id_project=$this->input->get('id_project');
		$user_id=$this->session->userdata('id_admin');
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
    $tables = "tbl_tasks";
    $config = array();
   
    $config['base_url'] = base_url().'admin/task/tasks_type'; 
    	if($this->session->userdata('tasks_view')=="tasks_view"){
if($monthly=="true"){
$config['total_rows'] = $this->data->record_count($tables,array('project_id'=>$id_project,'task_type'=>$type,'real_date>='=>date("Y-m-01"),'real_date<='=>date("Y-m-t")),'','id','desc');	        
    	    }
    	    else {
$config['total_rows'] = $this->data->record_count($tables,array('project_id'=>$id_project,'task_type'=>$type),'','id','desc');    	        
    	    }
    
    	}
    	else {
if($monthly=="true"){
$config['total_rows'] = $this->data->record_count($tables,array('project_id'=>$id_project,'task_type'=>$type,'user_id'=>$user_id,'real_date>='=>date("Y-m-01"),'real_date<='=>date("Y-m-t")),'','id','desc');      
    }
    else {
     $config['total_rows'] = $this->data->record_count($tables,array('project_id'=>$id_project,'task_type'=>$type,'user_id'=>$user_id),'','id','desc');     
    }
    	    
  	    
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
 	if($this->session->userdata('tasks_view')=="tasks_view"){   
 	    if($monthly=="true"){
 	        
$data["results"] = $this->data->view_all_data($tables, array('project_id'=>$id_project,'task_type'=>$type,'real_date>='=>date("Y-m-01"),'real_date<='=>date("Y-m-t")), $config["per_page"], $page,'id','desc'); 	        
    }
    
    else {
$data["results"] = $this->data->view_all_data($tables, array('project_id'=>$id_project,'task_type'=>$type), $config["per_page"], $page,'id','desc');
}
}
 else{
     if($monthly=="true"){
         
         $data["results"] = $this->data->view_all_data($tables, array('project_id'=>$id_project,'task_type'=>$type,'user_id'=>$user_id,'real_date>='=>date("Y-m-01"),'real_date<='=>date("Y-m-t")), $config["per_page"], $page,'id','desc');
    }
    else {
$data["results"] = $this->data->view_all_data($tables, array('project_id'=>$id_project,'task_type'=>$type,'user_id'=>$user_id), $config["per_page"], $page,'id','desc');
    }   
 }
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
endif;
 $this->load->view("admin/task/tasks_type", $data); 
  }



public function tasks_finished(){
		$id_project=$this->input->get('id_project');
		$notifications_id=$this->input->get('notifications_id');
		if($notifications_id!=""){
			$ret_value=$this->data->delete_table_row('notification',array('id'=>$notifications_id)); 
		}
		$user_id=$this->session->userdata('id_admin');
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
    $tables = "tbl_tasks";
    $config = array();
    $config['base_url'] = base_url().'admin/task/tasks_finished'; 
    	if($this->session->userdata('tasks_view')=="tasks_view"){
    $config['total_rows'] = $this->data->record_count($tables,array('project_id'=>$id_project,'status'=>'2','status_review_id'=>'2','status_review1'=>'2','status_review'=>'2'),'','id','desc');
    	}
    	else {
    $config['total_rows'] = $this->data->record_count($tables,array('project_id'=>$id_project,'status'=>'2','status_review_id'=>'2','status_review1'=>'2','status_review'=>'2','user_id'=>$user_id),'','id','desc');	    
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
 	if($this->session->userdata('tasks_view')=="tasks_view"){   
$data["results"] = $this->data->view_all_data($tables, array('project_id'=>$id_project,'status'=>'2','status_review_id'=>'2','status_review1'=>'2','status_review'=>'2'), $config["per_page"], $page,'id','desc');
}
 else{
$data["results"] = $this->data->view_all_data($tables, array('project_id'=>$id_project,'status'=>'2','status_review_id'=>'2','status_review1'=>'2','status_review'=>'2','user_id'=>$user_id), $config["per_page"], $page,'id','desc');
     
 }
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
endif;
 $this->load->view("admin/task/tasks_finished", $data); 
  }

	
	
/*	public function tasks_finished(){
		$id_project=$this->input->get('id_project');
		$user_id=$this->session->userdata('id_admin');
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
		if($this->session->userdata('tasks_view')=="tasks_view"){
        $pg_config['sql'] = $this->data->get_sql('tbl_tasks',array('project_id'=>$id_project,'status'=>'2','status_review_id'=>'2','status_review1'=>'2','status_review'=>'2'),'id','DESC');
	}
	else {
		$pg_config['sql'] = $this->data->get_sql('tbl_tasks',array('project_id'=>$id_project,'status'=>'2','status_review_id'=>'2','status_review1'=>'2','status_review'=>'2','user_id'=>$user_id),'id','DESC');
	}
		$pg_config['per_page'] = 100;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/task/tasks_finished", $data); 
	}*/
	
	
	



public function tasks_working(){
		$id_project=$this->input->get('id_project');

		$user_id=$this->session->userdata('id_admin');
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
    $tables = "tbl_tasks";
    $config = array();
    $config['base_url'] = base_url().'admin/task/tasks_working'; 
    	if($this->session->userdata('tasks_view')=="tasks_view"){
    $config['total_rows'] = $this->data->record_count($tables,array('project_id'=>$id_project,'status'=>'1'),'','id','desc');
    	}
    	else {
    $config['total_rows'] = $this->data->record_count($tables,array('project_id'=>$id_project,'status'=>'1','user_id'=>$user_id),'','id','desc');	    
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
 	if($this->session->userdata('tasks_view')=="tasks_view"){   
$data["results"] = $this->data->view_all_data($tables, array('project_id'=>$id_project,'status'=>'1'), $config["per_page"], $page,'id','desc');
}
 else{
$data["results"] = $this->data->view_all_data($tables, array('project_id'=>$id_project,'status'=>'1','user_id'=>$user_id), $config["per_page"], $page,'id','desc');
     
 }
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
endif;
 $this->load->view("admin/task/tasks_working", $data); 
  }
	
	
	/*public function tasks_working(){
		$id_project=$this->input->get('id_project');
		$user_id=$this->session->userdata('id_admin');
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
		if($this->session->userdata('tasks_view')=="tasks_view"){
		$pg_config['sql'] = $this->data->get_sql('tbl_tasks',array('project_id'=>$id_project,'status'=>'1'),'id','DESC');
	}
	else {
		$pg_config['sql'] = $this->data->get_sql('tbl_tasks',array('project_id'=>$id_project,'status'=>'1','user_id'=>$user_id),'id','DESC');
	}
        $pg_config['per_page'] = 100;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/task/tasks_working", $data); 
	}*/
	
	public function tasks_error(){
		$id_project=$this->input->get('id_project');

		$user_id=$this->session->userdata('id_admin');
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
    $tables = "tbl_tasks";
    $config = array();
    $config['base_url'] = base_url().'admin/task/tasks_error'; 
    	if($this->session->userdata('tasks_view')=="tasks_view"){
    $config['total_rows'] = $this->data->record_count($tables,array('project_id'=>$id_project,'status_review_id'=>'1'),'','id','desc');
    	}
    	else {
    $config['total_rows'] = $this->data->record_count($tables,array('project_id'=>$id_project,'status_review_id'=>'1','user_id'=>$user_id),'','id','desc');	    
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
 	if($this->session->userdata('tasks_view')=="tasks_view"){   
$data["results"] = $this->data->view_all_data($tables, array('project_id'=>$id_project,'status_review_id'=>'1'), $config["per_page"], $page,'id','desc');
}
 else{
$data["results"] = $this->data->view_all_data($tables, array('project_id'=>$id_project,'status_review_id'=>'1','user_id'=>$user_id), $config["per_page"], $page,'id','desc');
     
 }
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
endif;
 $this->load->view("admin/task/tasks_error", $data); 
  }
	
	
	
/*	public function tasks_error(){
		$user_id=$this->session->userdata('id_admin');
		$id_project=$this->input->get('id_project');
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
		if($this->session->userdata('tasks_view')=="tasks_view"){
		$pg_config['sql'] = $this->data->get_sql('tbl_tasks',array('project_id'=>$id_project,'status_review_id'=>'1'),'id','DESC');
		}
		else {
			$pg_config['sql'] = $this->data->get_sql('tbl_tasks',array('project_id'=>$id_project,'status_review_id'=>'1','user_id'=>$user_id),'id','DESC');
		}

        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/task/tasks_error", $data); 
	}*/
	


	public function tasks_wait_review(){
		$id_project=$this->input->get('id_project');

		$user_id=$this->session->userdata('id_admin');
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
    $tables = "tbl_tasks";
    $config = array();
    $config['base_url'] = base_url().'admin/task/tasks_wait_review'; 
    	if($this->session->userdata('tasks_view')=="tasks_view"){
    $config['total_rows'] = $this->data->record_count($tables,array('project_id'=>$id_project,'status'=>'2','status_review_id'=>'0'),'','id','desc');
    	}
    	else {
    $config['total_rows'] = $this->data->record_count($tables,array('project_id'=>$id_project,'status'=>'2','status_review_id'=>'0','user_id'=>$user_id),'','id','desc');	    
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
 	if($this->session->userdata('tasks_view')=="tasks_view"){   
$data["results"] = $this->data->view_all_data($tables, array('project_id'=>$id_project,'status'=>'2','status_review_id'=>'0'), $config["per_page"], $page,'id','desc');
}
 else{
$data["results"] = $this->data->view_all_data($tables, array('project_id'=>$id_project,'status'=>'2','status_review_id'=>'0','user_id'=>$user_id), $config["per_page"], $page,'id','desc');
     
 }
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
endif;
 $this->load->view("admin/task/tasks_wait_review", $data); 
  }


	/*public function tasks_wait_review(){
		$user_id=$this->session->userdata('id_admin');
		$id_project=$this->input->get('id_project');
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
		if($this->session->userdata('tasks_view')=="tasks_view"){
		$pg_config['sql'] = $this->data->get_sql('tbl_tasks',array('project_id'=>$id_project,'status'=>'0','status_review_id'=>'0'),'id','DESC');
		}
		else {
			$pg_config['sql'] = $this->data->get_sql('tbl_tasks',array('project_id'=>$id_project,'status'=>'0','status_review_id'=>'0','user_id'=>$user_id),'id','DESC');
		}

        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/task/tasks_wait_review", $data); 
	}*/


/*	public function tasks_wait(){
		$user_id=$this->session->userdata('id_admin');
		$id_project=$this->input->get('id_project');
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
		if($this->session->userdata('tasks_view')=="tasks_view"){
		$pg_config['sql'] = $this->data->get_sql('tbl_tasks',array('project_id'=>$id_project,'status'=>'0','status_review_id'=>'0'),'id','DESC');
		}
		else {
			$pg_config['sql'] = $this->data->get_sql('tbl_tasks',array('project_id'=>$id_project,'status'=>'0','status_review_id'=>'0','user_id'=>$user_id),'id','DESC');
		}

        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/task/tasks_wait", $data); 
	}*/
	
	
	
	
	
	
		public function tasks_wait(){
		$id_project=$this->input->get('id_project');

		$user_id=$this->session->userdata('id_admin');
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
    $tables = "tbl_tasks";
    $config = array();
    $config['base_url'] = base_url().'admin/task/tasks_wait'; 
    	if($this->session->userdata('tasks_view')=="tasks_view"){
    $config['total_rows'] = $this->data->record_count($tables,array('project_id'=>$id_project,'status'=>'0','status_review_id'=>'0'),'','id','desc');
    	}
    	else {
    $config['total_rows'] = $this->data->record_count($tables,array('project_id'=>$id_project,'status'=>'0','status_review_id'=>'0','user_id'=>$user_id),'','id','desc');	    
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
 	if($this->session->userdata('tasks_view')=="tasks_view"){   
$data["results"] = $this->data->view_all_data($tables, array('project_id'=>$id_project,'status'=>'0','status_review_id'=>'0'), $config["per_page"], $page,'id','desc');
}
 else{
$data["results"] = $this->data->view_all_data($tables, array('project_id'=>$id_project,'status'=>'0','status_review_id'=>'0','user_id'=>$user_id), $config["per_page"], $page,'id','desc');
     
 }
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
endif;
 $this->load->view("admin/task/tasks_wait", $data); 
  }




    public function add(){
if($this->session->userdata('tasks_add')=="tasks_add"){
$this->load->view("admin/task/add"); 
}
else {
redirect(base_url().'admin/','refresh');	
}
    }
	
	


    public function add_action(){
$creation_date= date("Y-m-d H:i:s");
$code=$this->gen_random_string();
$id_user=$this->session->userdata('id_admin');
	
        $name_task=$this->input->post('name_task');
		$desc_ar=$this->input->post('desc_ar');
		$select_date=$this->input->post('select_date');
        $start_time=$this->input->post('start_time');
        $num_hrs=$this->input->post('num_hrs');
        $manager_id=$this->input->post('manager_id');
		$id_project=$this->input->post('id_project');
		$select_enddate=$this->input->post('select_enddate');
		$enddate=$this->input->post('enddate');
		$time_type=$this->input->post('time_type');
		$time_type_overtime=$this->input->post('time_type_overtime');
		$over_num_hrs=$this->input->post('over_num_hrs');
		$task_type_job=$this->input->post('task_type_job');
		$task_status_job=$this->input->post('task_status_job');
		$mydep=$this->input->post('mydep');
		$dep_id=$this->input->post('dep_id');
		
	$project_status=get_table_filed("tbl_projects",array("id"=>$id_project),"status");		
$count_task=get_table_filed("users_projects",array("id_projects"=>$id_project,'id_user'=>$manager_id),"count_task");
if($count_task!=""&&$manager_id!=""){
  $data_count_tasks['count_task']= $count_task+1;
  //$data_count_tasks['status']=$project_status;
  $this->db->update("users_projects",$data_count_tasks,array("id_projects"=>$id_project,'id_user'=>$manager_id));
}
else if($manager_id!=""){
$data_count_tasks['count_task']=1; 
$data_count_tasks['id_projects']=$id_project; 
$data_count_tasks['id_user']=$manager_id; 
$data_count_tasks['status']=$project_status;
$this->db->insert("users_projects",$data_count_tasks);    
}
		$code=get_table_filed("tbl_projects",array("id"=>$id_project),"code");
		$data['project_id'] = $id_project;
        $data['name'] = $name_task;
		$data['create_date'] =$creation_date;
		$data['user_id'] = $manager_id;
        $data['add_id'] = $id_user;
		$data['main_task'] = $desc_ar;
		$data['task_type'] = $task_type_job;
		$data['select_date'] = $select_date;
		$data['task_status'] = $task_status_job;
		
		if($mydep==2){	$data['service_id'] = $dep_id;}
		if($select_enddate==1&&$select_date==2){
		    $start_time_h=date("H",strtotime($start_time));
		    $break =get_table_filed('tbl_config',array('config_key'=>'break'),"config_value");
         	$start_work =get_table_filed('tbl_config',array('config_key'=>'start_work'),"config_value");
         	$totalhrs=(int)$break-(int)$start_work;
        
		    if($time_type==1){
		    $minutes=(float)$num_hrs*60;
		      $main_hrs=$num_hrs;
		    $data['total_hrs'] =$main_hrs;
		    }
		    else  if($time_type==2){
		       $minutes=(float)$num_hrs; 
		       $main_hrs=round($num_hrs/60,2);
		       $data['total_hrs'] =$main_hrs;
		    }
		     	$end_break=$main_hrs+date("H");
		    	    if($start_time_h<$break&&($main_hrs>$totalhrs||$end_break>$break)){$minutes=$minutes+30;}
		    	    else {$minutes=$minutes;}
		   $data['select_enddate'] = 2;
			$calculation = date("Y-m-d H:i",strtotime("$start_time+ $minutes minutes"));
				$data['finished_date'] = $calculation;
				$data['start_date'] = $start_time;
				
			}
			else if($select_enddate==2&&$select_date==2) {
			    
			     if($time_type==1){
		    $minutes=(float)$num_hrs*60;
		    $data['total_hrs'] =$num_hrs;
		    }
		    else  if($time_type==2){
		       $minutes=(float)$num_hrs; 
		       $data['total_hrs'] =round($num_hrs/60,2);
		    }
			    
			    $calculation=$enddate;
			    $data['select_enddate'] = $select_enddate;
			    	$data['finished_date'] = $calculation;
			    	$data['start_date'] = $start_time;
			}
		
			else if($select_date==1&&$select_enddate==1) {
			 $data['select_enddate'] = $select_enddate;
		 if($time_type==1){
		    $minutes=(float)$num_hrs*60;
		    $data['total_hrs'] =$num_hrs;
		    }
		    else  if($time_type==2){
		       $minutes=(float)$num_hrs; 
		       $data['total_hrs'] =round($num_hrs/60,2);
		    }
			 
			}

if($over_num_hrs!=""){
		if($time_type_overtime==1){
		    $data['over_time_hrs'] =$over_num_hrs;
		    }
		    else  if($time_type_overtime==2){
		       $data['over_time_hrs'] =round($over_num_hrs/60,2);
		    }
}
		$data['code'] = $start_time;
         $this->db->insert('tbl_tasks',$data);
		$id = $this->db->insert_id();
		$code_data['code']=$code.$id;
		$this->db->update('tbl_tasks',$data,array('id'=>$id));
		if($manager_id!=""){
			$task_notify['project_id']=$id_project;
			$task_notify['key_id']=1 ;
			$task_notify['notify']="يوجد تعديل فى  المهمة";
			$task_notify['create_date']=date("Y-m-d H:i");
			$task_notify['id_user']=$manager_id;
			$task_notify['view']='0';
			$this->db->insert("notification",$task_notify);
			}
 
if($id!=""){
   send_email($id,"task","add");
//send_email($id,"task","add");
echo 1;
}
else {
echo 0;
}
	
    }
	

		public function check_expire(){
			$current_time=date('Y-m-d H:i');
			$sql_old_task=get_table_data('tbl_tasks',array('status!='=>'2','finished_date!='=>"",'select_enddate'=>'2'));
if(count($sql_old_task)>0){
			foreach($sql_old_task as $sql_old_task){
				$finished_date=$sql_old_task->finished_date;
		$str_m=strtotime($current_time);
	/*	$str_o=strtotime($time);
		$diff=$str_m-$str_o;*/
			$expire_time=30;
			$calculation = strtotime("+".$expire_time." minutes", strtotime($finished_date));
				if($str_m<$calculation){
			$task_notify['project_id']=$sql_old_task->project_id;
			$task_notify['key_id']=9;
			$task_notify['notify']="وقت المحدد للمهمة واشك على الأنتهاء";
			$task_notify['create_date']=date("Y-m-d H:i");
			$task_notify['id_user']=$sql_old_task->user_id;
			$task_notify['view']='0';
			$this->db->insert("notification",$task_notify);
				}
			}
		}
  	}





	  
	  public function review_statistics(){
		$id_status=$this->input->get('id');
		$id_project=$this->input->get('id_project');
		$data['data'] = $this->data->get_table_data('review_task_log',array('id_task'=>$id_status));
		$this->load->view("admin/task/review_statistics",$data); 
  }


  public function user_statistics(){
	$id_status=$this->input->get('id');
	$id_project=$this->input->get('id_project');
	$data['data'] = $this->data->get_table_data('user_task_log',array('id_task'=>$id_status));
	$this->load->view("admin/task/user_statistics",$data); 
}

	public function change_status(){
			$id_status=$this->input->get('id_status');
			$id_project=$this->input->get('id_project');
			$data['data'] = $this->data->get_table_data('tbl_tasks',array('id'=>$id_status));
			$this->load->view("admin/task/change_status",$data); 
  	}
  		public function test(){
		$project=$this->db->get_where("tbl_tasks")->result(); 
		foreach($project as $project){
		    $id=$project->id;
		     $project_id=$project->project_id;
		    $data_project['id_project']=$project_id;
		    $this->db->update("user_task_log",$data_project,array('id_task'=>$id));
		}
  	}
  	

	  public function status_action(){
		$id_status=$this->input->post('id_status');
		$id_project=$this->input->post('id_project');
		$status=$this->input->post('status');
		$userid_review=$this->session->userdata('id_admin');
		$user_id=get_table_filed("tbl_tasks",array("id"=>$id_status),"user_id");
		$oldstatus=get_table_filed("tbl_tasks",array("id"=>$id_status),"status");
		$service_id=get_table_filed("tbl_tasks",array("id"=>$id_status),"service_id");
		
		$data['oldstatus'] = $oldstatus;
		$data['status'] =$status;
		if($status==""&&$oldstatus==1){
		 $data['status'] = '1';
		$data['oldstatus'] = $oldstatus;
		$status=1;
		}
	
	
		if($status==2){
		 
		$data['real_enddate'] = date("Y-m-d H:i");
		$id_final=$this->db->limit(1)->order_by("id","desc")->get_where("user_task_log",array("id_task"=>$id_status,'status'=>'1'))->result();
		$break =get_table_filed('tbl_config',array('config_key'=>'break'),"config_value");
		$end_break =get_table_filed('tbl_config',array('config_key'=>'end_break'),"config_value");
		$end_work =get_table_filed('tbl_config',array('config_key'=>'end_work'),"config_value");
		$start_work =get_table_filed('tbl_config',array('config_key'=>'start_work'),"config_value");
		$break_time =get_table_filed('tbl_config',array('config_key'=>'break_time'),"config_value");
	
		foreach($id_final as $id_final)
		$id_final_log=$id_final->id;
		$start_date_log=date("Y-m-d H:i",strtotime(date($id_final->start_date)));
		$end_date=date("Y-m-d H:i");
	
		$end_date_h=date("H");
		$end_date_d=date("d");
		$end_date_m=date("m");
		$end_date_y=date("Y");
		
		$start_date_h=date("H",strtotime(date($id_final->start_date)));
		$start_date_d=date("d",strtotime(date($id_final->start_date)));
		$start_date_m=date("m",strtotime(date($id_final->start_date)));
		$start_date_y=date("Y",strtotime(date($id_final->start_date)));
		
	   $total_hrs=(strtotime(date("Y-m-d H:i"))-strtotime($start_date_log))/(60);
	   $task_log['total_hrs']=$total_hrs;

		$end_date_h_timing=date("H:i");
if($start_date_h<=$break&&$end_date_h_timing>=$break&&$end_date_d==$start_date_d&&$start_date_m==$end_date_m&&$start_date_y==$end_date_y){
    $m=$total_hrs-$break_time;
   $total_hrs=$total_hrs-$break_time;
   $task_log['total_hrs']=$total_hrs;
   
}

 /************************IF END DATE AFTER ONE DAY*************************/
 /*************************************************************************/
/*************************************************************************/
/*************************************************************************/
/*************************************************************************/


if($end_date>$start_date_log&&$end_date_d!=$start_date_d){
   // echo "dfsd";
$old_date=date("Y-m-d",strtotime($start_date_log));
if($start_date_h<$end_work){
$end_day_start_task=$old_date." ".$end_work;
$start_day_end_task=date("Y-m-d")." ".$start_work;
}
else {$end_day_start_task=$end_date;$start_day_end_task=$end_date;}


$total_hrs_start=(strtotime($end_day_start_task)-strtotime($start_date_log))/(60);
 if($start_date_h<$break){
 $total_hrs_start=$total_hrs_start-$break_time;
 }
 else {
     $total_hrs_start=$total_hrs_start;
 }

$olddate=date("Y-m-d",strtotime($start_date_log));
$newdate=date("Y-m-d");
$final_minutes=0;
while($newdate>$olddate){
$date = date('Y-m-d', strtotime($olddate . ' +1 day'));
$day_name=date('D', strtotime($date ));
$permission=0;
if($day_name!="Fri"&&$day_name!="Sat"&&$date!=$newdate){
$time_value=get_table_filed('vacation_time',array('id_user'=>$userid_review,'date_vacation'=>$date),"time_value");
if($time_value!=""){$permission=$time_value*60;}
$final_minutes=((8*60)-$permission)+$final_minutes;
}
/*echo $date."<br>";
echo $total_hrs_start."<br>";
echo $start_date_h."<br>";
echo $break."<br>";*/
$olddate=$date;
}

$total_hrs_end=(strtotime($end_date)-strtotime($start_day_end_task))/(60);
 if($end_date_h>$end_break){$total_hrs_end=$total_hrs_end-$break_time;}
 
 
 else { $total_hrs_end=$total_hrs_end;}


$main_total_hrs=(int)$total_hrs_start+(int)$total_hrs_end+(int)$final_minutes;
//echo $main_total_hrs;
 $task_log['total_hrs']=round($main_total_hrs);
}
/*************************************************************************/
/*************************************************************************/
/*************************************************************************/
/*************************************************************************/


$task_log['enddate']=date("Y-m-d H:i");
$task_log['status']=$status;
$this->db->update("user_task_log",$task_log,array("id"=>$id_final_log));			 

	
		}
		
		
		else if($status==1){
	 $id_service=get_table_filed("tbl_users",array("id"=>$userid_review),"dep_id");	    
			$task_log['id_task']=$id_status;
			$task_log['start_date']=date("Y-m-d H:i");
			$task_log['status']=$status;
			$task_log['id_user']=$userid_review;
		    $task_log['id_project']=$id_project;
		    if($service_id!=""){
		       $task_log['id_service']=  $service_id;
		    }
		    else {
		    $task_log['id_service']=$id_service;
		    }
		     $id_old_task_ex=get_table_filed("user_task_log",array("id_task"=>$id_status,'id_project'=>$id_project),"id");
		     if($id_old_task_ex==""){
			$this->db->insert("user_task_log",$task_log);	
		     
		$data['real_date'] = date("Y-m-d");
		         
		     }
		}


		if($user_id!=""){
			$task_notify['project_id']=$id_project;
			$task_notify['key_id']=4;
			$task_notify['notify']="يوجد تعديل فى حالة  مهمة";
			$task_notify['create_date']=date("Y-m-d H:i");
			$task_notify['id_user']=$user_id;
			$task_notify['view']='0';
			$this->db->insert("notification",$task_notify);
			}
			
$this->db->update("tbl_tasks",$data,array('id'=>$id_status));


if($id_status!=""){	
 send_email($id_status,"task","change_status");
echo 1;
}
else {
echo 0;
}


	}



	public function start_date(){
		$id_status=$this->input->get('id_status');
		$id_project=$this->input->get('id_project');
		$data['data'] = $this->data->get_table_data('tbl_tasks',array('id'=>$id_status));
		$this->load->view("admin/task/start_date",$data); 
  }

	public function start_date_action(){
	$ceartion_date=date("Y-m-d H:i");
			$id_status=$this->input->post('id_status');
			$id_project=$this->input->post('id_project');
			$select_date=$this->input->post('select_date');
			$start_time=$this->input->post('start_time');
			$enddate=$this->input->post('enddate');
			$select_enddate=$this->input->post('select_enddate');
			$sql_old_task=get_table_data('tbl_tasks',array('id'=>$id_status));
			foreach($sql_old_task as $sql_old_task){
				$task_log['task_id']=$sql_old_task->id;
				$task_log['name']=$sql_old_task->name;
				$task_log['user_id']=$sql_old_task->user_id;
				$task_log['main_task']=$sql_old_task->main_task;
				$task_log['start_date']=$sql_old_task->start_date;
				$task_log['review_date']=$sql_old_task->review_date;
				$task_log['review1_date']=$sql_old_task->review1_date;
				$task_log['finished_date']=$sql_old_task->finished_date;
				$task_log['status']=$sql_old_task->status;
				$task_log['total_hrs']=$sql_old_task->total_hrs;
				$task_log['status_review']=$sql_old_task->status_review;
				$task_log['status_review1']=$sql_old_task->status_review1;
				$task_log['ceartion_date']=$ceartion_date;
				$this->db->insert("tbl_tasks_log",$task_log);
				/////////////////////////////////
				if($sql_old_task->user_id!=""){
				$task_notify['project_id']=$sql_old_task->project_id;
				$task_notify['key_id']=3;
				$task_notify['notify']="يوجد تعديل فى توقيت المهمة";
				$task_notify['create_date']=$ceartion_date;
				$task_notify['id_user']=$sql_old_task->user_id;
				$task_notify['view']='0';
				$this->db->insert("notification",$task_notify);
				}
			}


			$total_hrs=get_table_filed("tbl_tasks",array("id"=>$id_status),"total_hrs");
			
			
			
			
			
			if($select_enddate==1&&$select_date==2){
			$calculation = date("Y-m-d H:i",strtotime("+".$total_hrs." hours", strtotime($start_time)));
			$data['select_enddate'] =2;
			}
			else {$calculation=$enddate;	$data['select_enddate'] =2;}
			$data['finished_date']=$calculation ;
			$data['start_date'] = $start_time;
			$data['select_date'] =2;
			$this->db->update("tbl_tasks",$data,array('id'=>$id_status));
	if($id_status!=""){	
//send_email($id_status,"task","change_startdate");
echo 1;
}
else {
echo 0;
}

	}


	
	public function notes_reply(){
		$id_status=$this->input->get('id_status');
		$id_project=$this->input->get('id_project');
		$id_messg=$this->input->get('id_messg');
		$data['data'] = $this->data->get_table_data('tbl_tasks',array('id'=>$id_status));
		$this->load->view("admin/task/notes_reply",$data); 
  }


	public function change_review(){
if($this->session->userdata('task_review')=="task_review"||$this->session->userdata('task_review1')=="task_review1"){
		$id_status=$this->input->get('id_status');
		$id_project=$this->input->get('id_project');
		$data['data'] = $this->data->get_table_data('tbl_tasks',array('id'=>$id_status));
		$this->load->view("admin/task/change_review",$data); 
}

else {
redirect(base_url().'admin/','refresh');	
}
  }

  public function notes_reply_action(){
	$userid_review=$this->session->userdata('id_admin');
	$id_status=$this->input->post('id_status');
	$id_project=$this->input->post('id_project');
	$id_messg=$this->input->post('id_messg');
	$desc_ar=$this->input->post('desc_ar');
	$user_id=get_table_filed("tbl_tasks",array("id"=>$id_status),"user_id");
	$id_sender=	$this->session->userdata('id_admin');
	if($desc_ar!=""){
		$notes_data['id_sender']=$id_sender;
		$notes_data['id_reciver']=$user_id;
		$notes_data['id_task']=$id_status;
		$notes_data['id_projects']=$id_project;
		$notes_data['notes']=$desc_ar;
		$notes_data['id_replay']=$id_messg;
		$this->db->insert("projects_notes",$notes_data);
		}
//echo send_email($id_status,"task","change_review");
redirect(base_url()."admin/task/details?id_project=$id_project&id_status=$id_status",'refresh');
  }

  public function review_action(){
	$ceartion_date=date("Y-m-d H:i");
	$userid_review=$this->session->userdata('id_admin');
	$id_status=$this->input->post('id_status');
	$id_project=$this->input->post('id_project');
	$status=$this->input->post('status');
	$desc_ar=$this->input->post('desc_ar');
	$type=$this->input->post('type');
	$user_id=get_table_filed("tbl_tasks",array("id"=>$id_status),"user_id");
	$id_sender=	$this->session->userdata('id_admin');
	$status_review1=get_table_filed("tbl_tasks",array("id"=>$id_status),"status_review1");
	$status_review=get_table_filed("tbl_tasks",array("id"=>$id_status),"status_review");
	/*$user_name=get_table_filed("tbl_tasks",array("id"=>$id_status),"fname");*/



	if($status==2){

	if($type==0){
		$data['status_review'] =$status;
		$data['userid_review'] =$userid_review;
		if($status_review1==1){
		$data['status_review_id'] ='1';	
		}
		else if($status_review1==2){
		$data['status_review_id'] ='2';
		}
		$data['review_date'] = date("Y-m-d H:i:s");

		$task_review['id_task']=$id_status;
		$task_review['start_date']=date("Y-m-d H:i:");
		$task_review['type']=$type;
		$task_review['status']=$status;
		$this->db->insert("review_task_log",$task_review);

		if($user_id!=""){
			$task_notify['project_id']=$id_project;
			$task_notify['key_id']=5;
			$task_notify['notify']="تم مراجعة المهمة";
			$task_notify['create_date']=date("Y-m-d H:i");
			$task_notify['id_user']=$user_id;
			$task_notify['view']='0';
			$this->db->insert("notification",$task_notify);
			}
	}
	if($type==1){
		$data['userid_review1'] =$userid_review;
		$data['status_review1'] =$status;
		if($status_review==1){
			$data['status_review_id'] ='1';	
			}
			else if($status_review==2){
			$data['status_review_id'] ='2';
			}
		$data['review1_date'] = date("Y-m-d H:i");

		$task_review['id_task']=$id_status;
		$task_review['start_date']=date("Y-m-d H:i");
		$task_review['type']=$type;
		$task_review['status']=$status;
		$this->db->insert("review_task_log",$task_review);
		if($user_id!=""){
			$task_notify['project_id']=$id_project;
			$task_notify['key_id']=6;
			$task_notify['notify']="تم مراجعة المهمة";
			$task_notify['create_date']=date("Y-m-d H:i");
			$task_notify['id_user']=$user_id;
			$task_notify['view']='0';
			$this->db->insert("notification",$task_notify);
			}

	}
	$this->db->update("tbl_tasks",$data,array('id'=>$id_status));
}
else if($status==1){

	$data['status'] ='0';
	if($type==0){
		if($status_review1==1){
			$data['status_review_id'] ='1';	
			}
			else if($status_review1==2){
			$data['status_review_id'] =$status;
			}
		$data['userid_review'] =$userid_review;
		$data['review_date'] = date("Y-m-d H:i");
		$data['status_review'] =$status;
		$task_review['id_task']=$id_status;
		$task_review['start_date']=date("Y-m-d H:i");
		$task_review['type']=$type;
		$task_review['status']=$status;
		$this->db->insert("review_task_log",$task_review);
		if($user_id!=""){
			$task_notify['project_id']=$id_project;
			$task_notify['key_id']=5;
			$task_notify['notify']="تم مراجعة المهمة";
			$task_notify['create_date']=date("Y-m-d H:i");
			$task_notify['id_user']=$user_id;
			$task_notify['view']='0';
			$this->db->insert("notification",$task_notify);
			}
	}
	if($type==1){
		$data['userid_review1'] =$userid_review;
		$data['status_review1'] =$status;
		$data['review1_date'] = date("Y-m-d H:i");
		if($status_review==1){
			$data['status_review_id'] ='1';	
			}
			else if($status_review==2){
			$data['status_review_id'] =$status;
			}
		$task_review['id_task']=$id_status;
		$task_review['start_date']=date("Y-m-d H:i:");
		$task_review['type']=$type;
		$task_review['status']=$status;
		$this->db->insert("review_task_log",$task_review);
		if($user_id!=""){
			$task_notify['project_id']=$id_project;
			$task_notify['key_id']=6;
			$task_notify['notify']="تم مراجعة المهمة";
			$task_notify['create_date']=date("Y-m-d H:i");
			$task_notify['id_user']=$user_id;
			$task_notify['view']='0';
			$this->db->insert("notification",$task_notify);
			}
	}
	$this->db->update("tbl_tasks",$data,array('id'=>$id_status));
	if($desc_ar!=""){
	$notes_data['id_sender']=$id_sender;
	$notes_data['id_reciver']=$user_id;
	$notes_data['id_task']=$id_status;
	$notes_data['id_projects']=$id_project;
	$notes_data['notes']=$desc_ar;
	$notes_data['type']=$type;
	$notes_data['id_replay']=0;
	$this->db->insert("projects_notes",$notes_data);
	}
}


else if($status==0){
	if($type==0){
		$data['status_review_id'] =$status;
		$data['userid_review'] =$userid_review;
		$data['status_review'] =$status;
	}
	if($type==1){
		$data['status_review_id'] =$status;
		$data['userid_review1'] =$userid_review;
		$data['status_review1'] =$status;
	}
	$this->db->update("tbl_tasks",$data,array('id'=>$id_status));
}

$this->db->update("tbl_tasks",$data,array('id'=>$id_status));
 

if($id_status!=""){	
send_email($id_status,"task","change_review");
echo 1;
}
else {
echo 0;
}
}
	

    public function delete(){
        
        if($this->session->userdata('tasks_delete')=="tasks_delete"){
		$id_status = $this->input->get('id_status');
		$id_project = $this->input->get('id_project');
        $check=$this->input->post('check');

        if($id_status!=""){
	  send_email($id_status,"task","delete");
$ret_value=$this->data->delete_table_row('tbl_tasks',array('id'=>$id_status)); 
        }
     
        if(isset($check) && $check!=""){  
			$id_project = $this->input->post('id_project');

        $check=$this->input->post('check');
		$length=count($check);
        for($i=0;$i<$length;$i++){
          send_email($check[$i],"task","delete");
        $ret_value=$this->data->delete_table_row('tbl_tasks',array('id'=>$check[$i]));    
        }
        }
		$this->session->set_flashdata('msg', 'تم الحذف بنجاح');
		$this->session->mark_as_flash('msg');
		//$this->session->mark_as_temp('msg', 400);
	redirect(base_url().'admin/task/tasks?id_project='.$id_project,'refresh');
    }
    else {
        redirect(base_url().'admin/','refresh');	
    }
    }

    function active(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("tbl_tasks",array("id"=>$id,"active" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("tbl_tasks",array("active" => "0"),array("id"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("tbl_tasks",array("active" => "1"),array("id"=>$id));
            echo "1";
        } 
    }

    public function edit(){
		if($this->session->userdata('tasks_edit')=="tasks_edit"){
        $id=$this->input->get('id_status');
        $data['data'] = $this->data->get_table_data('tbl_tasks',array('id'=>$id));
		$this->load->view("admin/task/edit",$data); 
		}
		else {
			redirect(base_url().'admin/','refresh');	
		}
    }

    function edit_action(){
	
$id_user=$this->session->userdata('id_admin');
		$over_num_hrs=$this->input->post('over_num_hrs');
		$task_type_job=$this->input->post('task_type_job');
		$mydep=$this->input->post('mydep');
		$dep_id=$this->input->post('dep_id');

        $name_task=$this->input->post('name_task');
		$desc_ar=$this->input->post('desc_ar');
		$select_date=$this->input->post('select_date');
        $start_time=$this->input->post('start_time');
        $num_hrs=$this->input->post('num_hrs');
        $manager_id=$this->input->post('manager_id');
		$id_project=$this->input->post('id_project');
		$select_enddate=$this->input->post('select_enddate');
		$enddate=$this->input->post('enddate');
		$id=$this->input->post('id');
		$time_type=$this->input->post('time_type');
		$task_status_job=$this->input->post('task_status_job');
		

	$project_status=get_table_filed("tbl_projects",array("id"=>$id_project),"status");		
$count_task=get_table_filed("users_projects",array("id_projects"=>$id_project,'id_user'=>$manager_id),"count_task");
if($count_task!=""&&$manager_id!=""){
  $data_count_tasks['count_task']= $count_task+1;
  $data_count_tasks['status']=$project_status;
  $this->db->update("users_projects",$data_count_tasks,array("id_projects"=>$id_project,'id_user'=>$manager_id));
}
else if($manager_id!=""){
$data_count_tasks['count_task']=1; 
$data_count_tasks['id_projects']=$id_project; 
$data_count_tasks['id_user']=$manager_id; 
 $data_count_tasks['status']=$project_status;
$this->db->insert("users_projects",$data_count_tasks);    
}
		$sql_old_task=get_table_data('tbl_tasks',array('id'=>$id));
		foreach($sql_old_task as $sql_old_task){
		    $hrs_old=$sql_old_task->total_hrs;
				$creation_date= date("Y-m-d H:i:s");
			$task_log['task_id']=$sql_old_task->id;
			$task_log['name']=$sql_old_task->name;
			$task_log['user_id']=$sql_old_task->user_id;
			$task_log['main_task']=$sql_old_task->main_task;
			$task_log['start_date']=$sql_old_task->start_date;
			$task_log['review_date']=$sql_old_task->review_date;
			$task_log['review1_date']=$sql_old_task->review1_date;
			$task_log['finished_date']=$sql_old_task->finished_date;
			$task_log['status']=$sql_old_task->status;
			$task_log['status_review']=$sql_old_task->status_review;
			$task_log['status_review1']=$sql_old_task->status_review1;
			$task_log['total_hrs']=$sql_old_task->total_hrs;
			$task_log['ceartion_date']=date("Y-m-d H:i:s");
			
			$this->db->insert("tbl_tasks_log",$task_log);
			/////////////////////////////////
			if($manager_id!=""){
			$task_notify['project_id']=$sql_old_task->project_id;;
			$task_notify['notify']="يوجد تعديل فى  المهمة";
			$task_notify['create_date']=date("Y-m-d H:i");
			$task_notify['id_user']=$manager_id;
			$task_notify['view']='0';
			$this->db->insert("notification",$task_notify);
			}
			else if($sql_old_task->user_id!=""){
				$task_notify['project_id']=$sql_old_task->project_id;;
				$task_notify['key_id']=2;
				$task_notify['notify']="يوجد تعديل فى  المهمة";
				$task_notify['create_date']=date("Y-m-d H:i");
				$task_notify['id_user']=$sql_old_task->user_id;
				$task_notify['view']='0';
				$this->db->insert("notification",$task_notify);
				}
		}

		$data['project_id'] = $id_project;
        $data['name'] = $name_task;
		$data['create_date'] =$creation_date;
		
		if($manager_id!=""){$data['user_id'] = $manager_id;}
        $data['add_id'] = $id_user;
		$data['main_task'] = $desc_ar;
		$data['total_hrs'] =$num_hrs;
		$data['select_date'] = $select_date;
		$data['select_enddate'] = $select_enddate;
		$data['start_date'] = $start_time;
		$data['task_status'] = $task_status_job;

if($over_num_hrs!=""){
if($time_type_overtime==1){
$data['over_time_hrs'] =$over_num_hrs;
}
else  if($time_type_overtime==2){
$data['over_time_hrs'] =round($over_num_hrs/60,2);
}
}
$data['task_type'] = $task_type_job;
if($mydep==2){	$data['service_id'] = $dep_id;}
	
		if($select_enddate==1&&$select_date==2){
		      if($time_type==1){
		    $minutes=(float)$num_hrs*60;
		    }
		    else  if($time_type==2){
		       $minutes=(float)$num_hrs; 
		    }
		    else { $minutes=(float)$num_hrs*60;}
		   $data['select_enddate'] = 2;
			$calculation = date("Y-m-d H:i",strtotime("$start_time+ $minutes minutes"));
		}
		
		else	if($hrs_old!=$num_hrs&&$select_enddate==2&&$select_date==2){
		     if($time_type==1){
		    $minutes=(float)$num_hrs*60;
		    }
		    else  if($time_type==2){
		       $minutes=(float)$num_hrs; 
		    }
		    else { $minutes=(float)$num_hrs*60;}
		   $data['select_enddate'] = 2;
			$calculation = date("Y-m-d H:i",strtotime("$start_time+ $minutes minutes"));
		}
		
		else {$calculation=$enddate;$select_enddate==2;}
        $data['finished_date'] = $calculation;
		 $this->db->update('tbl_tasks',$data,array('id'=>$id));
	    
if($id!=""){	
 send_email($id,"task","edit");
echo 1;
}
else {
echo 0;
}
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
		
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
		
		$data['result'] = $users_tasks = $this->db->select('user_id as ids')
						->group_by('ids')
						->get_where('tbl_tasks',array('project_id'=>$id_project,'user_id!='=>""))
						->result();
		$data['data'] = $this->data->get_table_data('tbl_projects',array('id'=>$id_project));
       $this->load->view("admin/task/project_users",$data); 
	}










/***********************************************user_tasks*******************************************************/
	
		public function tasks_user(){
		$id_project=$this->input->get('id_project');
        $id_worker=$this->input->get('user_id');
		$user_id=$this->session->userdata('id_admin');
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
		
	$usersprojects=$this->db->get_where("users_projects",array('id_projects'=>$id_project))->result();
		if(count($usersprojects)>0){
		foreach($usersprojects as $usersprojects){
$id_user=$usersprojects->id_user;
$count_task=get_table_filed("users_projects",array('id_projects'=>$id_project,'id_user'=>$id_user),"count_task");
$total_task=$this->db->get_where("tbl_tasks",array('project_id'=>$id_project,'user_id'=>$id_user))->result();
    
    $total_minu=0;
    if($total_task!=$count_task){
	$this->db->select_sum('total_hrs');
    $this->db->from('tbl_tasks');
    $this->db->where('project_id',$id_project);
     $this->db->where('user_id',$id_user);
    $query_day= $this->db->get();
    $total_hrs= $query_day->row()->total_hrs;

 foreach($total_task as $totaltask){
    $total_minu=get_table_filed("user_task_log",array('id_task'=>$totaltask->id,'id_user'=>$id_user),"total_hrs")+$total_minu;
    }
    $final_hrs=round($total_minu/60);
    $data_user['count_task']=count($total_task);
    $data_user['total_hrs']=$total_hrs;
    $data_user['actual_time']=$final_hrs;
    $this->db->update('users_projects',$data_user,array('id_projects'=>$id_project,'id_user'=>$id_user));
    }
		    }
		}
		
		
    $tables = "tbl_tasks";
    $config = array();
    $config['base_url'] = base_url().'admin/task/tasks_user'; 
    	if($this->session->userdata('alltasks_user')=="alltasks_user"){
    $config['total_rows'] = $this->data->record_count($tables,array('project_id'=>$id_project,'user_id'=>$id_worker),'','id','desc');	    
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
 if($this->session->userdata('alltasks_user')=="alltasks_user"){   
$data["results"] = $this->data->view_all_data($tables, array('project_id'=>$id_project,'user_id'=>$id_worker), $config["per_page"], $page,'id','desc');
     
 }
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
endif;
 $this->load->view("admin/task/tasks_user", $data); 
  }




	public function user_tasks_wait(){
		$id_project=$this->input->get('id_project');
        $id_worker=$this->input->get('user_id');
		$user_id=$this->session->userdata('id_admin');
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
    $tables = "tbl_tasks";
    $config = array();
    $config['base_url'] = base_url().'admin/task/user_tasks_wait'; 
    	if($this->session->userdata('alltasks_user')=="alltasks_user"){
    $config['total_rows'] = $this->data->record_count($tables,array('project_id'=>$id_project,'status'=>'0','status_review_id'=>'0','user_id'=>$id_worker),'','id','desc');	    
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
 if($this->session->userdata('alltasks_user')=="alltasks_user"){   
$data["results"] = $this->data->view_all_data($tables, array('project_id'=>$id_project,'status'=>'0','status_review_id'=>'0','user_id'=>$id_worker), $config["per_page"], $page,'id','desc');
     
 }
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
endif;
 $this->load->view("admin/task/user_tasks_wait", $data); 
  }




public function user_tasks_working(){
		$id_project=$this->input->get('id_project');
        $id_worker=$this->input->get('user_id');
		$user_id=$this->session->userdata('id_admin');
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
    $tables = "tbl_tasks";
    $config = array();
    $config['base_url'] = base_url().'admin/task/user_tasks_working'; 
    	if($this->session->userdata('alltasks_user')=="alltasks_user"){
    $config['total_rows'] = $this->data->record_count($tables,array('project_id'=>$id_project,'status'=>'1','user_id'=>$id_worker),'','id','desc');	    
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
 if($this->session->userdata('alltasks_user')=="alltasks_user"){   
$data["results"] = $this->data->view_all_data($tables, array('project_id'=>$id_project,'status'=>'1','user_id'=>$id_worker), $config["per_page"], $page,'id','desc');
     
 }
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
endif;
 $this->load->view("admin/task/user_tasks_working", $data); 
  }




public function user_tasks_finished(){
		$id_project=$this->input->get('id_project');
        $id_worker=$this->input->get('user_id');
		$user_id=$this->session->userdata('id_admin');
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
    $tables = "tbl_tasks";
    $config = array();
    $config['base_url'] = base_url().'admin/task/user_tasks_finished'; 
    	if($this->session->userdata('alltasks_user')=="alltasks_user"){
    $config['total_rows'] = $this->data->record_count($tables,array('project_id'=>$id_project,'status'=>'2','status_review_id'=>'2','status_review1'=>'2','status_review'=>'2','user_id'=>$id_worker),'','id','desc');	    
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
 if($this->session->userdata('alltasks_user')=="alltasks_user"){   
$data["results"] = $this->data->view_all_data($tables, array('project_id'=>$id_project,'status'=>'2','status_review_id'=>'2','status_review1'=>'2','status_review'=>'2','user_id'=>$id_worker), $config["per_page"], $page,'id','desc');
     
 }
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
endif;
 $this->load->view("admin/task/user_tasks_finished", $data); 
  }


public function user_tasks_wait_review(){
		$id_project=$this->input->get('id_project');
        $id_worker=$this->input->get('user_id');
		$user_id=$this->session->userdata('id_admin');
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
    $tables = "tbl_tasks";
    $config = array();
    $config['base_url'] = base_url().'admin/task/user_tasks_wait_review'; 
    	if($this->session->userdata('alltasks_user')=="alltasks_user"){
    $config['total_rows'] = $this->data->record_count($tables,array('project_id'=>$id_project,'status'=>'2','status_review_id'=>'0','user_id'=>$id_worker),'','id','desc');	    
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
 if($this->session->userdata('alltasks_user')=="alltasks_user"){   
$data["results"] = $this->data->view_all_data($tables, array('project_id'=>$id_project,'status'=>'2','status_review_id'=>'0','user_id'=>$id_worker), $config["per_page"], $page,'id','desc');
     
 }
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
endif;
 $this->load->view("admin/task/user_tasks_wait_review", $data); 
  }




public function user_tasks_error(){
		$id_project=$this->input->get('id_project');
        $id_worker=$this->input->get('user_id');
		$user_id=$this->session->userdata('id_admin');
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
    $tables = "tbl_tasks";
    $config = array();
    $config['base_url'] = base_url().'admin/task/user_tasks_error'; 
    	if($this->session->userdata('alltasks_user')=="alltasks_user"){
    $config['total_rows'] = $this->data->record_count($tables,array('project_id'=>$id_project,'status_review_id'=>'1','user_id'=>$id_worker),'','id','desc');	    
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
 if($this->session->userdata('alltasks_user')=="alltasks_user"){   
$data["results"] = $this->data->view_all_data($tables, array('project_id'=>$id_project,'status_review_id'=>'1','user_id'=>$id_worker), $config["per_page"], $page,'id','desc');
     
 }
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
endif;
 $this->load->view("admin/task/user_tasks_error", $data); 
  }






public function status_task(){
      
      $monthly=$this->input->get('monthly');
      $task_type=$this->input->get('task_type');
        $task_status=$this->input->get('task_status');
		$id_project=$this->input->get('id_project');
		$user_id=$this->session->userdata('id_admin');
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
    $tables = "tbl_tasks";
    $config = array();
   
    $config['base_url'] = base_url().'admin/task/status_task'; 
    	if($this->session->userdata('tasks_view')=="tasks_view"){
if($monthly=="true"){
$config['total_rows'] = $this->data->record_count($tables,array('task_status'=>$task_status,'project_id'=>$id_project,'task_type'=>$task_type,'real_date>='=>date("Y-m-01"),'real_date<='=>date("Y-m-t")),'','id','desc');	        
    	    }
    	    else {
$config['total_rows'] = $this->data->record_count($tables,array('task_status'=>$task_status,'project_id'=>$id_project,'task_type'=>$task_type),'','id','desc');    	        
    	    }
    
    	}
    	else {
if($monthly=="true"){
$config['total_rows'] = $this->data->record_count($tables,array('task_status'=>$task_status,'project_id'=>$id_project,'task_type'=>$task_type,'user_id'=>$user_id,'real_date>='=>date("Y-m-01"),'real_date<='=>date("Y-m-t")),'','id','desc');      
    }
    else {
     $config['total_rows'] = $this->data->record_count($tables,array('task_status'=>$task_status,'project_id'=>$id_project,'task_type'=>$task_type,'user_id'=>$user_id),'','id','desc');     
    }
    	    
  	    
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
 	if($this->session->userdata('tasks_view')=="tasks_view"){   
 	    if($monthly=="true"){
 	        
$data["results"] = $this->data->view_all_data($tables, array('task_status'=>$task_status,'project_id'=>$id_project,'task_type'=>$task_type,'real_date>='=>date("Y-m-01"),'real_date<='=>date("Y-m-t")), $config["per_page"], $page,'id','desc'); 	        
    }
    
    else {
$data["results"] = $this->data->view_all_data($tables, array('task_status'=>$task_status,'project_id'=>$id_project,'task_type'=>$task_type), $config["per_page"], $page,'id','desc');
}
}
 else{
     if($monthly=="true"){
         
         $data["results"] = $this->data->view_all_data($tables, array('task_status'=>$task_status,'project_id'=>$id_project,'task_type'=>$task_type,'user_id'=>$user_id,'real_date>='=>date("Y-m-01"),'real_date<='=>date("Y-m-t")), $config["per_page"], $page,'id','desc');
    }
    else {
$data["results"] = $this->data->view_all_data($tables, array('task_status'=>$task_status,'project_id'=>$id_project,'task_type'=>$task_type,'user_id'=>$user_id), $config["per_page"], $page,'id','desc');
    }   
 }
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
endif;
 $this->load->view("admin/task/status_task", $data); 
  }



public function user_status_task(){
      	$id_worker=$this->input->get('user_id');
      $monthly=$this->input->get('monthly');
      $type_task=$this->input->get('type_task');
       $status_task=$this->input->get('status_task');
		$id_project=$this->input->get('id_project');
		$user_id=$this->session->userdata('id_admin');
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
    $tables = "tbl_tasks";
    $config = array();
   
    $config['base_url'] = base_url().'admin/task/user_status_task'; 
    	if($this->session->userdata('alltasks_user')=="alltasks_user"){
if($monthly=="true"){
$config['total_rows'] = $this->data->record_count($tables,array('task_status'=>$status_task,'user_id'=>$id_worker,'project_id'=>$id_project,'task_type'=>$type_task,'status'=>'2','real_date>='=>date("Y-m-01"),'real_date<='=>date("Y-m-t")),'','id','desc');	        
    	    }
    	    else {
$config['total_rows'] = $this->data->record_count($tables,array('task_status'=>$status_task,'user_id'=>$id_worker,'project_id'=>$id_project,'task_type'=>$type_task,'status'=>'2'),'','id','desc');    	        
    	    }
    
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
 	if($this->session->userdata('alltasks_user')=="alltasks_user"){   
 	    if($monthly=="true"){
 	        
$data["results"] = $this->data->view_all_data($tables, array('task_status'=>$status_task,'user_id'=>$id_worker,'project_id'=>$id_project,'task_type'=>$type_task,'status'=>'2','real_date>='=>date("Y-m-01"),'real_date<='=>date("Y-m-t")), $config["per_page"], $page,'id','desc'); 	        
    }
    
    else {
$data["results"] = $this->data->view_all_data($tables, array('task_status'=>$status_task,'project_id'=>$id_project,'task_type'=>$type_task,'status'=>'2'), $config["per_page"], $page,'id','desc');
}
}

$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
endif;
 $this->load->view("admin/task/user_status_task", $data); 
  }




public function statistics(){
		$id_project=$this->input->get('id_project');
		$task_type=$this->input->get('task_type');	
		$user_id=$this->session->userdata('id_admin');
		$startdate=$this->input->get('startdate');
		$enddate=$this->input->get('enddate');
		

    $tables = "tbl_tasks";
    $config = array();
    $monthly_date=date("Y-m-d");
    $config['base_url'] = base_url().'admin/task/statistics'; 
    	if($this->session->userdata('tasks_view')=="tasks_view"){
if($task_type!=""){
$config['total_rows'] = $this->data->record_count($tables,array('task_type'=>$task_type,'project_id'=>$id_project,'real_date>='=>$startdate,'real_date<='=>$enddate,'status'=>'2'),'','id','desc');
}   
else {
$config['total_rows'] = $this->data->record_count($tables,array('project_id'=>$id_project,'real_date>='=>$startdate,'real_date<='=>$enddate,'status'=>'2'),'','id','desc');
}
}
else {
if($task_type!=""){
$config['total_rows'] = $this->data->record_count($tables,array('task_type'=>$task_type,'project_id'=>$id_project,'real_date>='=>$startdate,'real_date<='=>$enddate,'status'=>'2','user_id'=>$user_id),'','id','desc');
}   
else {  	    
$config['total_rows'] = $this->data->record_count($tables,array('project_id'=>$id_project,'real_date>='=>$startdate,'real_date<='=>$enddate,'status'=>'2','user_id'=>$user_id),'','id','desc');	    
}
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
if($this->session->userdata('tasks_view')=="tasks_view"){   
    if($task_type!=""){
$data["results"] = $this->data->view_all_data($tables, array('task_type'=>$task_type,'project_id'=>$id_project,'status'=>'2','real_date>='=>$startdate,'real_date<='=>$enddate), $config["per_page"], $page,'id','desc');        
    }
    else {
$data["results"] = $this->data->view_all_data($tables, array('project_id'=>$id_project,'status'=>'2','real_date>='=>$startdate,'real_date<='=>$enddate), $config["per_page"], $page,'id','desc');
}
}
 else{
if($task_type!=""){
 $data["results"] = $this->data->view_all_data($tables, array('task_type'=>$task_type,'project_id'=>$id_project,'status'=>'2','real_date>='=>$startdate,'real_date<='=>$enddate,'user_id'=>$user_id), $config["per_page"], $page,'id','desc');       
    }
    else {
$data["results"] = $this->data->view_all_data($tables, array('project_id'=>$id_project,'status'=>'2','real_date>='=>$startdate,'real_date<='=>$enddate,'user_id'=>$user_id), $config["per_page"], $page,'id','desc');
    }    
 }
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
endif;
 $this->load->view("admin/task/statistics", $data); 
  }



public function fliter(){
		$id_project=$this->input->get('id_project');
		$task_type=$this->input->get('task_type');	
		$user_id=$this->session->userdata('id_admin');
		$startdate=$this->input->get('startdate');
		$enddate=$this->input->get('enddate');
		$id_worker=$this->input->get('user_id');

    $tables = "tbl_tasks";
    $config = array();
    $monthly_date=date("Y-m-d");
    $config['base_url'] = base_url().'admin/task/fliter'; 
    	if($this->session->userdata('tasks_view')=="tasks_view"){
if($task_type!=""){
$config['total_rows'] = $this->data->record_count($tables,array('task_type'=>$task_type,'project_id'=>$id_project,'user_id'=>$id_worker,'real_date>='=>$startdate,'real_date<='=>$enddate,'status'=>'2'),'','id','desc');
}   
else {
$config['total_rows'] = $this->data->record_count($tables,array('project_id'=>$id_project,'real_date>='=>$startdate,'user_id'=>$id_worker,'real_date<='=>$enddate,'status'=>'2'),'','id','desc');
}
}
else {
if($task_type!=""){
$config['total_rows'] = $this->data->record_count($tables,array('task_type'=>$task_type,'project_id'=>$id_project,'user_id'=>$id_worker,'real_date>='=>$startdate,'real_date<='=>$enddate,'status'=>'2','user_id'=>$user_id),'','id','desc');
}   
else {  	    
$config['total_rows'] = $this->data->record_count($tables,array('project_id'=>$id_project,'real_date>='=>$startdate,'user_id'=>$id_worker,'real_date<='=>$enddate,'status'=>'2','user_id'=>$user_id),'','id','desc');	    
}
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
if($this->session->userdata('tasks_view')=="tasks_view"){   
    if($task_type!=""){
$data["results"] = $this->data->view_all_data($tables, array('task_type'=>$task_type,'project_id'=>$id_project,'status'=>'2','user_id'=>$id_worker,'real_date>='=>$startdate,'real_date<='=>$enddate), $config["per_page"], $page,'id','desc');        
    }
    else {
$data["results"] = $this->data->view_all_data($tables, array('project_id'=>$id_project,'status'=>'2','real_date>='=>$startdate,'user_id'=>$id_worker,'real_date<='=>$enddate), $config["per_page"], $page,'id','desc');
}
}
 else{
if($task_type!=""){
 $data["results"] = $this->data->view_all_data($tables, array('task_type'=>$task_type,'project_id'=>$id_project,'status'=>'2','user_id'=>$id_worker,'real_date>='=>$startdate,'real_date<='=>$enddate,'user_id'=>$user_id), $config["per_page"], $page,'id','desc');       
    }
    else {
$data["results"] = $this->data->view_all_data($tables, array('project_id'=>$id_project,'status'=>'2','real_date>='=>$startdate,'real_date<='=>$enddate,'user_id'=>$user_id), $config["per_page"], $page,'id','desc');
    }    
 }
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
endif;
 $this->load->view("admin/task/fliter", $data); 
  }

	
}
