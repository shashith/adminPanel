<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->database();
    }

    public function index()
    {
        $loggedIn = $this->session->userdata('loginState');
        if ($loggedIn) {
            redirect('/adminPanel', 'refresh');
        } else {
            $this->load->view('login');
        }
    }

    public function authenticate()
    {
        $username = $_POST["username"];
        $pw = $_POST["password"];
        $resutrow = 'select authenticate('. $username . ',' . $pw . ')';
        $sp = $this->db->query("select authenticate(? ,?) as state", array($username, $pw));
        $state = $sp->row()->state;
        if ($state == 1)
        {
            $data = $this->db->query("select Name, Email from user where UserName = '" . $username . "'");
            $this->session->set_userdata('Name', $data->row()->Name);
            $this->session->set_userdata('Email', $data->row()->Email);
            $this->session->set_userdata('loginState', true);
            redirect('/adminPanel', 'refresh');
        } else {
            redirect('/login');
        }
    }
}
