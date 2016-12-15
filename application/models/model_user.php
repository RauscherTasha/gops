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
        $this->load->library('email');


        $email = $this->input->post('email');
        $username = $this->input->post('username');
        $pw = sha1($this->config->item('encryption_key'), $this->input->post('password'));
        /*
                $sql = "INSERT INTO 'users' ('id', 'email', 'username', 'pw', 'validated_email') VALUES (NULL,'" . $email . "','" . $this->db->escape($usern) . "','" . $pw . "', '')"; //$this->db->escape($email)
                $result = $this->db->query($sql);
        */

        $data = array('email' => $email, 'username' => $this->db->escape($username), 'pw' => $pw);
        $this->db->insert('users', $data);

        if ($this->db->affected_rows() === 1) {
            print_r('before set_session ' . $username);
            $this->set_session($username, $email);
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

    private function set_session($username, $email)
    {

        $this->db->select('id, reg_time');
        $this->db->from('users');
        $this->db->where('username', $this->db->escape($username));
        $this->db->limit(1);

        $result = $this->db->get();

        $row = $result->row();
        if (isset($row)) {
            echo $row->id;
            echo $row->reg_time;
        } else {
            echo 'DAFUQ';

        }
        $sess_data = array(
            'user_id' => $row->id,
            'username' => $username,
            'email' => $email,
            'loged_in' => 0
        );

        $this->email_code = md5((string)$row->reg_time);
        $this->session->set_userdata($sess_data);


    }

    private function send_validation_email($email)
    {
        //$this->load->library('email');

        $email_code = $this->email_code;

        $this->email->set_mailtype('html');
        $this->email->from($this->config->item('email'), 'gops register');
        $this->email->to($email); //TO_DOne testing for now but later change to $email
        $this->email->subject('Please Validate your Registration at gops.net');

        $measage = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"></head> <body>';

        $measage .= '<p>Dear ' . $this->session->userdata('username') . ',</p>';

        $measage .= '<p> thanks for reging on gops.net Please <strong> <a href="' . base_url() . 'login/validate_email/' . $email . '/' . $email_code . '"> click here to </a></strong> to activate your Account';

        $measage .= '</body> </html>';

        $this->email->message($measage);
        $this->email->send();

    }

    public function validate_email($email_adress, $email_code)
    {

        $this->db->select('reg_time');
        $this->db->from('users');
        $this->db->where('email', $email_adress);
        $this->db->limit(1);

        $result = $this->db->get();
        $row = $result->row();
        print_r($email_adress . '    ' . md5((string)$row->reg_time . '    ' . $email_code));

        if (isset($row)) {
            if (md5((string)$row->reg_time) === $email_code) {
                $result = $this->activate_account($email_adress);
                if ($result)
                    return true;
            }
        } else {
            return false;
        }
    }

    private function activate_account($email_adress)
    {
        $this->db->set('validated_email', 1);
        $this->db->where('email', $email_adress);
        $this->db->update('users');
        $this->db->trans_complete();

        if ($this->db->affected_rows() == '1') {
            return true;
        } else {
            // any trans error?
            if ($this->db->trans_status() === FALSE) {
                return false;
            }
            return true;
        }
    }
}
