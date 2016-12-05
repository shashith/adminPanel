<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminPanel extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index()
    {
        $this->load->view('admin_panel');
        $loggedIn = $this->session->userdata('loginState');

        if (!$loggedIn) {
            redirect('/login', 'refresh');
        }
	}
}
