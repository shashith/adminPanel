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
        $loggedIn = $this->session->userdata('loginState');
        $this->session->set_userdata('selected_page', 'to_final_video');
        if (!$loggedIn) {
            redirect('/login', 'refresh');
        }
        $toMergeFrameSetJson = $this->session->userdata('to-merge-frame-set-json');
        $data = array('toMergeFrameSetJson' => $toMergeFrameSetJson);
        $this->load->view('to_final_video', $data);
    }

    public function convertToFinalVideo() {
        $this->load->library('PHPRequests');
        $options = array(
            'timeout' => 120,
        );
        $toMergeFrameSetId = $this->session->userdata('to-merge-frame-set-id');
        $response = Requests::get(TO_FINAL_VIDEO . '?FrameSet=' . $toMergeFrameSetId, array(), $options);
        $json = json_decode($response->body);
        if (isset( $json->{'Error Details'})) {
            $this->session->set_userdata('error', $response->body);
            redirect('/error');
        }
        $this->session->set_userdata('to-final-video', $response->body);
        redirect('/outPut');
    }
}
