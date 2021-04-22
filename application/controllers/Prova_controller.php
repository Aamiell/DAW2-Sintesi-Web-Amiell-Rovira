<?php
class Prova_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('logins_model');
        $this->load->helper('url_helper');
        $this->load->helper('captcha');
        $this->load->library('session');
        //$this->load->library('ion_auth');
    }

    public function home()
    {
        $this->load->view('login/navbar-public');
        $this->load->view('pages/home');
        
    }

    public function about()
    {
        $this->load->view('login/navbar-public');
        $this->load->view('pages/about');
        
    }

    public function login()
    {
        $this->load->view('login/login');
    }

    public function settings()
    {
        $this->load->view('login/settings');
    }

    public function registre()
    {
        $this->load->view('login/registre');
    }

}
