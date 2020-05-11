<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_M extends CI_Model
{

    public function get_by_login_data($username, $password)
    {
        $curl = curl_init();
        $data = array(
            'username' => $username,
            'password' => $password
        );

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost/letex-garmindo-api/user/login.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    public function get_all_users()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost/letex-garmindo-api/user/read.php",
            CURLOPT_RETURNTRANSFER => true,
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    public function get_user_by_id($id)
    {
        $curl = curl_init();
        $data = array(
            'user_id' => $id
        );

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost/letex-garmindo-api/user/read.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    public function insert_user($data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost/letex-garmindo-api/user/insert.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    public function update_user($data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost/letex-garmindo-api/user/update.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    public function delete_user($id)
    {
        $curl = curl_init();

        $data = array(
            'user_id' => $id
        );

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost/letex-garmindo-api/user/delete.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }
}
