<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Company_M extends CI_Model
{
    public function get_all_company()
    {
        return $this->db->get('tb_company')->result();
    }

    public function get_company_by_id($id)
    {
        $this->db->where('company_id', $id);
        return $this->db->get('tb_company')->row();
    }

    public function insert_company($data)
    {
        return $this->db->insert('tb_company', $data);
    }

    public function update_company($id, $data)
    {
        $this->db->where('company_id', $id);
        return $this->db->update('tb_company', $data);
    }

    public function delete_company($id)
    {
        $this->db->where('company_id', $id);
        return $this->db->delete('tb_company');
    }
}
