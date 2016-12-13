<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OutPut extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->database();
    }

    public function index() {
        $this->load->view('output');
        $loggedIn = $this->session->userdata('loginState');
        $this->session->set_userdata('selected_page', 'output');
        if (!$loggedIn) {
            redirect('/login', 'refresh');
        }
    }
}
