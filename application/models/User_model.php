<?php
class user_model extends MY_Model
{
    public  $_table_name;

    public function get_user_group($group_id)
    {
        $user_group = $this->db->where('id', $group_id)->get('user_groups')->row_array();
        return $user_group;
    }
    public function hash($string)
    {
        return hash('sha512', $string . config_item('encryption_key'));
    }

    public function password_encrypt($string)
    {
        return md5($string);
    }

    public function isset_email($email, $id=0)
    {
        $id = intval(abs($id));
        $email = $this->security->xss_clean($email);

        $this->db->where('email', $email);
        $this->db->where('id !='.$id);
        $num = $this->db->from('users')->count_all_results();

        if($num > 0)
        {
            // $this->form_validation->set_message('check_id_num', lang('msg_this_email_already_isset'));
            return TRUE;
        }
        return FALSE;
    }

    public function login_check($email, $password)
    {
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $query = $this->db->get('users')->row_array();

        return $query;
    }

    public function change_code($code, $user_id)
    {
        $data = array( 'activation_code'=>$code );
        $this->db->where('id', $user_id)->update('users', $data);
    }

    public function change_password($password,$user_id)
    {
        $data = array( 'password' => $password );
        $this->db->where('id', $user_id)->update('users', $data);
    }

    public function get_permissions($group_id)
    {
        $group_id = intval(abs($group_id));
        $permissions = array();

        $user_permissions = $this->db->where('id', $group_id)->get('user_groups')->row_array();
        $permissions = @explode(',', $user_permissions['permissions']);

        return $permissions;
    }
}

?>