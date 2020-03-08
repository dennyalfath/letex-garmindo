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

    public function get_all_users()
    {
        return $this->db->get('tb_user')->result();
    }

    public function get_user_by_id($id)
    {
        $this->db->where('user_id', $id);
        return $this->db->get('tb_user')->row();
    }

    public function insert_user($data)
    {
        return $this->db->insert('tb_user', $data);
    }

    public function update_user($id, $data)
    {
        $this->db->where('user_id', $id);
        return $this->db->update('tb_user', $data);
    }

    public function delete_user($id)
    {
        $this->db->where('user_id', $id);
        return $this->db->delete('tb_user');
    }
}
