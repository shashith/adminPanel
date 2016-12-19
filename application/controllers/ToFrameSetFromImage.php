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
        $baseFrameSet = $_POST["baseFrameSet"];
        $this->load->library('PHPRequests');
        $options = array(
            'timeout' => 600,
        );
        $response = Requests::get(TO_FRAME_SET_FROM_IMAGE . '?Image=' . $imageName . '&Json=' . $jsonName . '&BaseFrameSet=' . $baseFrameSet, array(), $options);
        $json = json_decode($response->body);
        if (isset( $json->{'Error Details'})) {
            $this->session->set_userdata('error', $response->body);
            redirect('/error');
        }
        $this->session->set_userdata('to-frame-set-from-image', $response->body);
        $this->session->set_userdata('child-video-id', json_decode($response->body)->{'ID'});
        redirect('/toMergeFrameSet');
    }
}
