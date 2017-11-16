<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CmsFrontend extends CI_Controller
{   

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cms_frontend_model');
    }

    /* coInformation
     * Display Com. INformation
     * @access public
     * @param null
     * @return view file
     */
    public function coInformation()
    {
    	$id= 10;
    	$data['information']=$this->Cms_frontend_model->getData($id);

    	$this->load->view('frontend/header.php');
        $this->load->view('frontend/cms_co_information',$data);
        $this->load->view('frontend/footer');
    }

    /* coTerms
     * Display Com. Terms
     * @access public
     * @param null
     * @return view file
     */
    public function coTerms()
    {
    	$id= 11;
    	$data['information']=$this->Cms_frontend_model->getData($id);

    	$this->load->view('frontend/header.php');
        $this->load->view('frontend/cms_co_information',$data);
        $this->load->view('frontend/footer');
    }

    /* coPrivacy
     * Display Com. Privacy
     * @access public
     * @param null
     * @return view file
     */
    public function coPrivacy()
    {
    	$id= 12;
    	$data['information']=$this->Cms_frontend_model->getData($id);

    	$this->load->view('frontend/header.php');
        $this->load->view('frontend/cms_co_information',$data);
        $this->load->view('frontend/footer');
    }

    /* coRefund
     * Display Com. refund policy
     * @access public
     * @param null
     * @return view file
     */
    public function coRefund()
    {
    	$id= 13;
    	$data['information']=$this->Cms_frontend_model->getData($id);

    	$this->load->view('frontend/header.php');
        $this->load->view('frontend/cms_co_information',$data);
        $this->load->view('frontend/footer');
    }


    /* coCopyright
     * Display Com. copyright
     * @access public
     * @param null
     * @return view file
     */
    public function coCopyright()
    {
    	$id= 14;
    	$data['information']=$this->Cms_frontend_model->getData($id);

    	$this->load->view('frontend/header.php');
        $this->load->view('frontend/cms_co_information',$data);
        $this->load->view('frontend/footer');
    }

}