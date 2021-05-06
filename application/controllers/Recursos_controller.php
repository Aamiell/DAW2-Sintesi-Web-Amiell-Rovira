<?php
class Recursos_controller extends Profe_controller
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

    public function formrecurs()
    {

        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");
        $this->load->view('login/navbar-private', $data);

        $this->form_validation->set_rules(
            'titol',
            'Titol',
            'required',
            array('required' => 'Omple el camp Titol')
        );
        $this->form_validation->set_rules(
            'descripcio',
            'Descripcio',
            'required',
            array('required' => 'Omple el camp Descripcio')
        );
        $this->form_validation->set_rules(
            'explicacio',
            'Explicacio',
            'required',
            array('required' => 'Omple el camp Explicacio')
        );
        $this->form_validation->set_rules(
            'recurs',
            'Recurs',
            'required',
            array('required' => 'Selecciona un tipus de video recurs')
        );
        $this->form_validation->set_rules(
            'tags',
            'Tags',
            'required',
            array('required' => 'Omple el camp tags')
        );

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('recursos/formrecurs');
        } else {
            $titol = $this->input->post('titol');
            $descripcio = $this->input->post('descripcio');
            $explicacio = $this->input->post('explicacio');
            $recurs = $this->input->post('recurs');
            $tags = $this->input->post('tags');

            $additional_data = array(
                'first_name' => $titol,
                'last_name' => $descripcio,
                'explicacio' => $explicacio,
                'recurs' => $recurs,
                'tags' => $tags
            );
            $this->ion_auth->register($additional_data);
            //$this->load->view('login/login');
        }
    }
}
