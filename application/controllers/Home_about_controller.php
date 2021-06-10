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
        if (!$this->ion_auth->logged_in()) {
            $this->load->view('login/navbar-public');
            $this->load->view('pages/home');
            $this->load->view('templates/footer');
        } else {
            $data['isalumne'] = $this->ion_auth->in_group("alumne");
            $data['isprofe'] = $this->ion_auth->in_group("profe");
            $data['isadmin'] = $this->ion_auth->in_group("admin");
            $this->load->view('login/navbar-private', $data);
            $this->load->view('pages/home');
            $this->load->view('templates/footer');
        }
    }

    public function about()
    {
        if (!$this->ion_auth->logged_in()) {
            $this->load->view('login/navbar-public');
            $this->load->view('pages/about');
        } else {
            $data['isalumne'] = $this->ion_auth->in_group("alumne");
            $data['isprofe'] = $this->ion_auth->in_group("profe");
            $data['isadmin'] = $this->ion_auth->in_group("admin");
            $this->load->view('login/navbar-private', $data);
            $this->load->view('pages/about');
        }
    }
}
