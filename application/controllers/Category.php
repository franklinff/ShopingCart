<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Category_model');
        $this->load->helper(array('form','url'));

                    if (!$this->session->userdata('admin_login')) {
                    redirect('index.php/login');
                    }
    }
    
    public function index()
    {
       /* echo '<pre>';
        print_r( $this->session->userdata('admin_login'));
        die();*/

        $data['categories'] = $this->Category_model->getByCat();
        $this->load->view('backend/header.php');
        $this->load->view('backend/sidebar.php');
        $this->load->view("backend/list_category.php",$data);
        $this->load->view('backend/footer.php');
    }
    
    public function add_category()
    {
        $data['categories'] = $this->Category_model->getAll(); //to display the category in select category dropdown
    
        /*  $cat_procedure = "CALL add_category (?,?,?)";
        $data1 = $this->db->query($cat_procedure, array('name' => $data['name'], 'parent_id' => $data['parent_id'], 'created_date' => date('Y-m-d h:i:s')));*/

        //Validating Category Field
        $this->form_validation->set_rules('category_name', 'Category', 'required|min_length[5]|max_length[15]');
        
                if ($this->form_validation->run() == TRUE) {
                    //Setting values for tabel columns
                    $datacc = array(
                        'name' => $this->input->post('category_name'),
                        'parent_id' => $this->input->post('role_type')
                    );
                    //Transfering data to Model
                    $this->Category_model->insert_category($datacc);
                    //Loading View
                    redirect('index.php/category');                   
                }      
        $this->load->view('backend/header.php');
        $this->load->view('backend/sidebar.php');
        $this->load->view('backend/add_category.php', $data);
        $this->load->view('backend/footer.php');
    }

    public function delete_category($id)
    {
        $this->Category_model->delete_categry($id);
        redirect('index.php/category');
    }


    public function edit_categy($id)
    {
    $data['current_catg'] = $this->Category_model->getCategory($id);
    $data['get_name'] = $this->Category_model->getAll();
        
       /* echo '<pre>';
        print_r($data['current_catg']);
        exit;*/
       /* echo '<pre>';
        print_r($data['get_name']);
        exit;*/

    $datax = array(
                'name' => $this->input->post('category_name'),
                'parent_id' => $this->input->post('role_type')
                );

    //Validating Category Field
    $this->form_validation->set_rules('category_name', 'Category', 'required|min_length[5]|max_length[15]');

         if ($this->form_validation->run() == TRUE)
            {          
                $result = $this->Category_model->update($datax, $id);
                $this->session->set_flashdata('success', 'Updated successfully !');
                redirect('index.php/category');
            }

    $this->load->view('backend/header.php');
    $this->load->view('backend/sidebar.php');
    $this->load->view("backend/edit_category.php",$data);
    $this->load->view('backend/footer.php');   

    }
    
}
?>