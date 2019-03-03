<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Email_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        
        //load email library
        $this->load->library('email');
    }

    public function sendEmail($to='', $subject='', $message='') {
        $config = array();
        $config['charset']  = 'utf-8';
        $config['newline']  = "\r\n";
        $config['wordwrap'] = TRUE; // define se haverá quebra de palavra no texto
        $config['validate'] = TRUE; // define se haverá validação dos endereços de email
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = '';
        $config['smtp_user'] = '';
        $config['smtp_pass'] = '';
        $config['smtp_port'] = 587;

        $this->email->initialize($config);
        $this->email->from('', '');
        $this->email->to($to);
        
        $this->email->subject($subject);
        $this->email->message($message);
        return $this->email->send();
    }
}
?>