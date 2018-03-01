<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Topic
 */
class Topic extends MY_Controller
{
    /**
     * Topic constructor.
     */
    function __construct()
    {
        parent::__construct();
        $this->session->set_userdata('category', 'topic');
        $this->load->model('Topic_model');

    }

    /**
     *
     */
    function _head()
    {
        parent::_head();
    }

    /**
     *
     */
    function index()
    {
        $this->_head();
        $this->_sidebar();
        $this->load->view('main');
        $this->_footer();
    }

    /**
     * @param $id
     */
    function get($id)
    {
        $this->_head();

        $topic = $this->Topic_model->get($id);
        $this->load->helper(array('url', 'HTML', 'korean'));
        $this->load->view('get', array('topic' => $topic));

        $this->load->view('footer');
    }

    /**
     *
     */
    function add()
    {
        // TODO 로그인 요구.

        // todo 로그인 되어 있지 않다면, 로그인 페이지로 리다이렉션
        if (true) {
            $this->load->helper('url');
            redirect('/auth/login');
        }
        $this->_head();

        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->load->helper('url');
            $this->load->view('add');
        } else {
            $title = $this->input->post('title');
            $description = $this->input->post('description');
            $topic_id = $this->Topic_model->add($title, $description);
            $this->load->helper('url');
            redirect('/topic/get/' . $topic_id);
        }

        $this->load->view('footer');
    }


}
