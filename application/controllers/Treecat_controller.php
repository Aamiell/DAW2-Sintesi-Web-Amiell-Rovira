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

        $this->load->view('tree/index', $data);
    }

    /**
     * mostrar_taula
     * $categories
     */
    public function mostrar_tree($categories)
    {
        //mostrar categoria
        echo "<ol>";

        foreach ($categories as $cat) {
            echo "<li>" . $cat['nom'] . "</li>";

            $fills = $this->treecat_model->get_fills($cat['id']);

            if (count($fills) > 0)
                $this->mostrar_tree($fills);
        }
        echo "</ol>";
    }
}
