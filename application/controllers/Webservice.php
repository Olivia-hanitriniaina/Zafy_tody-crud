<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */

//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */

class Webservice extends CI_Controller {
    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->__resTraitConstruct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key

        $this->load->libraries('session');
    }

    public function index_get(){
        $this->load->model('auth_model');
        
        $data=array(
            'login'=>$this->get('username'),
            'password'=>$this->get('password')
        );
        $result=$this->auth_model->login($data);

        if($result==TRUE){
            /* $data=array();
            $data['status']="OK";
            $data['result']=$result;
            $res = json_encode($data);
            $this->output->set_output($res); */

            $this->response($result);
        }else{
            /* $data=array();
            $data['status']="ERROR";
            $data['message']="Identifiant incorrecte";
            $data['result']=$result;
            $res = json_encode($data);
            $this->output->set_output($res); */
            $this->response([
                'status' => FALSE,
                'message' => 'No users were found'
            ]);
        }   
    }
}