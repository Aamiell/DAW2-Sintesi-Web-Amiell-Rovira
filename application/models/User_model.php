<?php
class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper('captcha');
        $this->load->library('upload');
    }

    public function get_infouser($id)
    {
        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row_array();
    }

    public function update_infouser($id, $username,$nom, $cognom, $email)
    {
        if ($username != null) {
            $this->db->set("username", $username);
        }
        if ($nom != null) {
            $this->db->set("first_name", $nom);
        }
        if ($cognom != null) {
            $this->db->set("last_name", $cognom);
        }
        if ($email != null) {
            $this->db->set("email", $email);
        }
        $this->db->where("id", $id);
        $this->db->update('users');
        return $this->db->affected_rows();
    }
}