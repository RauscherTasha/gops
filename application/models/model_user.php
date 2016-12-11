<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Natascha
 * Date: 10/12/2016
 * Time: 23:39
 */
class Model_user extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insert_user()
    {

                $email = $this->input->post('email');
                $usern = $this->input->post('username');
                $pw = sha1($this->config->item('encryption_key'), $this->input->post('password'));
        /*
                $sql = "INSERT INTO 'users' ('id', 'email', 'username', 'pw', 'validated_email') VALUES (NULL,'" . $email . "','" . $this->db->escape($usern) . "','" . $pw . "', '')"; //$this->db->escape($email)
                $result = $this->db->query($sql);
        */

        $data = array('email'=> $email, 'username'=> $usern, 'pw' => $pw );
        $this->db->insert('users', $data);

        if ($this->db->affected_rows() === 1) {
            return $usern;
        } else {
        }


    }
}
