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
        /*$this->form_validation->set_rules(
            'recurs',
            'Recurs',
            'required',
            array('required' => 'Selecciona un tipus de video recurs')
        );*/
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
            if ($this->input->post("recurs") == "infografia") {
                $config['upload_path']          = "./uploads";
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['encrypt_name'] = true;
                $this->upload->initialize($config);
            } else if ($this->input->post("recurs") == "video") {
                $config['upload_path']          = "./uploads";
                $config['allowed_types']        = 'mp4|avi|mkv|flv';
                $config['encrypt_name'] = true;
                $this->upload->initialize($config);
            }
            if (!$this->upload->do_upload('arxiu')) {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('recursos/formrecurs', $error);
            } else {
                $data = array('info_fichero' => $this->upload->data());
                $nom = $data['info_fichero']['file_name'];
                $extensio = $data['info_fichero']['file_ext'];
                $tamany = $data['info_fichero']['file_size'];
                $user = $this->ion_auth->user()->row();
                $data['error'] = "";
                $id_recurs = $this->recursos_model->set_recurs($user->username);
                $this->recursos_model->set_fitxer($nom, $extensio, $tamany, $id_recurs);
                $this->load->view('recursos/formrecurs', $data);
            }

            $mostrarSortida = false;

            for ($i = 1; $i <= 3; $i++) {
                if (isset($_FILES["adjunts" . $i]) && $_FILES["adjunts" . $i]["name"] != null) {
                    $config['upload_path']          = "./uploads";
                    $config['allowed_types']        = 'gif|jpg|png|jpeg|docx|xlsx|pptx|odt|ods|odp|pdf';
                    $config['encrypt_name'] = true;
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload("adjunts" . $i)) {
                        $error = array('error' => $this->upload->display_errors());
                        $this->load->view('recursos/formrecurs', $error);
                    } else {
                        $data = array('info_fichero' => $this->upload->data());
                        $nom = $data['info_fichero']['file_name'];
                        $extensio = $data['info_fichero']['file_ext'];
                        $tamany = $data['info_fichero']['file_size'];
                        $user = $this->ion_auth->user()->row();
                        $data['error'] = "";
                        $this->recursos_model->set_fitxer($nom, $extensio, $tamany, $id_recurs);
                        $mostrarSortida = true;
                    }
                }
            }

            if ($mostrarSortida) {
                $this->load->view('recursos/formrecurs', $data);
            }
            //Si la creat anar a la url del recurs
            //http://localhost/sintesi/index.php/recursos/recursosgrocery/read/32
        }
    }

    public function formrecursos()
    {
        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");
        $this->load->view('login/navbar-private', $data);
        $this->load->view('recursos/formrecursos');
    }

    public function recurs_infografia()
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
        if ($this->form_validation->run() === FALSE) {
            $data['error'] = "";
            $this->load->view('recursos/infografia', $data);
        } else {
            $config['upload_path']          = "./uploads";
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['encrypt_name'] = true;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('arxiu')) {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('recursos/infografia', $error);
            } else {
                $data = array('info_fichero' => $this->upload->data());
                $nom = $data['info_fichero']['file_name'];
                $extensio = $data['info_fichero']['file_ext'];
                $tamany = $data['info_fichero']['file_size'];
                $user = $this->ion_auth->user()->row();
                $data['error'] = "";
                $this->session->set_flashdata('ok', '<div style="text-align: center; margin-top: -5%;" class="alert alert-success" role="alert"><b>RECURS GUARDAT CORRECTAMENT<b></div>');
                $id_recurs = $this->recursos_model->set_recurs_infografia($user->username);
                $this->recursos_model->set_fitxer($nom, $extensio, $tamany, $id_recurs);
                $this->load->view('recursos/infografia', $data);
            }
        }
        $mostrarSortida = false;

        for ($i = 1; $i <= 3; $i++) {
            if (isset($_FILES["adjunts" . $i]) && $_FILES["adjunts" . $i]["name"] != null) {
                $config['upload_path']          = "./uploads";
                $config['allowed_types']        = 'gif|jpg|png|jpeg|docx|xlsx|pptx|odt|ods|odp|pdf';
                $config['encrypt_name'] = true;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload("adjunts" . $i)) {
                    $error = array('error' => $this->upload->display_errors());
                    $this->load->view('recursos/formrecurs', $error);
                } else {
                    $data = array('info_fichero' => $this->upload->data());
                    $nom = $data['info_fichero']['file_name'];
                    $extensio = $data['info_fichero']['file_ext'];
                    $tamany = $data['info_fichero']['file_size'];
                    $user = $this->ion_auth->user()->row();
                    $data['error'] = "";
                    $this->recursos_model->set_fitxer($nom, $extensio, $tamany, $id_recurs);
                    $mostrarSortida = true;
                }
            }
        }

        if ($mostrarSortida) {
            $this->load->view('recursos/formrecursos', $data);
        }
    }

    public function recurs_pissarra()
    {
        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");
        $this->load->view('login/navbar-private', $data);
        $this->load->view('recursos/pissarra');
    }

    public function recurs_video()
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
        if ($this->form_validation->run() === FALSE) {
            $data['error'] = "";
            $this->load->view('recursos/video', $data);
        } else {
            $config['upload_path']          = "./uploads";
            $config['allowed_types']        = 'mp4|avi|mkv|flv';
            $config['encrypt_name'] = true;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('arxiu')) {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('recursos/video', $error);
            } else {
                $data = array('info_fichero' => $this->upload->data());
                $nom = $data['info_fichero']['file_name'];
                $extensio = $data['info_fichero']['file_ext'];
                $tamany = $data['info_fichero']['file_size'];
                $user = $this->ion_auth->user()->row();
                $data['error'] = "";
                $this->session->set_flashdata('ok', '<div style="text-align: center; margin-top: -5%;" class="alert alert-success" role="alert"><b>RECURS GUARDAT CORRECTAMENT<b></div>');
                $id_recurs = $this->recursos_model->set_recurs_video($user->username);
                $this->recursos_model->set_fitxer($nom, $extensio, $tamany, $id_recurs);
                $this->load->view('recursos/video', $data);
            }
        }
    }

    public function recurs_link_video()
    {
        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");
        $this->load->view('login/navbar-private', $data);
        $this->load->view('recursos/link_video');
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

        $user = $this->ion_auth->user()->row();

        $crud->where('propietari', $user->username);

        $crud->set_theme('tablestrap4');
        $crud->set_table('recursos');

        $crud->columns('tipus_recurs', 'titol', 'propietari');
        $crud->change_field_type('tipus_recurs', 'disabled');

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
    protected function _render_output($output = null)
    {

        $this->load->view('recursos/recursos', (array)$output);
    }
}
