<?php
class Logins_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('prova_model');  
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->library('ion_auth');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('grocery_CRUD');
    }

    public function login()
    {
        $this->load->view('login/login');
        $identity = $this->input->post('user');
        $password = $this->input->post('pass');

        if ($this->ion_auth->login($identity, $password)) {
            redirect(base_url('login/profile'));
        }
    }

    public function registre()
    {
        $this->form_validation->set_rules(
            'firstname',
            'Nom',
            'required',
            array('required' => 'Omple el camp Nom')
        );
        $this->form_validation->set_rules(
            'lastname',
            'Cognom',
            'required',
            array('required' => 'Omple el camp Cognom')
        );
        $this->form_validation->set_rules(
            'user',
            'Usuari',
            'required',
            array('required' => 'Omple el camp Usuari')
        );
        $this->form_validation->set_rules(
            'pass',
            'Password',
            'required',
            array('required' => 'Omple el camp Password')
        );
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required',
            array('required' => 'Omple el camp Email')
        );
        $this->form_validation->set_rules(
            'casella',
            'Casella de Privacitat',
            'required',
            array('required' => 'Marca la casella')
        );

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('login/registre');
        } else {
            $first_name = $this->input->post('firstname');
            $last_name = $this->input->post('lastname');
            $username = $this->input->post('user');
            $password = $this->input->post('pass');
            $email = $this->input->post('email');

            $additional_data = array(
                'first_name' => $first_name,
                'last_name' => $last_name
            );
            $this->ion_auth->register($username, $password, $email, $additional_data);
            $this->load->view('login/login'); 
        }
    }

    public function isgroup()
    {
        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");
        $this->load->view('login/navbar-private', $data);
    }
}
