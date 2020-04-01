<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category_M extends CI_Model
{
    public function get_all_category()
    {
        return $this->db->get('tb_category')->result();
    }

    public function get_category_by_id($id)
    {
        $this->db->where('cat_id', $id);
        return $this->db->get('tb_category')->row();
    }

    public function insert_category($data)
    {
        return $this->db->insert('tb_category', $data);
    }

    public function update_category($id, $data)
    {
        $this->db->where('cat_id', $id);
        return $this->db->update('tb_category', $data);
    }

    public function delete_category($id)
    {
        $this->db->where('cat_id', $id);
        return $this->db->delete('tb_category');
    }
}
