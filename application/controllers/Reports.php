<?php

class Reports extends CI_Controller{

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Reports_model');

        if (empty($this->session->userdata('admin_login'))){      
           redirect(base_url() . 'Login');
        }       
    } 

    /*
     * function name : couponsUsed
     * Coupon used by the user is displayed in the list
     * @access  public
     * @param : null
     * @return : view file
     */
    public function couponsUsed()
    {
		$data['coupons'] = $this->Reports_model->getCoupons();
        $this->load->view('backend/header');
        $this->load->view('backend/sidebar');
        $this->load->view('backend/coupons_used',$data);              
        $this->load->view('backend/footer');
    }

    /*
     * function name :customersRegistered
     * 
     * @access  public
     * @param : $start_date,$end_date
     * @return : view file
     */
    public function customersRegistered($start_date='',$end_date='')
    {	
		//$data['customers'] = $this->Reports_model->getCustomers();
        if(!empty($start_date) && !empty($end_date)){
            $start_date = $this->input->get('start_date');
            $start_date = date("Y-m-d", strtotime($start_date));

            $end_date = $this->input->get('end_date');
            $end_date = date("Y-m-d", strtotime($end_date));

            $data['customers'] = $this->Reports_model->getCustomers($start_date,$end_date);
        }else{
            $data['customers'] = $this->Reports_model->getCustomers('','');
        }

        $this->load->view('backend/header');
        $this->load->view('backend/sidebar');
        $this->load->view('backend/customers_registered',$data);              
        $this->load->view('backend/footer');
    }


    /*
     * function name : salesReports
     * Display graphical report of sales done
     * @access  public
     * @param : null
     * @return : view file
     */
    public function salesReports()
    {
    	$data['sales_reports'] = $this->Reports_model->get_sales_data();

        $i = 0;
        $curr_date = date('Y-m-d');
        $prev_date = date_create($curr_date);  //DateTime Object acheived

        date_sub($prev_date,date_interval_create_from_date_string("30 days")); //DateTime Object
        $prev_date = date_format($prev_date,"Y-m-d");  //begining date of current month

        $begin = new DateTime($prev_date); //DateTime Object of the first day of month
        $end = new DateTime($curr_date);  //DateTime Object of the last day of month

        $interval = DateInterval::createFromDateString('1 day');  //DateInterval Object

        $period = new DatePeriod($begin, $interval, $end); //DatePeriod Object containing - start,current,end,interval,recurrences,include_start_date

        $arr_sales = array();
        $i = 0;

        foreach ($period as $dt) {
            $no_of_sales = 0;
            $curr_pt_date = $dt->format("Y-m-d");
            foreach ($data['sales_reports'] as $value) {
                if (!($curr_pt_date < $value['created_date']) && !($curr_pt_date > $value['created_date'])) {
                    $no_of_sales = (int)$value['no_of_sales'];
                }
            }   
            $arr_sales[] = array(
                0 => $i,
                1 => $no_of_sales
            );      
            $i++;
        }
        $data['arr_sales'] = json_encode($arr_sales);

        $this->load->view('backend/header');
        $this->load->view('backend/sidebar');
        $this->load->view('backend/sales_report',$data);              
        $this->load->view('backend/footer');
    }


}