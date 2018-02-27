<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Topic extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Topic_model');
    }

    function index()
    {
        $topics = $this->Topic_model->gets();
        $this->load->view('Head');
        $this->load->view('topic_list', array('topics' => $topics));
        $this->load->view('main');
        $this->load->view('Footer');
    }

    function get($id)
    {
        $topics = $this->Topic_model->gets();
        $topic = $this->Topic_model->get($id);
        $this->load->view('Head');
        $this->load->view('topic_list', array('topics' => $topics));
        $this->load->helper(array('url', 'HTML', 'korean'));
        $this->load->view('get', array('topic' => $topic));
        $this->load->view('Footer');
    }
}
