<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function index()
    {
        $this->load->view('includes/header');
        $this->load->view('login_form');
        $this->load->view('includes/footer');
    }

    public function signup()
    {
        $this->load->view('includes/header');
        $this->load->view('login_signup');
        $this->load->view('includes/footer');

    }

    public function validate_credentials()
    {
        $this->load->view('includes/header');
        $this->load->view('login_form');
        $this->load->view('includes/footer');

    }

    public function create_account()
    {

    }
}
