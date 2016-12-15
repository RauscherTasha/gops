<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_user');
        $this->load->library('form_validation');
        $this->load->helper('security');



        if ($this->session->userdata('loged_in')) {
            $this->logged_in = true;
        } else {
            $this->logged_in = false;
        }
    }

    public function index()
    {
        if ($this->logged_in) {
            $this->load->view('includes/view_header', array('title' => 'GOPS Login'));
            $this->load->view('view_login_success', array('logged_in' => $this->logged_in));
            $this->load->view('includes/view_footer');

        } else {
            $this->load_HFview('view_login_form', 'GOPS Login');
        }
    }

    public function signup()
    {
        $this->load_HFview('view_login_signup', 'GOPS Register');

    }

    public function validate_credentials()
    {
        //$this->load->view('includes/view_header');
        //echo "Validate coming soon!"; //TODO
        //$this->load->view('includes/view_footer');

        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|max_length[65]|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[60]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            //user didn't validate right
            $this->load_HFview('view_login_form', 'GOPS Login');


        } else {
            $result = $this->model_user->login_user();

            switch ($result) {
                case 'logged in':
                    echo 'logged in';
                    redirect('/', 'location');  //if website will runn on windows server find a diffeten method instead of 'location'
                    break;

                case 'email_not_validated':
                    echo 'email not veried';
                    break;
                case 'incorrect_password':
                    echo 'wrong password';
                    break;
                case 'email_not_found':
                    echo 'email not found';
                    break;


            }

        }
    }

    public function create_account()
    {


        // validation rules
        //TODO check xss_clean bzw xss_clean() https://www.codeigniter.com/user_guide/helpers/security_helper.html#id2
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|max_length[65]|is_unique[users.email]|xss_clean');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|max_length[25]|is_unique[users.username]|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[60]|matches[password_confirm]|xss_clean');
        $this->form_validation->set_rules('password_confirm', 'Confirmed Password', 'trim|required|min_length[4]|max_length[60]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            //user didn't validate
            $this->load_HFview('view_login_signup', 'GOPS Register');


        } else {
            $result = $this->model_user->insert_user();

            //$this->load->view('view_login');

            $this->load->view('includes/view_header', array('title' => 'GOPS Login'));
            $this->load->view('view_login_form', array('result' => $result));
            $this->load->view('includes/view_footer');

        }
    }

    public function validate_email($email_address, $email_code)
    {
        $email_code = trim($email_code);

        $validated = $this->model_user->validate_email($email_address, $email_code);

        if ($validated === true) {
            $this->load->view('includes/view_header', array('title' => 'GOPS Email adress Verified'));
            $this->load->view('view_login_email_validated', array('email_adress' => $email_address));
            $this->load->view('includes/view_footer');
        } else {
            echo 'OHHHNOOOOOOO!!!!!';
        }

        //echo 'avilable mabye soone xE';


    }
}
