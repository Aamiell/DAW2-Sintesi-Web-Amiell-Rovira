<?php
class News_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }



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

    public function get_news_id($id) {
        $query = $this->db->get_where('news', array('id' => $id));
        return $query->row_array();
    }

    public function set_news() 
    {
        $this->load->helper('url');

        $slug = url_title($this->input->post('title'), 'dash', TRUE);

        $data = array(
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'text' => $this->input->post('text'),
            'data_publicacio' => $this->input->post('data'),
            'id' => $this->input->post('id')
        );

        return $this->db->insert('news', $data);
    }

    public function delete_news($slug) {
        $this->db->where('slug', $slug);
        $this->db->delete('news');
    }
    
    public function modificar_news($id,$title,$text,$slug,$data) {
        $infocamps = array(
            'title' => $title,
            'text' => $text,
            'slug' => $slug,
            'data_publicacio' => $data,
            'id' => $id
    );
    $this->db->where('id', $id);
    $this->db->update('news', $infocamps);
    }

    public function count_news() {
        return $this->db->count_all_results('news');
    }

    
    public function pagination_news($limit, $id) {
    //Li diem quin sera el limit que volem per a cada pagina
    $this->db->limit($limit, $id);
    $query = $this->db->get('news');
    return $query->result_array();
    }
}
