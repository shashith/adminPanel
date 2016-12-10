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

        if (!$loggedIn) {
            redirect('/login', 'refresh');
        }

        $toVideoJson = $this->session->userdata('to-video-json');
        $data = array('toVideoJson' => $toVideoJson);
        $this->load->view('to_frame_set', $data);
	}

    public function convertToFrameSet() {
        $toVideoJson = $this->session->userdata('to-video-json');
        $videoID = json_decode($toVideoJson)->{'ID'};
        $this->load->library('PHPRequests');
        $options = array(
	'timeout' => 60,
);
        $response = Requests::get('http://localhost/HRE/ToFrameSet.php?VideoID=' . $videoID, array(), $options);
        $this->session->set_userdata('to-frame-set-json', $response->body);
        redirect('/toFrameSetFromImage');
    }
}
