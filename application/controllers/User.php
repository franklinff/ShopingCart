<?php

class User extends CI_Controller
{   
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Login_model');

        if (!$this->session->userdata('admin_login')) {
            redirect('Login');
        }
    }
    
    /*
     * function name :index
     * List the active users.
     * @access  public
     * @param : null
     * @return : view file
     */
    public function index()
    {
        $data['result'] = $this->User_model->list_user();
        $this->load->view('backend/header.php');
        $this->load->view('backend/sidebar.php');
        $this->load->view("backend/list_user.php", $data);
        $this->load->view('backend/footer.php');
    }

    /*
     * function name :addUser
     * Add user form.
     * @access  public
     * @param : null
     * @return : view file
     */ 
    public function addUser()
    {
        $this->load->view('backend/header.php');
        $this->load->view('backend/sidebar.php');
        $this->load->view("backend/add_user.php");
        $this->load->view('backend/footer.php');
        
        $this->form_validation->set_rules('firstname', 'Firstname', 'required|alpha|min_length[3]|max_length[20]');
        $this->form_validation->set_rules('lastname', 'Lastname', 'required|alpha|min_length[3]|max_length[20]');
        $this->form_validation->set_rules('email', 'Email ID', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|max_length[12]');
        $this->form_validation->set_rules('confirmpwd', 'Confirm Password', 'required|matches[password]');
        //validate form input
        if ($this->form_validation->run() == TRUE) {
            $new_data = array(
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'status' => $this->input->post('optionsRadios'),
                'role_type' => $this->input->post('role_type')
            );
            /*print_r($new_data);
            exit;*/
            if (!empty($new_data)) {
                //print_r($new_data);
                //exit();
                $result = $this->User_model->insert_data($new_data);
                $this->session->set_flashdata('success', 'Registration successfull!');
                redirect('User');
            } else {
                $this->session->set_flashdata('error', 'Error! Please try again.');
            }
        } else {
            $this->session->set_flashdata('error', 'Error! Please try again.');
        }
    }

    /*
     * function name : edit
     * Edit user details.
     * @access  public
     * @param : $id
     * @return : view file
     */
    public function edit($id)
    {        
        $data['current_user'] = $this->User_model->getById($id);             
        /*echo '<pre>';
        print_r($data['current_user']);
        exit;*/
        $new_data = array(
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'email' => $this->input->post('email'),
            'status' => $this->input->post('optionsRadios'),
            'role_type' => $this->input->post('role_type')
        );
        
        $this->form_validation->set_rules('firstname', 'Firstname', 'required|alpha|min_length[3]|max_length[20]');
        $this->form_validation->set_rules('lastname', 'Lastname', 'required|alpha|min_length[3]|max_length[20]');
        $this->form_validation->set_rules('email', 'Email ID', 'required|valid_email');
      
            if ($this->form_validation->run() == TRUE) {          
                $result = $this->User_model->update($new_data, $id);
                $this->session->set_flashdata('success', 'Updated successfully !');
                redirect('User');
            }
            
        $this->load->view('backend/header.php');
        $this->load->view('backend/sidebar.php');
        $this->load->view("backend/edit_user.php",$data);
        $this->load->view('backend/footer.php');             
    }
    
    /*
     * function name :deleteUser
     * Deletes a user.
     * @access  public
     * @param : $id
     * @return : view file
     */
    public function deleteUser($id)
    {
        $this->User_model->delete_user($id);
        redirect('User');
    }

    /*
     * function name :configData
     * Display config list
     * @access  public
     * @param : null
     * @return : view file
     */
    public function configData()
    {
        $data['resultz'] = $this->User_model->config();
    
        $this->load->view('backend/header.php');
        $this->load->view('backend/sidebar.php');
        $this->load->view("backend/config_list.php",$data);
        $this->load->view('backend/footer.php');        
    }

    /*
     * function name :editConfiguration
     * Edit configuration details
     * @access  public
     * @param : $id
     * @return : view file
     */
    public function editConfiguration($id)
    {
        $data['current_config'] = $this->User_model->getConfigId($id);

      /*  echo '<pre>';
        print_r($data['current_config']);
        exit;*/
        $postData = $this->input->post('config_value');
        $this->form_validation->set_rules('config_value', 'Configuration value', 'required|valid_email');

        if ($this->form_validation->run() == TRUE)
        {
            $result = $this->User_model->update_config(array('conf_value'=>$postData),$id);

                if($result)
                {
                $this->session->set_flashdata('success','Configuration Updated!');
                 redirect('User/config_data'); 
                }else
                {
                $this->session->set_flashdata('error','Error! Please try again.');
                } 
        } 
        else
        {
            $this->load->view('backend/header.php');
            $this->load->view('backend/sidebar.php');
            $this->load->view("backend/edit_config.php",$data);
            $this->load->view('backend/footer.php');              
        }   
    }
}
?>







