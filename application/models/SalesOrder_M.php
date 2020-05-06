<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SalesOrder_M extends CI_Model
{
    public function get_all_so()
    {
        return $this->db->get('tb_sales_order')->result();
    }

    public function get_client_by_clid($client)
    {
        $this->db->where('client_id', $client);
        $response = $this->db->get('tb_client')->row();
        return $response;
    }
}
