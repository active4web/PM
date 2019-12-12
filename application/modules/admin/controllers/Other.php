<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Other extends MX_Controller
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
        redirect(base_url().'admin/other/tasks','refresh');
    }

    public function tasks(){
		$notifications_id=$this->input->get('notifications_id');
		if($notifications_id!=""){
			$ret_value=$this->data->delete_table_row('notification',array('id'=>$notifications_id)); 
		}
		$user_id=$this->session->userdata('id_admin');
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
		
		if($this->session->userdata('view_allother_task')=="view_allother_task"){
		$pg_config['sql'] = $this->data->get_sql('other_tasks','','id','DESC');
		}
		else {
		$pg_config['sql'] = $this->data->get_sql('other_tasks',array('user_id'=>$user_id),'id','DESC');
		}
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/other/tasks", $data); 
	}
	
	
	
	
	
	
	
	
		public function tasks_user(){
			$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
		

    $tables = "other_tasks";
    $config = array();
    $config['base_url'] = base_url().'admin/other/tasks_user'; 
    	if($this->session->userdata('alltasks_user')=="alltasks_user"){
    	    $id_project=$this->input->get('user_id');
    $config['total_rows'] = $this->data->record_count($tables,array('user_id'=>$id_project),'','id','desc');
    	}
    	else {
    	     $id_project=$this->session->userdata('id_admin');
    $config['total_rows'] = $this->data->record_count($tables,array('user_id'=>$id_project,'user_id'=>$user_id),'','id','desc');	    
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
$data["results"] = $this->data->view_all_data($tables, array('user_id'=>$id_project), $config["per_page"], $page,'id','desc');
}
 else{
$data["results"] = $this->data->view_all_data($tables, array('user_id'=>$id_project,'user_id'=>$user_id), $config["per_page"], $page,'id','desc');
     
 }
$str_links = $this->pagination->create_links();
$data["links"] = explode('&nbsp;',$str_links);
endif;
 $this->load->view("admin/other/tasks_user", $data); 
  }

	
	public function tasks_finished(){
		
		$user_id=$this->session->userdata('id_admin');
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
		if($this->session->userdata('view_allother_task')=="view_allother_task"){
        $pg_config['sql'] = $this->data->get_sql('other_tasks',array('status'=>'2','status_review_id'=>'2','status_review1'=>'2','status_review'=>'2'),'id','DESC');
	}
	else {
		$pg_config['sql'] = $this->data->get_sql('other_tasks',array('status'=>'2','status_review_id'=>'2','status_review1'=>'2','status_review'=>'2','user_id'=>$user_id),'id','DESC');
	}
		$pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/other/tasks_finished", $data); 
	}
	
	public function tasks_working(){
	
		$user_id=$this->session->userdata('id_admin');
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
		if($this->session->userdata('view_allother_task')=="view_allother_task"){
		$pg_config['sql'] = $this->data->get_sql('other_tasks',array('status'=>'1'),'id','DESC');
	}
	else {
		$pg_config['sql'] = $this->data->get_sql('other_tasks',array('status'=>'1','user_id'=>$user_id),'id','DESC');
	}
        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/other/tasks_working", $data); 
	}
	public function tasks_error(){
		$user_id=$this->session->userdata('id_admin');
	
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
		if($this->session->userdata('view_allother_task')=="view_allother_task"){
		$pg_config['sql'] = $this->data->get_sql('other_tasks',array('status_review_id'=>'1'),'id','DESC');
		}
		else {
			$pg_config['sql'] = $this->data->get_sql('other_tasks',array('status_review_id'=>'1','user_id'=>$user_id),'id','DESC');
		}

        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/other/tasks_error", $data); 
	}
	public function tasks_wait_review(){
		$user_id=$this->session->userdata('id_admin');
		
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
		if($this->session->userdata('view_allother_task')=="view_allother_task"){
		$pg_config['sql'] = $this->data->get_sql('other_tasks',array('status'=>'2','status_review_id'=>'0'),'id','DESC');
		}
		else {
			$pg_config['sql'] = $this->data->get_sql('other_tasks',array('status'=>'2','status_review_id'=>'0','user_id'=>$user_id),'id','DESC');
		}

        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/other/tasks_wait_review", $data); 
	}


	public function tasks_wait(){
		$user_id=$this->session->userdata('id_admin');
		
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
		if($this->session->userdata('view_allother_task')=="view_allother_task"){
		$pg_config['sql'] = $this->data->get_sql('other_tasks',array('status'=>'0','status_review_id'=>'0'),'id','DESC');
		}
		else {
			$pg_config['sql'] = $this->data->get_sql('other_tasks',array('status'=>'0','status_review_id'=>'0','user_id'=>$user_id),'id','DESC');
		}

        $pg_config['per_page'] = 50;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/other/tasks_wait", $data); 
	}


    public function add(){
		$permission_array=get_permission();
		for($i=0; $i<count($permission_array); $i++){
		$this->session->set_userdata(array($permission_array[$i] => $permission_array[$i]));
		}
		//print_r($permission_array);
if($this->session->userdata('add_other_task')=="add_other_task"){
      $this->load->view("admin/other/add"); 
}
      	else {
			redirect(base_url().'admin/','refresh');	
		}
    }
	
	


    public function add_action(){
$creation_date= date("Y-m-d H:i:s");
$code=$this->gen_random_string();
$add_id=$this->session->userdata('id_admin');

        $name_task=$this->input->post('name_task');
		$desc_ar=$this->input->post('desc_ar');
		$select_date=$this->input->post('select_date');
        $start_time=$this->input->post('start_time');
        $num_hrs=$this->input->post('num_hrs');
		$manager_id=$this->input->post('manager_id');
		$user_id=$this->input->post('user_id');
		$select_enddate=$this->input->post('select_enddate');
		$enddate=$this->input->post('enddate');
		$type=$this->input->post('type');
		$time_type=$this->input->post('time_type');
				$time_type_overtime=$this->input->post('time_type_overtime');
		$over_num_hrs=$this->input->post('over_num_hrs');
		
		
        $data['name'] = $name_task;
		$data['create_date'] =$creation_date;
		$data['user_id'] = $user_id;
		$data['manager_id'] = $manager_id;
        $data['add_id'] = $add_id;
		$data['main_task'] = $desc_ar;
		$data['total_hrs'] =$num_hrs;
		$data['select_date'] = $select_date;
		$data['start_date'] = $start_time;

		if($select_enddate==1&&$select_date==2){
		    	     $break =get_table_filed('tbl_config',array('config_key'=>'break'),"config_value");
         	$start_work =get_table_filed('tbl_config',array('config_key'=>'start_work'),"config_value");
         		$totalhrs=(int)$break-(int)$start_work;
		     $start_time_h=date("H",strtotime($start_time));
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
		      if($start_time_h<$break&&$main_hrs>$totalhrs){$minutes=$minutes+30;}
		    	    else {$minutes=$minutes;}
		    	    
		   $data['select_enddate'] = 2;
			$calculation = date("Y-m-d H:i",strtotime("$start_time+ $minutes minutes"));
				$data['finished_date'] = $calculation;
				$data['start_date'] = $start_time;
				
			}
			else if($select_enddate==2&&$select_date==2) {
			     $start_time_h=date("H",strtotime($start_time));
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
		      if($start_time_h<$break&&$main_hrs>$totalhrs){$minutes=$minutes+30;}
		    	    else {$minutes=$minutes;}
			    
			    $calculation=$enddate;
			    $data['select_enddate'] = $select_enddate;
			    	$data['finished_date'] = $calculation;
			    	$data['start_date'] = $start_time;
			}
		
		if($over_num_hrs!=""){
		if($time_type_overtime==1){
		    $data['over_time_hrs'] =$over_num_hrs;
		    }
		    else  if($time_type_overtime==2){
		       $data['over_time_hrs'] =round($over_num_hrs/60,2);
		    }
}


         $this->db->insert('other_tasks',$data);
		$id = $this->db->insert_id();
		if($manager_id!=""){
			$task_notify['project_id']=$id;
			$task_notify['key_id']=10 ;
			$task_notify['notify']="تم اضافة مهمة اخرى جديدة";
			$task_notify['create_date']=date("Y-m-d H:i");
			$task_notify['id_user']=$manager_id;
			$task_notify['view']='0';
			$this->db->insert("notification",$task_notify);
			}
			if($user_id!=""){
				$task_notify_user['project_id']=$id;
				$task_notify_user['key_id']=10 ;
				$task_notify_user['notify']="تم اضافة مهمة اخرى جديدة";
				$task_notify_user['create_date']=date("Y-m-d H:i");
				$task_notify_user['id_user']=$user_id;
				$task_notify_user['view']='0';
				$this->db->insert("notification",$task_notify_user);
				}


if($id!=""){	
send_email($id,"other_task","add");
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
		$data['data'] = $this->data->get_table_data('review_other_task_log',array('id_task'=>$id_status));
		$this->load->view("admin/other/review_statistics",$data); 
  }


  public function user_statistics(){
	$id_status=$this->input->get('id');
	$data['data'] = $this->data->get_table_data('user_other_task_log',array('id_task'=>$id_status));
	$this->load->view("admin/other/user_statistics",$data); 
}

	public function change_status(){
			$id_status=$this->input->get('id_status');
			$id_project=$this->input->get('id_project');
			$data['data'] = $this->data->get_table_data('other_tasks',array('id'=>$id_status));
			$this->load->view("admin/other/change_status",$data); 
  	}

	  public function status_action(){
		$id_status=$this->input->post('id_status');
		$status=$this->input->post('status');
		$userid_review=$this->session->userdata('id_admin');
		$user_id=get_table_filed("other_tasks",array("id"=>$id_status),"user_id");
		$data['status'] = $status;

		if($status==2||$status==3){
		$data['real_enddate'] = date("Y-m-d H:i");
		$id_final=$this->db->limit(1)->order_by("id","desc")->get_where("user_other_task_log",array("id_task"=>$id_status))->result();
		foreach($id_final as $id_final)
		$id_final_log=$id_final->id;
		$start_date_log=$id_final->start_date;
		$status_log=$id_final->status;
$total_hrs=(strtotime(date("Y-m-d H:i"))-strtotime($start_date_log))/(60);
$task_log['total_hrs']=$total_hrs;


$data['real_enddate'] = date("Y-m-d H:i");
		$break =get_table_filed('tbl_config',array('config_key'=>'break'),"config_value");
		$end_break =get_table_filed('tbl_config',array('config_key'=>'end_break'),"config_value");
		$end_work =get_table_filed('tbl_config',array('config_key'=>'end_work'),"config_value");
		$start_work =get_table_filed('tbl_config',array('config_key'=>'start_work'),"config_value");
		$break_time =get_table_filed('tbl_config',array('config_key'=>'break_time'),"config_value");
	
	
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

		
if($start_date_h<$break&&$end_date_h>$end_break&&$end_date_d==$start_date_d&&$start_date_m==$end_date_m&&$start_date_y==$end_date_y){
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
 $task_log['total_hrs']=round($main_total_hrs);
}
/*************************************************************************/
/*************************************************************************/
/*************************************************************************/
/*************************************************************************/





$task_log['enddate']=date("Y-m-d H:i");
$task_log['status']=$status;
$this->db->update("user_other_task_log",$task_log,array("id"=>$id_final_log));	
		}
		else if($status==1){
			$task_log['id_task']=$id_status;
			$task_log['start_date']=date("Y-m-d H:i");
			$task_log['status']=$status;
			$task_log['id_user']=$user_id;
			$this->db->insert("user_other_task_log",$task_log);	
		    $data['real_startdate'] = date("Y-m-d H:i");
		}

if($user_id!=""){
			$task_notify['project_id']=$id_status;
			$task_notify['key_id']=10;
			$task_notify['notify']="يوجد تعديل فى حالة  مهمة";
			$task_notify['create_date']=date("Y-m-d H:i");
			$task_notify['id_user']=$user_id;
			$task_notify['view']='0';
			$this->db->insert("notification",$task_notify);
			}
			
$this->db->update("other_tasks",$data,array('id'=>$id_status));


if($id_status!=""){	
send_email($id_status,"other_task","change_status");
echo 1;
}
else {
echo 0;
}

	}



	public function start_date(){
		$id_status=$this->input->get('id_status');
		$data['data'] = $this->data->get_table_data('other_tasks',array('id'=>$id_status));
		$this->load->view("admin/other/start_date",$data); 
  }

	public function start_date_action(){
	$ceartion_date=date("Y-m-d H:i");
			$id_status=$this->input->post('id_status');
			$select_date=$this->input->post('select_date');
			$start_time=$this->input->post('start_time');
			$enddate=$this->input->post('enddate');
			$select_enddate=$this->input->post('select_enddate');
			$sql_old_task=get_table_data('other_tasks',array('id'=>$id_status));
			foreach($sql_old_task as $sql_old_task){
				if($sql_old_task->user_id!=""){
				$task_notify['project_id']=$sql_old_task->id;
				$task_notify['key_id']=11;
				$task_notify['notify']="يوجد تعديل فى توقيت المهمة";
				$task_notify['create_date']=$ceartion_date;
				$task_notify['id_user']=$sql_old_task->user_id;
				$task_notify['view']='0';
				$this->db->insert("notification",$task_notify);
				}
			}

			$total_hrs=get_table_filed("other_tasks",array("id"=>$id_status),"total_hrs");
			if($select_enddate==1&&$select_date==2){
			$calculation = date("Y-m-d H:i",strtotime("+".$total_hrs." hours", strtotime($start_time)));
			}
			else {$calculation=$enddate;}
			$data['finished_date']=$calculation ;
			$data['start_date'] = $start_time;
			$data['select_date'] =$select_date;
			$data['select_enddate'] =$select_enddate;
			$this->db->update("other_tasks",$data,array('id'=>$id_status));
			 send_email($id_status,"other_task","change_startdate");
			$this->session->set_flashdata('msg', 'تمت الإضافة بنجاح');
			$this->session->mark_as_flash('msg');
		//	$this->session->mark_as_temp('msg', 400);	
			redirect(base_url().'admin/other/tasks','refresh');
	}


	
	public function notes_reply(){
		$id_status=$this->input->get('id_status');
		$id_project=$this->input->get('id_project');
		$id_messg=$this->input->get('id_messg');
		$data['data'] = $this->data->get_table_data('tbl_tasks',array('id'=>$id_status));
		$this->load->view("admin/other/notes_reply",$data); 
  }


	public function change_review(){
		$id_status=$this->input->get('id_status');
		$data['data'] = $this->data->get_table_data('other_tasks',array('id'=>$id_status));
		$this->load->view("admin/other/change_review",$data); 
  }

  public function notes_reply_action(){
	$userid_review=$this->session->userdata('id_admin');
	$id_status=$this->input->post('id_status');
	$id_messg=$this->input->post('id_messg');
	$desc_ar=$this->input->post('desc_ar');
	$user_id=get_table_filed("other_tasks",array("id"=>$id_status),"user_id");
	$id_sender=	$this->session->userdata('id_admin');
	if($desc_ar!=""){
		$notes_data['id_sender']=$id_sender;
		$notes_data['id_reciver']=$user_id;
		$notes_data['id_task']=$id_status;
		$notes_data['notes']=$desc_ar;
		$notes_data['id_replay']=$id_messg;
		$this->db->insert("othertasks_notes",$notes_data);
		}
echo send_email($id_status,"other_task","change_review");
redirect(base_url()."admin/other/details?id_status=$id_status",'refresh');
  }

  public function review_action(){
	$ceartion_date=date("Y-m-d H:i");
	$userid_review=$this->session->userdata('id_admin');
	$id_status=$this->input->post('id_status');
	$status=$this->input->post('status');
	$desc_ar=$this->input->post('desc_ar');
	$type=$this->input->post('type');
	$user_id=get_table_filed("other_tasks",array("id"=>$id_status),"user_id");
	$id_sender=	$this->session->userdata('id_admin');
	$status_review1=get_table_filed("other_tasks",array("id"=>$id_status),"status_review1");
	$status_review=get_table_filed("other_tasks",array("id"=>$id_status),"status_review");
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
		$this->db->insert("review_other_task_log",$task_review);

		if($user_id!=""){
			$task_notify['project_id']=$id_status;
			$task_notify['key_id']=12;
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
		$this->db->insert("review_other_task_log",$task_review);
		if($user_id!=""){
			$task_notify['project_id']=$id_status;
			$task_notify['key_id']=12;
			$task_notify['notify']="تم مراجعة المهمة";
			$task_notify['create_date']=date("Y-m-d H:i");
			$task_notify['id_user']=$user_id;
			$task_notify['view']='0';
			$this->db->insert("notification",$task_notify);
			}
	}
	$this->db->update("other_tasks",$data,array('id'=>$id_status));
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
		$this->db->insert("review_other_task_log",$task_review);
		if($user_id!=""){
			$task_notify['project_id']=$id_status;
			$task_notify['key_id']=12;
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
		$this->db->insert("review_other_task_log",$task_review);
		if($user_id!=""){
			$task_notify['project_id']=$id_status;
			$task_notify['key_id']=12;
			$task_notify['notify']="تم مراجعة المهمة";
			$task_notify['create_date']=date("Y-m-d H:i");
			$task_notify['id_user']=$user_id;
			$task_notify['view']='0';
			$this->db->insert("notification",$task_notify);
			}
	}
	$this->db->update("other_tasks",$data,array('id'=>$id_status));
	if($desc_ar!=""){
	$notes_data['id_sender']=$id_sender;
	$notes_data['id_reciver']=$user_id;
	$notes_data['id_task']=$id_status;
	$notes_data['notes']=$desc_ar;
	$notes_data['type']=$type;
	$notes_data['id_replay']=0;
	$this->db->insert("othertasks_notes",$notes_data);
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
	$this->db->update("other_tasks",$data,array('id'=>$id_status));
}

$this->db->update("other_tasks",$data,array('id'=>$id_status));

if($id_status!=""){	
send_email($id_status,"other_task","change_review");
echo 1;
}
else {
echo 0;
}

}
	

    public function delete(){
		$id_status = $this->input->get('id_status');
        $check=$this->input->post('check');
        if($id_status!=""){
echo send_email($id_status,"other_task","delete");
$ret_value=$this->data->delete_table_row('other_tasks',array('id'=>$id_status)); 
        }
        if(isset($check) && $check!=""){  
        $check=$this->input->post('check');
		$length=count($check);
		 send_email($check[0],"other_task","delete");
        for($i=0;$i<$length;$i++){
        $ret_value=$this->data->delete_table_row('other_tasks',array('id'=>$check[$i]));    
        }
        }
		$this->session->set_flashdata('msg', 'تم الحذف بنجاح');
		$this->session->mark_as_flash('msg');
	//	$this->session->mark_as_temp('msg', 400);
        redirect(base_url().'admin/other/tasks','refresh');
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
		if($this->session->userdata('edit_other_task')=="edit_other_task"){
        $id=$this->input->get('id_status');
        $data['data'] = $this->data->get_table_data('other_tasks',array('id'=>$id));
		$this->load->view("admin/other/edit",$data); 
		}
		else {
			redirect(base_url().'admin/','refresh');	
		}
    }

    function edit_action(){
	
$id_user=$this->session->userdata('id_admin');
        $name_task=$this->input->post('name_task');
		$desc_ar=$this->input->post('desc_ar');
		$select_date=$this->input->post('select_date');
        $start_time=$this->input->post('start_time');
        $num_hrs=$this->input->post('num_hrs');
		$manager_id=$this->input->post('manager_id');
		$user_id=$this->input->post('user_id');
		$id_project=$this->input->post('id_project');
		$select_enddate=$this->input->post('select_enddate');
		$enddate=$this->input->post('enddate');
		$id=$this->input->post('id');
$creation_date= date("Y-m-d H:i:s");

		$sql_old_task=get_table_data('tbl_tasks',array('id'=>$id));
		foreach($sql_old_task as $sql_old_task){
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
			$task_log['ceartion_date']=date("Y-m-d H:i:s");
			$this->db->insert("tbl_othertasks_log",$task_log);
			/////////////////////////////////
			if($manager_id!=""){
				$task_notify['project_id']=$sql_old_task->project_ids;;
			$task_notify['notify']="يوجد تعديل فى  المهمة";
			$task_notify['create_date']=date("Y-m-d H:i");
			$task_notify['id_user']=$manager_id;
			$task_notify['key_id']=12;
			$task_notify['view']='0';
			$this->db->insert("notification",$task_notify);
			}
			else if($sql_old_task->user_id!=""){
				$task_notify['project_id']=$sql_old_task->project_id;;
				$task_notify['key_id']=12;
				$task_notify['notify']="يوجد تعديل فى  المهمة";
				$task_notify['create_date']=date("Y-m-d H:i");
				$task_notify['id_user']=$sql_old_task->user_id;
				$task_notify['view']='0';
				$this->db->insert("notification",$task_notify);
				}
		}

        $data['name'] = $name_task;
		$data['create_date'] =$creation_date;
	if($user_id!=""){
		$data['user_id'] =$user_id;
	}
	if($manager_id!=""){$data['manager_id'] =$manager_id;}
        $data['add_id'] = $id_user;
		$data['main_task'] = $desc_ar;
		$data['total_hrs'] =$num_hrs;
		$data['select_date'] = $select_date;
		$data['start_date'] = $start_time;
		if($select_enddate==1&&$select_date==2){
		$calculation = date("Y-m-d H:i",strtotime("+".$num_hrs." hours", strtotime($start_time)));
			$data['select_enddate'] =2;
		}
		else {$calculation=$enddate;
		    
		    	$data['select_enddate'] =$select_enddate;
		}
        $data['finished_date'] = $calculation;
		 $this->db->update('other_tasks',$data,array('id'=>$id));
	     
if($id!=""){	
 send_email($id,"other_task","edit");
echo 1;
}
else {
echo 0;
}
       
	}
	


	public function details(){
		$id_status = $this->input->get('id_status');
		$data['data'] = $this->data->get_table_data('other_tasks',array('id'=>$id_status));
		$data['notes'] = $this->db->order_by('id','desc')->get_where('othertasks_notes',array('id_task'=>$id_status,'id_replay'=>0))->result();
       $this->load->view("admin/other/details",$data); 
	}

	public function project_users(){
	//$id_status = $this->input->get('id_status');
		$id_project = $this->input->get('id_project');
		$data['result'] = $this->db->group_by("user_id")->get_where('tbl_tasks',array('project_id'=>$id_project,'user_id!='=>""))->result();
		$data['data'] = $this->data->get_table_data('tbl_projects',array('id'=>$id_project));
       $this->load->view("admin/task/project_users",$data); 
	}

	
}
