 <!-- <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{   

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_addres_model');
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

    public function get_countries()
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
     * function name :get_states
     * get_states function for states
     * @access  public
     * @param : 
     * @return : void
     */
    public function get_states() 
    {
        $result = $this->db->where('country_id', $_POST['id'])
                ->get('states')
                ->result_array();

        $data = array();
        foreach ($result as $r) {
            $data['value'] = $r['id'];
            $data['label'] = $r['name'];
            $json[] = $data;
        }
        echo json_encode($json);
    }



    /*
     * function name :get_cities
     * get_cities function for cities
     * @access  public
     * @param : 
     * @return : void
     */
    public function get_cities()
    {
        $result = $this->db->where('state_id', $_POST['id'])
                ->get('cities')
                ->result_array();

        $data = array();
        foreach ($result as $r) {
            $data['value'] = $r['id'];
            $data['label'] = $r['name'];
            $json[] = $data;
        }
        echo json_encode($json);
    }



    /*
     * function name :get_cities
     * add user address
     * @access  public
     * @param : 
     * @return : void
     */
    public function add_user_adds()
    {
        $user = $this->session->userdata('user_login'); // user_login is session name in User_login controller.
        $x = $user[0]['id'];
         /*       echo '<pre>';
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
             redirect('index.php/home'); 
        }
        
        $this->load->view('frontend/header.php');
        $this->load->view('frontend/user_add_address.php');
        $this->load->view('frontend/footer.php');
    }


    /*
     * function name :delete_address
     *  
     * @access  public
     * @param : 
     * @return : void
     */
    public function delete_address($id)
    {
        $this->User_addres_model->delete_address($id);
        redirect('index.php/home');   
    }



    /*
     * function name :update_address
     * updates the address as per the id
     * @access  public
     * @param : 
     * @return : void
     */
    public function update_address($id)
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
            /* print_r($data_info);
              die();*/
             $this->User_addres_model->modify_user_address($data_info,$id);
             redirect('index.php/home'); 
        }
        $this->load->view('frontend/header.php');
        $this->load->view('frontend/edit_user_address',$data);
        $this->load->view('frontend/footer.php');
    }


} -->