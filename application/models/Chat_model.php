<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Chat_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    public function add_user($data){
        $this->db->insert('users',$data);
    }
    public function get_all_online($status){
        $this->db->where('status_chat',$status);
        return $this->db->get('tbl_users')->result();
	}
	public function get_all_online_user($status,$userid){
		$array = array('status_chat' => $status,'id' => $userid);
$this->db->where($array); 
      //  $this->db->where('','');
        return $this->db->get('tbl_users')->result();
    }
    public function get_by_id($id){
        $this->db->where('id',$id);
        return $this->db->get('tbl_users')->row();
    }
    public function update($id,$data){
        $this->db->where('id', $id);
        $this->db->update('tbl_users', $data);
    }
    public function login(){
        $query = $this->db->get_where('tbl_users', 
            array(
            'email' => $this->input->post('email'),
        ));

        $row = $query->result();
        $num_rows = $query->num_rows();

        if( $num_rows == 1 && password_verify($this->input->post('password'), $row[0]->password) ){


            $newdata = array(
              'id'        => $row[0]->id,
              'user_name' => $row[0]->username,
              'email'     => $row[0]->email, 
            );

            $this->session->set_userdata($newdata);
                
            
            return $num_rows;
        }
    }
}
