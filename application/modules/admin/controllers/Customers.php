<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends MX_Controller
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
    }

    public function index(){
		redirect(base_url().'admin/customers/show','refresh');
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
	
    public function show(){
		$where = "status='1'";
        $pg_config['sql'] = $this->data->get_sql('customers',$where,'id','DESC');
        $pg_config['per_page'] = 10;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/customers/show", $data); 
    }
	
	public function show_none(){
		$where = "status='0'";
        $pg_config['sql'] = $this->data->get_sql('customers',$where,'id','DESC');
        $pg_config['per_page'] = 10;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/customers/show_none", $data); 
    }
	
	public function edit(){
		$id=$this->input->get('id');
        $data['data'] = $this->data->get_table_data('customers',array('id'=>$id));
        $this->load->view("admin/customers/edit",$data); 
	}
	
	public function edit_action(){
		$id=$this->input->post('id');
		
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		$email=$this->input->post('email');
		$phone=$this->input->post('phone');
		$points=$this->input->post('points');
		$invitation_count=$this->input->post('invitation_count');
			
			$updates = ['username'=>$username,'email'=>$email,'phone'=>$phone,'points'=>$points,'invitation_count'=>$invitation_count];
			$this->Main_model->update('customers',['id'=>$id],$updates);
			
			if($password && $password!=""){
				$update_pass = ['password'=>md5($password)];
				$this->Main_model->update('customers',['id'=>$id],$update_pass);
			}
			
			if($_FILES['img']['name']!=""){
            $img_name=$this->gen_random_string(); 
            $imagename = $img_name;
            $config['upload_path'] = 'uploads/customers/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             =100000;
            $config['max_width']            =100000;
            $config['max_height']           =100000;
            $config['file_name'] = $imagename; 
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('img')){
                echo $this->upload->display_errors();
                print_r($config);
                die;
            }
            else {
            $url= $_FILES['img']['name'];
            $ext = explode(".",$url);
            $file_extension = end($ext);
            $data = array('img'=>$imagename.".".$file_extension);
            $this->data->edit_table_id('customers',array('id'=>$id),$data);
            }
        }
		$this->session->set_flashdata('msg', 'تم التعديل بنجاح');
		redirect(base_url().'admin/customers/edit?id='.$id,'');
	}
	
	public function check_status(){    
    $id = $this->input->post("id");
    $ser = $this->db->get_where("customers",array("id"=>$id,"status" => "1"))->num_rows();
    if ($ser == 1) {
      $this->db->update("customers",array("status" => "0"),array("id"=>$id));
      echo "0";
    }
    if ($ser == 0) {
      $this->db->update("customers",array("status" => "1"),array("id"=>$id));
      echo "1";
    }    

	}
	
	public function json($status,$msg=[]){
		$data['status'] = $status;
		$data['msg'] = $msg;
		echo json_encode($data);
	}
	
	public function check_phone(){
    $phone = $this->input->post("phone");
    $res = $this->db->get_where("customers",array("phone" =>$phone))->num_rows();
		if ($res == 1) {
			return $this->json(true,1);
		}else{
			return $this->json(false,0);
		}
	}
	
	public function check_email(){
    $email = $this->input->post("email");
    $res = $this->db->get_where("customers",array("email" =>$email))->num_rows();
		if ($res == 1) {
			return $this->json(true,1);
		}else{
			return $this->json(false,0);
		}
	}
	
	public function details(){
		$id=$this->input->get('id');
        $data['data'] = $this->data->get_table_data('customers',array('id'=>$id));
        //$data['values'] = get_table_2('mazad_subscribers',['customer_id'=>$id],'','mazad_id');
		$where['customer_id'] = $id;
		$data['values'] = $this->db->select('mazad_id as ids')
										->group_by('ids')
										->get_where('mazad_subscribers',$where)
										->result();
        $data['winner'] = $this->data->get_table_data('mazad_subscribers',array('customer_id'=>$id,'status'=>'1'));
        $data['transactions'] = $this->data->get_table_data('transactions_points',array('customer_id'=>$id));
        $this->load->view("admin/customers/details",$data); 
	}

    public function view(){
        $id=$this->input->get('id');
        $up = array('view'=>'1');
        $re=$this->data->edit_table_id('customers',array('id_customers'=>$id),$up);
        //echo $this->db->last_query();die;
        $data['data'] = $this->data->get_table_data('customers',array('id_customers'=>$id));
        $this->load->view("admin/customers/view",$data); 
    }

    public function verify(){
        $id=$this->input->get('id');
        $data['data'] = $this->data->get_table_data('customers',array('id_customers'=>$id));
        $this->load->view("admin/customers/verify",$data); 
    }

    function active(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("customers",array("id_customers"=>$id,"active" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("customers",array("active" => "0"),array("id_customers"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("customers",array("active" => "1"),array("id_customers"=>$id));
            echo "1";
        } 
    }

    function active_mail(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("customers",array("id_customers"=>$id,"active_mail" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("customers",array("active_mail" => "0"),array("id_customers"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("customers",array("active_mail" => "1"),array("id_customers"=>$id));
            echo "1";
        } 
    }

    function active_phone(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("customers",array("id_customers"=>$id,"active_phone" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("customers",array("active_phone" => "0"),array("id_customers"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("customers",array("active_phone" => "1"),array("id_customers"=>$id));
            echo "1";
        } 
    }

    function active_img(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("customers",array("id_customers"=>$id,"active_img" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("customers",array("active_img" => "0"),array("id_customers"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("customers",array("active_img" => "1"),array("id_customers"=>$id));
            echo "1";
        } 
    }

    public function send_action(){
        unset($_SESSION['msg']);
        $this->session->unset_userdata('msg');
        $this->load->library('email');
        $name=$this->input->post('name');
        $email_to=$this->input->post('email');
        $subject=$this->input->post('subject');
        $send_message=$this->input->post('message');
        $subject = $subject;
        $mail_message='Dear '.$name.','. "\r\n";
        $mail_message.='Thanks For customersing With Us'."\r\n";
        $mail_message.='<br>Dmitry.com'."\r\n";
        $mail_message.=$send_message;
        $message = $mail_message;
        $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
          <html xmlns="http://www.w3.org/1999/xhtml">
          <head>
              <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
              <title>' . html_escape($subject) . '</title>
              <style type="text/css">
                  body {
                      font-family: Arial, Verdana, Helvetica, sans-serif;
                      font-size: 16px;
                  }
              </style>
          </head>
          <body>
          ' . $message . '
          </body>
          </html>';
        $result = $this->email
        ->from('dmitry@tareki.com')
        ->reply_to('dmitry@tareki.com')    // Optional, an account where a human being reads.
        ->to($email_to)
        ->subject($subject)
        ->message($body)
        ->send();
        //  echo $email_to;
        //  var_dump($result);
        //  echo $this->email->print_debugger();
        //  die;
        $type=$this->input->post('t');
        if($result==true){
          $this->session->set_flashdata('msg','Replay sent to your $email');
          redirect(base_url().'admin/customers/type/?t='.$type,'refresh');
        }else{
          $this->session->set_flashdata('msg','Failed to send please try again!');
          redirect(base_url().'admin/customers/type/?t='.$type,'refresh');
        }
        
    }

    public function delete(){
        $id_customers = $this->input->get('id_customers');
        $check=$this->input->post('check');

        if($id_customers!=""){
        $ret_value=$this->data->delete_table_row('customers',array('id_customers'=>$id_customers)); 
        }
     
        if(isset($check) && $check!=""){  
        $check=$this->input->post('check');
        $length=count($check);
        for($i=0;$i<$length;$i++){
        $ret_value=$this->data->delete_table_row('customers',array('id_customers'=>$check[$i]));    
        }
        }
        $type=$this->input->get('t');
        $this->session->set_flashdata('msg', 'Success Deleted');
        redirect(base_url().'admin/customers/type/?t='.$type,'refresh');

    }

}