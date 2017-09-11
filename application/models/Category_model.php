<?php
class Category_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


    /*
     * function name : insert_category
     * insert the data into category table
     * @author  Franklin
     * @access  public
     * @param : $datacc
     */
    public function insert_category($datacc)
    {
        $result = $this->db->insert('category', $datacc);
        return $result;
    }


    /*
     * function name : getAll
     * retreives the data from category table
     * @author  Franklin
     * @access  public
     * @param : null
     * @return : array
     */
    public function getAll()
    {
        $r = $this->db->get('category');
        return $r->result_array();
    }
    

     /*
     * function name : getCatgId
     * retreives the data from category table as per the id
     * @author  Franklin
     * @access  public
     * @param : $id
     * @return : array
     */
    public function getCatgId($id)
    {
        $this->db->where('id', $id);
        $r = $this->db->get('category');
        return $r->result_array();
    }
   


    /*
     * function name : getByCat
     * 
     * @author  Franklin
     * @access  public
     * @param :null
     * @return : array
     */ 
    public function getByCat()
    {
        $this->db->select('c.id as id, c.name as name, c.parent_id as parent_id, c2.name as parent_name');
        $this->db->from('category as c');
        $this->db->join('category as c2', 'c.parent_id = c2.id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }



    /*
     * function name : delete_categry
     * delete individual row(hard delete) from category table
     * @author  Franklin
     * @access  public
     * @param : $id
     */  
    public function delete_categry($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('category');
    }


    /*
     * function name : getCategory
     * retreives the data from category table
     * @author  Franklin
     * @access  public
     * @param : $id
     * @return : array
     */
    public function getCategory($id)
    {
        $this->db->where('id', $id);
        $r = $this->db->get('category');
        return $r->result_array();
    }
 

    /*
     * function name : update
     * updates the data of category table
     * @author  Franklin
     * @access  public
     * @param : $data, $id
     */   
    public function update($data, $id)
    {
        $this->db->where('id', $id);
        $r = $this->db->update('category', $data);
        return $r;
    }
    
}