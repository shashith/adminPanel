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
       $this->load->view('login');
    }

    public function authenticate()
    {
        $name = $_POST["username"];
        $pw = $_POST["password"];
        $resutrow = 'select authenticate('. $name . ',' . $pw . ')';
        $sp = $this->db->query("select authenticate(? ,?) as state", array($name, $pw));
        $state = $sp->row()->state;
        if ($state == 1)
        {
            redirect('/adminPanel', 'refresh');
        } else {
            redirect('/login');
        }
    }
}
