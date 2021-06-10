<?php
class Recursos_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper('captcha');
        $this->load->library('upload');
    }

    public function get_fills($catid)
    {
        $data = array(
            'pare' => $catid
        );

        $query = $this->db->get_where('treecat', $data);

        return $query->result_array();
    }

    public function set_recurs_infografia($user)
    {
        $this->load->helper('url');
        $tipus = 'infografia';
        $data = array(
            'tipus_recurs' => $tipus,
            'titol' => $this->input->post('titol'),
            'descripcio' => $this->input->post('descripcio'),
            'explicacio' => $this->input->post('explicacio'),
            'categoria' => $this->input->post('cat'),
            'tipus_access' => $this->input->post('tipus_access'),
            'codi_invitacio' => $this->input->post('codi'),
            'propietari' => $user
        );

        $this->db->insert('recursos', $data);
        return $this->db->insert_id();
    }

    public function set_recurs_video($user)
    {
        $this->load->helper('url');
        $tipus = 'video';
        $data = array(
            'tipus_recurs' => $tipus,
            'titol' => $this->input->post('titol'),
            'descripcio' => $this->input->post('descripcio'),
            'explicacio' => $this->input->post('explicacio'),
            'categoria' => $this->input->post('cat'),
            'tipus_access' => $this->input->post('tipus_access'),
            'codi_invitacio' => $this->input->post('codi'),
            'propietari' => $user
        );

        $this->db->insert('recursos', $data);
        return $this->db->insert_id();
    }

    public function set_recurs_link($user)
    {
        $this->load->helper('url');
        $tipus = 'link_video';
        $data = array(
            'tipus_recurs' => $tipus,
            'titol' => $this->input->post('titol'),
            'descripcio' => $this->input->post('descripcio'),
            'explicacio' => $this->input->post('explicacio'),
            'link' => $this->input->post('link'),
            'categoria' => $this->input->post('cat'),
            'tipus_access' => $this->input->post('tipus_access'),
            'codi_invitacio' => $this->input->post('codi'),
            'propietari' => $user
        );

        $this->db->insert('recursos', $data);
        return $this->db->insert_id();
    }

    public function set_recurs_pissarra($user)
    {
        $this->load->helper('url');
        $tipus = 'pissarra';
        $data = array(
            'tipus_recurs' => $tipus,
            'titol' => $this->input->post('titol'),
            'descripcio' => $this->input->post('descripcio'),
            'explicacio' => $this->input->post('explicacio'),
            'pissarra' => $this->input->post('pissarra'),
            'categoria' => $this->input->post('cat'),
            'tipus_access' => $this->input->post('tipus_access'),
            'codi_invitacio' => $this->input->post('codi'),
            'codi_invitacio' => $this->input->post('codi'),
            'propietari' => $user
        );

        $this->db->insert('recursos', $data);
        return $this->db->insert_id();
    }
   
    public function set_fitxer($nom, $nom_original, $extensio, $tamany, $id_recurs, $fitxer)
    {
        $this->load->helper('url');

        $data = array(
            'extensio' => $extensio,
            'nom' => $nom,
            'nom_original' => $nom_original,
            'tamany_bytes' => $tamany,
            'id_recurs' => $id_recurs,
            'fitxer_principal' => $fitxer
        );
        return $this->db->insert('fitxers', $data);
    }

    public function get_recursos_cat($catid)
    {
        $query = $this->db->query("select * from RECURSOS where categoria='" . $catid . "'");
        return $query->result_array();
    }

    public function get_recursos_id($id)
    {
        $query = $this->db->get_where('recursos', array('id' => $id));
        return $query->row_array();
    }

    public function get_fitxer_adjunts($id)
    {
        $query = $this->db->get_where('fitxers', array('id_recurs' => $id, 'fitxer_principal' => '0'));
        return $query->result_array();
    }

    public function get_fitxer_principal($id)
    {
        $query = $this->db->get_where('fitxers', array('id_recurs' => $id, 'fitxer_principal' => '1'));
        return $query->row_array();
    }

    public function get_fitxers_principals()
    {
        $query = $this->db->get_where('fitxers', array('fitxer_principal' => '1'));
        return $query->row_array();
    }

    public function get_arxius_adjunts($id)
    {
        $query = $this->db->get_where('fitxers', array('id_recurs' => $id, 'fitxer_principal' => '0'));
        return $query->row_array();
    }
    public function get_nom_arxius_adjunt($id)
    {
        $query = $this->db->get_where('fitxers', array('id' => $id));
        return $query->row_array();
    }

    public function recursos_user($user)
    {
        $query = $this->db->get_where('recursos', array('propietari' => $user));
        return $query->result_array();
    }

    public function get_recursos()
    {
        $query = $this->db->get('recursos');
        return $query->result_array();
    }

    public function modificar_infografia($id, $user)
    {
        $this->load->helper('url');
        $tipus = 'infografia';
        $data = array(
            'id' => $this->input->post('id'),
            'tipus_recurs' => $tipus,
            'titol' => $this->input->post('titol'),
            'descripcio' => $this->input->post('descripcio'),
            'explicacio' => $this->input->post('explicacio'),
            'categoria' => $this->input->post('cat'),
            'tipus_access' => $this->input->post('tipus_access'),
            'codi_invitacio' => $this->input->post('codi'),
            'propietari' => $user
        );
        $this->db->where('id', $id);
        $this->db->update('recursos', $data);
    }

    public function modificar_video($id, $user)
    {
        $this->load->helper('url');
        $tipus = 'video';
        $data = array(
            'id' => $this->input->post('id'),
            'tipus_recurs' => $tipus,
            'titol' => $this->input->post('titol'),
            'descripcio' => $this->input->post('descripcio'),
            'explicacio' => $this->input->post('explicacio'),
            'categoria' => $this->input->post('cat'),
            'tipus_access' => $this->input->post('tipus_access'),
            'codi_invitacio' => $this->input->post('codi'),
            'propietari' => $user
        );
        $this->db->where('id', $id);
        $this->db->update('recursos', $data);
    }

    public function modificar_link_video($id, $user)
    {
        $this->load->helper('url');
        $tipus = 'link_video';
        $data = array(
            'id' => $this->input->post('id'),
            'tipus_recurs' => $tipus,
            'titol' => $this->input->post('titol'),
            'descripcio' => $this->input->post('descripcio'),
            'explicacio' => $this->input->post('explicacio'),
            'link' => $this->input->post('link'),
            'categoria' => $this->input->post('cat'),
            'tipus_access' => $this->input->post('tipus_access'),
            'codi_invitacio' => $this->input->post('codi'),
            'propietari' => $user
        );
        $this->db->where('id', $id);
        $this->db->update('recursos', $data);
    }

    public function modificar_pissarra($id, $user)
    {
        $this->load->helper('url');
        $tipus = 'pissarra';
        $data = array(
            'id' => $this->input->post('id'),
            'tipus_recurs' => $tipus,
            'titol' => $this->input->post('titol'),
            'descripcio' => $this->input->post('descripcio'),
            'explicacio' => $this->input->post('explicacio'),
            'pissarra' => $this->input->post('pissarra'),
            'categoria' => $this->input->post('cat'),
            'tipus_access' => $this->input->post('tipus_access'),
            'codi_invitacio' => $this->input->post('codi'),
            'propietari' => $user
        );
        $this->db->where('id', $id);
        $this->db->update('recursos', $data);
    }

    // public function modificar_fitxer($id, $nom, $nom_original, $extensio, $tamany, $id_recurs, $fitxer) {
    //     $this->load->helper('url');

    //     $infofitxer = array(
    //         'extensio' => $extensio,
    //         'nom' => $nom,
    //         'nom_original' => $nom_original,
    //         'tamany_bytes' => $tamany,
    //         'id_recurs' => $id_recurs,
    //         'fitxer_principal' => $fitxer,
    //         'id' => $id
    //     );
    //     $this->db->where('id', $id);
    //     $this->db->update('fitxers', $infofitxer);
    // }

    public function borrar_fitxer_principal($id)
    {
        $this->load->helper('url');
        $this->db->delete('fitxers', array('id_recurs' => $id, 'fitxer_principal' => '1'));
    }

    public function borrar_fitxers_adjunts($id, $id_arxiu)
    {
        $this->load->helper('url');
        $this->db->delete('fitxers', array('id_recurs' => $id,'id' => $id_arxiu, 'fitxer_principal' => '0'));
    }
}
