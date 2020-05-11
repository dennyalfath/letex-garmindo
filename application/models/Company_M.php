<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Company_M extends CI_Model
{
    public function get_all_company()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost/letex-garmindo-api/company/read.php",
            CURLOPT_RETURNTRANSFER => true,
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    public function get_company_list()
    {
        $this->db->select('company_id, company_name');
        return $this->db->get('tb_company')->result();
    }

    public function get_company_by_id($id)
    {
        $curl = curl_init();
        $data = array(
            'company_id' => $id
        );

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost/letex-garmindo-api/company/read.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    public function insert_company($data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost/letex-garmindo-api/company/insert.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    public function update_company($data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost/letex-garmindo-api/company/update.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    public function update_company_data($data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost/letex-garmindo-api/company/update_so_number.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    public function delete_company($id)
    {
        $curl = curl_init();

        $data = array(
            'company_id' => $id
        );

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost/letex-garmindo-api/company/delete.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }
}
