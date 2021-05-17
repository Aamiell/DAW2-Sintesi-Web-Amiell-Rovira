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


public function set_recurs() 
    {
        $this->load->helper('url');

        $data = array(
            'tipus_recurs' => $this->input->post('recurs'),
            'titol' => $this->input->post('titol'),
            'descripcio' => $this->input->post('descripcio'),
            'explicacio' => $this->input->post('explicacio')
            //'id' => $this->input->post('id')
        );

        return $this->db->insert('recursos', $data);
    }
    public function set_fitxer($nom, $extesio, $tamany) 
    {
        $this->load->helper('url');

        //$fitxer = $this->input->post('arxiu');
        $data = array(
            'extensio' => $extesio,
            'nom' => $nom,
            'tamany_bytes' => $tamany,
            'id_recurs' => 1,
        );

        return $this->db->insert('fitxers', $data);
    }
}

