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


    // public function set_recurs($user)
    // {
    //     $this->load->helper('url');

    //     $data = array(
    //         'tipus_recurs' => $this->input->post('recurs'),
    //         'titol' => $this->input->post('titol'),
    //         'descripcio' => $this->input->post('descripcio'),
    //         'explicacio' => $this->input->post('explicacio'),
    //         'propietari' => $user
    //     );

    //     $this->db->insert('recursos', $data);
    //     return $this->db->insert_id();
    // }

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
        $tipus = 'lpissarra';
        $data = array(
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


    public function delete_recurs($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('recursos');
    }

    public function get_recursos()
    {
        $query = $this->db->get('recursos');
        return $query->result_array();
    }
}
