<?php
defined('BASEPATH') or exit('No direct script access allowed');
class JwtApi_controller extends Jwt_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('recursos_model');
        $this->load->model('api_model');
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

    public function recursos_get()
    {
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $id = $this->get("id");
        if ($id != null) {
            $recursos = $this->api_model->get_recursos_id($id);
        } else {
            $recursos = $this->api_model->get_recursos();
        }
        //Ens retorna els recursos amb el codi que li hem dit
        $this->response($recursos, API_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }

    public function infouser_options()
    {
        $this->output->set_header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        $this->output->set_header("Access-Control-Allow-Methods: GET, DELETE, POST, PUT, OPTIONS");
        $this->output->set_header("Access-Control-Allow-Origin: *");

        $this->response(null, API_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }

    public function infouser_put()
    {
        $this->output->set_header("Access-Control-Allow-Methods: GET, DELETE, POST, PUT, OPTIONS");
        $this->output->set_header("Access-Control-Allow-Origin: *");
        if ($this->auth_request()) {

            $token = $this->renewJWT();

            //Son els camps que neccesitarem per actulitzar
            $id = $this->put('id', true); // true for XSS Clean
            $username = $this->put('username', true);
            $nom = $this->put('nom', true);
            $cognom = $this->put('cognom', true);
            $email = $this->put('email', true);
            //Si la id es diferent a null 
            if ($id != null) {
                $comprovacio = $this->user_model->update_infouser($id, $username, $nom, $cognom, $email);
                if ($comprovacio > 0) {
                    $message = [
                        'id' => $id,
                        'message' => 'Resource update',
                        'token' => $token //Cada vegada que faci el update correcte ens retornara un token
                    ];
                    //Ens retorna el missatge i el codi 200 (OK)
                    $this->set_response($message, API_Controller::HTTP_OK); // CREATED (200) being the HTTP response code
                } else {
                    $message = [
                        'id' => $id,
                        'message' => 'Fail update'
                    ];
                    //Ens retorna el missatge i el codi 200 (OK)
                    $this->set_response($message, 400); // CREATED (200) being the HTTP response code
                }
            } else {
                $message = [
                    'id' => $id,
                    'message' => 'Fail update'
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


    public function recurs_options()
    {
        $this->output->set_header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        $this->output->set_header("Access-Control-Allow-Methods: GET, DELETE, POST, OPTIONS");
        $this->output->set_header("Access-Control-Allow-Origin: *");

        $this->response(null, API_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }

    public function recurs_delete($id)
    {
        $this->output->set_header("Access-Control-Allow-Origin: *");
        if ($this->auth_request()) {

            $token = $this->renewJWT();

            //Si la id es diferent a null 
            if ($id != null) {
                $comprovacio = $this->api_model->delete_recurs($id);
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
                    //Ens retorna el missatge i el codi 400 (BAD_REQUEST)
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

    // public function veure_arxiu_principal_($id_recurs)
    // {
    //     if ($this->auth_request()) {
    //     $arxiu = $this->recursos_model->get_fitxer_principal($id_recurs);
    //     force_download('../../uploads/' . $id_recurs . '/' . $arxiu['nom'], NULL);
    //     }
    // }

    // public function veure_arxius_adjunts($id_recurs, $id_arxiu)
    // {
    //     $arxiu = $this->recursos_model->get_nom_arxius_adjunt($id_arxiu);
    //     force_download('../../uploads/' . $id_recurs . '/adjunts/' . $arxiu['nom'], NULL);
    // }

    public function arxiup_options()
    {
        $this->output->set_header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        $this->output->set_header("Access-Control-Allow-Methods: GET, DELETE, POST, OPTIONS");
        $this->output->set_header("Access-Control-Allow-Origin: *");

        $this->response(null, API_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }

    public function arxiup_get()
    {
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $id = $this->get("id");
        if ($id != null) {
            $arxiu = $this->api_model->get_fitxer_principal_id($id);
            //Ens retorna els recursos amb el codi que li hem dit
            $this->response($arxiu, API_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $message = [
                'id' => $id,
                'message' => 'Fitxer o recurs no registrat',
            ];
            //Ens retorna el missatge i el codi 200 (OK)
            $this->set_response($message, API_Controller::HTTP_OK); // CREATED (200) being the HTTP response code
        }
    }

    public function arxiuadj_options()
    {
        $this->output->set_header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        $this->output->set_header("Access-Control-Allow-Methods: GET, DELETE, POST, OPTIONS");
        $this->output->set_header("Access-Control-Allow-Origin: *");

        $this->response(null, API_Controller::HTTP_OK); // OK (200) being the HTTP response code
    }

    public function arxiuadj_get()
    {
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $id = $this->get("id");
        if ($id != null) {
            $arxius = $this->api_model->get_fitxer_adjunts_id($id);
            //Ens retorna els recursos amb el codi que li hem dit
            $this->response($arxius, API_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $message = [
                'id' => $id,
                'message' => 'Fitxer o recurs no registrat',
            ];
            //Ens retorna el missatge i el codi 200 (OK)
            $this->set_response($message, API_Controller::HTTP_OK); // CREATED (200) being the HTTP response code
        }
    }

    protected function _parse_post()
    {

        if ($this->request->format === 'json') {

            //Truc per tal que el JSON quedi ben carregat (parsejat) a $_POST

            $_POST = json_decode(file_get_contents('php://input'), true);
        }

        parent::_parse_post();
    }
}
