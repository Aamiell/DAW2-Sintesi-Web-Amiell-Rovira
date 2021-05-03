<?php
class Logins_controller extends CI_Controller //Private_controller
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

        // die($identity."-".$password);
        if ($this->ion_auth->login($identity, $password)) {

            //die('user ok');
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
            //$data['missatge'] = '<center><h5>OMPLE TOTS ELS CAMPS I MARCA LA CASELLA</h5></center>';
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

    public function settings()
    {
        $user = $this->ion_auth->user()->row();
        $id = $user->id;
        $data["user"] = $user;
        $this->load->view('login/settings', $data);


        $first_name = $this->input->post('firstname');
        $last_name = $this->input->post('lastname');
        $username = $this->input->post('user');
        $email = $this->input->post('email');

        $data_update = array(
            'id' => $id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'username' => $username,
            'email' => $email
        );
        $this->ion_auth->update($id, $data_update);
        //die($user->id);
    }
    public function changepass()
    {
        $user = $this->ion_auth->user()->row();
        $id = $user->id;
        $data["user"] = $user;
        $this->load->view('login/changepass', $data);
        $password = $this->input->post('actupass');
        $new_pass = $this->input->post('newpass');
        $new_pass2 = $this->input->post('newpass2');

        if ($this->ion_auth->login($id, $password) || $new_pass == $new_pass2) {
            $data_update = array(
                'id' => $id,
                'first_name' => $new_pass,
            );
            $this->ion_auth->update($id, $data_update);
            die("HOLA");
        }
    }

    public function profile()
    {
        $user = $this->ion_auth->user()->row();
        $data["user"] = $user;
        $this->load->view('login/profile', $data);
        //die(print_r($data));
    }

    public function logout()
    {
        //die("HOLA");
        $this->ion_auth->logout();
        redirect(base_url('login'));
    }

    public function usersgrocery()
    {
        $this->load->view('login/navbar-private');
        $crud = new grocery_CRUD();

        $crud->set_theme('tablestrap4');
        $crud->set_table('users');

        $crud->columns('first_name', 'last_name', 'username', 'email', 'password');

        $crud->display_as('first_name', 'Nom');
        $crud->display_as('last_name', 'Cognom');
        $crud->display_as('username', 'Usuari');
        $crud->display_as('email', 'Email');
        $crud->display_as('password', 'Contrasenya');

        $crud->change_field_type('id', 'invisible');

        $output = $crud->render();
        $this->_render_output($output);
    }

    protected function _render_output($output = null)
    {

        $this->load->view('grocery/groceryusers', (array)$output);
    }
}
