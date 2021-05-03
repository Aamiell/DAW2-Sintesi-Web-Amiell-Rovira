<?php
class Home_about_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('prova_model');
        $this->load->helper('url_helper');
        //$this->load->helper('captcha');
        $this->load->library('session');
        $this->load->library('ion_auth');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function home()
    {
        $this->load->view('login/navbar-public');
        $this->load->view('pages/home');
    }

    public function about()
    {
        $this->load->view('templates/footer');
        $this->load->view('login/navbar-public');
        $this->load->view('pages/about');
    }
}
