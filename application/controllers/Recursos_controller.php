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

    public function formrecursos()
    {
        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");
        $this->load->view('login/navbar-private', $data);
        $this->load->view('recursos/formrecursos');
    }

    public function mostrar_categories($categories)
    {
        foreach ($categories as $cat) {
            echo "<option>" . $cat['nom'] . "</option>";

            $fills = $this->recursos_model->get_fills($cat['id']);

            if (count($fills) > 0)
                $this->mostrar_categories($fills);
        }
    }

    public function recurs_infografia()
    {

        $errorArxiuPrincipal = false;
        $errorArxiusAdjunts = false;
        $errorFormulari = false;

        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");
        $data['controller'] = $this;
        $data["cat"] = $this->recursos_model->get_fills(NULL);
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
            $errorFormulari = false;
        } else {
            $user = $this->ion_auth->user()->row();
            $id_recurs = $this->recursos_model->set_recurs_infografia($user->username);
            mkdir('../../uploads/' . $id_recurs);
            mkdir('../../uploads/' . $id_recurs . '/' . 'adjunts');
            $config['upload_path']          = '../../uploads/' . $id_recurs;
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['encrypt_name'] = true;
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('arxiu')) {
                $error = array('error' => $this->upload->display_errors());
                $errorArxiuPrincipal = true;
            } else {
                $data = array('info_fichero' => $this->upload->data());
                $nom = $data['info_fichero']['file_name'];
                $extensio = $data['info_fichero']['file_ext'];
                $tamany = $data['info_fichero']['file_size'];
                //$user = $this->ion_auth->user()->row();
                $data['error'] = "";
                $this->session->set_flashdata('ok', '<div style="text-align: center; margin-top: -5%;" class="alert alert-success" role="alert"><b>RECURS GUARDAT CORRECTAMENT</b></div>');
                //$id_recurs = $this->recursos_model->set_recurs_infografia($user->username);
                $this->recursos_model->set_fitxer($nom, $extensio, $tamany, $id_recurs);
                //$this->load->view('recursos/infografia', $data);
            }
        }


        for ($i = 1; $i <= 3; $i++) {
            if (isset($_FILES["adjunts" . $i]) && $_FILES["adjunts" . $i]["name"] != null) {
                $config['upload_path']          = '../../uploads/' . $id_recurs . '/' . 'adjunts';
                $config['allowed_types']        = 'gif|jpg|png|jpeg|docx|xlsx|pptx|odt|ods|odp|pdf';
                $config['encrypt_name'] = true;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload("adjunts" . $i)) {
                    $error = array('error' => $this->upload->display_errors());
                    $errorArxiusAdjunts = true;
                } else {
                    $data = array('info_fichero' => $this->upload->data());
                    $nom = $data['info_fichero']['file_name'];
                    $extensio = $data['info_fichero']['file_ext'];
                    $tamany = $data['info_fichero']['file_size'];
                    $user = $this->ion_auth->user()->row();
                    $data['error'] = "";
                    $this->recursos_model->set_fitxer($nom, $extensio, $tamany, $id_recurs);
                }
            }
        }
        if ($errorArxiuPrincipal || $errorArxiusAdjunts || $errorFormulari) {
            $this->load->view('recursos/infografia', $error);
        } else {
            $this->load->view('recursos/infografia', $data);
        }
    }

    public function recurs_video()
    {
        $errorArxiuPrincipal = false;
        $errorArxiusAdjunts = false;
        $errorFormulari = false;

        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");
        $data['controller'] = $this;
        $data["cat"] = $this->recursos_model->get_fills(NULL);
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
            $errorFormulari = false;
        } else {
            $user = $this->ion_auth->user()->row();
            $id_recurs = $this->recursos_model->set_recurs_video($user->username);
            mkdir('../../uploads/' . $id_recurs);
            mkdir('../../uploads/' . $id_recurs . '/' . 'adjunts');
            $config['upload_path']          = '../../uploads/' . $id_recurs;
            $config['allowed_types']        = 'mp4|avi|mkv|mov';
            $config['encrypt_name'] = true;
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('arxiu')) {
                $error = array('error' => $this->upload->display_errors());
                $errorArxiuPrincipal = true;
            } else {
                $data = array('info_fichero' => $this->upload->data());
                $nom = $data['info_fichero']['file_name'];
                $extensio = $data['info_fichero']['file_ext'];
                $tamany = $data['info_fichero']['file_size'];
                //$user = $this->ion_auth->user()->row();
                $data['error'] = "";
                $this->session->set_flashdata('ok', '<div style="text-align: center; margin-top: -5%;" class="alert alert-success" role="alert"><b>RECURS GUARDAT CORRECTAMENT</b></div>');
                //$id_recurs = $this->recursos_model->set_recurs_infografia($user->username);
                $this->recursos_model->set_fitxer($nom, $extensio, $tamany, $id_recurs);
                //$this->load->view('recursos/infografia', $data);
            }
        }


        for ($i = 1; $i <= 3; $i++) {
            if (isset($_FILES["adjunts" . $i]) && $_FILES["adjunts" . $i]["name"] != null) {
                $config['upload_path']          = '../../uploads/' . $id_recurs . '/' . 'adjunts';
                $config['allowed_types']        = 'gif|jpg|png|jpeg|docx|xlsx|pptx|odt|ods|odp|pdf';
                $config['encrypt_name'] = true;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload("adjunts" . $i)) {
                    $error = array('error' => $this->upload->display_errors());
                    $errorArxiusAdjunts = true;
                } else {
                    $data = array('info_fichero' => $this->upload->data());
                    $nom = $data['info_fichero']['file_name'];
                    $extensio = $data['info_fichero']['file_ext'];
                    $tamany = $data['info_fichero']['file_size'];
                    $user = $this->ion_auth->user()->row();
                    $data['error'] = "";
                    $this->recursos_model->set_fitxer($nom, $extensio, $tamany, $id_recurs);
                }
            }
        }
        if ($errorArxiuPrincipal || $errorArxiusAdjunts || $errorFormulari) {
            $this->load->view('recursos/video', $error);
        } else {
            $this->load->view('recursos/video', $data);
        }
    }
    public function recurs_link()
    {

        $errorArxiusAdjunts = false;
        $errorFormulari = false;

        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");
        $data['controller'] = $this;
        $data["cat"] = $this->recursos_model->get_fills(NULL);
        $this->load->view('login/navbar-private', $data);

        $this->form_validation->set_rules(
            'link',
            'Link',
            'required',
            array('required' => 'Omple el camp Link')
        );
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
            $errorFormulari = false;
        } else {
            $user = $this->ion_auth->user()->row();
            $data['error'] = "";
            $this->session->set_flashdata('ok', '<div style="text-align: center; margin-top: -5%;" class="alert alert-success" role="alert"><b>RECURS GUARDAT CORRECTAMENT</b></div>');
            $id_recurs = $this->recursos_model->set_recurs_link($user->username);
            mkdir('../../uploads/' . $id_recurs);
            mkdir('../../uploads/' . $id_recurs . '/' . 'adjunts');
            //$this->load->view('recursos/link_video', $data);
        }

        for ($i = 1; $i <= 3; $i++) {
            if (isset($_FILES["adjunts" . $i]) && $_FILES["adjunts" . $i]["name"] != null) {
                $config['upload_path']          = '../../uploads/' . $id_recurs . '/' . 'adjunts';
                $config['allowed_types']        = 'gif|jpg|png|jpeg|docx|xlsx|pptx|odt|ods|odp|pdf';
                $config['encrypt_name'] = true;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload("adjunts" . $i)) {
                    $error = array('error' => $this->upload->display_errors());
                    $errorArxiusAdjunts = false;
                } else {
                    $data = array('info_fichero' => $this->upload->data());
                    $nom = $data['info_fichero']['file_name'];
                    $extensio = $data['info_fichero']['file_ext'];
                    $tamany = $data['info_fichero']['file_size'];
                    $user = $this->ion_auth->user()->row();
                    $data['error'] = "";
                    $this->recursos_model->set_fitxer($nom, $extensio, $tamany, $id_recurs);
                }
            }
        }
        if ($errorArxiusAdjunts || $errorFormulari) {
            $this->load->view('recursos/link_video', $error);
        } else {
            $this->load->view('recursos/link_video', $data);
        }
    }

    public function recurs_pissarra()
    {
        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");
        $data['controller'] = $this;
        $data["cat"] = $this->recursos_model->get_fills(NULL);
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
            $this->load->view('recursos/pissarra', $data);
        } else {
            $user = $this->ion_auth->user()->row();
            $data['error'] = "";
            $this->session->set_flashdata('ok', '<div style="text-align: center; margin-top: -5%;" class="alert alert-success" role="alert"><b>RECURS GUARDAT CORRECTAMENT</b></div>');
            $id_recurs = $this->recursos_model->set_recurs_pissarra($user->username);
            //$this->load->view('recursos/link_video', $data);
            mkdir('../../uploads/' . $id_recurs);
            mkdir('../../uploads/' . $id_recurs . '/' . 'adjunts');
        }

        for ($i = 1; $i <= 3; $i++) {
            if (isset($_FILES["adjunts" . $i]) && $_FILES["adjunts" . $i]["name"] != null) {
                $config['upload_path']          = '../../uploads/' . $id_recurs . '/' . 'adjunts';
                $config['allowed_types']        = 'gif|jpg|png|jpeg|docx|xlsx|pptx|odt|ods|odp|pdf';
                $config['encrypt_name'] = true;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload("adjunts" . $i)) {
                    $error = array('error' => $this->upload->display_errors());
                    $this->load->view('recursos/pissarra', $error);
                } else {
                    $data = array('info_fichero' => $this->upload->data());
                    $nom = $data['info_fichero']['file_name'];
                    $extensio = $data['info_fichero']['file_ext'];
                    $tamany = $data['info_fichero']['file_size'];
                    $user = $this->ion_auth->user()->row();
                    $data['error'] = "";
                    $this->recursos_model->set_fitxer($nom, $extensio, $tamany, $id_recurs);
                }
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
