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
}
