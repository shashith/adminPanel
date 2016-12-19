<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ToMergeFrameSet extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->database();
    }

    public function index() {
        $loggedIn = $this->session->userdata('loginState');
        $this->session->set_userdata('selected_page', 'to_merge_frame_set');
        if (!$loggedIn) {
            redirect('/login', 'refresh');
        }
        $toFrameSetFromImage = $this->session->userdata('to-frame-set-from-image');
        $data = array('toFrameSetFromImage' => $toFrameSetFromImage);
        $this->load->view('to_merge_frame_set', $data);
    }

    public function mergeFrameSet() {
        $this->load->library('PHPRequests');

        $baseId = $this->session->userdata('base-video-id');
        $childId = $this->session->userdata('child-video-id');
        $options = array(
            'timeout' => 600,
        );
        $response = Requests::get(TO_MERGE_FRAME_SET. '?ChildFrameSet=' . $childId, array(), $options);
        $this->session->set_userdata('to-merge-frame-set-json', $response->body);
        $this->session->set_userdata('to-merge-frame-set-id', json_decode($response->body)->{'ID'});
        redirect('/toFinalVideo');
    }
}
