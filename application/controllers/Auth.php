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

    function index()
    {
        $this->login();
    }


    function login()
    {
        if (empty($returnURL))
            $returnURL = '/';
        if ($this->session->userdata('is_login') == true) {
            $this->session->set_userdata('message', 'Already Signed In.');

            redirect($returnURL);
        }

        $returnURL = $this->input->get('returnURL');
        $this->load->view('login', array('returnURL' => $returnURL));
        $this->_footer();
    }

    function logout()
    {
        $this->session->sess_destroy();
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
        $user->old_password = $this->User_model->getOldPassword($user->id);
        if (!function_exists('password_hash')) {
            $this->load->helper('password');
        }
        if ($this->input->post('id') == $user->id) {
            if (password_verify($this->input->post('password'), $user->password)) {
                /* If the pw is correct with new ver. */
                $this->session->set_userdata('is_login', true);
                $returnURL = $this->input->get('returnURL');
                if ($returnURL === false) {
                    $returnURL = '/';
                }
                redirect($returnURL);
            } else if (password_verify($this->input->post('password'), $user->old_password)) {
                /* If the pw is correct with old ver. */
                $this->session->set_userdata('old_pw', true);
                $returnURL = $this->input->get('returnURL');
                if ($returnURL === false) {
                    $returnURL = '/';
                }
                $this->session->set_flashdata('message', '비밀번호를 변경해야 합니다.');
                $s_user = serialize($user);
                $this->session->set_userdata('s_user', $s_user);
                $this->session->set_userdata('returnURL', $returnURL);
                redirect('/auth/renewPW');


            } else {
                /* */
                $this->session->set_flashdata('message', '로그인에 실패 했습니다.');
                redirect('/auth/login');
            }
        }
    }

    function renewPW()
    {
        $this->load->library('calendar');
        if (empty($this->input->post('password'))) {
            $user = unserialize($this->session->userdata('s_user'));
            $returnURL = unserialize($this->session->userdata('returnURL'));
            $this->load->view('renewPW', array('user' => $user, 'returnURL' => $returnURL));
        } else {
            // TODO: Varify two passwords, and then set or not.
            if (false) {
                // TODO: If Two passwords are same and follows the rule
                // reset password

                $this->session->sess_destroy();
                redirect('/auth/login');
            } else {
                // TODO
                // clear post data and refresh teh page
                redirect('/auth/renewPW');
            }
        }
    }


}
