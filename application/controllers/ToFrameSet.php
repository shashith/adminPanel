<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ToFrameSet extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->database();
    }

    public function index() {
        $loggedIn = $this->session->userdata('loginState');
        $this->session->set_userdata('selected_page', 'to_frame_set');
        if (!$loggedIn) {
            redirect('/login', 'refresh');
        }
        $toVideoJson = $this->session->userdata('to-video-json');
        $toVideoJsonLink = $this->session->userdata('to-video-json-link');
        $data = array('toVideoJson' => $toVideoJson, 'toVideoJsonLink' => $toVideoJsonLink);
        $this->load->view('to_frame_set', $data);
    }

    public function convertToFrameSet() {
        $toVideoJson = $this->session->userdata('to-video-json');
        $videoID = json_decode($toVideoJson)->{'ID'};
        $this->load->library('PHPRequests');
        $options = array(
            'timeout' => 60,
        );
        $response = Requests::get(TO_FRAME_SET . '?VideoID=' . $videoID, array(), $options);
        $this->session->set_userdata('to-frame-set-json', $response->body);
        redirect('/toFrameSetFromImage');
    }
}
