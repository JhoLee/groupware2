<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');


class Auth extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->session->set_userdata('category', 'auth');
        $this->_head();
        $this->load->model('User_model');

    }


    function login()
    {
        if ($this->session->userdata('is_login') == true) {
            $this->session->set_userdata('message', 'Already Signed In.');
            if (empty($returnURL))
                $returnURL = '/';

            redirect($returnURL);
        }
        $returnURL = $this->input->get('returnURL');
        $this->load->view('login', array('returnURL' => $returnURL));
        $this->_footer();
    }

    function logout()
    {
        $this->session->sess_destroy();
        $this->load->helper('url');
        redirect('/');
    }

    function register()
    {
        // TODO 회원가입. 기존 방식과 틀은 같되, 암호화 방식에 차이가 생길 수도.
        // 기존 아이디 및 비밀번호로 로그인 시, 새로 비밀번호 설정 및 이메일 설정하게 하는 방법이 좋을듯.

    }

    function authentication()
    {
        // TODO: 구버전 로그인 지원하도록 만들어야 함... 구버전 로그인 시에는 '이메일 추가' 및 비밀번호 변경이 되어야 함.
        // 로그인 인증
        $user = $this->User_model->getBy('id', $this->input->post('id'));
        $user->password = $this->User_model->getPassword($user->id);
        /* copied */
        if (!function_exists('password_hash')) {
            $this->load->helper('password');
        }
        if (
            $this->input->post('id') == $user->id &&
            password_verify($this->input->post('password'), $user->password)
        ) {
            $this->session->set_userdata('is_login', true);
            $this->load->helper('url');
            $returnURL = $this->input->get('returnURL');
            if ($returnURL === false) {
                $returnURL = '/';
            }
            redirect($returnURL);
        } else {
            $this->session->set_flashdata('message', '로그인에 실패 했습니다.' . $user->id);
            $this->load->helper('url');
            redirect('/auth/login');
        }
        /* End of copied */

    }


}
