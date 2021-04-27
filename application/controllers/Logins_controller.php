<?php
class Logins_controller extends CI_Controller
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

    public function login()
    {
        $this->load->view('login/login');

        $identity = $this->input->post('user');
        $password = $this->input->post('pass');

        if($this->ion_auth->login($identity, $password)){
            redirect(base_url('login/settings'));
        }
    }

    public function registre()
    {
        $this->load->view('login/registre');

        $first_name= $this->input->post('firstname');
        $last_name= $this->input->post('lastname');
        $username = $this->input->post('user');
        $password = $this->input->post('pass');
        $email = $this->input->post('email');

        $additional_data = array(
                    'first_name' =>$first_name,
                    'last_name' => $last_name
                    );

        $this->ion_auth->register($username, $password, $email, $additional_data);
    }

    public function settings()
    {
        $this->load->view('login/settings');
    }
    
    public function logout()
    {
        $this->load->view('login/logout');
        $this->ion_auth->logout();
    }

}