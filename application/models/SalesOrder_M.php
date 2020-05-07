<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SalesOrder_M extends CI_Model
{
    public function get_all_so()
    {
        $this->db->select('tb_sales_order.*, tb_client.client_name');
        $this->db->join('tb_client', 'tb_sales_order.client_id = tb_client.client_id', 'left');
        return $this->db->get('tb_sales_order')->result();
    }

    public function get_so_by_id($id)
    {
        $this->db->select('tb_sales_order.*, tb_client.client_name');
        $this->db->join('tb_client', 'tb_sales_order.client_id = tb_client.client_id', 'left');
        $this->db->where('so_id', $id);
        return $this->db->get('tb_sales_order')->row();
    }

    public function count_all_so()
    {
        return $this->db->get('tb_sales_order')->num_rows();
    }

    public function count_oncutting_so()
    {
        $this->db->where('so_status', 'cut');
        return $this->db->get('tb_sales_order')->num_rows();
    }

    public function count_onsewing_so()
    {
        $this->db->where('so_status', 'sew');
        return $this->db->get('tb_sales_order')->num_rows();
    }

    public function count_onpacking_so()
    {
        $this->db->where('so_status', 'pack');
        return $this->db->get('tb_sales_order')->num_rows();
    }

    public function count_sent_out_so()
    {
        $this->db->where('so_status', 'sent');
        return $this->db->get('tb_sales_order')->num_rows();
    }

    public function count_cancelled_so()
    {
        $this->db->where('so_status', 'cancelled');
        return $this->db->get('tb_sales_order')->num_rows();
    }

    public function get_client_by_clid($client)
    {
        $this->db->where('client_id', $client);
        $response = $this->db->get('tb_client')->row();
        return $response;
    }

    public function insert_sales_order($data)
    {
        return $this->db->insert('tb_sales_order', $data);
    }

    public function update_sales_order($id, $data)
    {
        $this->db->where('so_id', $id);
        return $this->db->update('tb_sales_order', $data);
    }
}
