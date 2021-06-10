<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Downtoken_controller  extends CI_Controller { 

    public function __construct () 
    { 
         parent::__construct ();

         $this->load->model('tokens_m');
         $this->load->model('recursos_model');

         
        $this->load->helper("jwt");
        $this->load->helper('download');

        $this->load->library('ion_auth');
        $this->load->config('jwt');
    }
 

    public function imatgeprincipal ($id_recurs)
    {
        $token=$this->input->get("token");
        $token_data = JWT::decode($token, $this->config->item('jwt_key'), array('HS256'));

        if ($this->auth_request($token,$token_data))
        {
            $arxiu = $this->recursos_model->get_fitxer_principal($id_recurs);
            force_download('../../uploads/' . $id_recurs . '/' . $arxiu['nom'], NULL); 
        } else 
            show_404();
    }

    public function arxiusadjunt ($id_recurs, $id_arxiu)
    {
        $token=$this->input->get("token");
        $token_data = JWT::decode($token, $this->config->item('jwt_key'), array('HS256'));

        if ($this->auth_request($token,$token_data))
        {
            $arxiu = $this->recursos_model->get_nom_arxius_adjunt($id_arxiu);
            force_download('../../uploads/' . $id_recurs . '/adjunts/' . $arxiu['nom'], NULL);
        } else 
            show_404();
    }


    protected function auth_request($token, $token_data, $memberof=null)
    {
        try {
            if ($token == null) {
                // $this->auth_code = 400;
                // $this->error_message = "Token no present or wrong format";
                return false;
            }
            if ($this->config->item("jwt_autorenew")) {
                if ($this->tokens_m->revoked($token_data)) {
                    // $this->auth_code = 401;
                    // $this->error_message = "Token revoked";
                    return false;
                } 
            }

            $user = $this->ion_auth->user($token_data->usr)->row();
            if ($user->active) {     // user exists && is active
                if ($memberof !== null) {   //chek if user is member of a group or groups
                    if ($this->ion_auth->in_group($memberof, $token_data->usr)) {
                        // $this->auth_code = 200;
                        return true;
                    } else {
                        // $this->error_message = "User NOT MEMBER of valid groups";
                        // $this->auth_code = 401;
                        return false;
                    }
                } else {
                    // $this->auth_code = 200;
                    return true;
                }
            } else {
                // $this->auth_code = 401;
                // $this->error_message = "User disabled";
                return false;
            }
        } catch (SignatureInvalidException $e) {     // to get exception message => $e->getMessage()
            // $this->error_message = print_r($e->getMessage(), true);
            // $this->auth_code = 400;
            return false;
        } catch (BeforeValidException $e) {     // to get exception message => $e->getMessage()
            // $this->error_message = print_r($e->getMessage(), true);
            // $this->auth_code = 400;
            return false;
        } catch (UnexpectedValueException $e) {     // to get exception message => $e->getMessage()
            // $this->error_message = print_r($e->getMessage(), true);
            // $this->auth_code = 400;
            return false;
        } catch (ExpiredException $e) {     // to get exception message => $e->getMessage()
            // $this->error_message = print_r($e->getMessage(), true);
            // $this->auth_code = 400;
            return false;
        } catch (Exception $e) {
            // $this->error_message = print_r($e->getMessage(), true);
            // $this->auth_code = 400;
            return false;
        } finally {
            $this->tokens_m->purge();
        }
    }
}

/* End of file Downtoken_controller.php */