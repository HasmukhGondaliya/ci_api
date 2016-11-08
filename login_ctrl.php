<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Login_ctrl extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('reg_model');
        $this->load->library('session');
    }

    public function index_get()
    {
        $abc = $this->login_model->get();

        if (!is_null($abc)) {
            $this->response(array('response' => $abc), 200);
        } else {
            $this->response(array('error' => 'No User Found'), 404);
        }
    }

    public function find_get($id)
    {
        if (!$id) {
            $this->response(null, 400);
        }
        $city = $this->login_model->get($id);

        if (!is_null($city)) {
            $this->response(array('response' => $city), 200);
        } else {
            $this->response(array('error' => 'No User Found'), 404);
        }
    }

    public function index(){
        $this->ProfileApi();
    }

    public function ProfileApi(){
        $result = $this->reg_model->ProfileApi();
        echo json_encode($result);
    }

    public function LoginApi()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $result = $this->login_model->LoginApi($username, $password);
        if ($result){
            echo "Login Successfull";
            $this->session->set_userdata('name',$username);
            echo json_encode($result);
        } else {
            echo "Login Failed Please try again...!";
            echo json_encode($result);
        }
        //echo json_encode($result);
    }

    public function LogoutApi(){
        $sess_array = array('username' => '');
        $this->session->unset_userdata('logged_in', $sess_array);
        echo "Logout Successfull..!";
    }

    public function Fpass()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $result = $this->login_model->Fpass($username);
        if($result){
        
            if($this->login_model->Fpass1($username,$password)){
                echo "Password Changed..!";
            }else{
                echo "Oops..!";
            }
        }else{
            echo "No Username Found..!";
        }
       
    }
}
