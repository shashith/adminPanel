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
        $data = array('toVideoJson' => $toVideoJson);
        $this->load->view('to_frame_set', $data);
    }

    public function convertToFrameSet() {
        $toVideoJson = $this->session->userdata('to-video-json');
        $videoID = json_decode($toVideoJson)->{'ID'};
        $this->load->library('PHPRequests');
        $options = array(
            'timeout' => 600,
        );
        $response = Requests::get(TO_FRAME_SET . '?RawMaterialsID=' . $videoID, array(), $options);
        $json = json_decode($response->body);
        if (isset( $json->{'Error Details'})) {
            $this->session->set_userdata('error', $response->body);
            redirect('/error');
        }
        $this->session->set_userdata('to-frame-set-json', $response->body);
        $this->session->set_userdata('base-video-id', json_decode($response->body)->{'ID'});
        //$sp = $this->db->query("UPDATE video SET ToVideoID=" . $response->body . " where ID=" . $this->session->userdata('to-video-json'));
        redirect('/toFrameSetFromImage');
    }
}
