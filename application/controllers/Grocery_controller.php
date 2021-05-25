<?php
class Grocery_controller extends Admin_controller
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
    public function usersgrocery()
    {
        $this->load->view('templates/footer');

        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");
        $this->load->view('login/navbar-private', $data);
        $crud = new grocery_CRUD();

        $crud->set_theme('tablestrap4');
        $crud->set_table('users');
        $crud->set_language("catalan");

        $crud->columns('first_name', 'last_name', 'username', 'email');
        $crud->fields('first_name', 'last_name', 'username', 'password', 'email', 'active');
        $crud->field_type('ip_address', 'hidden');
        $crud->field_type('activation_selector', 'hidden');
        $crud->field_type('activation_code', 'hidden');
        $crud->field_type('forgotten_password_selector', 'hidden');
        $crud->field_type('forgotten_password_code', 'hidden');
        $crud->field_type('forgotten_password_time', 'hidden');
        $crud->field_type('remember_selector', 'hidden');
        $crud->field_type('remember_code', 'hidden');
        $crud->field_type('created_on', 'hidden');
        $crud->field_type('last_login', 'hidden');
        $crud->field_type('active', 'hidden');
        $crud->field_type('remember_code', 'hidden');
        $crud->field_type('company', 'hidden');
        $crud->field_type('phone', 'hidden');
        $crud->field_type('password', 'hidden');

        $crud->display_as('first_name', 'Nom');
        $crud->display_as('last_name', 'Cognom');
        $crud->display_as('username', 'Usuari');
        $crud->display_as('email', 'Email');


        $crud->change_field_type('id', 'invisible');
        $crud->change_field_type('active', 'invisible');

        $crud->unset_clone();

        $output = $crud->render();
        $this->_render_output($output);
    }
    public function users_groupgrocery()
    {
        $this->load->view('templates/footer');

        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");
        $this->load->view('login/navbar-private', $data);
        $crud = new grocery_CRUD();
        $crud->set_language("catalan");

        $crud->display_as('user_id', "Nom d'usuari");
        $crud->display_as('group_id', 'Rol');
        $crud->set_relation('user_id', 'users', 'username');
        $crud->field_type("user_id", 'readonly');
        $crud->set_relation('group_id', 'groups', 'description');

        $crud->set_theme('tablestrap4');
        $crud->set_table('users_groups');

        $crud->unset_clone();
        $crud->unset_delete();

        $crud->change_field_type('id', 'invisible');

        $output = $crud->render();
        $this->_render_output($output);
    }

    protected function _render_output($output = null)
    {

        $this->load->view('grocery/groceryusers', (array)$output);
    }

    public function recursosgrocery()
    {
        $this->load->view('templates/footer');

        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");
        $this->load->view('login/navbar-private', $data);
        $crud = new grocery_CRUD();
        $crud->set_language("catalan");

        $crud->set_theme('tablestrap4');
        $crud->set_table('recursos');

        $crud->columns('tipus_recurs', 'titol', 'propietari');

        $crud->display_as('tipus_recurs', 'Tipus Recurs');
        $crud->display_as('titol', 'Titol');
        $crud->display_as('tipus_access', 'Access');
        $crud->display_as('email', 'Email');
        $crud->display_as('propietari', 'Propietari');
        $crud->change_field_type('id', 'invisible');

        $crud->unset_clone();
        $output = $crud->render();
        $this->_render_output($output);
    }
    protected function _render_output2($output = null)
    {
        $this->load->view('grocery/groceryrecurs', (array)$output);
    }

    public function tagsgrocery()
    {
        $this->load->view('templates/footer');

        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");
        $this->load->view('login/navbar-private', $data);
        $crud = new grocery_CRUD();
        $crud->set_language("catalan");
        

        $crud->set_theme('tablestrap4');
        $crud->set_table('tags');

        //$crud->columns('id', 'nom');

        $crud->display_as('nom', 'Nom');
        $crud->change_field_type('id', 'invisible');

        $crud->unset_clone();

        $output = $crud->render();
        $this->_render_output($output);
    }

}
