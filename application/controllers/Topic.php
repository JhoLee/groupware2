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

    function _head()
    {
        $topics = $this->Topic_model->gets();
        $this->load->view('head');
        $this->load->view('topic_list', array('topics' => $topics));
    }

    function index()
    {
        $this->_head();


        $this->load->view('main');

        $this->load->view('footer');
    }

    function get($id)
    {
        $this->_head();

        $topic = $this->Topic_model->get($id);
        $this->load->helper(array('url', 'HTML', 'korean'));
        $this->load->view('get', array('topic' => $topic));

        $this->load->view('footer');
    }

    function add()
    {
        $this->_head();

        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('add');
        } else {
            $topic_id = $this->Topic_model->add($this->input->post('title'), $this->input->post('description'));
            $this->load->helper('url');
            redirect('/topic/get/' . $topic_id);
        }

        $this->load->view('footer');
    }


}
