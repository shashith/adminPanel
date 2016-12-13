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
        $this->session->set_userdata('selected_page', 'to_frame_set_from_image');
        if (!$loggedIn) {
            redirect('/login', 'refresh');
        }

        $toFrameSetJson = $this->session->userdata('to-frame-set-json');
        $data = array('toFrameSetJson' => $toFrameSetJson);
        $this->load->view('to_frame_set_from_image', $data);
	}

    public function convertToFrameSetFromImage() {
        $imageName = $_POST["image"];
        $jsonName = $_POST["json"];
        $this->load->library('PHPRequests');
        $options = array(
            'timeout' => 120,
        );
        $response = Requests::get(TO_FRAME_SET_FROM_IMAGE . '?Image=' .$imageName . '&Json='. $jsonName, array(), $options);
        $this->session->set_userdata('to-frame-set-from-image', $response->body);
        redirect('/toMergeFrameSet');
    }
}
