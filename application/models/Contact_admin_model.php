<?php
class Contact_admin_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();

    }

     /*
     * function name : list_banner
     * retreives the data from banners table
     * @author  Franklin
     * @access  public
     * @param : number
     * @return : array
     */       
    public function user_query()
    {
        $query = $this->db->get('contact_us');
        return $query->result_array();
    }

    public function user_email_as_per_id($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        $r = $this->db->get('contact_us');
        return $r->result_array();
    }


    public function resolution($content,$id)
    {
        $data['note_admin'] = $content;

        $this->db->where('id', $id);
        $r = $this->db->update('contact_us',$data);
        return $r;       
    }
 
}
