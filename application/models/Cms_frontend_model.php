<?php
class Cms_frontend_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


    /*
     * function name : getData
     * Retreives the data from cms table
     * @author  Franklin
     * @access  public
     * @param : id
     * @return : array
     */
    public function getData($id)
    {
    	$this->db->select('*');
    	$this->db->where('id',$id);
    	$r = $this->db->get('cms');
    	return $r->result_array();
    }
}