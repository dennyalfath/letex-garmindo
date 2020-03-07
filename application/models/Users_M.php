<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_M extends CI_Model
{

    public function get_by_login_data($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        return $this->db->get('tb_user');
    }

    public function insert_user($data)
    {
        return $this->db->insert('tb_user', $data);
    }
}
