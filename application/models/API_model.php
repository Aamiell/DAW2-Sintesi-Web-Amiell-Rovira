<?php
class API_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper('captcha');
        $this->load->library('upload');
    }

    public function get_recursos()
    {
        $query = $this->db->get('recursos');
        return $query->result_array();
    }

    public function get_recursos_id($id)
    {
        $query = $this->db->get_where('recursos', array('id' => $id));
        return $query->row_array();
    }

    public function delete_recurs($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('recursos');
        return $this->db->affected_rows();
    }

    public function get_fitxers()
    {
        $query = $this->db->get_where('fitxers');
        return $query->result_array();
    }

    public function get_fitxer_principal_id($id)
    {
        $query = $this->db->get_where('fitxers', array('id_recurs' => $id, 'fitxer_principal' => '1'));
        return $query->result_array();
    }

    public function get_fitxer_adjunts_id($id)
    {
        $query = $this->db->get_where('fitxers', array('id_recurs' => $id, 'fitxer_principal' => '0'));
        return $query->result_array();
    }

}
