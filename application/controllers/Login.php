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
            redirect('main');
            /*$this->load->view('includes/view_header', array('title' => 'GOPS Login'));
            $this->load->view('login/success', array('logged_in' => $this->logged_in));
            $this->load->view('includes/view_footer');*/

        } else {
            $this->load_HFview('login/signin', 'GOPS Login');
        }
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
            $this->load_HFview('login/signin', 'GOPS Login');


        } else {
            $result = $this->model_user->login_user();

            switch ($result) {
                case 'logged in':
                    echo 'logged in';
                    redirect('/', 'location');
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

}
