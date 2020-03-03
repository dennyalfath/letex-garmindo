<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client_M extends CI_Model
{
    public function get_all_client()
    {
        $this->db->join('tb_company', 'tb_client.company_id = tb_company.company_id', 'left');
        return $this->db->get('tb_client')->result();
    }

    public function get_client_by_id($id)
    {
        $this->db->where('client_id', $id);
        return $this->db->get('tb_client')->row();
    }

    public function insert_client($data)
    {
        return $this->db->insert('tb_client', $data);
    }

    public function update_client($id, $data)
    {
        $this->db->where('client_id', $id);
        return $this->db->update('tb_client', $data);
    }

    public function delete_client($id)
    {
        $this->db->where('client_id', $id);
        return $this->db->delete('tb_client');
    }
}