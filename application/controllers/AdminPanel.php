<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminPanel extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->database();
    }

    public function index() {
        $this->load->view('admin_panel');
        $loggedIn = $this->session->userdata('loginState');
        $this->session->set_userdata('selected_page', 'admin_panel');

        if (!$loggedIn) {
            redirect('/login', 'refresh');
        }
	}

    public function uploadVideo() {
        $name = $_POST["name"];
        $description = $_POST["description"];
        $video_path = $_POST["path"];
        $duration = $_POST["duration"];
        $height = $_POST["height"];
        $width = $_POST["width"];
        $sp = $this->db->query("call insert_video(? ,?, ?, ?)", array($name, $description, $video_path, date('Y-m-d H:i:sa')));
        $this->session->set_userdata('video-id', $sp->row()->ID);
        //send request to API
        $this->load->library('PHPRequests');
        $response = Requests::get(TO_VIDEO . '?FileName=' . $name . '&Duration=' . $duration . '&Height=' . $height . '&Width=' . $width);
        $json = json_decode($response->body);
        if (isset( $json->{'Error Details'})) {
            $this->session->set_userdata('error', $response->body);
            redirect('/error');
        }
        $this->session->set_userdata('to-video-json', $response->body);
        redirect('/toFrameSet');
    }
}
