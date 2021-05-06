<?php
class Users_controller extends Private_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('prova_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->library('ion_auth');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('grocery_CRUD');
    }

    public function settings_update()
    {
        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");
        $user = $this->ion_auth->user()->row();
        $id = $user->id;
        $data["user"] = $user;

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
        redirect(base_url('login'));
    }
    public function settings()
    {
        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");
        $user = $this->ion_auth->user()->row();
        $id = $user->id;
        $data["user"] = $user;
        $this->load->view('login/settings', $data);
    }

    public function changepass()
    {
        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");
        $user = $this->ion_auth->user()->row();
        $id = $user->id;
        $data["user"] = $user;
        $this->load->view('login/changepass', $data);
    }

    public function changepass_update()
    {
        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");
        $user = $this->ion_auth->user()->row();
        $id = $user->id;
        $data["user"] = $user;
        $this->load->view('login/changepass', $data);
        $password = $this->input->post('actupass');
        $new_pass = $this->input->post('newpass');
        $new_pass2 = $this->input->post('newpass2');

        if ($this->ion_auth->login($user->username, $password) && $new_pass == $new_pass2) {
            $data_update = array(
                'id' => $id,
                'password' => $new_pass2,
            );
            //die("HOLA");
            if ($this->ion_auth->update($id, $data_update)) {
                redirect(base_url('login'));
            }
        }
        //die("HOLA");
    }

    public function profile()
    {
        $user = $this->ion_auth->user()->row();
        $data["user"] = $user;
        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");
        $this->load->view('login/profile', $data);
        //die(print_r($data));
    }

    public function logout()
    {
        //die("HOLA");
        $this->ion_auth->logout();
        redirect(base_url('login'));
    }
}
