<?php

class Admin_Controller extends MY_Controller
{
    public $user_info = array();

    function __construct()
    {
        parent::__construct();

        $permissions = array();
        if( !$this->session->has_userdata('cp_logged') || empty($this->session->userdata('user_id')) )
        {
            redirect(base_url().admin_dir().'/account/login');
            exit();
        }
        $user_id = intval(abs($this->session->userdata('user_id')));
        $user_info = $this->db->where('id', $user_id)->get('users')->row_array();
        $user_permissions = $this->db->where('id', $user_info['group_id'])->get('user_groups')->row_array();
        $permissions = @explode(',', $user_permissions['permissions']);

        $this->user_info = $user_info;
        $this->user_info['permissions'] =  $permissions;

    }
}