<?php
class Reports_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


    /*
     * function name : get_sales_data
     * @author  Franklin
     * @access  public
     * @param : null
     * @return : array
     */
    public function get_sales_data(){
        $curr_date = date('Y-m-d');
        $prev_date = date_create($curr_date);
        date_sub($prev_date,date_interval_create_from_date_string("30 days"));
        $prev_date = date_format($prev_date,"Y-m-d");
        
        $this->db->select('SUM(grand_total) AS grand_total , COUNT(1) AS no_of_sales, id, created_date');
        $this->db->from('user_order');
        $this->db->where('created_date >=',$prev_date);
        $this->db->where('created_date <=',$curr_date);
        $this->db->group_by('created_date');
        
        $r = $this->db->get();
        return $r->result_array();
    } 

    /*
     * function name : getCustomers
     * @author  Franklin
     * @access  public
     * @param : $start_date,$end_date
     * @return : array
     */
    public function getCustomers($start_date,$end_date){

        $this->db->select('firstname,lastname,email,created_date');
        $this->db->from('users');
        $this->db->where('role_type','5');
        if(!empty($start_date) && !empty($end_date)){
            $this->db->where('created_date >=',$start_date);
            $this->db->where('created_date <=',$end_date);
        }
        $r = $this->db->get();
        return $r->result_array();
    } 

    /*
     * function name : getCoupons
     * @author  Franklin
     * @access  public
     * @param : null
     * @return : array
     */
    public function getCoupons(){
        $this->db->select('users.id AS u_id,users.role_type,users.email,users.firstname,users.lastname,coupon.id AS coup_id,coupon.code,'. 'coupon.percent_off,coupons_used.user_id,coupons_used.coupon_id');
        $this->db->from('coupons_used');
        $this->db->join('coupon','coupon.id = coupons_used.coupon_id');
        $this->db->join('users','users.id = coupons_used.user_id');
        $this->db->where('users.role_type','5');
        $r = $this->db->get();
        return $r->result_array();	
    } 
    
}