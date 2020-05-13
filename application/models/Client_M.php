<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client_M extends CI_Model
{
    public function get_all_client()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost/letex-garmindo-api/client/read.php",
            CURLOPT_RETURNTRANSFER => true,
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    public function get_client_by_id($id)
    {
        $curl = curl_init();
        $data = array(
            'client_id' => $id
        );

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost/letex-garmindo-api/client/read.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    public function get_client_by_cpid($cpid)
    {
        $curl = curl_init();
        $data = array(
            'company_id' => $cpid
        );

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost/letex-garmindo-api/client/read_by_company.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    public function insert_client($data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost/letex-garmindo-api/client/insert.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    public function update_client($data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost/letex-garmindo-api/client/update.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    public function delete_client($id)
    {
        $curl = curl_init();

        $data = array(
            'client_id' => $id
        );

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost/letex-garmindo-api/client/delete.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }
}
