<?php
defined('BASEPATH') or exit('No direct script access allowed');
class JwtApi_controller extends Jwt_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('recursos_model');
        $this->load->library('form_validation');

        $config = [
            //            "iat" => time(), // AUTOMATIC value 
            //            "exp" => time() + 300, // expires 5 minutes AUTOMATIC VALUE
            "sub" => "secure.jwt.daw.local", // subject of token
            "jti" => $this->uuid->v5('secure.jwt.daw.local') // Json Token Id
        ];
        $this->init($config, 300); // configuration + auth timeout
        // $this->init($config); // configuration + auth timeout is configured from JWT config file
    }

    public function login_options()
    {
        $this->output->set_header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $this->output->set_header("Access-Control-Allow-Methods: GET, DELETE, OPTIONS");
        $this->output->set_header("Access-Control-Allow-Origin: *");

        $this->response(null, API_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }

    public function login_post()
    {
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $user = $this->post('user');
        $pass = $this->post('pass');
        $this->login($user, $pass);
    }


    public function recursos_options()
    {
        $this->output->set_header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        $this->output->set_header("Access-Control-Allow-Methods: GET, DELETE, POST, OPTIONS");
        $this->output->set_header("Access-Control-Allow-Origin: *");

        $this->response(null, API_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }

    public function recurs_options()
    {
        $this->output->set_header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        $this->output->set_header("Access-Control-Allow-Methods: GET, DELETE, POST, OPTIONS");
        $this->output->set_header("Access-Control-Allow-Origin: *");

        $this->response(null, API_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }
    // PART PUBLICA PODREM DEMANAR TOTS ELS RECURSOS O UN SOL PER ID
    public function recursos_get()
    {
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $id = $this->get("id");
        if ($id != null) {
            $recursos = $this->recursos_model->get_recursos_id($id);
        } else {
            $recursos = $this->recursos_model->get_recursos();
        }
        //Ens retorna les noticies amb el codi que li hem dit
        $this->response($recursos, API_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }

    // PART PRIVADA POST, DELETE, PUT FA FALTA EL TOKEN PER PODER UTILITZARLO
    // public function news_post()
    // {
    //     $this->output->set_header("Access-Control-Allow-Origin: *");
    //     if ($this->auth_request()) {

    //         $token = $this->renewJWT();

    //         // ##########################################################################################
    //         $this->form_validation->set_rules('title', 'Title', 'required');
    //         $this->form_validation->set_rules('text', 'Text', 'required');
    //         $this->form_validation->set_rules('slug', 'Slug', 'required');
    //         $this->form_validation->set_rules('data', 'Data', 'required');

    //         if ($this->form_validation->run() === FALSE) {
    //             $message = [
    //                 'title' => $this->post('title'),
    //                 'status' => API_Controller::HTTP_BAD_REQUEST,
    //                 'message' => validation_errors()
    //             ];
    //             $this->set_response($message, API_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400)
    //         } else {
    //             $this->news_model->set_news($this->post('title'), $this->post('text'));

    //             $message = [
    //                 'title' => $this->post('title'),
    //                 'text' => $this->post('text'),
    //                 'slug' => $this->post('slug'),
    //                 'data_publicacio' => $this->post('data'),
    //                 'status' => API_Controller::HTTP_CREATED,
    //                 'message' => 'Added a resource',
    //                 'token' => $token //Cada vegada que faci el afegir correcte ens retornara un token
    //             ];

    //             $this->set_response($message, API_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    //         }
    //         // ##########################################################################################

    //     } else {
    //         $message = [
    //             'status' => $this->auth_code,
    //             'token' => "",
    //             'message' => 'Bad auth information. ' . $this->error_message
    //         ];
    //         $this->set_response($message, $this->auth_code); // 400 / 401 / 419 / 500
    //     }
    // }

    public function recurs_delete($id)
    {
        $this->output->set_header("Access-Control-Allow-Origin: *");
        if ($this->auth_request()) {

            $token = $this->renewJWT();

            //$slug = $this->delete('slug', true); // true for XSS Clean
            //Si el slug es diferent a null 
            if ($id != null) {
                $comprovacio = $this->recursos_model->delete_recurs($id);
                if ($comprovacio > 0) {
                    $message = [
                        'slug' => $id,
                        'message' => 'Resource deleted',
                        'token' => $token //Cada vegada que faci el delete correcte ens retornara un token
                    ];
                    //Ens retorna el missatge i el codi 200 (OK)
                    $this->set_response($message, API_Controller::HTTP_OK); // CREATED (200) being the HTTP response code
                } else {
                    $message = [
                        'slug' => $id,
                        'message' => 'Fail deleted'
                    ];
                    //Ens retorna el missatge i el codi 200 (OK)
                    $this->set_response($message, 400); // CREATED (200) being the HTTP response code
                }
            } else {
                $message = [
                    'slug' => $id,
                    'message' => 'Fail deleted'
                ];
                //Ens retorna el missatge i el codi 400 (BAD_REQUEST)
                $this->set_response($message, API_Controller::HTTP_BAD_REQUEST); // CREATED (400) being the HTTP response code
            }
        } else {
            $message = [
                'status' => $this->auth_code,
                'token' => "",
                'message' => 'Bad auth information. ' . $this->error_message
            ];
            $this->set_response($message, $this->auth_code); // 400 / 401 / 419 / 500
        }
    }
    // public function news_put()
    // {

    //     if ($this->auth_request()) {

    //         $token = $this->renewJWT();

    //         //Son els camps que neccesitarem per actulitzar
    //         $slug = $this->put('slug', true); // true for XSS Clean
    //         $id = $this->put('id', true);
    //         $title = $this->put('title', true);
    //         $text = $this->put('text', true);
    //         $data = $this->put('data', true);
    //         //Si el slug es diferent a null 
    //         if ($slug != null) {
    //             $comprovacio = $this->news_model->update_news($text, $title, $slug, $data, $id);
    //             if ($comprovacio > 0) {
    //                 $message = [
    //                     'slug' => $slug,
    //                     'message' => 'Resource update',
    //                     'token' => $token //Cada vegada que faci el update correcte ens retornara un token
    //                 ];
    //                 //Ens retorna el missatge i el codi 200 (OK)
    //                 $this->set_response($message, API_Controller::HTTP_OK); // CREATED (200) being the HTTP response code
    //             } else {
    //                 $message = [
    //                     'slug' => $slug,
    //                     'message' => 'Fail update'
    //                 ];
    //                 //Ens retorna el missatge i el codi 200 (OK)
    //                 $this->set_response($message, 400); // CREATED (200) being the HTTP response code
    //             }
    //         } else {
    //             $message = [
    //                 'slug' => $slug,
    //                 'message' => 'Fail update'
    //             ];
    //             //Ens retorna el missatge i el codi 400 (BAD_REQUEST)
    //             $this->set_response($message, API_Controller::HTTP_BAD_REQUEST); // CREATED (400) being the HTTP response code
    //         }
    //     } else {
    //         $message = [
    //             'status' => $this->auth_code,
    //             'token' => "",
    //             'message' => 'Bad auth information. ' . $this->error_message
    //         ];
    //         $this->set_response($message, $this->auth_code); // 400 / 401 / 419 / 500
    //     }
    // }
    protected function _parse_post()
    {

        if ($this->request->format === 'json') {

            //Truc per tal que el JSON quedi ben carregat (parsejat) a $_POST

            $_POST = json_decode(file_get_contents('php://input'), true);
        }

        parent::_parse_post();
    }
}
