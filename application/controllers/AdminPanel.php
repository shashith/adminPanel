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

        if (!$loggedIn) {
            redirect('/login', 'refresh');
        }
	}

    public function uploadVideo() {
        $name = $_POST["name"];
        $description = $_POST["description"];
        $video_path = $_POST["path"];
        $sp = $this->db->query("call insert_video(? ,?, ?, ?)", array($name, $description, $video_path, date('Y-m-d H:i:sa')));
        $this->session->set_userdata('video-id', $sp->row()->ID);
        //send request to API
        $this->load->library('PHPRequests');
        $response = Requests::get('http://localhost/HRE/ToVideo.php?FileName=' . $name);
        $this->session->set_userdata('to-video-json', $response->body);
        redirect('/toFrameSet');
    }
}
