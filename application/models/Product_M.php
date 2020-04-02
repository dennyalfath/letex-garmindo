<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_M extends CI_Model
{
    public function get_all_products()
    {
        $this->db->join('tb_category', 'tb_category.cat_id = tb_product.cat_id', 'left');
        $this->db->join('tb_client', 'tb_client.client_id = tb_product.client_id', 'left');
        return $this->db->get('tb_product')->result();
    }

    public function get_product_by_id($id)
    {
        $this->db->join('tb_category', 'tb_category.cat_id = tb_product.cat_id', 'left');
        $this->db->join('tb_client', 'tb_client.client_id = tb_product.client_id', 'left');
        $this->db->where('tb_product.pr_id', $id);
        return $this->db->get('tb_product')->row();
    }

    public function insert_product($data)
    {
        return $this->db->insert('tb_product', $data);
    }

    public function update_product($id, $data)
    {
        if ($data['pr_picture'] != NULL || $data['pr_picture'] != '') {
            $this->db->where('pr_id', $id);
            $row = $this->db->get('tb_product')->row();
            $img_path = './uploads/product-image/' . $row->pr_picture;
            if (file_exists($img_path)) {
                unlink($img_path);
                $this->db->where('pr_id', $id);
                return $this->db->update('tb_product', $data);
            }
        } else {
            $this->db->where('pr_id', $id);
            return $this->db->update('tb_product', $data);
        }
    }

    public function delete_product($id)
    {
        $this->db->where('pr_id', $id);
        $row = $this->db->get('tb_product')->row();
        $img_path = './uploads/product-image/' . $row->pr_picture;
        if (file_exists($img_path)) {
            unlink($img_path);
        }
        $this->db->where('pr_id', $id);
        return $this->db->delete('tb_product');
    }
}
