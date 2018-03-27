<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');


class Alert extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->_require_login('/Errors/404');
        $this->_category = 'alert';
        $this->load->helper('korean_helper');
    }

    function index()
    {
        $this->_404();

    }

    function _404()
    {
        $this->load->config('jho');
        $id = $this->session->userdata('user_id');
        $this->load->view($this->_category . '/head', ['id' => $id]);
        $this->load->view('alert/404');
    }

}