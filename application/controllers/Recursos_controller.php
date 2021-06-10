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
        $this->load->helper('download');
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
            echo "<option value='" . $cat['id'] . "'>" . $cat['nom'] . "</option>";
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
                $nom_original = $data['info_fichero']['client_name'];
                $extensio = $data['info_fichero']['file_ext'];
                $tamany = $data['info_fichero']['file_size'];
                $fitxer = 1;
                $data['error'] = "";
                $this->session->set_flashdata('ok', '<div style="text-align: center; margin-top: -8%; width: 70%" class="alert alert-success" role="alert"><b>RECURS GUARDAT CORRECTAMENT</b></div>');
                $this->recursos_model->set_fitxer($nom, $nom_original, $extensio, $tamany, $id_recurs, $fitxer);
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
                    $nom_original = $data['info_fichero']['client_name'];
                    $extensio = $data['info_fichero']['file_ext'];
                    $tamany = $data['info_fichero']['file_size'];
                    $fitxer = 0;
                    $user = $this->ion_auth->user()->row();
                    $data['error'] = "";
                    $this->recursos_model->set_fitxer($nom, $nom_original, $extensio, $tamany, $id_recurs, $fitxer);
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
                $nom_original = $data['info_fichero']['client_name'];
                $extensio = $data['info_fichero']['file_ext'];
                $tamany = $data['info_fichero']['file_size'];
                $fitxer = 1;
                $data['error'] = "";
                $this->session->set_flashdata('ok', '<div style="text-align: center; margin-top: -8%; width: 70%" class="alert alert-success" role="alert"><b>RECURS GUARDAT CORRECTAMENT</b></div>');
                $this->recursos_model->set_fitxer($nom, $nom_original, $extensio, $tamany, $id_recurs, $fitxer);
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
                    $nom_original = $data['info_fichero']['client_name'];
                    $extensio = $data['info_fichero']['file_ext'];
                    $tamany = $data['info_fichero']['file_size'];
                    $fitxer = 0;
                    $user = $this->ion_auth->user()->row();
                    $data['error'] = "";
                    $this->recursos_model->set_fitxer($nom, $nom_original, $extensio, $tamany, $id_recurs, $fitxer);
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
            $this->session->set_flashdata('ok', '<div style="text-align: center; margin-top: -8%; width: 70%" class="alert alert-success" role="alert"><b>RECURS GUARDAT CORRECTAMENT</b></div>');
            $id_recurs = $this->recursos_model->set_recurs_link($user->username);
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
                    $errorArxiusAdjunts = false;
                } else {
                    $data = array('info_fichero' => $this->upload->data());
                    $nom = $data['info_fichero']['file_name'];
                    $nom_original = $data['info_fichero']['client_name'];
                    $extensio = $data['info_fichero']['file_ext'];
                    $tamany = $data['info_fichero']['file_size'];
                    $user = $this->ion_auth->user()->row();
                    $data['error'] = "";
                    $fitxer = 0;
                    $this->recursos_model->set_fitxer($nom, $nom_original, $extensio, $tamany, $id_recurs, $fitxer);
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
        // $this->form_validation->set_rules(
        //     'pissarra',
        //     'Pissarra',
        //     'required',
        //     array('required' => 'Omple el camp pissarra')
        // );
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
            $this->session->set_flashdata('ok', '<div style="text-align: center; margin-top: -8%; width: 70%" class="alert alert-success" role="alert"><b>RECURS GUARDAT CORRECTAMENT</b></div>');
            $id_recurs = $this->recursos_model->set_recurs_pissarra($user->username);
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
                    $errorArxiusAdjunts = false;
                } else {
                    $data = array('info_fichero' => $this->upload->data());
                    $nom = $data['info_fichero']['file_name'];
                    $nom_original = $data['info_fichero']['client_name'];
                    $extensio = $data['info_fichero']['file_ext'];
                    $tamany = $data['info_fichero']['file_size'];
                    $user = $this->ion_auth->user()->row();
                    $data['error'] = "";
                    $fitxer = 0;
                    $this->recursos_model->set_fitxer($nom, $nom_original, $extensio, $tamany, $id_recurs, $fitxer);
                }
            }
        }
        if ($errorArxiusAdjunts || $errorFormulari) {
            $this->load->view('recursos/pissarra', $error);
        } else {
            $this->load->view('recursos/pissarra', $data);
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

        $crud->unset_clone();
        $crud->unset_read();
        $crud->unset_edit();
        $crud->unset_add();

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
        $crud->callback_before_delete(array($this, 'delete_file_before_delete'));

        $output = $crud->render();
        $this->_render_output($output);
    }

    public function delete_file_before_delete($primary_key)
    {
        $query = $this->db->get_where('fitxers', array('id_recurs' => $primary_key));
        $files = $query->result_array();

        foreach ($files as $file) {
            if ($file['fitxer_principal'] == '1') {
                $principal = "../../uploads/" . $primary_key . '/' . $file['nom'];
                unlink($principal);
            } else {
                $adjunts = "../../uploads/" . $primary_key . '/adjunts/' . $file['nom'];
                unlink($adjunts);
            }
        }
    }

    protected function _render_output($output = null)
    {

        $this->load->view('recursos/recursos', (array)$output);
    }

    public function recursos_categoria($cat)
    {
        $this->load->view('templates/footer');

        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");

        $recursos = $this->recursos_model->get_recursos_cat($cat);

        $data['recursos'] = $recursos;
        $this->load->view('login/navbar-private', $data);
        $this->load->view('recursos/list_recursos_cat', $data);
    }

    public function mostrar_infografia($id)
    {
        $this->load->view('templates/footer');

        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");

        $recursos = $this->recursos_model->get_recursos_id($id);
        $adjunts = $this->recursos_model->get_fitxer_adjunts($id);
        $arxiu = $this->recursos_model->get_fitxer_principal($id);

        $data['recursos'] = $recursos;
        $data['adjunts'] = $adjunts;
        $data['arxiu'] = $arxiu;
        $data['id_recurs'] = $id;
        $this->load->view('login/navbar-private', $data);
        $this->load->view('recursos/mostrar_infografia', $data);
    }

    public function mostrar_video($id)
    {
        $this->load->view('templates/footer');

        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");

        $recursos = $this->recursos_model->get_recursos_id($id);
        $adjunts = $this->recursos_model->get_fitxer_adjunts($id);
        $arxiu = $this->recursos_model->get_fitxer_principal($id);

        $data['recursos'] = $recursos;
        $data['adjunts'] = $adjunts;
        $data['arxiu'] = $arxiu;
        $data['id_recurs'] = $id;

        $this->load->view('login/navbar-private', $data);
        $this->load->view('recursos/mostrar_video', $data);
    }

    public function mostrar_link_video($id)
    {
        $this->load->view('templates/footer');

        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");

        $recursos = $this->recursos_model->get_recursos_id($id);
        $adjunts = $this->recursos_model->get_fitxer_adjunts($id);
        $arxiu = $this->recursos_model->get_fitxer_principal($id);

        $data['recursos'] = $recursos;
        $data['adjunts'] = $adjunts;
        $data['arxiu'] = $arxiu;
        $data['id_recurs'] = $id;

        $this->load->view('login/navbar-private', $data);
        $this->load->view('recursos/mostrar_link_video', $data);
    }

    public function mostrar_pissarra($id)
    {
        $this->load->view('templates/footer');

        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");

        $recursos = $this->recursos_model->get_recursos_id($id);
        $adjunts = $this->recursos_model->get_fitxer_adjunts($id);
        $arxiu = $this->recursos_model->get_fitxer_principal($id);

        $data['recursos'] = $recursos;
        $data['adjunts'] = $adjunts;
        $data['arxiu'] = $arxiu;
        $data['id_recurs'] = $id;
        $this->load->view('login/navbar-private', $data);
        $this->load->view('recursos/mostrar_pissarra', $data);
    }

    public function veure_arxiu_principal($id_recurs)
    {
        $arxiu = $this->recursos_model->get_fitxer_principal($id_recurs);
        force_download('../../uploads/' . $id_recurs . '/' . $arxiu['nom'], NULL);
    }

    public function veure_arxius_adjunts($id_recurs, $id_arxiu)
    {
        $arxiu = $this->recursos_model->get_nom_arxius_adjunt($id_arxiu);
        force_download('../../uploads/' . $id_recurs . '/adjunts/' . $arxiu['nom'], NULL);
    }

    public function llistar_recursos_usuari()
    {

        $this->load->view('templates/footer');
        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");
        $this->load->view('login/navbar-private', $data);

        $infouser = $this->ion_auth->user()->row();
        $user = $infouser->username;
        $data['user'] = $user;
        $recursos = $this->recursos_model->recursos_user($user);
        $data['recursos'] = $recursos;
        $this->load->view('recursos/list_recursos_modificar', $data);
    }

    public function llistar_recursos()
    {
        $this->load->view('templates/footer');
        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");
        $this->load->view('login/navbar-private', $data);

        $recursos = $this->recursos_model->get_recursos();
        $data['recursos'] = $recursos;
        $this->load->view('recursos/list_recursos', $data);
    }

    public function borrar_arxiu_principal_infografia($id_recurs)
    {
        $arxiu = $this->recursos_model->get_fitxer_principal($id_recurs);
        unlink('../../uploads/' . $id_recurs . '/' . $arxiu['nom']);
        $this->recursos_model->borrar_fitxer_principal($id_recurs);
        redirect(base_url('recursos/modificar_infografia/' . $id_recurs));
    }

    public function borrar_arxius_adjunts_infografia($id_recurs, $id_arxiu)
    {
        $arxiu = $this->recursos_model->get_nom_arxius_adjunt($id_arxiu);
        unlink('../../uploads/' . $id_recurs . '/adjunts/' . $arxiu['nom']);
        $this->recursos_model->borrar_fitxers_adjunts($id_recurs, $id_arxiu);
        redirect(base_url('recursos/modificar_infografia/' . $id_recurs));
    }

    public function modificar_infografia_form($id)
    {
        $this->load->view('templates/footer');

        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");
        $this->load->view('login/navbar-private', $data);

        $recursos = $this->recursos_model->get_recursos_id($id);
        $adjunts = $this->recursos_model->get_fitxer_adjunts($id);
        $arxiu = $this->recursos_model->get_fitxer_principal($id);

        $data['recursos'] = $recursos;
        $data['adjunts'] = $adjunts;
        $data['arxiu'] = $arxiu;
        $data['id_recurs'] = $id;
        $data['controller'] = $this;
        $data["cat"] = $this->recursos_model->get_fills(NULL);
        $this->load->view('recursos/modificar_infografia', $data);
    }

    public function modificar_infografia()
    {
        $errorArxiuPrincipal = false;
        $errorArxiusAdjunts = false;
        $errorFormulari = false;

        $id = $this->input->post('id');
        $this->load->view('templates/footer');

        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");
        $this->load->view('login/navbar-private', $data);

        $recursos = $this->recursos_model->get_recursos_id($id);
        $adjunts = $this->recursos_model->get_fitxer_adjunts($id);
        $arxiu = $this->recursos_model->get_fitxer_principal($id);

        $data['recursos'] = $recursos;
        $data['adjunts'] = $adjunts;
        $data['arxiu'] = $arxiu;
        $data['id_recurs'] = $id;
        $data['controller'] = $this;
        $data["cat"] = $this->recursos_model->get_fills(NULL);
        $user = $this->ion_auth->user()->row();
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
            $this->recursos_model->modificar_infografia($id, $user->username);

            if (!is_dir('../../uploads/' . $id)) {
                mkdir('../../uploads/' . $id);
            }
            if (!is_dir('../../uploads/' . $id . '/' . 'adjunts')) {
                mkdir('../../uploads/' . $id . '/' . 'adjunts');
            }

            $config['upload_path']          = '../../uploads/' . $id;
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['encrypt_name'] = true;
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('arxiu')) {
                $data['error'] = $this->upload->display_errors();
                $errorArxiuPrincipal = true;
            } else {
                $data = array('info_fichero' => $this->upload->data());
                $nom = $data['info_fichero']['file_name'];
                $nom_original = $data['info_fichero']['client_name'];
                $extensio = $data['info_fichero']['file_ext'];
                $tamany = $data['info_fichero']['file_size'];
                $fitxer = 1;
                $data['error'] = "";
                $this->session->set_flashdata('ok', '<div style="text-align: center; margin-top: -8%; width: 70%" class="alert alert-success" role="alert"><b>RECURS GUARDAT CORRECTAMENT</b></div>');
                $this->recursos_model->set_fitxer($nom, $nom_original, $extensio, $tamany, $id, $fitxer);
            }
        }

        for ($i = 1; $i <= 3; $i++) {
            if (isset($_FILES["adjunts" . $i]) && $_FILES["adjunts" . $i]["name"] != null) {
                $config['upload_path']          = '../../uploads/' . $id . '/' . 'adjunts';
                $config['allowed_types']        = 'gif|jpg|png|jpeg|docx|xlsx|pptx|odt|ods|odp|pdf';
                $config['encrypt_name'] = true;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload("adjunts" . $i)) {
                    $data['error'] = $this->upload->display_errors();
                    print_r($data['error']);
                    die();
                    $errorArxiusAdjunts = false;
                } else {
                    $data = array('info_fichero' => $this->upload->data());
                    $nom = $data['info_fichero']['file_name'];
                    $nom_original = $data['info_fichero']['client_name'];
                    $extensio = $data['info_fichero']['file_ext'];
                    $tamany = $data['info_fichero']['file_size'];
                    $user = $this->ion_auth->user()->row();
                    $data['error'] = "";
                    $fitxer = 0;
                    $this->recursos_model->set_fitxer($nom, $nom_original, $extensio, $tamany, $id, $fitxer);
                }
            }
        }

        if ($errorArxiuPrincipal || $errorFormulari || $errorArxiusAdjunts) {
            $this->load->view('recursos/modificar_infografia', $data);
        } else {
            redirect(base_url('recursos/mostrar_infografia/' . $id));
        }
    }

    public function borrar_arxiu_principal_video($id_recurs)
    {
        $arxiu = $this->recursos_model->get_fitxer_principal($id_recurs);
        unlink('../../uploads/' . $id_recurs . '/' . $arxiu['nom']);
        $this->recursos_model->borrar_fitxer_principal($id_recurs);
        redirect(base_url('recursos/modificar_video/' . $id_recurs));
    }

    public function borrar_arxius_adjunts_video($id_recurs, $id_arxiu)
    {
        $arxiu = $this->recursos_model->get_nom_arxius_adjunt($id_arxiu);
        unlink('../../uploads/' . $id_recurs . '/adjunts/' . $arxiu['nom']);
        $this->recursos_model->borrar_fitxers_adjunts($id_recurs, $id_arxiu);
        redirect(base_url('recursos/modificar_video/' . $id_recurs));
    }

    public function modificar_video_form($id)
    {
        $this->load->view('templates/footer');

        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");

        $this->load->view('login/navbar-private', $data);

        $recursos = $this->recursos_model->get_recursos_id($id);
        $adjunts = $this->recursos_model->get_fitxer_adjunts($id);
        $arxiu = $this->recursos_model->get_fitxer_principal($id);

        $data['recursos'] = $recursos;
        $data['adjunts'] = $adjunts;
        $data['arxiu'] = $arxiu;
        $data['id_recurs'] = $id;
        $data['controller'] = $this;
        $data["cat"] = $this->recursos_model->get_fills(NULL);
        $this->load->view('recursos/modificar_video', $data);
    }

    public function modificar_video()
    {
        $errorArxiuPrincipal = false;
        $errorArxiusAdjunts = false;
        $errorFormulari = false;

        $id = $this->input->post('id');
        $this->load->view('templates/footer');

        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");
        $this->load->view('login/navbar-private', $data);

        $recursos = $this->recursos_model->get_recursos_id($id);
        $adjunts = $this->recursos_model->get_fitxer_adjunts($id);
        $arxiu = $this->recursos_model->get_fitxer_principal($id);

        $data['recursos'] = $recursos;
        $data['adjunts'] = $adjunts;
        $data['arxiu'] = $arxiu;
        $data['id_recurs'] = $id;
        $data['controller'] = $this;
        $data["cat"] = $this->recursos_model->get_fills(NULL);
        $user = $this->ion_auth->user()->row();
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
            $this->recursos_model->modificar_video($id, $user->username);

            if (!is_dir('../../uploads/' . $id)) {
                mkdir('../../uploads/' . $id);
            }
            if (!is_dir('../../uploads/' . $id . '/' . 'adjunts')) {
                mkdir('../../uploads/' . $id . '/' . 'adjunts');
            }

            $config['upload_path']          = '../../uploads/' . $id;
            $config['allowed_types']        = 'mp4|avi|mkv|mov';
            $config['encrypt_name'] = true;
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('arxiu')) {
                $data['error'] = $this->upload->display_errors();
                $errorArxiuPrincipal = true;
            } else {
                $data = array('info_fichero' => $this->upload->data());
                $nom = $data['info_fichero']['file_name'];
                $nom_original = $data['info_fichero']['client_name'];
                $extensio = $data['info_fichero']['file_ext'];
                $tamany = $data['info_fichero']['file_size'];
                $fitxer = 1;
                $data['error'] = "";
                $this->session->set_flashdata('ok', '<div style="text-align: center; margin-top: -8%; width: 70%" class="alert alert-success" role="alert"><b>RECURS GUARDAT CORRECTAMENT</b></div>');
                $this->recursos_model->set_fitxer($nom, $nom_original, $extensio, $tamany, $id, $fitxer);
            }
        }

        for ($i = 1; $i <= 3; $i++) {
            if (isset($_FILES["adjunts" . $i]) && $_FILES["adjunts" . $i]["name"] != null) {
                $config['upload_path']          = '../../uploads/' . $id . '/' . 'adjunts';
                $config['allowed_types']        = 'gif|jpg|png|jpeg|docx|xlsx|pptx|odt|ods|odp|pdf';
                $config['encrypt_name'] = true;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload("adjunts" . $i)) {
                    $data['error'] = $this->upload->display_errors();
                    $errorArxiusAdjunts = false;
                } else {
                    $data = array('info_fichero' => $this->upload->data());
                    $nom = $data['info_fichero']['file_name'];
                    $nom_original = $data['info_fichero']['client_name'];
                    $extensio = $data['info_fichero']['file_ext'];
                    $tamany = $data['info_fichero']['file_size'];
                    $user = $this->ion_auth->user()->row();
                    $data['error'] = "";
                    $fitxer = 0;
                    $this->recursos_model->set_fitxer($nom, $nom_original, $extensio, $tamany, $id, $fitxer);
                }
            }
        }
        if ($errorArxiuPrincipal || $errorFormulari || $errorArxiusAdjunts) {
            $this->load->view('recursos/modificar_video', $data);
        } else {
            redirect(base_url('recursos/mostrar_video/' . $id));
        }
    }

    public function borrar_arxius_adjunts_link($id_recurs, $id_arxiu)
    {
        $arxiu = $this->recursos_model->get_nom_arxius_adjunt($id_arxiu);
        unlink('../../uploads/' . $id_recurs . '/adjunts/' . $arxiu['nom']);
        $this->recursos_model->borrar_fitxers_adjunts($id_recurs, $id_arxiu);
        redirect(base_url('recursos/modificar_link_video/' . $id_recurs));
    }

    public function modificar_link_video_form($id)
    {

        $this->load->view('templates/footer');

        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");

        $this->load->view('login/navbar-private', $data);

        $recursos = $this->recursos_model->get_recursos_id($id);
        $adjunts = $this->recursos_model->get_fitxer_adjunts($id);
        $arxiu = $this->recursos_model->get_fitxer_principal($id);

        $data['recursos'] = $recursos;
        $data['adjunts'] = $adjunts;
        $data['arxiu'] = $arxiu;
        $data['id_recurs'] = $id;
        $data['controller'] = $this;
        $data["cat"] = $this->recursos_model->get_fills(NULL);
        $this->load->view('recursos/modificar_link_video', $data);
    }

    public function modificar_link_video()
    {
        $id = $this->input->post('id');
        $this->load->view('templates/footer');

        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");
        $this->load->view('login/navbar-private', $data);

        $recursos = $this->recursos_model->get_recursos_id($id);
        $adjunts = $this->recursos_model->get_fitxer_adjunts($id);
        $arxiu = $this->recursos_model->get_fitxer_principal($id);

        $data['recursos'] = $recursos;
        $data['adjunts'] = $adjunts;
        $data['arxiu'] = $arxiu;
        $data['id_recurs'] = $id;
        $data['controller'] = $this;
        $data["cat"] = $this->recursos_model->get_fills(NULL);
        $user = $this->ion_auth->user()->row();

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
            $this->session->set_flashdata('ok', '<div style="text-align: center; margin-top: -8%; width: 70%" class="alert alert-success" role="alert"><b>RECURS GUARDAT CORRECTAMENT</b></div>');
            $this->recursos_model->modificar_link_video($id, $user->username);
            if (!is_dir('../../uploads/' . $id)) {
                mkdir('../../uploads/' . $id);
            }
            if (!is_dir('../../uploads/' . $id . '/' . 'adjunts')) {
                mkdir('../../uploads/' . $id . '/' . 'adjunts');
            }
        }

        for ($i = 1; $i <= 3; $i++) {
            if (isset($_FILES["adjunts" . $i]) && $_FILES["adjunts" . $i]["name"] != null) {
                $config['upload_path']          = '../../uploads/' . $id . '/' . 'adjunts';
                $config['allowed_types']        = 'gif|jpg|png|jpeg|docx|xlsx|pptx|odt|ods|odp|pdf';
                $config['encrypt_name'] = true;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload("adjunts" . $i)) {
                    $data['error'] = $this->upload->display_errors();
                    $errorArxiusAdjunts = false;
                } else {
                    $data = array('info_fichero' => $this->upload->data());
                    $nom = $data['info_fichero']['file_name'];
                    $nom_original = $data['info_fichero']['client_name'];
                    $extensio = $data['info_fichero']['file_ext'];
                    $tamany = $data['info_fichero']['file_size'];
                    $user = $this->ion_auth->user()->row();
                    $data['error'] = "";
                    $fitxer = 0;
                    $this->recursos_model->set_fitxer($nom, $nom_original, $extensio, $tamany, $id, $fitxer);
                }
            }
        }
        if ($errorArxiusAdjunts || $errorFormulari) {
            $this->load->view('recursos/link_video', $data);
        } else {
            redirect(base_url('recursos/mostrar_link_video/' . $id));
        }
    }

    public function borrar_arxius_adjunts_pissarra($id_recurs, $id_arxiu)
    {
        $arxiu = $this->recursos_model->get_nom_arxius_adjunt($id_arxiu);
        unlink('../../uploads/' . $id_recurs . '/adjunts/' . $arxiu['nom']);
        $this->recursos_model->borrar_fitxers_adjunts($id_recurs, $id_arxiu);
        redirect(base_url('recursos/modificar_pissarra/' . $id_recurs));
    }


    public function modificar_pissarra_form($id)
    {

        $this->load->view('templates/footer');

        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");

        $this->load->view('login/navbar-private', $data);

        $recursos = $this->recursos_model->get_recursos_id($id);
        $adjunts = $this->recursos_model->get_fitxer_adjunts($id);
        $arxiu = $this->recursos_model->get_fitxer_principal($id);

        $data['recursos'] = $recursos;
        $data['adjunts'] = $adjunts;
        $data['arxiu'] = $arxiu;
        $data['id_recurs'] = $id;
        $data['controller'] = $this;
        $data["cat"] = $this->recursos_model->get_fills(NULL);
        $this->load->view('recursos/modificar_pissarra', $data);
    }

    public function modificar_pissarra()
    {
        $errorArxiusAdjunts = false;
        $errorFormulari = false;

        $id = $this->input->post('id');
        $this->load->view('templates/footer');

        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isprofe'] = $this->ion_auth->in_group("profe");
        $data['isadmin'] = $this->ion_auth->in_group("admin");
        $this->load->view('login/navbar-private', $data);

        $recursos = $this->recursos_model->get_recursos_id($id);
        $adjunts = $this->recursos_model->get_fitxer_adjunts($id);
        $arxiu = $this->recursos_model->get_fitxer_principal($id);

        $data['recursos'] = $recursos;
        $data['adjunts'] = $adjunts;
        $data['arxiu'] = $arxiu;
        $data['id_recurs'] = $id;
        $data['controller'] = $this;
        $data["cat"] = $this->recursos_model->get_fills(NULL);
        $user = $this->ion_auth->user()->row();
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
            $this->recursos_model->modificar_pissarra($id, $user->username);

            if (!is_dir('../../uploads/' . $id)) {
                mkdir('../../uploads/' . $id);
            }
            if (!is_dir('../../uploads/' . $id . '/' . 'adjunts')) {
                mkdir('../../uploads/' . $id . '/' . 'adjunts');
            }

            for ($i = 1; $i <= 3; $i++) {
                if (isset($_FILES["adjunts" . $i]) && $_FILES["adjunts" . $i]["name"] != null) {
                    $config['upload_path']          = '../../uploads/' . $id . '/' . 'adjunts';
                    $config['allowed_types']        = 'gif|jpg|png|jpeg|docx|xlsx|pptx|odt|ods|odp|pdf';
                    $config['encrypt_name'] = true;
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload("adjunts" . $i)) {
                        $data['error'] = $this->upload->display_errors();
                        $errorArxiusAdjunts = false;
                    } else {
                        $data = array('info_fichero' => $this->upload->data());
                        $nom = $data['info_fichero']['file_name'];
                        $nom_original = $data['info_fichero']['client_name'];
                        $extensio = $data['info_fichero']['file_ext'];
                        $tamany = $data['info_fichero']['file_size'];
                        $user = $this->ion_auth->user()->row();
                        $data['error'] = "";
                        $fitxer = 0;
                        $this->recursos_model->set_fitxer($nom, $nom_original, $extensio, $tamany, $id, $fitxer);
                    }
                }
            }
            if ($errorArxiusAdjunts || $errorFormulari) {
                $this->load->view('recursos/modificar_pissarra', $data);
            } else {
                redirect(base_url('recursos/mostrar_pissarra/' . $id));
            }
        }
    }
}
