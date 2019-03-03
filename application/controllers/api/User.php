<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
use Restserver\Libraries\REST_Controller;

//include Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';
class User extends REST_Controller {

    public function __construct() { 
        parent::__construct();

        $this->load->model('User_Model');
    }

    protected function badRequest($arr) {
        $this->response($arr, REST_Controller::HTTP_BAD_REQUEST);
    }
    
    public function data_get($id = 0) {
        $email = $this->get('email');
        $users = $this->User_Model->getRows($id, $email);
        
        if(empty($users) && (!empty($id) || !empty($email)) ){
            //set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No user were found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }else{
            $this->response($users, REST_Controller::HTTP_OK);
        }
    }

    public function data_post() {
        $userData = array();
        $userData['email'] = $this->post('email');

        if (!empty($userData['email'])) {
            //insert user data
            $insert = $this->User_Model->insert($userData);
            
            //check if the user data inserted
            if($insert){
                $userData['id'] = $insert;

                //set the response and exit
                $this->response([
                    'message' => 'User has been added successfully.',
                    'data' => $userData
                ], REST_Controller::HTTP_OK);
            }else{
                $errorEn = "Some problems occurred, please try again.";
                $errorPt = "Algum problema ocorreu, por favor tente novamente";
                
                //set the response and exit
                $this->badRequest([
                    "messageEn"=>$errorEn,
                    "messagePt"=>$errorPt
                ]);
            }
        }else{
            //set the response and exit
            $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    
    public function data_put($id) {
        $userData = array();
        $userData['email'] = $this->put('email');

        if (!empty($id) && !empty($userData['email'])) {
            //update user data
            $update = $this->User_Model->update($userData, $id);
            
            //check if the user data updated
            if($update){
                $user = $this->User_Model->getRows($id);
                //set the response and exit
                $this->response([
                    'message' => 'User has been updated successfully.',
                    'data' => $user
                ], REST_Controller::HTTP_OK);
            }else{
                //set the response and exit
                $this->response([
                    'messagePt'=>'Some problems occurred, please try again.',
                    'messageEn'=>'Algum problema ocorreu, por favor tente novamente'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            //set the response and exit
            $this->response("Provide complete user information to update.", REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function data_delete($id) {
        if (!empty($id)) {
            //delete user data
            $delete = $this->User_Model->delete($id);
            
            //check if the user data updated
            if($delete){
                $this->response([
                    'message' => 'User has been deleted successfully.'
                ], REST_Controller::HTTP_OK);
            }else{
                //set the response and exit
                $this->response([
                    'messagePt'=>'Some problems occurred, please try again.',
                    'messageEn'=>'Algum problema ocorreu, por favor tente novamente'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            //set the response and exit
            $this->response("Provide complete user information to delete.", REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
?>
