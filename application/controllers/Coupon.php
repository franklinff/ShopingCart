<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Coupon extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Coupon_model');
        if (!$this->session->userdata('admin_login')) {
            redirect('Login');
        }
    }

    public function index()
    {
        $data['current_coupon'] = $this->Coupon_model->getAll();

        $this->load->view('backend/header.php');
        $this->load->view('backend/sidebar.php');
        $this->load->view('backend/list_coupon.php',$data);   
        $this->load->view('backend/footer.php');   
    }

    public function add_coupon()
    {
       $data_info = array(
                    'code' => $this->input->post('code'),
                    'percent_off' => $this->input->post('percent_off'),
                    'no_of_uses' => $this->input->post('no_of_uses')
                    );

        $this->form_validation->set_rules('code', 'Coupon code', 'required');
        $this->form_validation->set_rules('percent_off', 'Percentage', 'required|regex_match[/^[0-9]+$/]');
        $this->form_validation->set_rules('no_of_uses', 'User','required|regex_match[/^[0-9]+$/]');

       if ($this->form_validation->run() == TRUE){
          $result = $this->Coupon_model->insert_coupon_info($data_info);
          redirect('Coupon');
        }
        $this->load->view('backend/header.php');
        $this->load->view('backend/sidebar.php');
        $this->load->view("backend/add_coupon.php");
        $this->load->view('backend/footer.php');
    }

    public function delete_coupon($id)
    {
        $this->Coupon_model->delete_coupon($id);
        redirect('Coupon');
    }

    public function edit_coupon($id)
    {
      $data['current_coupon'] = $this->Coupon_model->getCoupon($id);

        $data_info = array(
                          'code' => $this->input->post('code'),
                          'percent_off' => $this->input->post('percent_off'),
                          'no_of_uses' => $this->input->post('no_of_uses'),    
                          );

        $id = $data['current_coupon'][0]['id'];

        $this->form_validation->set_rules('code', 'Coupon code', 'required');
        $this->form_validation->set_rules('percent_off', 'Percentage', 'required|numeric');
        $this->form_validation->set_rules('no_of_uses', 'User','required|numeric');

        if ($this->form_validation->run() == TRUE)
            {          
                $result = $this->Coupon_model->edit_coupon($data_info,$id);
                redirect('Coupon');
            }

        $this->load->view('backend/header.php');
        $this->load->view('backend/sidebar.php');
        $this->load->view("backend/edit_coupon.php",$data);
        $this->load->view('backend/footer.php');   
    }


  }
?>