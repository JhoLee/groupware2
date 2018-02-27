<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Topic extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('topic_model');
    }

    function index()
    {
        $this->load->database();
        $this->load->model('topic_model');
        $data = $this->topic_model->gets();
        $this->load->view('head');
        $this->load->view('main');
        $this->load->view('footer');
    }

    function get($id)
    {
        $this->load->view('head');
        $this->load->view('get', array('id'=>$id));
        $this->load->view('footer');
    }
}
