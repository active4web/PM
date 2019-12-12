<?php
class discussion_model extends MY_Model
{
    public  $_table_name;

    public function update_views($discussion_id)
    {
        $this->db->where('id', $discussion_id)->update('discussions', array('views'=>1));
    }
}

?>