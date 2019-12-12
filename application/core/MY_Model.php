<?php
class MY_Model extends CI_Model
{

    protected $_table_name = '';

    function __construct()
    {
        parent::__construct();
    }

    public function array_from_post($fields)
    {
        $data = array();
        foreach ($fields as $field) {
            $data[$field] = $this->input->post($field);
        }
        return $data;
    }


     /*
    * get
    *
    * returned all of data
    */
    public function get($where='', $limit='', $limit_start='', $orderBy='')
    {
         if($where !='')
            $this->db->where($where);

         if($orderBy !='')
            $this->db->order_by($orderBy);

         if($limit!='' || $limit_start != '')
            $query = $this->db->get($this->_table_name, $limit, $limit_start);
         else
            $query = $this->db->get($this->_table_name);

         $result = $query->result_array();

         return $result;
    }

    /*
    * get_single
    *
    * returned single row
    */
    public function get_single($where, $orderBy='')
    {
        $this->db->where($where);

         if($orderBy !='')
            $this->db->order_by($orderBy);

         $query = $this->db->get($this->_table_name);
         $result = $query->row_array();

         return $result;
    }

   /*
    * get_num
    *
    * returned  num
    */
    public function get_num($where='')
    {
        if($where !='')
           $this->db->where($where);

        $this->db->from($this->_table_name);
        return $this->db->count_all_results();
    }


  /*
   * save
   */
   public function save($data = array(), $id = NULL)
   {
       if(count($data) > 0)
       {
           if($id === NULL)
           {
              $this->db->insert($this->_table_name, $data);
              return $this->db->insert_id();
           }
           else
           {
              $this->db->where('id', $id)->update($this->_table_name, $data);
              return $id;
           }
       }

   }

   /*
    * delete
    */
    public function delete($id)
    {
         $id = intval(abs($id));
         $this->db->where('id', $id);
         $this->db->delete($this->_table_name);
    }


}

