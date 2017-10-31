<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model{

    function __construct() {
        $this->tableName = 'users';
        $this->primaryKey = 'id';
    }

    public function checkUser($data = array()){
        $this->db->select($this->primaryKey);
        $this->db->from($this->tableName);
        $this->db->where(array('oauth_provider'=>$data['oauth_provider'],'oauth_uid'=>$data['oauth_uid']));
        $prevQuery = $this->db->get();
        $prevCheck = $prevQuery->num_rows();
        
        if($prevCheck > 0){
            $prevResult = $prevQuery->row_array();
            $data['modified'] = date("Y-m-d H:i:s");
            $update = $this->db->update($this->tableName,$data,array('id'=>$prevResult['id']));
            $userID = $prevResult['id'];
        }else{
            $data['created'] = date("Y-m-d H:i:s");
            $data['modified'] = date("Y-m-d H:i:s");
            $insert = $this->db->insert($this->tableName,$data);
            $userID = $this->db->insert_id();
        }

        return $userID?$userID:FALSE;
    }
}




/*Views (user_authentication/index.php)

If the user already logged in with their Facebook account, this view will display the profile details, otherwise, Facebook login button will be shown.

<?php
if(!empty($authUrl)) {
    echo '<a href="'.$authUrl.'"><img src="'.base_url().'assets/images/flogin.png" alt=""/></a>';
}else{
?>
<div class="wrapper">
    <h1>Facebook Profile Details </h1>
    <div class="welcome_txt">Welcome <b><?php echo $userData['first_name']; ?></b></div>
    <div class="fb_box">
        <p class="image"><img src="<?php echo $userData['picture_url']; ?>" alt="" width="300" height="220"/></p>
        <p><b>Facebook ID : </b><?php echo $userData['oauth_uid']; ?></p>
        <p><b>Name : </b><?php echo $userData['first_name'].' '.$userData['last_name']; ?></p>
        <p><b>Email : </b><?php echo $userData['email']; ?></p>
        <p><b>Gender : </b><?php echo $userData['gender']; ?></p>
        <p><b>Locale : </b><?php echo $userData['locale']; ?></p>
        <p><b>You are login with : </b>Facebook</p>
        <p><a href="<?php echo $userData['profile_url']; ?>" target="_blank">Click to Visit Facebook Page</a></p>
        <p><b>Logout from <a href="<?php echo $logoutUrl; ?>">Facebook</a></b></p>
    </div>
</div>
<?php } ?>*/