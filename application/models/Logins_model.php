<?php
class Logins_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper('captcha');
    }
    //Pasem les variables del controlador al model
    //$usr, $pass son les variables que guardem lo que ens pasen per post
    public function verificar_usuari($usr, $pass)
    {
        //Creem una variable que tindra el valor false
        $confirmacio = false;
        $this->db->where('user', $usr);     // Mirarem la fila user si es igual a la variable pasada per l'usuari
        $query = $this->db->get('users');   // De la taula users
        $row = $query->row();               // Guarem la informacio en una fila
        //die ($row->password."<br>". $pass );
        //Si la contrasenya passada per l'input es igual a la hash
        if (password_verify($pass, $row->password)) {
            $confirmacio = true;
        } else {
            $confirmacio = false;
        }
        //Retornem el valor confirmacio sigui true o false
        return $confirmacio;
    }

    //Agafem les noticies per mostrar la pagina publica
    public function get_news($slug = FALSE)
    {
        if ($slug === FALSE) {
            //SELECT * FROM news
            $query = $this->db->get('news');
            //Enviem la variable $query en un array
            return $query->result_array();
        }

        $query = $this->db->get_where('news', array('slug' => $slug));
        return $query->row_array();
    }

    public function set_users()
    {
        $this->load->helper('url');
        $rPass_hash = password_hash($this->input->post('rPass'), PASSWORD_DEFAULT);
        $data = array(
            'user' => $this->input->post('rUser'),
            'password' => $rPass_hash
        );
        return $this->db->insert('users', $data);
    }

    public function verificar_registre($usr)
    {
        //Creem una variable que tindra el valor false
        $registrevalid = true;
        $this->db->where('user', $usr);     // Mirarem la fila user si es igual a la variable pasada per l'usuari
        $query = $this->db->get('users');   // De la taula users
        $row = $query->row();               // Guarem la informacio en una fila
        //Si el usuari no existeix a la base de dades
        if (!empty($row)) {
            //Ens asegurem que l'usuari no esta repetit
            if ($usr != $row->user) {
                $registrevalid = true;
            } else {
                $registrevalid = false;
            }
        }
        //Retornem el valor registrevalid sigui true o false
        return $registrevalid;
    }

    public function set_captcha($cap)
    {
        $data = array(
            'captcha_time'  => $cap['time'],
            'ip_address'    => $this->input->ip_address(),
            'word'          => $cap['word']
    );
        $query = $this->db->insert_string('captcha', $data);
        $this->db->query($query);
    }

    public function verificar_captcha($capt)
    {
        $captchavalid = false;
        $this->db->where('word', $capt);        // Mirarem la fila word si es igual a la variable pasada per l'usuari
        $query = $this->db->get('captcha');     // De la taula captcha
        $row = $query->row();                   // Guarem la informacio en una fila
        //Si el captcha no existeix a la base de dades
        if (!empty($row)) {
            //Ens asegurem que l'usuari ha introduit correctament la paraula
            if ($capt == $row->word) {
                $captchavalid = true;
            } else {
                $captchavalid = false;
            }
            //Retornem el valor capthcavalid sigui true o false
            return $captchavalid;
        }
    }
}
