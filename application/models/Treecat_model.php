<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Treecat_model  extends CI_Model { 

    public function __construct () 
    { 
         parent::__construct ();
    }
 
    
    public function get_fills ($catid)
    {
        $data = array(
            'pare' => $catid
        );

        $query = $this->db->get_where('treecat', $data);
        
        return $query->result_array();
    }
}