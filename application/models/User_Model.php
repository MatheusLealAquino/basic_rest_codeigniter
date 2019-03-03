<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_Model extends CI_Model {
    private $table_name = 'user';

    public function __construct() {
        parent::__construct();
        
        //load database library
        $this->load->database();
    }

    /*
     * Fetch user data
     */
    function getRows($id = "", $email = "") {
        if(!empty($id)){
            return $this->db->get_where($this->table_name, array('id' => $id))->row_array();
        }else if(!empty($email)){
            return $this->db->get_where($this->table_name, array('email' => $email))->row_array();
        }else{
            return $this->db->get($this->table_name)->result_array();
        }
    }

    /*
     * Insert user data
     */
    public function insert($data = array()) {
        if(!array_key_exists('created', $data)){
            $data['created'] = date("Y-m-d H:i:s");
        }
        $insert = $this->db->insert($this->table_name, $data);
        if($insert){
            return $this->db->insert_id();
        }
        return false;
    }

    /*
     * Update user data
     */
    public function update($data, $id) {
        if(!empty($data) && !empty($id)){
            $update = $this->db->update($this->table_name, $data, array('id'=>$id));
            return $update?true:false;
        }
        return false;
    }
    
    /*
     * Delete user data
     */
    public function delete($id){
        $delete = $this->db->delete($this->table_name,array('id'=>$id));
        return $delete?true:false;
    }

}
?>