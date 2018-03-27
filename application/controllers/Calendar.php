<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->_require_login('/Calendar');
        $this->_category = 'calendar';
        $this->load->helper('korean_helper');
    }

    function index()
    {
        $this->load->config('jho');
        $id = $this->session->userdata('user_id');
        $this->load->view($this->_category . '/head', ['id' => $id]);
        $this->load->view('alert/construction');
    }

}