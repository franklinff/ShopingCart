<?php
class Coupon_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    /*
     * function name :insert_coupon_info
     *  
     * @author  Franklin
     * @access  public
     * @param : number
     * @return : array
     */
    public function insert_coupon_info($data_info)
    {
        $code         = $data_info['code'];
        $percent_off  = $data_info['percent_off'];
        $created_date = date('y-m-d');
        $no_of_uses   = $data_info['no_of_uses'];
        $result       = $this->db->query("CALL add_coupon('$code','$percent_off','$created_date','$no_of_uses','2','0')");
    }


     /*
     * function name :getAll
     *  for listing coupon table.
     * @author  Franklin
     * @access  public
     * @param : number
     * @return : array
     */    
    public function getAll()
    {
       $this->db->where('is_deleted', '0');
        $r = $this->db->get('coupon');
        return $r->result_array();
    }
 
     /*
     * function name :getCoupon
     *  
     * @author  Franklin
     * @access  public
     * @param : number
     * @return : array
     */   
    public function getCoupon($id)
    {
        $this->db->where('id', $id);
        $r = $this->db->get('coupon');
        return $r->result_array();
    }


     /*
     * function name :delete_coupon
     *  sets 'is_deleted' column to 0.
     * @author  Franklin
     * @access  public
     * @param : number
     * @return : array
     */    
    public function delete_coupon($id)
    {
        $data = array(
            'is_deleted' => '1'
        );
        $this->db->where('id', $id);
        $this->db->update('coupon',$data);
        
    }

     /*
     * function name :edit_coupon
     *  edit coupon data
     * @author  Franklin
     * @access  public
     * @param : number
     * @return : array
     */ 
    public function edit_coupon($data_info, $id)
    {
        $code         = $data_info['code'];
        $percent_off  = $data_info['percent_off'];
        $no_of_uses   = $data_info['no_of_uses'];
        $created_date = date('y-m-d');
        $cou_id       = $id;
        //;print_r($id);exit;
        $result       = $this->db->query("CALL update_coupon('$code','$percent_off','56','$created_date','$no_of_uses','1','$cou_id')");
    }
    
}