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
            $this->load->view('recursos/infografia', $data);
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
                $this->load->view('recursos/infografia', $error);
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
                    $this->load->view('recursos/infografia', $error);
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
            $user = $this->ion_auth->user()->row();
            $id_recurs = $this->recursos_model->set_recurs_video($user->username);
            mkdir('../../uploads/' . $id_recurs);
            mkdir('../../uploads/' . $id_recurs . '/' . 'adjunts');
            $config['upload_path']          = '../../uploads/' . $id_recurs;
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
                //$user = $this->ion_auth->user()->row();
                $data['error'] = "";
                $this->session->set_flashdata('ok', '<div style="text-align: center; margin-top: -5%;" class="alert alert-success" role="alert"><b>RECURS GUARDAT CORRECTAMENT</b></div>');
                //$id_recurs = $this->recursos_model->set_recurs_video($user->username);
                $this->recursos_model->set_fitxer($nom, $extensio, $tamany, $id_recurs);
                //$this->load->view('recursos/video', $data);
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
                    $this->load->view('recursos/video', $error);
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

    public function recurs_link()
    {
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
            $this->load->view('recursos/link_video', $data);
        } else {
            $user = $this->ion_auth->user()->row();
            $data['error'] = "";
            $this->session->set_flashdata('ok', '<div style="text-align: center; margin-top: -5%;" class="alert alert-success" role="alert"><b>RECURS GUARDAT CORRECTAMENT</b></div>');
            $id_recurs = $this->recursos_model->set_recurs_link($user->username);
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
                    $this->load->view('recursos/link_video', $error);
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

    public function recurs_pissarra()
    {
        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");
        $this->load->view('login/navbar-private', $data);
        $this->load->view('recursos/pissarra');
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
