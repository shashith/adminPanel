<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ToFinalVideo extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->database();
    }

    public function index() {
        $this->load->view('to_final_video');
        $loggedIn = $this->session->userdata('loginState');
        $this->session->set_userdata('selected_page', 'to_final_video');
        if (!$loggedIn) {
            redirect('/login', 'refresh');
        }
    }

    public function convertToFinalVideo()
        $this->load->library('PHPRequests');
        $options = array(
            'timeout' => 120,
        );
        $response = Requests::get(TO_FINAL_VIDEO, array(), $options);
        $this->session->set_userdata('to-final-video', $response->body);
        redirect('/outPut');
    }
}
