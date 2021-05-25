<?php defined('BASEPATH') or exit('No direct script access allowed');

class Treecat_controller  extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('treecat_model');
    }


    public function index()
    {
        $data['controller'] = $this;
        $data["cat"] = $this->treecat_model->get_fills(NULL);
        if (!$this->ion_auth->logged_in()) {
            $this->load->view('login/navbar-public');
        } else {
            $data['isalumne'] = $this->ion_auth->in_group("alumne");
            $data['isprofe'] = $this->ion_auth->in_group("profe");
            $data['isadmin'] = $this->ion_auth->in_group("admin");
            $this->load->view('templates/footer', $data);
            $this->load->view('login/navbar-private', $data);
        }
        


        $this->load->view('tree/index', $data);
    }

    public function mostrar_tree($categories)
    {
        
        echo "<ul>";

        foreach ($categories as $cat) {
            echo "<li>". $cat['nom'] . "</li>";

            $fills = $this->treecat_model->get_fills($cat['id']);

            if (count($fills) > 0)
                $this->mostrar_tree($fills);
        }
        echo "</ul>";
    }
}
