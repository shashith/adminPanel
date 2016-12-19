<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->database();
    }

    public function index() {
        $loggedIn = $this->session->userdata('loginState');
        if (!$loggedIn) {
            redirect('/login', 'refresh');
        }
        $error = $this->session->userdata('error');
        $data = array('error' => $error);
        $this->load->view('error', $data);
    }
}
