<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms_frontend extends CI_Controller
{   

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cms_frontend_model');
    }

    public function co_information()
    {
    	$id= 10;
    	$data['information']=$this->Cms_frontend_model->getData($id);

    	$this->load->view('frontend/header.php');
        $this->load->view('frontend/cms_co_information',$data);
        $this->load->view('frontend/footer');
    }

    public function co_terms()
    {
    	$id= 11;
    	$data['information']=$this->Cms_frontend_model->getData($id);

    	$this->load->view('frontend/header.php');
        $this->load->view('frontend/cms_co_information',$data);
        $this->load->view('frontend/footer');
    }

    public function co_privacy()
    {
    	$id= 12;
    	$data['information']=$this->Cms_frontend_model->getData($id);

    	$this->load->view('frontend/header.php');
        $this->load->view('frontend/cms_co_information',$data);
        $this->load->view('frontend/footer');
    }

    public function co_refund()
    {
    	$id= 13;
    	$data['information']=$this->Cms_frontend_model->getData($id);

    	$this->load->view('frontend/header.php');
        $this->load->view('frontend/cms_co_information',$data);
        $this->load->view('frontend/footer');
    }

    public function co_copyright()
    {
    	$id= 14;
    	$data['information']=$this->Cms_frontend_model->getData($id);

    	$this->load->view('frontend/header.php');
        $this->load->view('frontend/cms_co_information',$data);
        $this->load->view('frontend/footer');
    }

}