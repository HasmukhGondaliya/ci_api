<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reg_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

	function ProfileApi()
    {
        $result = $this->db->query("SELECT * FROM t1");
        return $result->result();
    }

    function RegApi($fullname, $username, $email, $password, $mno)
    {
        $this->db->query("INSERT INTO t1(fullname, username, email, password, mno) VALUES ('$fullname','$username','$email','$password','$mno')");
        return true;
    }
	function RegApiCheck($username)
    {
        $result = $this->db->query("SELECT fullname, username, email, password, mno FROM t1 WHERE username='$username'");
        return $result->result();
    }
}
