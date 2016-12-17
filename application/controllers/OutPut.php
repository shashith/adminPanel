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
        $loggedIn = $this->session->userdata('loginState');
        $this->session->set_userdata('selected_page', 'output');
        if (!$loggedIn) {
            redirect('/login', 'refresh');
        }
        $toFinalVideo = $this->session->userdata('to-final-video');
        $data = array('toFinalVideo' => $toFinalVideo);
        $this->load->view('output', $data);
    }
}
