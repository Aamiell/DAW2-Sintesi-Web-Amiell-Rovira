<?php
class Public_recursos_controller extends Alumne_controller
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
    
    public function pmostrar_categories($categories)
    {
        foreach ($categories as $cat) {
            echo "<option value='" . $cat['id'] . "'>" . $cat['nom'] . "</option>";
            $fills = $this->recursos_model->get_fills($cat['id']);
            if (count($fills) > 0)
                $this->pmostrar_categories($fills);
        }
    }

    public function precursos_categoria($cat)
    {
        $this->load->view('templates/footer');

        $data['isalumne'] = $this->ion_auth->in_group("alumne");
        $data['isadmin'] = $this->ion_auth->in_group("admin");
        $data['isprofe'] = $this->ion_auth->in_group("profe");

        $recursos = $this->recursos_model->get_recursos_cat($cat);

        $data['recursos'] = $recursos;
        $this->load->view('login/navbar-private', $data);
        $this->load->view('recursos/public/list_recursos_cat', $data);
    }

    public function pmostrar_infografia($id)
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
        $this->load->view('recursos/public/mostrar_infografia', $data);
    }

    public function pmostrar_video($id)
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
        $this->load->view('recursos/public/mostrar_video', $data);
    }

    public function pmostrar_link_video($id)
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
        $this->load->view('recursos/public/mostrar_link_video', $data);
    }

    public function pmostrar_pissarra($id)
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
        $this->load->view('recursos/public/mostrar_pissarra', $data);
    }

    public function pveure_arxiu_principal($id_recurs)
    {
        $arxiu = $this->recursos_model->get_fitxer_principal($id_recurs);
        force_download('../../uploads/' . $id_recurs . '/' . $arxiu['nom'], NULL);
    }

    public function pveure_arxius_adjunts($id_recurs, $id_arxiu)
    {
        $arxiu = $this->recursos_model->get_nom_arxius_adjunt($id_arxiu);
        force_download('../../uploads/' . $id_recurs . '/adjunts/' . $arxiu['nom'], NULL);
    }
}
