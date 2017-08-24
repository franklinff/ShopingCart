<?php
class Cms_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert_cms_data($data_info)
    {
        $result = $this->db->insert('cms', $data_info);
        return $result;
    }

    public function getAll()
    {
        $r = $this->db->get('cms');
        return $r->result_array();
    }

    public function getById($id)
    {
        $this->db->where('id', $id);
        $r = $this->db->get('cms');
        return $r->result_array();
    }

    public function getTitle()
    {
        $this->db->select('title');
        $r = $this->db->get('cms');
        return $r->result_array();
    }


    public function update_cms_data($data_info,$id)
    {
        $this->db->where('id', $id);
        $result = $this->db->update('cms',$data_info);
        return $result;
    }


}
    