<?php
class User_addres_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    /*
     * function name : insert_user_address
     * insert into user table
     * @author  Franklin
     * @access  public
     * @param : $data_info
     */
    public function insert_user_address($data_info)
    {
        $this->db->insert('user_address', $data_info);
    }

    /*
     * function name : modify_user_address
     * update into user table
     * @author  Franklin
     * @access  public
     * @param :$data_info,$idf
     */
    public function modify_user_address($data_info,$idf)
    {
        $this->db->where('id', $idf);
        $r = $this->db->update('user_address', $data_info);
        return $r;
    }

    /*
     * function name : list_address
     * retreives the country,state and city name
     * @author  Franklin
     * @access  public
     * @param : number
     * @return : array
     */
    public function list_address()
    {    
        $this->db->select('user_address.*,countries.id AS count_id,countries.name AS count_name,states.id AS st_id,states.name AS st_name,cities.id AS ct_id,cities.name AS ct_name');
        $this->db->from('user_address');
        $this->db->join('countries', 'user_address.country = countries.id');
        $this->db->join('states', 'user_address.state = states.id');
        $this->db->join('cities', 'user_address.city = cities.id');
        $r = $this->db->get();
        return $r->result_array();       
    }

    /*
     * function name : getUserAddressINDEX
     * used for listing the user address
     * @author  Franklin
     * @access  public
     * @param : $user_id
     * @return : array
     */
    public function getUserAddressINDEX($user_id)
    {
        $this->db->select('user_address.*,countries.id AS count_id,countries.name AS count_name,states.id AS st_id,states.name AS st_name,cities.id AS ct_id,cities.name AS ct_name');
        $this->db->from('user_address');
        $this->db->join('countries', 'user_address.country = countries.id');
        $this->db->join('states', 'user_address.state = states.id');
        $this->db->join('cities', 'user_address.city = cities.id');
        $this->db->where('user_address.user_id', $user_id);
        $r = $this->db->get();
        return $r->result_array();
    }

     /*
     * function name : getUserAddress
     * used for displaying the  address contents in edit view
     * @author  Franklin
     * @access  public
     * @param : $id
     * @return : array
     */
    public function getUserAddress($id)
    {
        $this->db->select('user_address.*,countries.id AS count_id,countries.name AS count_name,states.id AS st_id,states.name AS st_name,cities.id AS ct_id,cities.name AS ct_name');
        $this->db->from('user_address');
        $this->db->join('countries', 'user_address.country = countries.id');
        $this->db->join('states', 'user_address.state = states.id');
        $this->db->join('cities', 'user_address.city = cities.id');
        $this->db->where('user_address.id', $id);
        $r = $this->db->get();
        return $r->result_array();
    }

    /*
     * function name : getUserAddress_By_Id
     * @author  Franklin
     * @access  public
     * @param : $user_addr_id
     * @return : array
     */
    public function getUserAddress_By_Id($user_addr_id) {
        $this->db->select('user_address.*,countries.id AS count_id,countries.name AS count_name,states.id AS st_id,states.name AS st_name,cities.id AS ct_id,cities.name AS ct_name');
        $this->db->from('user_address');
        $this->db->join('countries', 'user_address.country = countries.id');
        $this->db->join('states', 'user_address.state = states.id');
        $this->db->join('cities', 'user_address.city = cities.id');
        $this->db->where('user_address.id', $user_addr_id);
        $r = $this->db->get();
        return $r->result_array();
    }


    /*
     * function name : delete_address
     * deletes the address as per the id.
     * @author  Franklin
     * @access  public
     * @param : $id
     */
    public function delete_address($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_address');  
    }


    /*
     * function name : getAddress
     * @author  Franklin
     * @access  public
     * @param : $id
     * @return : array
     */
    public function getAddress($id)
    {
        $this->db->where('id', $id);
        $r = $this->db->get('user_address');
        return $r->result_array();
    }

     /*
     * function name : getCountry
     * @author  Franklin
     * @access  public
     * @param : $id
     * @return : array
     */
    public function getCountry($id)
    {
        $this->db->select('*');
        $this->db->from('countries');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    /*
     * function name : getCountries
     * @author  Franklin
     * @access  public
     * @param : null
     * @return : array
     */
    public function getCountries() {
        $this->db->select('*');
        $this->db->from('countries');
        $query = $this->db->get();
        return $query->result_array();
    }


    /*
     * function name : getStates
     * @author  Franklin
     * @access  public
     * @param : $idz
     * @return : array
     */
    public function getStates($idz) 
    {
        $this->db->select('*');
        $this->db->from('states');
        $this->db->where('country_id', $idz);
        $query = $this->db->get();
        return $query->result_array();
    }


    /*
     * function name : getCities
     * @author  Franklin
     * @access  public
     * @param :$id_city
     * @return : array
     */
    public function getCities($id_city) 
    {
        $this->db->select('*');
        $this->db->from('cities');
        $this->db->where('state_id', $id_city);
        $query = $this->db->get();
        //print_r($this->db->last_query());exit;
        return $query->result_array();
    }

  
}