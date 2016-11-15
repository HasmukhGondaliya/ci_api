<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Login_ctrl extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('reg_model');
        $this->load->library('session');
        log_info($this->input->ip_address());
		log_info('login_ctrl Controller Class Initialized');
		log_debug('login_ctrl Controller Class');
		
    }

    public function index(){
        $this->LoginApi();
        
    }
    public function LoginApi()
    {
        $user_name = $this->input->post('user_name');
        $password = $this->input->post('password');
        if ($this->login_model->LoginApi($user_name, $password)){
            echo "Login Successfull";
			
            $this->session->set_userdata('name',$user_name);
    //        echo json_encode($result);
        } else {
			log_error('Invalid Username and Password');
                echo "{
status: 400,
kind: \"Bad Request\",
problems: [
{
    code: \"400\",
    title: \"Bad Request\",
    message: \"You should enter valid username or password\",
}
}";
            //echo json_encode($result);
           
        }
        //echo json_encode($result);
		
		
	}


}
