<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms extends CI_Controller
{   

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cms_model');
    }

    public function index() 
    {
        $data['cms_data'] = $this->Cms_model->getAll();
        $this->load->view('backend/header.php');
        $this->load->view('backend/sidebar.php');
        $this->load->view('backend/list_cms.php',$data);
        $this->load->view('backend/footer.php');       
    }


    public function cms_data()
    {
        $data_info = array(
                'title' => $this->input->post('role_type'),
                'content' => $this->input->post('editor1'),
                'meta_title' => $this->input->post('meta_title'),
                'meta_description' => $this->input->post('long_description'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'created_by'=> '2',
                'created_date'=> date('Y-m-d')
                );

        $this->form_validation->set_rules('role_type', 'Long desc.', 'required');
        $this->form_validation->set_rules('meta_title', 'Meta keywd', 'required');
        $this->form_validation->set_rules('long_description', 'Meta title', 'required');
        $this->form_validation->set_rules('meta_keywords', 'Meta desc', 'required');

        if ($this->form_validation->run() == TRUE)
        {
            $this->Cms_model->insert_cms_data($data_info);
            redirect('index.php/Cms');
        }

        $this->load->view('backend/header.php');
        $this->load->view('backend/sidebar.php');
        $this->load->view('backend/cms.php',$data_info);
        $this->load->view('backend/footer.php'); 
    }



    public function update_cms($id)
    {
        $data['individual_cms']=$this->Cms_model->getById($id);
        $data['cms_data'] = $this->Cms_model->getAll();
        $data['cms_da'] = $this->Cms_model->getTitle();

        $data_info = array(
                'title' => $this->input->post('role_type'),
                'content' => $this->input->post('editor1'),
                'meta_title' => $this->input->post('meta_title'),
                'meta_description' => $this->input->post('long_description'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'created_by'=> '2',
                'created_date'=> date('Y-m-d')
                );

        $this->form_validation->set_rules('role_type', 'Long desc.', 'required');
        $this->form_validation->set_rules('meta_title', 'Meta keywd', 'required');
        $this->form_validation->set_rules('long_description', 'Meta title', 'required');
        $this->form_validation->set_rules('meta_keywords', 'Meta desc', 'required');

        if ($this->form_validation->run() == TRUE)
        {
            $result = $this->Cms_model->update_cms_data($data_info,$id);
            redirect('index.php/Cms');
        }

        $this->load->view('backend/header.php');
        $this->load->view('backend/sidebar.php');
        $this->load->view('backend/edit_cms.php',$data);
        $this->load->view('backend/footer.php'); 
    }

} 
