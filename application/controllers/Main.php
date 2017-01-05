<?php
class Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_user');


        if ($this->session->userdata('loged_in')) {
            $this->logged_in = true;
        } else {
            $this->logged_in = false;
        }
    }

    public function index()
    {

        if ($this->logged_in) {
        $this->load->view('includes/view_header', array('title' => 'GOPS'));
        $this->load->view('main/main', array('logged_in' => $this->logged_in));
        $this->load->view('includes/view_footer');
        } else {
            redirect('login');
        }

    }

}
