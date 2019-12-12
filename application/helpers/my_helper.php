<?php defined('BASEPATH') OR exit('No direct script access allowed');
function get_this($table=null , $where=null ,$colomn=null){

    if (empty($table)||empty($where)) {

        return false;

    }else{

        $ci = & get_instance();

        $role = $ci->db->get_where($table, $where)->row_array();

        if (!empty($colomn)) {

            return $role[$colomn];

        }else{

            return $role;

        }

    }

}

function get_this_limit($table=null , $where=null ,$colomn=null,$limit = null,$order_by = null){
    if (empty($table)||empty($where)) {
        return false;
    }else{
        $ci = & get_instance();
		if ($limit)
        $ci->db->limit($limit[0],$limit[1]); 
        if ($order_by)
        $ci->db->order_by($order_by[0],$order_by[1]); 
		
		$role = $ci->db->get_where($table, $where)->result();
        if (!empty($colomn)) {
            return $role[$colomn];
        }else{
            return $role;
        }
    }
}

function get_avg($id=''){
    $ci = & get_instance();
    if($id)
        $rate = $ci->db->select_avg('rate')->get_where('product_rates',['product_id'=>$id])->row()->rate;
        if($rate)
        return $rate;
    else
        return 0;
}


function get_table($table=null , $where=null,$return=null,$limit = null,$order_by = null){

    if (empty($table)) {

        return false;

    }else{

        $ci = & get_instance();

        if ($limit)

            $ci->db->limit($limit); 

        if ($order_by)

            $ci->db->order_by($order_by[0],$order_by[1]); 

        if ($return == "count") {

            return $ci->db->where($where)->count_all_results($table);

        }else{

         return $ci->db->get_where($table, $where)->result();

        }

    }

}


function get_table_2($table=null ,$where=null,$colomn=null,$group_by=null){
    if (empty($table)) {
        return false;
    }else{
        $ci = & get_instance();
        if ($group_by)
            $ci->db->group_by($group_by); 
		
        $role = $ci->db->get_where($table, $where)->result();
        if (!empty($colomn)) {
            return $role[$colomn];
        }else{
            return $role;
        }
    }
}

	function generate_verification_code($chars_min=4, $chars_max=4, $use_upper_case=false, $include_special_chars=false){
      $length = rand($chars_min, $chars_max);
        $selection = '1234567890';                   
        $code = "";
        for($i=0; $i<$length; $i++) {
            $current_letter = $use_upper_case ? (rand(0,1) ? strtoupper($selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))];            
            $code .=  $current_letter;
        }                
        
      return $code;
    }
	
	function generate_verification_code_pass($chars_min=6, $chars_max=6, $use_upper_case=false, $include_special_chars=false){
      $length = rand($chars_min, $chars_max);
        $selection = '1234567890';                   
        $code = "";
        for($i=0; $i<$length; $i++) {
            $current_letter = $use_upper_case ? (rand(0,1) ? strtoupper($selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))];            
            $code .=  $current_letter;
        }                
        
      return $code;
    }

    // function send_sms($phone, $code){
    //     $sms = new MobilySms('966507717440','159789','88f55e6be5eed49301496725879b72ac');
    //     $msg = "عزيزي (1)، كود التفعيل الخاص بك هو (2)";
    //     $msgKey = "(1),*,$reciever,@,(2),*,$code";
    //     $numbers = $reciever;
    //     $result = $sms->sendMsgWK($msg,$numbers,'0507717440',$msgKey,'12:00:00',now(),0,'deleteKey','curl');
    //     $message_info = json_decode($result);
    //     if($message_info->ResponseStatus == 'success'){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // }

function update_setting($name, $value) {
    $CI = & get_instance();
    $CI->db->query("UPDATE settings SET value='$value' WHERE name='$name'");
}

function get_setting($name) {
    $CI = & get_instance();
    $query = $CI->db->get_where('settings', array('name' => $name))->result();
    if ($query) {
        return $query[0]->value;
    } else {
        return "";
    }

}



function show_message($message,$type='success')

{

    $message = trim(preg_replace('/\s+/', ' ', $message));

	$type = ($type == 'success') ?'success':'danger'; 

    return'<script>

                UIkit.notify({

                    message : "'.$message.'",

                    status  : "'.$type.'",

                    timeout : 5000,

                    pos     : "top-center"

                });

            </script>';

}

function show_message2($message,$type='success')

{

    $type = ($type == 'success') ?'success':'danger'; 

    return '<div class="alert media fade in remove alert-'.$type.' alert-dismissable">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                '.$message.'

            </div>';

}
function notify($message,$type='success'){
    $type = ($type == 'success') ?'success':'danger';
    return '<div class="alert alert-'.$type.' background-'.$type.'">
                     <a href="#"  style="float: left; color: #721c24" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong></strong> '.$message.'</code>
                </div>';
}
