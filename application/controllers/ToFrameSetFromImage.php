<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ToFrameSetFromImage extends CI_Controller {

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

        $toFrameSetJson = $this->session->userdata('to-frame-set-json');
        $data = array('toFrameSetJson' => $toFrameSetJson);
        $this->load->view('to_frame_set_from_image', $data);
	}

    public function convertToFrameSet() {
    }
}
