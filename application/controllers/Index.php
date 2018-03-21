<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');


class Index extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->session->set_userdata('category', 'index');
        redirect('/TransactionHistory');

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
}