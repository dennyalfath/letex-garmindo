<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_M extends CI_Model
{
    public function get_all_products()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost/letex-garmindo-api/product/read.php",
            CURLOPT_RETURNTRANSFER => true,
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    public function get_product_by_id($id)
    {
        $curl = curl_init();
        $data = array(
            'pr_id' => $id
        );

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost/letex-garmindo-api/product/read.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    public function get_products_by_clid($id)
    {
        $curl = curl_init();
        $data = array(
            'client_id' => $id
        );

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost/letex-garmindo-api/product/read_by_client.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    public function insert_product($data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost/letex-garmindo-api/product/insert.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    public function update_product($data)
    {
        if ($data['pr_picture'] != NULL || $data['pr_picture'] != '') {
            $row = $this->get_product_by_id($data['pr_id']);
            $img_path = './uploads/product-image/' . $row->pr_picture;
            if (file_exists($img_path)) {
                unlink($img_path);

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "http://localhost/letex-garmindo-api/product/update.php",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => json_encode($data),
                ));

                $response = curl_exec($curl);
                curl_close($curl);

                return json_decode($response);
            }
        } else {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://localhost/letex-garmindo-api/product/update.php",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data),
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            return json_decode($response);
        }
    }

    public function delete_product($id)
    {
        $row = $this->get_product_by_id($id);
        $img_path = './uploads/product-image/' . $row->pr_picture;
        if (file_exists($img_path)) {
            unlink($img_path);
        }

        $curl = curl_init();

        $data = array(
            'pr_id' => $id
        );

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost/letex-garmindo-api/product/delete.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }
}
