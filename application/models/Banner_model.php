<?php
class Banner_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    

     /*
     * function name : insert_banner
     * insert the data into banners table
     * @author  Franklin
     * @access  public
     * @param : array
     * @return : array
     */
    public function insert_banner($new_data)
    {
        $result = $this->db->insert('banners', $new_data);
        return $result;
    }


     /*
     * function name : delete_banner
     * delete individual row(hard delete) from banners table
     * @author  Franklin
     * @access  public
     * @param : number
     * @return : array
     */
    public function delete_banner($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('banners');
    }



     /*
     * function name : list_banner
     * retreives the data from banners table
     * @author  Franklin
     * @access  public
     * @param : number
     * @return : array
     */       
    public function list_banner()
    {
        $query = $this->db->get('banners');
        return $query->result_array();
    }


    /*
     * function name : update
     * updates the data from banners table
     * @author  Franklin
     * @access  public
     * @param : number
     * @return : array
     */
    public function update($new_data, $id)
    {
        $this->db->where('id', $id);
        $r = $this->db->update('banners', $new_data);
        return $r;
    }


    /*
     * function name : getById
     * retreives individual row from banners table as per the id
     * @author  Franklin
     * @access  public
     * @param : number
     * @return : array
     */
    public function getById($id)
    {
        $this->db->where('id', $id);
        $r = $this->db->get('banners');
        /*  echo "<pre>";
        print_r($r);
        die();*/
        return $r->result_array();
    }
    
}