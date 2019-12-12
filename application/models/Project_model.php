<?php
class project_model extends MY_Model
{
    public  $_table_name;

    public function store_files($data)
    {
        if(is_array($data))
        {
            $this->db->insert('project_files', $data);
        }
    }

    public function get_files($project_id, $type='')
    {
        if($type == 'analysis')
        {
            return $this->db->where(' project_id='.$project_id.' AND type="analysis" ')->get('project_files')->result_array();
        }
        elseif($type == 'screen')
        {
            return $this->db->where(' project_id='.$project_id.' AND type="screen" ')->get('project_files')->result_array();
        }
        elseif($type == 'design')
        {
            return $this->db->where(' project_id='.$project_id.' AND type="design" ')->get('project_files')->result_array();
        }
        elseif($type == 'design_cut')
        {
            return $this->db->where(' project_id='.$project_id.' AND type="design_cut" ')->get('project_files')->result_array();
        }
        else
        {
            return $this->db->where(' project_id='.$project_id)->get('project_files')->result_array();
        }
    }

    public function get_file($file_id)
    {
        $file_id = intval(abs($file_id));
        if($file_id > 0)
        {
            return $this->db->where(' id='.$file_id )->get('project_files')->row_array();
        }
       return FALSE;
    }

    public function delete_file($file_id)
    {
        $file_id = intval(abs($file_id));
        if($file_id > 0)
        {
             $this->db->where(' id='.$file_id )->delete('project_files');
            return TRUE;
        }
        return FALSE;
    }

    public function get_allow_employees_ids_for_project($project_id)
    {
        $output = array();
        $output[] = 0;
        $project_id = intval(abs($project_id));
        if($project_id > 0)
        {
            $this->db->distinct();
            $this->db->select('user_id');
            $this->db->where('project_id', $project_id);
            $query = $this->db->get('tasks')->result_array();
            foreach($query as $row)
            {
                $output[] = $row['user_id'];
            }
            return $output;
        }
    }

    public function get_projects_ids_by_emp_user_id($user_id)
    {
        $user_id = intval(abs($user_id));
        $output = array();
        $output[]=0;
        $this->db->distinct();
        $this->db->select('project_id');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('tasks')->result_array();
        foreach($query as $row)
        {
            $output[] = $row['project_id'];
        }
        return $output;
    }
}

?>