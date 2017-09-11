<?php
class Cms_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


    /*
     * function name : insert_cms_data
     * Insert data in cms table
     * @author  Franklin
     * @access  public
     * @param : $data_info
     */
    public function insert_cms_data($data_info)
    {
        $result = $this->db->insert('cms', $data_info);
        return $result;
    }

    /*
     * function name : getAll
     * retreive data from cms table
     * @author  Franklin
     * @access  public
     * @param : null
     * @return : array
     */
    public function getAll()
    {
        $r = $this->db->get('cms');
        return $r->result_array();
    }


    /*
     * function name : getById
     * retreive data from cms table as per the id
     * @author  Franklin
     * @access  public
     * @param : $id
     * @return : array
     */
    public function getById($id)
    {
        $this->db->where('id', $id);
        $r = $this->db->get('cms');
        return $r->result_array();
    }


    /*
     * function name : getTitle
     * retreives only the title from cms table
     * @author  Franklin
     * @access  public
     * @param : null
     * @return : array
     */
    public function getTitle()
    {
        $this->db->select('title');
        $r = $this->db->get('cms');
        return $r->result_array();
    }

    /*
     * function name : update_cms_data
     * updates cms content
     * @author  Franklin
     * @access  public
     * @param : $data_info,$id
     */
    public function update_cms_data($data_info,$id)
    {
        $this->db->where('id', $id);
        $result = $this->db->update('cms',$data_info);
        return $result;
    }


}
    