<?php
class Private_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');

        if (!$this->ion_auth->logged_in()) {
            redirect(base_url('login'));
        }
    }
}

class Public_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }
}

class Profe_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');

        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->in_group("profe")&& (!$this->ion_auth->in_group("admin")) )) {
            redirect(base_url('login'));
        }
    }
}

class Admin_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');

        if (!$this->ion_auth->in_group("admin")) {
            redirect(base_url('login'));
        }
    }
}
