<?php
class User_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    

    /*
     * function name : insert_data
     * To insert users data in users table
     * @author  Franklin
     * @access  public
     * @param : array
     * @return : array
     */
    public function insert_data($new_data)
    {
        $this->db->insert('users', $new_data);
    }
    

    /*
     * function name : list_user
     * retrive content from users table
     * @author  Franklin
     * @access  public
     * @param : array
     * @return : array
     */   
    public function list_user()
    {
        $query = $this->db->join('roles', 'roles.role_id  = users.role_type')->get('users');
        //print_r($this->db->last_query());
        //$this->db->where('status','1');
        return $query->result_array();
    }


     /*
     * function name : delete_user
     * Deletes the admin,users registration content
     * @author  Franklin
     * @access  public
     * @param : array
     * @return : array
     */    
    public function delete_user($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('users');
    }   

     /*
     * function name : update
     * Updates the users content as per individual id
     * @author  Franklin
     * @access  public
     * @param : number
     * @return : boolean 
     */ 
    public function update($new_data, $id)
    {
        //unset($data['button']);
        $this->db->where('id', $id);
        $r = $this->db->update('users', $new_data);
        return $r;
    }

     /*
     * function name : getById
     * retrieves the data as per the id in view section 
     * @author  Franklin
     * @access  public
     * @param : array
     * @return : array
     */ 
    public function getById($id)
    {
        $this->db->where('id',$id);
        $r = $this->db->get('users');
        return $r->result_array();
    }   

    /*
     * function name : config
     * retrieves the data from configuration table for listing
     * @author  Franklin
     * @access  public
     * @param : array
     * @return : array
     */
    public function config()
    { 
        $query = $this->db->get('configuration');   
   /*   echo '<pre>';
        print_r($query->result_array());
        exit;*/
        return $query->result_array();
    }


    /*
     * function name : getConfigId
     * retrieves the data from configuration table for display in edit view
     * @author  Franklin
     * @access  public
     * @param : array
     * @return : array
     */
    public function getConfigId($id)
    {
        $this->db->where('id',$id);
        $r = $this->db->get('configuration');
        return $r->result_array();
    } 

     /*
     * function name : update_config
     * Updates the configuration content as per individual id
     * @author  Franklin
     * @access  public
     * @param : array
     * @return : array
     */
    public function update_config($new_data, $id)
    {  
        $this->db->where('id', $id);
        $r = $this->db->update('configuration', $new_data);
        return $r;
    }
}
?>