<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class login_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
        public function get($id = null)
    {
        if (!is_null($id)) {
            $query = $this->db->select('*')->from('t1')->where('id', $id)->get();
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }

            return null;
        }

        $query = $this->db->select('*')->from('t1')->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

        return null;
    }

    function LoginApi($username, $password)
    {
        $result = $this->db->query("SELECT id,username,password FROM t1 WHERE username='$username' and password='$password'");
        return $result->result();
    }
    function Fpass($username)
    {
        $result = $this->db->query("SELECT username FROM t1 WHERE username='$username'");
        return $result->result();
    }
    function Fpass1($username,$password)
    {
        $result = $this->db->query("UPDATE t1 SET password='$password' WHERE username='$username'");
        return true;
    }
}
