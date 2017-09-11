<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


class Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
      /*  $this->load->helper(array('form','url'));*/

        if (!$this->session->userdata('admin_login')) {
                redirect('Login');
            }
    }
    
    public function index()
    {
        $data['products'] = $this->Product_model->getAll();
/*      echo '<pre>';
        print_r($data['products']);
        die();*/
        $this->load->view('backend/header.php');
        $this->load->view('backend/sidebar.php');
        $this->load->view('backend/list_product.php',$data);   
        $this->load->view('backend/footer.php');   
    }


    public function add_product()
    {
       $data_info = array(
                'name' => $this->input->post('name'),
                'price' => $this->input->post('price'),
                'quantity' => $this->input->post('quantity'),
                'special_price' => $this->input->post('special_price'),  
                'sku' => $this->input->post('sku'),
                'short_description' => $this->input->post('short_description'),
                'long_description' => $this->input->post('long_description'),
                'meta_title' => $this->input->post('meta_title'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description'),
                'status' => $this->input->post('status'),
                'is_featured' => $this->input->post('is_featured'),
                'special_price_from' => $this->input->post('special_price_from'),
                'special_price_to' => $this->input->post('special_price_to'),
                'category_id' => $this->input->post('role_type')
                );
       
        $this->form_validation->set_rules('name', 'Product name', 'required');
        $this->form_validation->set_rules('price', 'Product price', 'required|regex_match[/^[0-9]+$/]');
        $this->form_validation->set_rules('quantity', 'Product quantity','required|regex_match[/^[0-9]+$/]');
        $this->form_validation->set_rules('special_price', 'Special price', 'regex_match[/^[0-9]+$/]');
        $this->form_validation->set_rules('sku', 'SKU', 'required');
        $this->form_validation->set_rules('short_description', 'Short desc.', 'required');
        $this->form_validation->set_rules('long_description', 'Long desc.', 'required');
        $this->form_validation->set_rules('meta_title', 'Meta title', 'required');
        $this->form_validation->set_rules('meta_keywords', 'Meta keywd', 'required');
        $this->form_validation->set_rules('meta_description', 'Meta desc', 'required');
        
        $config['upload_path'] = '/var/www/html/project/uploads';
        $config['allowed_types'] = 'jpg|png';
        $config['max_size'] = '2048'; 
        $rand1 = rand(10000000, 999999999);
        $rand2 = rand(10000000, 999999999);
        $rand3 = rand(10000000, 999999999);
        $time1 = time();
        $time2 = time();
        $time3 = time();       
               
        if ($this->form_validation->run() == TRUE)
        {
            $i = 0;
            $config['file_name'] = '';
            $postData['image_name'] = array( 
                                 0 => $rand1 . $time1 . strrchr($_FILES['uploadFile_0']['name'],'.'),
                                 1 => $rand2 . $time2 . strrchr($_FILES['uploadFile_1']['name'],'.'),
                                 2 => $rand3 . $time3 . strrchr($_FILES['uploadFile_2']['name'],'.')
                                 );
      
           $p_id = $this->Product_model->insert_product_info($data_info);

            foreach ($postData['image_name'] as $value)
            {             
                $config['file_name'] = $value;

                if (!empty($config['file_name']))
                {
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('uploadFile_'.$i))
                        {
                            $data['image'] = $this->upload->data();
                            $this->Product_model->insert_product_img($data,$data_info,$p_id);
                        } 
                        else
                        {
                            $error = array('error' => $this->upload->display_errors());
                            $this->session->set_flashdata('image_error' . $i, $error['error']);
                        } 
                }
                $i++;   
            }
        redirect('Product'); 
        }
        $data['categories'] = $this->Product_model->getByCat();
        $this->load->view('backend/header.php');
        $this->load->view('backend/sidebar.php');
        $this->load->view('backend/add_product.php',$data);
        $this->load->view('backend/footer.php');
    }



    public function edit_product($id)
    {
        $data['current_product'] = $this->Product_model->getProduct($id); //retrives product information 
        $data['current_image'] = $this->Product_model->getProduct_image($id);// retrives the product image
        $data['category'] = $this->Product_model->getCurrentCategory($id);


        $data_info = array(
                'name' => $this->input->post('name'),
                'price' => $this->input->post('price'),
                'quantity' => $this->input->post('quantity'),
                'special_price' => $this->input->post('special_price'),  
                'sku' => $this->input->post('sku'),
                'short_description' => $this->input->post('short_description'),
                'long_description' => $this->input->post('long_description'),
                'meta_title' => $this->input->post('meta_title'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description'),
                'status' => $this->input->post('status'),
                'is_featured' => $this->input->post('is_featured'),
                'special_price_from' => $this->input->post('special_price_from'),
                'special_price_to' => $this->input->post('special_price_to'),
                'category_id' => $this->input->post('role_type')
                );

        $this->form_validation->set_rules('name', 'Product name', 'required');
        $this->form_validation->set_rules('price', 'Product price', 'required|regex_match[/^[0-9]+$/]');
        $this->form_validation->set_rules('quantity', 'Product quantity','required|regex_match[/^[0-9]+$/]');
        $this->form_validation->set_rules('special_price', 'Special price','regex_match[/^[0-9]+$/]');
        $this->form_validation->set_rules('sku', 'SKU', 'required');
        $this->form_validation->set_rules('short_description', 'Short desc.', 'required');
        $this->form_validation->set_rules('long_description', 'Long desc.', 'required');
        $this->form_validation->set_rules('meta_title', 'Meta title', 'required');
        $this->form_validation->set_rules('meta_keywords', 'Meta keywd', 'required');
        $this->form_validation->set_rules('meta_description', 'Meta desc', 'required');

        $config['upload_path'] = '/var/www/html/project/uploads';
        $config['allowed_types'] = 'jpg|png';
        $config['max_size'] = '2048'; 
        $rand1 = rand(10000000, 999999999);
        $rand2 = rand(10000000, 999999999);
        $rand3 = rand(10000000, 999999999);
        $time1 = time();
        $time2 = time();
        $time3 = time(); 

        if ($this->form_validation->run() == TRUE)
        {
            $this->Product_model->delete_product_images($id); //Images get deleted as per the id of product table 

            $i = 0;
            $config['file_name'] = '';
            $postData['image_name'] = array( 
                                 0 => $rand1 . $time1 . strrchr($_FILES['uploadFile_0']['name'],'.'),
                                 1 => $rand2 . $time2 . strrchr($_FILES['uploadFile_1']['name'],'.'),
                                 2 => $rand3 . $time3 . strrchr($_FILES['uploadFile_2']['name'],'.')
                                 );

            $p_id = $this->Product_model->update_product_info($data_info,$id);
 
            foreach ($postData['image_name'] as $value)
            {             
                $config['file_name'] = $value;
                if (!empty($config['file_name']))
                {
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('uploadFile_'.$i))
                        {
                            $data['image'] = $this->upload->data();
                            $this->Product_model->insert_product_imghh($data,$data_info,$p_id);
                        } 
                        else
                        {
                            $error = array('error' => $this->upload->display_errors());
                            $this->session->set_flashdata('image_error' . $i, $error['error']);
                        } 
                }
                $i++;   
            }
           
        redirect('Product'); 
        }

        $data['categories'] = $this->Product_model->getByCat();// for getting categories in dropdown.
        $this->load->view('backend/header.php');
        $this->load->view('backend/sidebar.php');
        $this->load->view('backend/edit_product.php',$data);
        $this->load->view('backend/footer.php');
    }




    public function delete_product($id)
    {       
        $this->Product_model->delete_product($id);
        redirect('Product');
    }
}
?>

