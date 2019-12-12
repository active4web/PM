<?php defined('BASEPATH') OR exit('No direct script access allowed');

function get_table_filed($table, $where = array() , $filed = null)
{
	$ci= & get_instance();
	$query = $ci->db->get_where($table, $where);
	foreach($query->result() as $row) {
		return $row->$filed;
	}
}

 function get_permission(){
	$ci= & get_instance();
	$type_admin=$ci->session->userdata('type_admin');
		$id_admin=$ci->session->userdata('id_admin');
	$permission=get_table_filed('tbl_user_groups',array('id'=>$type_admin),'permissions');
	//$permission=get_table_filed('tbl_user_groups',array('id'=>$type_admin),'key');
	$permission_array=explode(",",$permission);
	return $permission_array;
}


function remove_element(&$array,$value) {
 if(($key = array_search($value,$array)) !== false) {
       unset($array[$key]);
  }    
}

function get_sub($table,$filed,$where = array()) {
$ci= & get_instance();
 $ci->db->select_sum($filed);
    $ci->db->from($table);
    $ci->db->where($where);
    $query = $ci->db->get();
    return $query->row()->$filed;
}

function get_table_data($table, $where = array() , $limit = null, $order_field = null, $order_type = null)
	{
		$ci= & get_instance();
		$ci->db->where($where);
		if ($limit) $ci->db->limit($limit);
		if ($order_field) $ci->db->order_by($order_field, $order_type);
		$query = $ci->db->get($table);
		return $query->result();
	}

	
	
	function send_email($id_project,$service_type,$service_value)
	{
	    $ci= & get_instance();
	    $url_login=base_url()."admin";
	    $id_admin=$ci->session->userdata('id_admin');
			$sname=get_table_filed("tbl_users",array("id"=>$id_admin),"sname");
						$lname=get_table_filed("tbl_users",array("id"=>$id_admin),"lname");
						$fname=get_table_filed("tbl_users",array("id"=>$id_admin),"fname");
		$main_msg="";
                       if($service_value=="add"&& $service_type=="projects"){
							$projectname=get_table_filed("tbl_projects",array("id"=>$id_project),"name");
						$sname=get_table_filed("tbl_users",array("id"=>$id_admin),"sname");
						$lname=get_table_filed("tbl_users",array("id"=>$id_admin),"lname");
						$fname=get_table_filed("tbl_users",array("id"=>$id_admin),"fname");
						$main_msg="<div class='headerlgb'>  تم إضافة مشروع جديد باسم : $projectname </diV>";
						$main_msg.="<div class='headerlgb'> الموظف المسؤول عن العملية: $fname $sname $lname  </div>";
						$subject="اضافة مشروع";
					}
				
						if($service_value=="update"&& $service_type=="projects"){
						$projectname=get_table_filed("tbl_projects",array("id"=>$id_project),"name");
						$sname=get_table_filed("tbl_users",array("id"=>$id_admin),"sname");
						$lname=get_table_filed("tbl_users",array("id"=>$id_admin),"lname");
						$fname=get_table_filed("tbl_users",array("id"=>$id_admin),"fname");
	          $main_msg="<div class='headerlgb'>تم التعديل على مشروع : $projectname </diV>";
						$main_msg.="<div class='headerlgb'> الموظف المسؤول عن العملية: $fname $sname $lname  </div>";
						$subject="تعديل مشروع";
					}			
				
				
				        if($service_value=="delete"&& $service_type=="projects"){
						$projectname=get_table_filed("tbl_projects",array("id"=>$id_project),"name");
						$sname=get_table_filed("tbl_users",array("id"=>$id_admin),"sname");
						$lname=get_table_filed("tbl_users",array("id"=>$id_admin),"lname");
						$fname=get_table_filed("tbl_users",array("id"=>$id_admin),"fname");
						$main_msg="<div class='headerlgb'> تم حذف مشروع : $projectname </div>";
						$main_msg.="<div class='headerlgb'> الموظف المسؤول عن العملية: $fname $sname $lname </div>";
						$subject="حذف مشروع";
					}
				
				if($service_value=="edit"&& $service_type=="user"){
						$password=get_table_filed("tbl_users",array("id"=>$id_project),"txt_key");
						$login_email=get_table_filed("tbl_users",array("id"=>$id_project),"email");
						$group_id=get_table_filed("tbl_users",array("id"=>$id_project),"group_id");
						$group_name=get_table_filed("tbl_user_groups",array("id"=>$group_id),"name");
						$dep_id=get_table_filed("tbl_users",array("id"=>$id_project),"dep_id");
						$dep_name=get_table_filed("services_type",array("id"=>$dep_id),"name");
						$main_msg="<div class='headerlgb5'>تم تعديل حساب موظف  بنجاح وبيانات الموظف هي:</div>";
						$main_msg.="<div class='headerlgb5'>اسم المستخدم: $login_email</div>";
						$main_msg.="<div class='headerlgb5'> كلمة المرور: $password </div>";
						$main_msg.="<div class='headerlgb5'> المسمى الوظيفى: $group_name </div>";
						$main_msg.="<div class='headerlgb5'> التخصص : $dep_name </div>";
						$main_msg.="<div style='height: 17px;'></div>";
						$main_msg.="<div class='headerlgb'> الموظف المسؤول عن العملية: $fname $sname $lname </div>";
						$subject="تعديل موظف";
					}
					
					if($service_value=="add"&& $service_type=="user"){
					
						$password=get_table_filed("tbl_users",array("id"=>$id_project),"txt_key");
						$login_email=get_table_filed("tbl_users",array("id"=>$id_project),"email");
						$group_id=get_table_filed("tbl_users",array("id"=>$id_project),"group_id");
						$group_name=get_table_filed("tbl_user_groups",array("id"=>$group_id),"name");
						$dep_id=get_table_filed("tbl_users",array("id"=>$id_project),"dep_id");
						$dep_name=get_table_filed("services_type",array("id"=>$dep_id),"name");
						$main_msg="<div class='headerlgb5'>تم إنشاء حساب موظف جديد بنجاح وبيانات الموظف هي:</div>";
						$main_msg.="<div class='headerlgb5'>اسم المستخدم: $login_email</div>";
						$main_msg.="<div class='headerlgb5'> كلمة المرور: $password </div>";
						$main_msg.="<div class='headerlgb5'> المسمى الوظيفى: $group_name </div>";
						$main_msg.="<div class='headerlgb5'> التخصص : $dep_name </div>";
						$main_msg.="<div style='height: 17px;'></div>";
						$main_msg.="<div class='headerlgb'> الموظف المسؤول عن العملية: $fname $sname $lname </div>";
						$subject="اضافة موظف";

					}
					

					if($service_value=="edit"&& $service_type=="task"){
						$taskname=get_table_filed("tbl_tasks",array("id"=>$id_project),"name");
						$main_task=get_table_filed("tbl_tasks",array("id"=>$id_project),"main_task");
						$finished_date=get_table_filed("tbl_tasks",array("id"=>$id_project),"finished_date");
						$start_date=get_table_filed("tbl_tasks",array("id"=>$id_project),"start_date");
						$select_date=get_table_filed("tbl_tasks",array("id"=>$id_project),"select_date");
						$select_enddate=get_table_filed("tbl_tasks",array("id"=>$id_project),"select_enddate");
						if($select_date==1){$main_start="غير معلوم";}else{$main_start=$start_date;}
						if($select_enddate==1){$main_end="غير معلوم"; } else {$main_end=$finished_date;}
						$total_hrs=get_table_filed("tbl_tasks",array("id"=>$id_project),"total_hrs");
						$project_id=get_table_filed("tbl_tasks",array("id"=>$id_project),"project_id");
						$project_name=get_table_filed("tbl_projects",array("id"=>$project_id),"name");
						$main_old=$ci->db->order_by("id","desc")->limit(1)->get_where("tbl_tasks_log",array("task_id"=>$id_project))->result();
						foreach($main_old as $main_old){
						 $oldmain_task=$main_old->main_task;
						  $oldfinished_date=$main_old->finished_date;
						   $oldstart_date=$main_old->start_date;
						   $oldtotal_hrs=$main_old->total_hrs;
						 $oldfname=$main_old->name;
						  if($oldfname!=$taskname){$edittypename=1;} else {$edittypename=0;}
						  if($oldmain_task!=$main_task){$edittypedescription=1;}    else {$edittypedescription=0;}
						  if($oldfinished_date!=$finished_date){$finaldate=1;} else {$finaldate=0;}
						   if($oldtotal_hrs!=$total_hrs){$thrs=1;} else {$thrs=0;}
						  if($oldstart_date!=$start_date){$startdate=1;} else {$startdate=0;}
						}
	 if($edittypedescription!=0&&$edittypename!=0){
						 $main_msg=" <div class='headerlgb5'>تم تعديل المهمة :$taskname  </div>";
						 $main_msg.=" <div class='headerlgb5'>من مشروع".":".$project_name."</div>";
						 $main_msg.="<div style='height:25px;'></div>";
						    }


						if($edittypename!=0){
						 if($edittypedescription==0&&$edittypename!=0){
						 $main_msg=" <div class='headerlgb5'>تم تعديل المهمة :$taskname  </div>";
						 $main_msg.=" <div class='headerlgb5'>من مشروع".":".$project_name."</div>";
						 $main_msg.="<div style='height:25px;'></div>";
						    }
						$main_msg.=" <div class='headerlgb5'>نوع التعديل:"." "." اسم المهمة</div>";
						$main_msg.=" <div class='headerlgb5'>قبل التعديل:"." ".$oldfname."</div>";
            $main_msg.=" <div class='headerlgb5'>بعد التعديل:"." ".$taskname."</div>";
						if($edittypedescription!=0&&!$edittypename!=0){$main_msg.="<div style='height:25px;'></div>";}
						else {	$main_msg.="<div style='height:15px;'></div>";}
						}
							
						if($edittypedescription!=0){

		    if($edittypedescription!=0&&$edittypename==0){
						 $main_msg=" <div class='headerlgb5'>تم تعديل المهمة :$taskname  </div>";
						 $main_msg.=" <div class='headerlgb5'>من مشروع".":".$project_name."</div>";
						 $main_msg.="<div style='height:25px;'></div>";
						    }

						$main_msg.=" <div class='headerlgb5'>نوع التعديل: وصف الهمة</div>";
						$main_msg.=" <div class='headerlgb5'>قبل التعديل:"." ".$oldmain_task."</div>";
             $main_msg.="<div class='headerlgb5'>بعد التعديل:"." ".$main_task."</div>";
						 $main_msg.="<div style='height:15px;'></div>";

						if(($thrs!=0||$startdate!=0)&&!$edittypename!=0){$main_msg.="<div style='height:25px;'></div>";}
						else {	$main_msg.="<div style='height:15px;'></div>";}
						 
						}
						if($thrs!=0||$startdate!=0){
						    if($edittypedescription==0&&$edittypename==0){
						 $main_msg=" <div class='headerlgb5'>تم تعديل تاريخ المهمة:$taskname  </div>";
						 $main_msg.=" <div class='headerlgb5'>من مشروع".":".$project_name."</div>";

						 $main_msg.="<div style='height:25px;'></div>";
						    }
						$main_msg.=" <div class='headerlgb5'>تاريخ البداية السابق".":".$oldstart_date."</div>";
						$main_msg.=" <div class='headerlgb5'>تاريخ البداية الجديد".":".$start_date."</div>";
						$main_msg.="<div style='height:15px;'></div>";
						$main_msg.=" <div class='headerlgb5'>تاريخ النهاية السابق".":".$oldfinished_date."</div>";
						$main_msg.=" <div class='headerlgb5'>تاريخ النهاية الجديد".":".$finished_date."</div>";
						$main_msg.="<div style='height:15px;'></div>";
						$main_msg.=" <div class='headerlgb5'>عدد الساعات السابق".":".$oldtotal_hrs."</div>";
						$main_msg.="<div class='headerlgb5'>عدد الساعات الجديد".":".$total_hrs."</div>";
						$main_msg.="<div style='height:15px;'></div>";
						}
						
					$main_msg.=" <div class='headerlgb'> الموظف المسؤول عن العملية: $fname $sname $lname</div>";
					$subject="اضافة مهمة جديدة";
                              }


						if($service_value=="add"&& $service_type=="task"){
						$taskname=get_table_filed("tbl_tasks",array("id"=>$id_project),"name");
						$main_task=get_table_filed("tbl_tasks",array("id"=>$id_project),"main_task");
						$finished_date=get_table_filed("tbl_tasks",array("id"=>$id_project),"finished_date");
						$start_date=get_table_filed("tbl_tasks",array("id"=>$id_project),"start_date");
						$select_date=get_table_filed("tbl_tasks",array("id"=>$id_project),"select_date");
						$select_enddate=get_table_filed("tbl_tasks",array("id"=>$id_project),"select_enddate");
						if($select_date==1){$main_start="غير معلوم";}else{$main_start=$start_date;}
						if($select_enddate==1){$main_end="غير معلوم"; } else {$main_end=$finished_date;}
						$total_hrs=get_table_filed("tbl_tasks",array("id"=>$id_project),"total_hrs");
						$project_id=get_table_filed("tbl_tasks",array("id"=>$id_project),"project_id");
						$project_name=get_table_filed("tbl_projects",array("id"=>$project_id),"name");
						$main_msg.=" <div class='headerlgb5'>تم إضافة مهمة جديدة في مشروع:"." ".$project_name."</div>";
								$main_msg.="<div style='height:25px;'></div>";
						$main_msg.=" <div class='headerlgb5'>المهمة:"." ".$taskname."</div>";
                     	$main_msg.=" <div class='headerlgb5'>وصف المهمة:"." ".$main_task."</div>";
						$main_msg.=" <div class='headerlgb5'>عدد ساعات المهمة:"." ".$total_hrs ."</div>";
						$main_msg.=" <div class='headerlgb5'>تاريخ بداية المهمة :"." ".$main_start ."</div>";
						$main_msg.=" <div class='headerlgb5'>تاريخ انتهاء المهمة :"." ".$main_end ."</div>";
							$main_msg.="<div style='height:15px;'></div>";
						$main_msg.="<div class='headerlgb'>الموظف المسؤول عن العملية: $fname $sname $lname </div>";
						$subject="إضافة مهمة ";
						}



						if($service_value=="delete"&& $service_type=="task"){
						$taskname=get_table_filed("tbl_tasks",array("id"=>$id_project),"name");
						$project_id=get_table_filed("tbl_tasks",array("id"=>$id_project),"project_id");
						$project_name=get_table_filed("tbl_projects",array("id"=>$project_id),"name");
						$main_msg.=" <div class='headerlgb5'>تم حذف المهمة:"." ".$taskname."</div>";
						$main_msg.=" <div class='headerlgb5'>من مشروع:"." ".$project_name."</div>";
						$main_msg.="<div style='height:15px;'></div>";
						$main_msg.="<div class='headerlgb'>الموظف المسؤول عن العملية: $fname $sname $lname </div>";
						$subject="حذف مهمة";
						}



						if($service_value=="change_startdate"&& $service_type=="task"){
					$taskname=get_table_filed("tbl_tasks",array("id"=>$id_project),"name");
						$total_hrs=get_table_filed("tbl_tasks",array("id"=>$id_project),"total_hrs");
						$project_id=get_table_filed("tbl_tasks",array("id"=>$id_project),"project_id");
						$project_name=get_table_filed("tbl_projects",array("id"=>$project_id),"name");
					$start_date=get_table_filed("tbl_tasks",array("id"=>$id_project),"start_date");
						$finished_date=get_table_filed("tbl_tasks",array("id"=>$id_project),"finished_date");
						$select_date=get_table_filed("tbl_tasks",array("id"=>$id_project),"select_date");
						$select_enddate=get_table_filed("tbl_tasks",array("id"=>$id_project),"select_enddate");
						if($select_date==1){$main_start="غير معلوم";}else{$main_start=$start_date;}
						if($select_enddate==1){$main_end="غير معلوم"; } else {$main_end=$finished_date;}
						$total_hrs=get_table_filed("tbl_tasks",array("id"=>$id_project),"total_hrs");

						$main_old=$ci->db->order_by("id","desc")->limit(1)->get_where("tbl_tasks_log",array("task_id"=>$id_project))->result();
						foreach($main_old as $main_old){
						 $oldstart_date		=$main_old->start_date		;
						 $oldfinished_date		=$main_old->finished_date		;
						}
						
						$main_msg=" <div class='headerlgb5'>تم تعديل تاريخ المهمة:$taskname  </div>";
						$main_msg.=" <div class='headerlgb5'>من مشروع".":".$project_name."</div>";
						$main_msg.="<div style='height:25px;'></div>";
						$main_msg.=" <div class='headerlgb5'>تاريخ البداية السابق".":".$oldstart_date."</div>";
						$main_msg.=" <div class='headerlgb5'>تاريخ البداية الجديد".":".$main_start."</div>";
												$main_msg.="<div style='height:25px;'></div>";

						$main_msg.=" <div class='headerlgb5'>تاريخ النهاية السابق".":".$oldfinished_date."</div>";
						$main_msg.=" <div class='headerlgb5'>تاريخ النهاية الجديد".":".$main_end."</div>";
												$main_msg.="<div style='height:25px;'></div>";

						$main_msg.=" <div class='headerlgb5'>عدد الساعات السابق".":".$total_hrs."</div>";
						$main_msg.=" <div class='headerlgb5'>عدد الساعات الجديد".":".$total_hrs."</div>";
						$main_msg.="<div style='height:15px;'></div>";
						$main_msg.=" <div class='headerlgb'>الموظف المسؤول عن العملية: $fname $sname $lname </div>";
						$subject="تغير تاريخ مهمة";
						

						}

						if($service_value=="change_status"&& $service_type=="task"){
							$taskname=get_table_filed("tbl_tasks",array("id"=>$id_project),"name");
						$total_hrs=get_table_filed("tbl_tasks",array("id"=>$id_project),"total_hrs");
						$project_id=get_table_filed("tbl_tasks",array("id"=>$id_project),"project_id");
						$project_name=get_table_filed("tbl_projects",array("id"=>$project_id),"name");
						$start_date=get_table_filed("tbl_tasks",array("id"=>$id_project),"start_date");
						$status	=get_table_filed("tbl_tasks",array("id"=>$id_project),"status");
						$oldstatus	=get_table_filed("tbl_tasks",array("id"=>$id_project),"oldstatus");
						
						 	switch($oldstatus){case 0:
													  $oldstatus="لم تبدا";
													  break;
													case 1:
													  $oldstatus="قيد العمل";
													  break;
													  case 2:
													  $oldstatus="تم الانتهاء";
													  break;
													default:
													  break; 
												}
					
						switch($status){case 0:
													  $status="لم تبدا";
													  break;
													case 1:
													  $status="قيد العمل";
													  break;
													  case 2:
													  $status="تم الانتهاء";
													  break;
													default:
													  break; 
												}
							$main_msg="  <div class='headerlgb5'>تم تعديل حالة المهمة : $taskname     </div>";
							$main_msg.="  <div class='headerlgb5'>من مشروع".":".$project_name."</div>";
							$main_msg.="<div style='height:25px;'></div>";
						$main_msg.="  <div class='headerlgb5'>الحالة السابقة".":".$oldstatus."</div>";
						$main_msg.="  <div class='headerlgb5'>الحالة الحالية".":".$status."</div>";
						$main_msg.="<div style='height:15px;'></div>";
						$main_msg.="  <div class='headerlgb'>الموظف المسؤول عن العملية: $fname $sname $lname </div>";
						$subject="تغير حالة مهمة";


						}

						if($service_value=="change_review"&& $service_type=="task"){
						$taskname=get_table_filed("tbl_tasks",array("id"=>$id_project),"name");
						$finished_date=get_table_filed("tbl_tasks",array("id"=>$id_project),"finished_date");
						$start_date=get_table_filed("tbl_tasks",array("id"=>$id_project),"start_date");
						$finished_date=get_table_filed("tbl_tasks",array("id"=>$id_project),"finished_date");
						$select_date=get_table_filed("tbl_tasks",array("id"=>$id_project),"select_date");
						$select_enddate=get_table_filed("tbl_tasks",array("id"=>$id_project),"select_enddate");
						if($select_date==1){$main_start="غير معلوم";}else{$main_start=$start_date;}
						if($select_enddate==1){$main_end="غير معلوم"; } else {$main_end=$finished_date;}
						$total_hrs=get_table_filed("tbl_tasks",array("id"=>$id_project),"total_hrs");
						$project_id=get_table_filed("tbl_tasks",array("id"=>$id_project),"project_id");
						$project_name=get_table_filed("tbl_projects",array("id"=>$project_id),"name");
						$main_msg.=" <div class='headerlgb5'>تم مراجعة المهمة:"." ".$taskname."</div>";
						$main_msg.="  <div class='headerlgb5'>من مشروع:"." ".$project_name."</div>";
							$main_msg.="<div style='height:25px;'></div>";
						$main_msg.="  <div class='headerlgb5'>عدد الساعات:"." ".$total_hrs ."</div>";
						$main_msg.="  <div class='headerlgb5'>تاريخ البداية  :"." ".$main_start ."</div>";
						$main_msg.="  <div class='headerlgb5'>تاريخ النهاية  :"." ".$main_end ."</div>";
							$main_msg.="<div style='height:15px;'></div>";
						$main_msg.="  <div class='headerlgb'>الموظف المسؤول عن العملية: $fname $sname $lname </div>";
						$subject="مراجعة مهمة";
						}






					if($service_value=="edit"&& $service_type=="other_task"){
						$taskname=get_table_filed("other_tasks",array("id"=>$id_project),"name");
						$main_task=get_table_filed("other_tasks",array("id"=>$id_project),"main_task");
						$finished_date=get_table_filed("other_tasks",array("id"=>$id_project),"finished_date");
						$start_date=get_table_filed("other_tasks",array("id"=>$id_project),"start_date");
						$select_date=get_table_filed("other_tasks",array("id"=>$id_project),"select_date");
						$select_enddate=get_table_filed("other_tasks",array("id"=>$id_project),"select_enddate");
						if($select_date==1){$main_start="غير معلوم";}else{$main_start=$start_date;}
						if($select_enddate==1){$main_end="غير معلوم"; } else {$main_end=$finished_date;}
						$total_hrs=get_table_filed("other_tasks",array("id"=>$id_project),"total_hrs");
						
						$main_old=$ci->db->order_by("id","desc")->limit(1)->get_where("user_other_task_log",array("task_id"=>$id_project))->result();
						foreach($main_old as $main_old){
						 $oldmain_task=$main_old->main_task;
						  $oldfinished_date=$main_old->finished_date;
						   $oldstart_date=$main_old->start_date;
						   $oldtotal_hrs=$main_old->total_hrs;
						 $oldfname=$main_old->name;
						  if($oldfname!=$taskname){$edittypename=1;} else {$edittypename=0;}
						  if($oldmain_task!=$main_task){$edittypedescription=1;}    else {$edittypedescription=0;}
						  if($oldfinished_date!=$finished_date){$finaldate=1;} else {$finaldate=0;}
						   if($oldtotal_hrs!=$total_hrs){$thrs=1;} else {$thrs=0;}
						  if($oldstart_date!=$start_date){$startdate=1;} else {$startdate=0;}
						}
	 if($edittypedescription!=0&&$edittypename!=0){
						 $main_msg=" <div class='headerlgb5'>تم تعديل المهمة :$taskname  </div>";
						 $main_msg.=" <div class='headerlgb5'>من مشروع".":".$project_name."</div>";
						 $main_msg.="<div style='height:25px;'></div>";
						    }


						if($edittypename!=0){
						 if($edittypedescription==0&&$edittypename!=0){
						 $main_msg=" <div class='headerlgb5'>تم تعديل المهمة :$taskname  </div>";
						 $main_msg.="<div style='height:25px;'></div>";
						    }
						$main_msg.=" <div class='headerlgb5'>نوع التعديل:"." "." اسم المهمة</div>";
						$main_msg.=" <div class='headerlgb5'>قبل التعديل:"." ".$oldfname."</div>";
            $main_msg.=" <div class='headerlgb5'>بعد التعديل:"." ".$taskname."</div>";
						if($edittypedescription!=0&&!$edittypename!=0){$main_msg.="<div style='height:25px;'></div>";}
						else {	$main_msg.="<div style='height:15px;'></div>";}
						}
							
						if($edittypedescription!=0){

		    if($edittypedescription!=0&&$edittypename==0){
						 $main_msg=" <div class='headerlgb5'>تم تعديل المهمة :$taskname  </div>";
						 $main_msg.="<div style='height:25px;'></div>";
						    }

						$main_msg.=" <div class='headerlgb5'>نوع التعديل: وصف الهمة</div>";
						$main_msg.=" <div class='headerlgb5'>قبل التعديل:"." ".$oldmain_task."</div>";
             $main_msg.="<div class='headerlgb5'>بعد التعديل:"." ".$main_task."</div>";
						 $main_msg.="<div style='height:15px;'></div>";

						if(($thrs!=0||$startdate!=0)&&!$edittypename!=0){$main_msg.="<div style='height:25px;'></div>";}
						else {	$main_msg.="<div style='height:15px;'></div>";}
						 
						}
						if($thrs!=0||$startdate!=0){
						    if($edittypedescription==0&&$edittypename==0){
						 $main_msg=" <div class='headerlgb5'>تم تعديل تاريخ المهمة:$taskname  </div>";
						 $main_msg.=" <div class='headerlgb5'>من مشروع".":".$project_name."</div>";

						 $main_msg.="<div style='height:25px;'></div>";
						    }
						$main_msg.=" <div class='headerlgb5'>تاريخ البداية السابق".":".$oldstart_date."</div>";
						$main_msg.=" <div class='headerlgb5'>تاريخ البداية الجديد".":".$start_date."</div>";
						$main_msg.="<div style='height:15px;'></div>";
						$main_msg.=" <div class='headerlgb5'>تاريخ النهاية السابق".":".$oldfinished_date."</div>";
						$main_msg.=" <div class='headerlgb5'>تاريخ النهاية الجديد".":".$finished_date."</div>";
						$main_msg.="<div style='height:15px;'></div>";
						$main_msg.=" <div class='headerlgb5'>عدد الساعات السابق".":".$oldtotal_hrs."</div>";
						$main_msg.="<div class='headerlgb5'>عدد الساعات الجديد".":".$total_hrs."</div>";
						$main_msg.="<div style='height:15px;'></div>";
						}
						
					$main_msg.=" <div class='headerlgb'> الموظف المسؤول عن العملية: $fname $sname $lname</div>";
					$subject="تعديل فى مهمة اخرى";
                              }


						if($service_value=="add"&& $service_type=="other_task"){
						$taskname=get_table_filed("other_tasks",array("id"=>$id_project),"name");
						$main_task=get_table_filed("other_tasks",array("id"=>$id_project),"main_task");
						$finished_date=get_table_filed("other_tasks",array("id"=>$id_project),"finished_date");
						$start_date=get_table_filed("other_tasks",array("id"=>$id_project),"start_date");
						$select_date=get_table_filed("other_tasks",array("id"=>$id_project),"select_date");
						$select_enddate=get_table_filed("other_tasks",array("id"=>$id_project),"select_enddate");
						if($select_date==1){$main_start="غير معلوم";}else{$main_start=$start_date;}
						if($select_enddate==1){$main_end="غير معلوم"; } else {$main_end=$finished_date;}
						$total_hrs=get_table_filed("other_tasks",array("id"=>$id_project),"total_hrs");
						
						$main_msg.=" <div class='headerlgb5'>تم إضافة مهمة جديدة  :</div>";
								$main_msg.="<div style='height:25px;'></div>";
						$main_msg.=" <div class='headerlgb5'>المهمة:"." ".$taskname."</div>";
                     	$main_msg.=" <div class='headerlgb5'>وصف المهمة:"." ".$main_task."</div>";
						$main_msg.=" <div class='headerlgb5'>عدد ساعات المهمة:"." ".$total_hrs ."</div>";
						$main_msg.=" <div class='headerlgb5'>تاريخ بداية المهمة :"." ".$main_start ."</div>";
						$main_msg.=" <div class='headerlgb5'>تاريخ انتهاء المهمة :"." ".$main_end ."</div>";
							$main_msg.="<div style='height:15px;'></div>";
						$main_msg.="<div class='headerlgb'>الموظف المسؤول عن العملية: $fname $sname $lname </div>";
						$subject="إضافة مهمة اخرى";
						}



						if($service_value=="delete"&& $service_type=="other_task"){
						$taskname=get_table_filed("other_tasks",array("id"=>$id_project),"name");
						
						$main_msg.=" <div class='headerlgb5'>تم حذف المهمة:"." ".$taskname."</div>";
						$main_msg.="<div style='height:15px;'></div>";
						$main_msg.="<div class='headerlgb'>الموظف المسؤول عن العملية: $fname $sname $lname </div>";
						$subject="حذف مهمة اخرى";
						}



						if($service_value=="change_startdate"&& $service_type=="other_task"){
					$taskname=get_table_filed("other_tasks",array("id"=>$id_project),"name");
						$total_hrs=get_table_filed("other_tasks",array("id"=>$id_project),"total_hrs");
						
					$start_date=get_table_filed("other_tasks",array("id"=>$id_project),"start_date");
						$finished_date=get_table_filed("other_tasks",array("id"=>$id_project),"finished_date");
						$select_date=get_table_filed("other_tasks",array("id"=>$id_project),"select_date");
						$select_enddate=get_table_filed("other_tasks",array("id"=>$id_project),"select_enddate");
						if($select_date==1){$main_start="غير معلوم";}else{$main_start=$start_date;}
						if($select_enddate==1){$main_end="غير معلوم"; } else {$main_end=$finished_date;}
						$total_hrs=get_table_filed("other_tasks",array("id"=>$id_project),"total_hrs");

						$main_old=$ci->db->order_by("id","desc")->limit(1)->get_where("user_other_task_log",array("task_id"=>$id_project))->result();
						foreach($main_old as $main_old){
						 $oldstart_date		=$main_old->start_date		;
						 $oldfinished_date		=$main_old->finished_date		;
						}
						
						$main_msg=" <div class='headerlgb5'>تم تعديل تاريخ المهمة:$taskname  </div>";
						$main_msg.="<div style='height:25px;'></div>";
						$main_msg.=" <div class='headerlgb5'>تاريخ البداية السابق".":".$oldstart_date."</div>";
						$main_msg.=" <div class='headerlgb5'>تاريخ البداية الجديد".":".$main_start."</div>";
												$main_msg.="<div style='height:25px;'></div>";

						$main_msg.=" <div class='headerlgb5'>تاريخ النهاية السابق".":".$oldfinished_date."</div>";
						$main_msg.=" <div class='headerlgb5'>تاريخ النهاية الجديد".":".$main_end."</div>";
												$main_msg.="<div style='height:25px;'></div>";

						$main_msg.=" <div class='headerlgb5'>عدد الساعات السابق".":".$total_hrs."</div>";
						$main_msg.=" <div class='headerlgb5'>عدد الساعات الجديد".":".$total_hrs."</div>";
						$main_msg.="<div style='height:15px;'></div>";
						$main_msg.=" <div class='headerlgb'>الموظف المسؤول عن العملية: $fname $sname $lname </div>";
						$subject="تعديل تاريخ مهمة اخرى";

						}

						if($service_value=="change_status"&& $service_type=="other_task"){
							$taskname=get_table_filed("other_tasks",array("id"=>$id_project),"name");
						$total_hrs=get_table_filed("other_tasks",array("id"=>$id_project),"total_hrs");
						
						$start_date=get_table_filed("other_tasks",array("id"=>$id_project),"start_date");
						$status	=get_table_filed("other_tasks",array("id"=>$id_project),"status");
						$oldstatus	=get_table_filed("other_tasks",array("id"=>$id_project),"oldstatus");
						
						 	switch($oldstatus){case 0:
													  $oldstatus="لم تبدا";
													  break;
													case 1:
													  $oldstatus="قيد العمل";
													  break;
													  case 2:
													  $oldstatus="تم الانتهاء";
													  break;
													default:
													  break; 
												}
					
						switch($status){case 0:
													  $status="لم تبدا";
													  break;
													case 1:
													  $status="قيد العمل";
													  break;
													  case 2:
													  $status="تم الانتهاء";
													  break;
													default:
													  break; 
												}
							$main_msg="  <div class='headerlgb5'>تم تعديل حالة المهمة : $taskname     </div>";
							$main_msg.="<div style='height:25px;'></div>";
						$main_msg.="  <div class='headerlgb5'>الحالة السابقة".":".$oldstatus."</div>";
						$main_msg.="  <div class='headerlgb5'>الحالة الحالية".":".$status."</div>";
						$main_msg.="<div style='height:15px;'></div>";
						$main_msg.="  <div class='headerlgb'>الموظف المسؤول عن العملية: $fname $sname $lname </div>";
						$subject= "تعديل حالة مهمة اخرى";


						}

						if($service_value=="change_review"&& $service_type=="other_task"){
						$taskname=get_table_filed("other_tasks",array("id"=>$id_project),"name");
						$finished_date=get_table_filed("other_tasks",array("id"=>$id_project),"finished_date");
						$start_date=get_table_filed("other_tasks",array("id"=>$id_project),"start_date");
						$finished_date=get_table_filed("other_tasks",array("id"=>$id_project),"finished_date");
						$select_date=get_table_filed("other_tasks",array("id"=>$id_project),"select_date");
						$select_enddate=get_table_filed("other_tasks",array("id"=>$id_project),"select_enddate");
						if($select_date==1){$main_start="غير معلوم";}else{$main_start=$start_date;}
						if($select_enddate==1){$main_end="غير معلوم"; } else {$main_end=$finished_date;}
						$total_hrs=get_table_filed("other_tasks",array("id"=>$id_project),"total_hrs");
						
						$main_msg.=" <div class='headerlgb5'>تم مراجعة المهمة:"." ".$taskname."</div>";
							$main_msg.="<div style='height:25px;'></div>";
						$main_msg.="  <div class='headerlgb5'>عدد الساعات:"." ".$total_hrs ."</div>";
						$main_msg.="  <div class='headerlgb5'>تاريخ البداية  :"." ".$main_start ."</div>";
						$main_msg.="  <div class='headerlgb5'>تاريخ النهاية  :"." ".$main_end ."</div>";
							$main_msg.="<div style='height:15px;'></div>";
						$main_msg.="  <div class='headerlgb'>الموظف المسؤول عن العملية: $fname $sname $lname </div>";
						$subject="مراجعة مهمة اخرى";
						}

















						if($service_value=="delete"&& $service_type=="files"){
							$name=get_table_filed("tbl_project_files",array("id"=>$id_project),"name");
							$id_proj=get_table_filed("tbl_project_files",array("id"=>$id_project),"project_id");
						$project_name=get_table_filed("tbl_projects",array("id"=>$id_proj),"name");
							$main_msg="<div class='headerlgb'>تم حذف ملف من مشروع : $project_name   </div>";
						$main_msg.="<div class='headerlgb'>الموظف المسؤول عن العملية: $fname $sname $lname </div>";
							$subject="حذف ملف";
						}
						
						if($service_value=="add"&& $service_type=="files"){
                        $name=get_table_filed("tbl_project_files",array("id"=>$id_project),"name");
							$id_proj=get_table_filed("tbl_project_files",array("id"=>$id_project),"project_id");
						$project_name=get_table_filed("tbl_projects",array("id"=>$id_proj),"name");
							$main_msg="<div class='headerlgb'>تم إضافة ملف جديد في مشروع : $project_name   </div>";
						$main_msg.="<div class='headerlgb'>الموظف المسؤول عن العملية: $fname $sname $lname </div>";
							$subject="اضافة ملف";
						}
		$site_favicon=$ci->session->userdata('site_favicon');
		$ci->load->library('email');

		$email=get_table_filed("tbl_config",array("config_key"=>"site_email"),"config_value");
		$name_manage=get_table_filed("tbl_config",array("config_key"=>"nickname"),"config_value");
			$oldstatus	=get_table_filed("tbl_tasks",array("id"=>$id_project),"oldstatus");
				$emailm_id0	=get_table_filed("tbl_user_groups",array("key"=>'ABC'),"id");
				$emailm_id1=get_table_filed("tbl_user_groups",array("key"=>"XIWE"),"id");
		        $emailm_id2=get_table_filed("tbl_user_groups",array("key"=>"xElk"),"id");
		
		 $site_name=$ci->session->userdata('site_name');
		 //$subject = "نظام ادارة المشروعات";
		 $mail_message= "<br>";
		 $mail_message.=
		 "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
	 <html xmlns='http://www.w3.org/1999/xhtml'>
	 <head>
	   <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	   <meta name='viewport' content='width=device-width, initial-scale=1' />
	   <title>$subject-نظام ادارة المشروعات</title>
	 
		   <style type='text/css'>
		 /* Take care of image borders and formatting, client hacks */
		 @import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;lang=en');
		 img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
		 a img { border: none; }
		 table { border-collapse: collapse !important;}
		 #outlook a { padding:0; }
		 .ReadMsgBody { width: 100%; }
		 .ExternalClass { width: 100%; }
		 .backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }
		 table td { border-collapse: collapse; }
		 .ExternalClass * { line-height: 115%; }
		 .container-for-gmail-android { min-width: 600px; }
	 
	 
		 /* General styling */
		 * {
		   font-family:Tahoma !important;;
		 }
	 
		 body {
		   -webkit-font-smoothing: antialiased;
		   -webkit-text-size-adjust: none;
		   width: 100% !important;
		   margin: 0 !important;
		   height: 100%;
		   color: #676767;
		 }
	 
		 td {
		   font-family: Tahoma !important;;
		   font-size:16px;
		   color: #777777;
		   text-align: right;
		   line-height: 21px;
		 }
	 
		 a {
		   color: #676767;
		   text-decoration: none !important;
		 }
	 
		 .pull-left {
		   text-align: right;
		 }
	 
		 .pull-right {
		   text-align: right;
		 }
	 
		 .header-lg,
		 .header-md,
		 .header-sm {
		   font-size:20px;
		   font-weight:500;
		   line-height: 30px;
		   padding:10px 0 0;
		   color: #666;
		   text-align:right;
		    font-family: Tahoma !important;;
		 }

		 .header-lg,
		 .header-md,
		 .header-sm {
		   font-size:17px;
		   font-weight:500;
		   line-height: 30px;
		   padding:10px 10px 0;
		   color: #666;
		   text-align:right;
		    font-family: Tahoma !important;;
		 }

		 .headerlgb {
			font-size:16px;
			font-weight:500;
			line-height:50px;
			padding:0px;
			color: #666;
			text-align:right;
			 font-family: Tahoma !important;;
		 }
		 		 .headerlgb5 {
			font-size:16px;
			font-weight:500;
			line-height:25px;
			padding:0px ;
			color: #666;
			text-align:right;
			 font-family: Tahoma !important;;
		 }
		 

		 .headerlgb1{
			font-size:16px;
			font-weight:500;
			line-height: 30px;
			padding:10px 10px 0;
			color: #666;
			text-align:right;
			 font-family: Tahoma !important;;
		   }
		   	 .headerlgbx{
			font-size:16px;
			font-weight:500;
			line-height: 30px;
			color: #666;
			text-align:right;
			 font-family: Tahoma !important;;
		   }
		   



	   .headerlgb3{
			font-size:15px;
			font-weight:500;
			line-height: 30px;
			padding:0px;
			color: #666;
			text-align:right;
			 font-family: Tahoma !important;;
		   }
		   
		   .headerlgb4 {
		    font-size:12px;
			font-weight:500;
			line-height:4px;
			padding:0px;
			color: #666;
			text-align:right;
			font-family: Tahoma !important; 
		   }
		   
		 .header-md {
		   font-size: 24px;
		 }
	 
		 .header-sm {
		   padding: 5px 0;
		   font-size: 18px;
		   line-height: 1.3;
		 }
	 
		 .content-padding {
		   padding: 20px 0 5px;
		 }
	 
		 .mobile-header-padding-right {
		   width: 290px;
		   text-align: right;
		   padding-left: 10px;
		 }
	 
		 .mobile-header-padding-left {
		   width: 290px;
		   text-align: left;
		   padding-left: 10px;
		 }
	 
		 .free-text {
		   width: 100% !important;
		   padding: 10px 60px 0px;
		 }
	 
		 .button {
		   padding: 30px 0;
		 }
	 
	 
		 .mini-block {
		   border: 1px solid #e5e5e5;
		   border-radius: 5px;
		   background-color: #ffffff;
		   padding: 12px 15px 15px;
		   text-align: left;
		   width: 253px;
		 }
	 
		 .mini-container-left {
		   width: 278px;
		   padding: 10px 0 10px 15px;
		 }
	 
		 .mini-container-right {
		   width: 278px;
		   padding: 10px 14px 10px 15px;
		 }
	 
		 .product {
		   text-align: left;
		   vertical-align: top;
		   width: 175px;
		 }
	 
		 .total-space {
		   padding-bottom: 8px;
		   display: inline-block;
		 }
	 
		 .item-table {
		   padding: 50px 20px;
		   width: 560px;
		 }
	 
		 .item {
		   width: 300px;
		 }
	 
		 .mobile-hide-img {
		   text-align: left;
		   width: 125px;
		 }
	 
		 .mobile-hide-img img {
		   border: 1px solid #e6e6e6;
		   border-radius: 4px;
		 }
	 
		 .title-dark {
		   text-align: left;
		   border-bottom: 1px solid #cccccc;
		   color: #4d4d4d;
		   font-weight: 700;
		   padding-bottom: 5px;
		 }
	 
		 .item-col {
		   padding-top: 20px;
		   text-align: left;
		   vertical-align: top;
		 }
	 
		 .force-width-gmail {
		   min-width:600px;
		   height: 0px !important;
		   line-height: 1px !important;
		   font-size: 1px !important;
		 }
	 
	   </style>
	 
	   <style type='text/css' media='screen'>
		 @import url(https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;lang=en);
	   </style>
	 
	   <style type='text/css' media='screen'>
		 @media screen {
		   /* Thanks Outlook 2013! */
		   * {
			font-family: Tahoma !important;
		   }
		 }
	   </style>
	 
	   <style type='text/css' media='only screen and (max-width: 480px)'>
		 /* Mobile styles */
		 @media only screen and (max-width: 480px) {
	 
		   table[class*='container-for-gmail-android'] {
			 min-width: 290px !important;
			 width: 100% !important;
		   }
	 
		   img[class='force-width-gmail'] {
			 display: none !important;
			 width: 0 !important;
			 height: 0 !important;
		   }
	 
		   table[class='w320'] {
			 width: 320px !important;
		   }
	 
	 
		   td[class*='mobile-header-padding-left'] {
			 width: 160px !important;
			 padding-left: 0 !important;
		   }
	 
		   td[class*='mobile-header-padding-right'] {
			 width: 160px !important;
			 padding-right: 0 !important;
		   }
	 
		   td[class='header-lg'] {
			 font-size:15px !important;
			 padding-bottom: 5px !important;
		   }
	 
		   td[class='content-padding'] {
			 padding: 5px 0 5px !important;
		   }
	 
			td[class='button'] {
			 padding: 5px 5px 30px !important;
		   }
	 
		   td[class*='free-text'] {
			 padding: 10px 18px 30px !important;
		   }
	 
		   td[class~='mobile-hide-img'] {
			 display: none !important;
			 height: 0 !important;
			 width: 0 !important;
			 line-height: 0 !important;
		   }
	 
		   td[class~='item'] {
			 width: 140px !important;
			 vertical-align: top !important;
		   }
	 
		   td[class~='quantity'] {
			 width: 50px !important;
		   }
	 
		   td[class~='price'] {
			 width: 90px !important;
		   }
	 
		   td[class='item-table'] {
			 padding: 30px 20px !important;
		   }
	 
		   td[class='mini-container-left'],
		   td[class='mini-container-right'] {
			 padding: 0 15px 15px !important;
			 display: block !important;
			 width: 290px !important;
		   }
		 }
	   </style>
	 <table align='right' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%' dir='rtl'>

						<tr>
						<td  width='100%' class=''>
						<center>
						<img src='https://wisyst.com/wp-content/uploads/2018/12/logo-22.jpg' style='width:200px;height:120px;'>
						</center>
						</td>
						</tr>
	  
		 
	   <tr>
		 <td align='center' valign='top' width='100%' style='' class='content-padding'>
			 <table cellspacing='0' cellpadding='0' width='600' class='w320'>
			
			   <tr>
				 <td style='line-height:50px;'>".$main_msg."</td>
			   </tr>
			   
			  <tr>
				 <td ><div style='line-height:50px'  class='headerlgb3'>للدخول لنظام إدارة المشروعات
				<a href=".$url_login." class='headerlgb3'>اضغط هنا</a>
				</div?
				</td>
			   </tr>
			     <tr>
				<td ><div class='headerlgb4'>
				   &copy; جميع الحقوق محفوظة لدى شركة <a href='https://wisyst.com/' class='headerlgb4'>واي سيست لتقنية المعلومات</a>  
				 </div>
				 </td>
			   </tr>
	
	 </table>
	 </html>
		 </div>";
		 $message = $mail_message;
$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
				<title>' . html_escape($subject) . '</title>
				
			</head>
			<header>
			<table style="direction:rtl">
			<tr></tr>
			</table>
			</header>
			<body>
			' . $message . '
			</body>
			</html>';

			$result = $ci->email
		  ->from('info@tasks.wisyst.info')
		  ->reply_to('info@tasks.wisyst.info')    // Optional, an account where a human being reads.
		  ->to($email)
		  ->subject($subject)
		  ->message($body)
		  ->send();



			 $managemail_users=get_table_data("tbl_users",array('group_id'=>$emailm_id0,'user_key'=>'ABC'));
			  if(count($managemail_users)>0){
			foreach($managemail_users as $mail_users)
                 $id_user=$mail_users->id;
                $email_manage	=get_table_filed("mail_system",array("id_user"=>$id_user),"email");
				$result = $ci->email
				->from('info@tasks.wisyst.info')
				->to( $email_manage)
				->subject($subject)
				->message($body)
				->send();
		}

		 $managemail_users1=get_table_data("tbl_users",array('group_id'=>$emailm_id1));
			  if(count($managemail_users1)>0){
			foreach($managemail_users1 as $mail_users1)
                 $id_user1=$mail_users1->id;
                $email_manage1	=get_table_filed("mail_system",array("id_user"=>$id_user1),"email");
				$result = $ci->email
				->from('info@tasks.wisyst.info')
				->to( $email_manage1)
				->subject($subject)
				->message($body)
				->send();
		}


        		 $managemail_users2=get_table_data("tbl_users",array('group_id'=>$emailm_id2));
			  if(count($managemail_users2)>0){
			foreach($managemail_users2 as $mail_users2)
                 $id_user2=$mail_users2->id;
                $email_manage2	=get_table_filed("mail_system",array("id_user"=>$id_user2),"email");
				$result = $ci->email
				->from('info@tasks.wisyst.info')
				->to( $email_manage2)
				->subject($subject)
				->message($body)
				->send();
		}

	if($service_type=="projects"){
		 $project_status=get_table_filed("tbl_projects",array("id"=>$id_project),"status");
			 $mail_users=get_table_data("mail_system",array('service_type'=>$service_type));
			  if(count($mail_users)>0){
			foreach($mail_users as $mail_users){
				$result = $ci->email
				->from('info@tasks.wisyst.info')
				->reply_to('info@tasks.wisyst.info')      // Optional, an account where a human being reads.
				->to($mail_users->email)
				->subject($subject)
				->message($body)
				->send();
			}
		}
		 

		 }

		 else 	if($service_type=="user"){
				$mail_users=get_table_data("mail_system",array('service_type'=>$service_type,'id_user'=>$id_project));
				 if(count($mail_users)>0){
			 foreach($mail_users as $mail_users){
				 $result = $ci->email
				 ->from('info@tasks.wisyst.info')
				 ->reply_to('info@tasks.wisyst.info')     // Optional, an account where a human being reads.
				 ->to($mail_users->email)
				 ->subject($subject)
				 ->message($body)
				 ->send();
				 //var_dump($result);
				 //return $mail_users->email.$mail_users->id;
			 
		 }
			}
		}
			else 	if($service_type=="task"){
				$user_id=get_table_filed("tbl_tasks",array("id"=>$id_project),"user_id");
			$mail_users=get_table_data("mail_system",array('service_type'=>$service_type,'id_user'=>$user_id));
				 if(count($mail_users)>0){
			 foreach($mail_users as $mail_users){
				 $result = $ci->email
				 ->from('info@tasks.wisyst.info')
				 ->reply_to('info@tasks.wisyst.info')     // Optional, an account where a human being reads.
				 ->to($mail_users->email)
				 ->subject($subject)
				 ->message($body)
				 ->send();
		 }
			}
	$project_id=get_table_filed("tbl_tasks",array("id"=>$id_project),"project_id");
	$id_magager_project=get_table_filed("tbl_projects",array("id"=>$project_id),"id_magager");
	$mail_usersx=get_table_data("mail_system",array('service_type'=>$service_type,'id_user'=>$id_magager_project));
			if(count($mail_usersx)>0){
		foreach($mail_usersx as $mail_userss)
			$result = $ci->email
			->from('info@tasks.wisyst.info')
			->reply_to('info@tasks.wisyst.info')     // Optional, an account where a human being reads.
			->to($mail_userss->email)
			->subject($subject)
			->message($body)
			->send();
			return $id_magager_project;
	 }
			
 
			}
		/**/

		else 	if($service_type=="files"){
			$user_id=get_table_filed("tbl_project_files",array("id"=>$id_project),"user_id");
			$project_id=get_table_filed("tbl_project_files",array("id"=>$id_project),"project_id");
			$id_magager=get_table_filed("tbl_projects",array("id"=>$project_id),"id_magager");
			
			$mail_users=get_table_data("mail_system",array('service_type'=>$service_type,'id_user'=>$user_id));
			 if(count($mail_users)>0){
		 foreach($mail_users as $mail_users){
			 $result = $ci->email
			 ->from('info@tasks.wisyst.info')
			 ->reply_to('info@tasks.wisyst.info')     // Optional, an account where a human being reads.
			 ->to($mail_users->email)
			 ->subject($subject)
			 ->message($body)
			 ->send();
			// return $mail_users->email.$mail_users->id;
	 }
		}
		$mail_users=get_table_data("mail_system",array('service_type'=>$service_type,'id_user'=>$id_magager));
		if(count($mail_users)>0){
	foreach($mail_users as $mail_users){
		$result = $ci->email
		->from('info@tasks.wisyst.info')
		->reply_to('info@tasks.wisyst.info')     // Optional, an account where a human being reads.
		->to($mail_users->email)
		->subject($subject)
		->message($body)
		->send();
		//return $mail_users->email.$mail_users->id;
}
 }
		}



	}

function create_captha(){
$ci= & get_instance();
		$vals = array(
		'img_path'      => './uploads/captcha/',
		'img_url'       => 'http://localhost/mywork/mazadat/uploads/captcha/',
		'img_width'     => '150',
		'img_height'    => 30,
		'expiration'    => 7200,
		'word_length'   => 8,
		'font_size'     => 20,
		'img_id'        => 'Imageid',
		'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
		// White background and border, black text and red grid
		'colors'        => array(
		'background' => array(255, 255, 255),
		'border' => array(255, 255, 255),
		'text' => array(0, 0, 0),
		'grid' => array(0, 255,255)
		)
		);
$cap = create_captcha($vals);
$doc = new DOMDocument();
$doc->loadHTML($cap['image']);
$imageTags = $doc->getElementsByTagName('img');

foreach($imageTags as $tag) {
	$title= $tag->getAttribute('src');
}


		$data = array(
			'captcha_time'  => $cap['time'],
			'ip_address'    => $ci->input->ip_address(),
			'word'          => $cap['word'],
			'img_name'      =>$title
		);
$query = $ci->db->insert_string('captcha', $data);
$ci->session->set_userdata('captchaWord',$cap['word']);
$ci->db->query($query);
 //echo $cap['image'];
return $cap['image'];
}


 function refresh()
{
	
	$ci= & get_instance();
	$word=$_SESSION['captchaWord'];
$img_name=get_table_filed('captcha',array('word'=>$word),'img_name');
$arr=explode("/",$img_name);
unlink("uploads/captcha/".$arr[count($arr)-1]);
$ci->db->where('word', $word)->delete('captcha');
		$vals = array(
		'img_path'      => './uploads/captcha/',
		'img_url'       => 'http://localhost/mywork/mazadat/uploads/captcha/',
		'img_width'     => '150',
		'img_height'    => 30,
		'expiration'    => 7200,
		'word_length'   => 8,
		'font_size'     => 20,
		'img_id'        => 'Imageid',
		'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
		// White background and border, black text and red grid
		'colors'        => array(
		'background' => array(255, 255, 255),
		'border' => array(255, 255, 255),
		'text' => array(0, 0, 0),
		'grid' => array(0, 255,255)
		)
		);
$cap = create_captcha($vals);
$doc = new DOMDocument();
$doc->loadHTML($cap['image']);
$imageTags = $doc->getElementsByTagName('img');

foreach($imageTags as $tag) {
	$title= $tag->getAttribute('src');
}


		$data = array(
			'captcha_time'  => $cap['time'],
			'ip_address'    => $ci->input->ip_address(),
			'word'          => $cap['word'],
			'img_name'      =>$title
		);
$query = $ci->db->insert_string('captcha', $data);
$ci->session->set_userdata('captchaWord',$cap['word']);
$ci->db->query($query);
 //echo $cap['image'];
return $cap['image'];
}
