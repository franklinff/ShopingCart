<?php

class Reports extends CI_Controller{

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Reports_model');

        if (empty($this->session->userdata('admin_login'))){      
           redirect(base_url() . 'index.php/Login');
        }       
    } 

    public function getCoupons()
    {
		$data['coupons'] = $this->Reports_model->getCoupons();

    }

    public function getCustomers()
    {	
		$data['customers'] = $this->Reports_model->getCustomers();

    }

    public function get_sales_data()
    {

    	$data['sales'] = $this->Reports_model->get_sales_data();


    }


}