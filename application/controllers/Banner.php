<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner extends CI_Controller
{   
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Banner_model');
        $this->load->helper(array('form', 'url'));
        if (empty($this->session->userdata('admin_login'))) {
        redirect('Login');
        }
    }

    public function index()
    {
        $data['result'] = $this->Banner_model->list_banner();        
        $this->load->view('backend/header.php');
		$this->load->view('backend/sidebar.php');
        $this->load->view("backend/banner_list.php", $data);
        $this->load->view('backend/footer.php');
    }

    public function upload_image()
    {
    	$this->load->view('backend/header.php');
	    $this->load->view('backend/sidebar.php');
	    $this->load->view('backend/banner_add.php');
	    $this->load->view('backend/footer.php');

	    $new_data['status']= $this->input->post('optionsRadios');

		$config['upload_path'] = '/var/www/html/project/uploads/';
		$config['allowed_types'] ='jpg|png';
		$config['max_size'] = '2048';
		$config['max_height'] = '2048';
		$config['max_width'] = '2048';

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload('uploadFile'))
        {
            $error = array('error' => $this->upload->display_errors());   
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $new_data['banner_path'] = $data['upload_data']['file_name'];            
            $result = $this->Banner_model->insert_banner($new_data);
            $this->session->set_flashdata('success', 'Banner successfully added!');
            redirect('Banner');
        }
	}

	public function delete_banner($id)
    {
		$this->Banner_model->delete_banner($id);
        redirect('Banner');
	}


    public function edit_banner($id)
    {
        $data['current_banner'] = $this->Banner_model->getById($id); //able to get data of the row as per the id.

        $this->load->view('backend/header.php');
        $this->load->view('backend/sidebar.php');
        $this->load->view("backend/edit_banner.php", $data);
        $this->load->view('backend/footer.php');

        $config['upload_path'] = '/var/www/html/project/uploads/';
        $config['allowed_types'] ='jpg|png';
        $config['max_size'] = '2048';
        $config['max_height'] = '2048';
        $config['max_width'] = '2048';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload('uploadFile'))
        {
             $error = array('error' => $this->upload->display_errors());   
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $new_data['banner_path'] = $data['upload_data']['file_name']; 
            $new_data['status']= $this->input->post('optionsRadios');           
            $result = $this->Banner_model->update($new_data,$id);
            $this->session->set_flashdata('success', 'Banner successfully updated!');
            redirect('Banner');
        }

    }
}
