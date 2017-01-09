<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Natascha
 * Date: 10/12/2016
 * Time: 23:39
 */
class Model_main extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add_friend(){

        //check if already in db
        $this->db->select('UID1,UID2');
        $this->db->from('friends');
        $this->db->where('UID1', '1');
        $this->db->or_where('UID1', '2');
        $this->db->or_where('UID2', '1');
        $this->db->or_where('UID2', '2');
        $this->db->limit(1);

        $result = $this->db->get();

        //TODO add check that user dosent befriend himself
        if($result->num_rows()==0 ) {
            $this->db->insert('friends', array('UID1' => '1', 'UID2' => '2'));
        }

    }

    public function new_game()
    {
        /*
        $email = $this->input->post('email');
        $pw = md5($this->input->post('password'));

        $this->db->select('pw,validated_email');
        $this->db->from('users');
        $this->db->where('email', $email);
        $this->db->limit(1);

        $result = $this->db->get();
        $row = $result->row();

        print_r('before set_session ' . $pw . '   database PW:   ' . $row->pw);

        if (isset($row)) {
            if ($pw == $row->pw) {
                if ($row->validated_email) {
                    $this->set_session($email, 1);
                    return 'logged in';
                } else {
                    return 'email_not_validated';
                }
            } else {
                return 'incorrect_password';
            }
        } else {
            return 'email_not_found';
        }
*/


    }

    public function insert_user()
    {
        $this->load->library('email');


        $email = $this->input->post('email');
        $username = $this->input->post('username');
        $pw = md5($this->input->post('password'));//sha1($this->config->item('encryption_key'), $this->input->post('password'));
        /*
                $sql = "INSERT INTO 'users' ('id', 'email', 'username', 'pw', 'validated_email') VALUES (NULL,'" . $email . "','" . $this->db->escape($usern) . "','" . $pw . "', '')"; //$this->db->escape($email)
                $result = $this->db->query($sql);
        */

        $data = array('email' => $email, 'username' => $this->db->escape($username), 'pw' => $pw);
        $this->db->insert('users', $data);

        if ($this->db->affected_rows() === 1) {
            //print_r('before set_session ' . $username);
            $this->set_session($email, 0);
            $this->send_validation_email($email);

            return $username;
        } else {
            $this->load->library('email');
            $this->email->from($this->config->item('email'), 'gops register');
            $this->email->to($this->config->item('email'));
            $this->email->subject('gops.net Error registration');

            if (isset($email)) {
                $this->email->message('Unable to register & insert user with mail of ' . $email . 'to the database');
            } else {
                $this->email->message('Unable to register & insert user to the database');
            }
        }

        $this->email->send();
        return NULL;


    }

    private function set_session($email, $logedin)
    {

        $this->db->select('UID, username, reg_time');
        $this->db->from('users');
        $this->db->where('email', $email);
        $this->db->limit(1);

        $result = $this->db->get();
        $row = $result->row();
        /*
                if (isset($row)) {
                    echo $row->id;
                    echo $row->reg_time;
                } else {
                    echo 'DAFUQ';

                }*/
        $sess_data = array(
            'user_id' => $row->UID,
            'username' => $row->username,
            'email' => $email,
            'loged_in' => $logedin
        );

        $this->email_code = md5((string)$row->reg_time);
        $this->session->set_userdata($sess_data);
    }
}