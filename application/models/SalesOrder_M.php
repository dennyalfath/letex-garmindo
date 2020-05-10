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
        $this->db->select('tb_sales_order.*, tb_client.client_id, tb_client.client_name');
        $this->db->join('tb_client', 'tb_sales_order.client_id = tb_client.client_id', 'left');
        $this->db->where('so_id', $id);
        return $this->db->get('tb_sales_order')->row();
    }

    public function get_so_num_by_id($id)
    {
        $this->db->select('so_id, so_number');
        $this->db->where('so_id', $id);
        return $this->db->get('tb_sales_order')->row();
    }

    public function get_all_so_details($so_number)
    {
        $this->db->join('tb_user', 'tb_sales_order_detail.user_id = tb_user.user_id', 'left');
        $this->db->join('tb_product', 'tb_sales_order_detail.pr_id = tb_product.pr_id', 'left');
        $this->db->where('so_number', $so_number);
        return $this->db->get('tb_sales_order_detail')->result();
    }

    public function count_all_so()
    {
        return $this->db->get('tb_sales_order')->num_rows();
    }

    public function count_oncutting_so()
    {
        $this->db->where('sod_status', 'cut');
        return $this->db->get('tb_sales_order_detail')->num_rows();
    }

    public function count_onsewing_so()
    {
        $this->db->where('sod_status', 'sew');
        return $this->db->get('tb_sales_order_detail')->num_rows();
    }

    public function count_onpacking_so()
    {
        $this->db->where('sod_status', 'pack');
        return $this->db->get('tb_sales_order_detail')->num_rows();
    }

    public function count_sent_out_so()
    {
        $this->db->where('sod_status', 'sent');
        return $this->db->get('tb_sales_order_detail')->num_rows();
    }

    public function count_cancelled_so()
    {
        $this->db->where('sod_status', 'cancelled');
        return $this->db->get('tb_sales_order_detail')->num_rows();
    }

    public function get_company_by_clid($client)
    {
        //Get client data to find the company id
        $this->db->where('client_id', $client);
        $client_data = $this->db->get('tb_client')->row();

        //Get company SO Number based on company id
        $this->db->select('so_number, company_code, company_id');
        $this->db->where('company_id', $client_data->company_id);
        $response = $this->db->get('tb_company')->row();
        return $response;
    }

    public function insert_sales_order($data)
    {
        return $this->db->insert('tb_sales_order', $data);
    }

    public function insert_sales_order_detail($data)
    {
        return $this->db->insert_batch('tb_sales_order_detail', $data);
    }

    public function update_sales_order_status($id) 
    {
        $so = $this->get_so_num_by_id($id);
        $details = $this->get_all_so_details($so->so_number);
        
        $status_list = array('cancelled', 'sent', 'pack', 'sew', 'cut');
        $index = 0;
        $status = '';
        $total = '';

        foreach ($details as $detail) {
            $detail_index = array_search($detail->sod_status, array_values($status_list));
            if ($detail_index >= $index) {
                $status = $detail->sod_status;
                $index = $detail_index;
            }
            if ($detail->sod_status != 'cancelled') {
                $total += $detail->price * $detail->qty;                
            }
        }
        $data = array(
            'so_status' => $status,
            'so_total_amount' => $total
        );
        $this->db->where('so_id', $id);
        $this->db->update('tb_sales_order', $data);
    }

    public function update_sales_order($id, $data)
    {
        $this->db->where('so_id', $id);
        return $this->db->update('tb_sales_order', $data);
    }

    public function update_sales_order_detail($id, $data)
    {
        $this->db->where('sod_id', $id);
        return $this->db->update('tb_sales_order_detail', $data);
    }
}
