<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Address extends CI_Controller
{   

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_addres_model');

        if (empty($this->session->userdata('user_login')) && empty($this->session->userdata('gmail_data'))){  //user_login is a session set in User_login controller
          redirect(base_url() . 'UserLogin');              //UserLogin is a controller
        }
    } 



    public function index()
    {
        $user = $this->session->userdata('user_login');    
        $user_id = $user[0]['id'];
        $data['result'] = $this->User_addres_model->getUserAddressINDEX($user_id);

        $this->load->view('frontend/header.php');
        $this->load->view('frontend/user_list_address.php',$data);
        $this->load->view('frontend/footer.php');
    }


    /*
     * function name : getCountries 
     * @access  public
     */
    public function getCountries()
    {
        $query = $this->db->get('countries');
        $result = $query->result_array();
        $data = array();

        foreach ($result as $r) {
            $data['value'] = $r['id'];
            $data['label'] = $r['name'];
            $json[] = $data;
        }
        echo json_encode($json);
    }


    /*
     * function name :getStates
     * get_states function for states
     * @access  public 
     * @return : void
     */
    public function getStates() 
    {
        $result = $this->db->where('country_id', $_POST['id'])->get('states')->result_array();
        $data = array();
        foreach ($result as $r) {
            $data['value'] = $r['id'];
            $data['label'] = $r['name'];
            $json[] = $data;
        }
        echo json_encode($json);
    }



    /*
     * function name :getCities
     * get_cities function for cities
     * @access  public 
     * @return : void
     */
    public function getCities()
    {
        $result = $this->db->where('state_id', $_POST['id'])->get('cities')->result_array();
        $data = array();
        foreach ($result as $r) {
            $data['value'] = $r['id'];
            $data['label'] = $r['name'];
            $json[] = $data;
        }
        echo json_encode($json);
    }



    /*
     * function name :addUserAdds
     * add user address
     * @access  public 
     * @return : void
     */
    public function addUserAdds()
    {
        $user = $this->session->userdata('user_login'); // user_login is session name in User_login controller.
        $x = $user[0]['id'];  
        /*echo '<pre>';
        print_r($user_id);
        die();*/
        $this->form_validation->set_rules('address_1', 'Address', 'required');
        $this->form_validation->set_rules('address_2', 'Address', 'required');
        $this->form_validation->set_rules('city', 'City','required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('zip_code', 'Zip code', 'required');

         if ($this->form_validation->run() == TRUE){  
            $data_info = array(
                    'address_1' => $this->input->post('address_1'),
                    'address_2' => $this->input->post('address_2'),
                    'city' => $this->input->post('city'),
                    'state' => $this->input->post('state'),  
                    'country' => $this->input->post('country'),
                    'zipcode' => $this->input->post('zip_code'),
                    'user_id'=> $x
                    );
             $this->User_addres_model->insert_user_address($data_info);
             redirect('Address'); 
        }
        
        $this->load->view('frontend/header.php');
        $this->load->view('frontend/user_add_address.php');
        $this->load->view('frontend/footer.php');
    }



    public function deleteAddress($id)
    {
        $this->User_addres_model->delete_address($id);
        redirect('Address');   
    }



    /*
     * function name :updateAddress
     * updates the address as per the id
     * @access  public
     * @param : id
     * @return : void
     */
    public function updateAddress($id)
    {
        $user = $this->session->userdata('user_login'); // user_login is session name in User_login controller.
        $x = $user[0]['id'];

        $data['pointing_address'] = $this->User_addres_model->getUserAddress($id);
        $data['countries'] = $this->User_addres_model->getCountries();
        $idz = $data['pointing_address'][0]['country'];
        $data['statesxx'] = $this->User_addres_model->getStates($idz);
        $id_state = $data['pointing_address'][0]['st_id'];
        $data['cityxx'] = $this->User_addres_model->getCities($id_state); 

        $this->form_validation->set_rules('address_1', 'Address', 'required');
        $this->form_validation->set_rules('address_2', 'Address', 'required');
        $this->form_validation->set_rules('city', 'City','required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('zip_code', 'Zip code', 'required');

        if ($this->form_validation->run() == TRUE){
            
            $data_info = array(
                    'address_1' => $this->input->post('address_1'),
                    'address_2' => $this->input->post('address_2'),
                    'city' => $this->input->post('city'),
                    'state' => $this->input->post('state'),  
                    'country' => $this->input->post('country'),
                    'zipcode' => $this->input->post('zip_code'),
                    'user_id'=> $x
                    );

             $this->User_addres_model->modify_user_address($data_info,$id);
             redirect('Address'); 
        }
        $this->load->view('frontend/header.php');
        $this->load->view('frontend/edit_user_address',$data);
        $this->load->view('frontend/footer.php');
    }

}
