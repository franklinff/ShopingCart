<?php
class Contact_admin_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();

    }

    /*
     * function name : user_query
     * Entire content from contact_us table is received
     * @author  Franklin
     * @access  public
     * @param : null
     * @return : array
     */       
    public function user_query()
    {
        $query = $this->db->get('contact_us');
        return $query->result_array();
    }


    /*
     * function name : user_email_as_per_id
     * Content from contact_us table is received as per the id
     * @author  Franklin
     * @access  public
     * @param : $id
     * @return : array
     */ 
    public function user_email_as_per_id($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        $r = $this->db->get('contact_us');
        return $r->result_array();
    }



    /*
     * function name : resolution
     * Admin reply is updated in contact_us table
     * @author  Franklin
     * @access  public
     * @param : $content,$id
     */ 
    public function resolution($content,$id)
    {
        $data['note_admin'] = $content;
        $this->db->where('id', $id);
        $r = $this->db->update('contact_us',$data);
        return $r;       
    }
 
}
