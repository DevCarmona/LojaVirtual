<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        //  Is there a function ? | Existe uma sessão ?
    }
    
    public function index()
    {
        $this->load->view('restrita/home/index');
    }
 }