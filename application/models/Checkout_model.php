<?php


class Checkout_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }


    /*
     * function name : getUserAddress
     * retreives users address as per the user_id
     * @author  Franklin
     * @access  public
     * @param : $user_id
     * @return : array
     */
    public function getUserAddress($user_id) {
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
     * function name : insert
     * Insert the data in table 
     * @author  Franklin
     * @access  public
     * @param : $data
     * @return : int
     */
    public function insert($data) {
        $r = $this->db->insert('user_order', $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }


    /*
     * function name : insert_order_details
     * Insert order details
     * @author  Franklin
     * @access  public
     * @param : $prod_cart_details
     * @return : boolean
     */
    public function insert_order_details($prod_cart_details) {
        $r = $this->db->insert_batch('order_details', $prod_cart_details);
        return $r;
        }


    /*
     * function name : update
     * Update address in user order table
     * @author  Franklin
     * @access  public
     * @param : $data,$addrss,$result_data
     * @return : boolean
     */
    public function update($data, $addrss, $result_data) {
        if ($addrss == 1) {
            $data = array(
                //'billing_address_id' => $data['id'],
                'billing_address_1' => $data['address_1'],
                'billing_address_2' => $data['address_2'],
                'billing_city' => $data['ct_name'],
                'billing_starte' => $data['st_name'],
                'billing_country' => $data['count_name'],
                'billing_zipcode' => $data['zipcode']
            );

            $this->db->set($data);
        }

        if ($addrss == 0) {
            $data = array(
                // 'shipping_address_id' => $data['id'],
                'shipping_address_1' => $data['address_1'],
                'shipping_address_2' => $data['address_2'],
                'shipping_city' => $data['ct_name'],
                'shipping_state' => $data['st_name'],
                'shipping_country' => $data['count_name'],
                'shipping_zipcode' => $data['zipcode']
            );

            $this->db->set($data);
        };
        $this->db->where('id', $result_data);
        $r = $this->db->update('user_order', $data);
        return $r;
    }


    /*
     * function name : update_trans_id
     * Update transaction id in user order table
     * @author  Franklin
     * @access  public
     * @param : $transaction_id,$last_id
     * @return : boolean
     */
    public function update_trans_id($transaction_id, $last_id) {
        $data['transaction_id'] = $transaction_id;
        $data['status'] = 'O';
        $this->db->where('id', $last_id);
        $r = $this->db->update('user_order', $data);
        return $r;
    }


    /*
     * function name : insert_coupon_used
     * Insert coupon code in coupons used table
     * @author  Franklin
     * @access  public
     * @param : $coupon_used
     * @return : boolean
     */
    public function insert_coupon_used($coupon_used) {
        $coupon_used['created_date'] = date('Y-m-d h:i:s');
        $r = $this->db->insert('coupons_used', $coupon_used);
        return $r;
    }

}
