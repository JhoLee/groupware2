<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->session->set_userdata('category', 'none');
    }

    function _head()
    {
        $this->load->config('jho');
        $this->load->view('head');
    }

    function _sidebar()
    {
        $this->load->model('Topic_model');
        $topics = $this->Topic_model->gets();
        $this->load->view('topic_list', array('topics' => $topics));
        /*
        if (!$topics = $this->cache->get('topics')) {
            $topics = $this->topic_model->gets();
            $this->cache->save('topics', $topics, 300);
        }
        */
        $this->load->view('topic_list', array('topics' => $topics));
    }

    function _footer()
    {
        $this->load->view('footer');
    }

    function _require_login($return_url)
    {
        // 로그인이 되어 있지 않다면 로그인 페이지로 리다이렉션
        if (!$this->session->userdata('is_login')) {
            $this->load->helper('url');
            redirect('/auth/login?returnURL=' . rawurlencode($return_url));
        }
    }
}