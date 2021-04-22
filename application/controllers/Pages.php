<?php
class Pages extends CI_Controller {

        public function view($page = 'home')
        {
                if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
                {
                        // Whoops, we don't have a page for that!
                        show_404();
                }
        
                $datahead['title'] = ucfirst($page); // Capitalize the first letter
                

                $colors=["vermell", "blau"];
                $datahead["fondos"]=$colors;

                $datapeu['autor'] = "&copy; 2020. AaronAmiell.";
        
                $this->load->view('templates/header', $datahead);
                $this->load->view('pages/'.$page);
                $this->load->view('templates/footer', $datapeu);
        }
}