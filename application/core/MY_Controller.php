<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->_category = 'none';

    }

    function _head()
    {
        $this->load->config('jho');
        $this->load->view($this->_category . '/head');
    }

//    function _sidebar()
//    {
//        $this->load->model('Topic_model');
//        $topics = $this->Topic_model->gets();
//        $this->load->view('topic_list', array('topics' => $topics));
//        /*
//        if (!$topics = $this->cache->get('topics')) {
//            $topics = $this->topic_model->gets();
//            $this->cache->save('topics', $topics, 300);
//        }
//        */
//    }

    function _footer($_args = [])
    {

        $this->load->view($this->_category . '/footer', $_args);
    }

    function _require_login($return_url)
    {
        // 로그인이 되어 있지 않다면 로그인 페이지로 리다이렉션
        if (!$this->session->userdata('is_login')) {
            redirect('/auth/login?return_url=' . rawurlencode($return_url));
        }
    }

    function _already_login($return_url)
    {

        if ($this->session->userdata('is_login')) {
            $this->session->set_flashdata('message', '이미 로그인 상태입니다.');
            redirect($return_url);

        }
    }


}