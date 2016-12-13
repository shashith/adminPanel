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
        $this->load->view('to_merge_frame_set');
        $loggedIn = $this->session->userdata('loginState');
        $this->session->set_userdata('selected_page', 'to_merge_frame_set');
        if (!$loggedIn) {
            redirect('/login', 'refresh');
        }
    }

    public function mergeFrameSet()
        $this->load->library('PHPRequests');
        $options = array(
            'timeout' => 120,
        );
        $response = Requests::get(TO_MERGE_FRAME_SET, array(), $options);
        $this->session->set_userdata('to-merge-frame-set', $response->body);
        redirect('/toFinalVideo');
    }
}
