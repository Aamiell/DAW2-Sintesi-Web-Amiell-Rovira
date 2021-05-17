<?php
class Recursos_controller extends Profe_controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('recursos_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->library('ion_auth');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('grocery_CRUD');
        $this->load->library('upload');
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
        /*         $this->form_validation->set_rules(
            'tags',
            'Tags',
            'required',
            array('required' => 'Omple el camp tags')
        ); */

        if ($this->form_validation->run() === FALSE) {
            $data['error'] = "";
            $this->load->view('recursos/formrecurs', $data);
        } else {
            // if per saber quina opcio del select a marcat
            $config['upload_path']          = "./uploads";
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['encrypt_name'] = true;
            //$config['max_size']             = 100;
            //$config['max_width']            = 1024;
            //$config['max_height']           = 768;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('arxiu')) {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('recursos/formrecurs', $error);
            } else {
                $data = array('info_fichero' => $this->upload->data());
                $nom = $data['info_fichero']['file_name'];
                $extensio = $data['info_fichero']['file_ext'];
                $tamany = $data['info_fichero']['file_size'];
                $data['error'] = "";
                $this->recursos_model->set_recurs();
                $this->recursos_model->set_fitxer($nom, $extensio, $tamany);
                $this->load->view('recursos/formrecurs', $data);
            }
        }
    }
    public function recursosgrocery()
    {
        $this->load->view('templates/footer');

        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");
        $this->load->view('login/navbar-private', $data);
        $crud = new grocery_CRUD();

        $crud->set_theme('tablestrap4');
        $crud->set_table('recursos');

        $crud->columns('tipus_recurs', 'titol', 'tipus_access');

        $crud->display_as('tipus_recurs', 'Tipus Recurs');
        $crud->display_as('titol', 'Titol');
        $crud->display_as('tipus_access', 'Access');
        $crud->display_as('email', 'Email');
        $crud->change_field_type('id', 'invisible');

        $crud->unset_clone();

        $output = $crud->render();
        $this->_render_output($output);
    }
    protected function _render_output($output = null)
    {

        $this->load->view('recursos/recursos', (array)$output);
    }
}