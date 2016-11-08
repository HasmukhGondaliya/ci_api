<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reg_ctrl extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('reg_model');
        $this->load->library('session');
    }

    public function index()
    {
        $this->RegApi();
    }

    public function RegApi()
    {
        $fullname = $this->input->post('fullname');
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $mno = $this->input->post('mno');

        $result = $this->reg_model->RegApiCheck($username);
        if ($result)
            {
                echo "User already registerd";
                echo json_encode($result);
            } else {
                
                if($this->reg_model->RegApi($fullname, $username, $email, $password, $mno)){
                    echo "Register Successfull";
                } else {
                    echo "Registration failed...!";
                }
            }
        
    }
}
