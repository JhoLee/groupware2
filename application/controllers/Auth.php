<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');


class Auth extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->_category = 'auth';
        $this->_head();
        $this->load->model('User_model');
        $this->load->helper('form');
    }

    function index()
    {
        $this->login();
    }


    function login()
    {
        if (empty($return_url))
            $return_url = '/';
        $this->_already_login($return_url);
        $return_url = $this->input->get('return_url');
        $this->load->view('auth/login', ['return_url' => $return_url, 'email' => safe_mailto('jooho_lee@outloo.kr', 'admin')]);
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

        if (empty($return_url))
            $return_url = '/';
        $this->_already_login($return_url);
        $this->load->view('alert/construction');

//        $this->load->view('auth/register', ['return_url' => $return_url]);


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
                $this->session->set_userdata('user_id', $user->id);
                $this->session->set_userdata('user_team', $user->team);
                $this->session->set_userdata('user_permission', $user->permission);
                $return_url = $this->input->get('return_url');
                if ($return_url === false) {
                    $return_url = '/';
                }
                redirect($return_url);
            } else if (password_verify($this->input->post('password'), $user->old_password)) {
                /* If the pw is correct with old ver. */
                $this->session->set_userdata('old_pw', true);
                $this->session->set_userdata('user_id', $user->id);
                $this->session->set_userdata('user_team', $user->team);
                $this->session->set_userdata('user_permission', $user->permission);
                $return_url = $this->input->get('return_url');
                if ($return_url === false) {
                    $return_url = '/';
                }
                $this->session->set_flashdata('message', '비밀번호를 변경해야 합니다.');
                $s_user = serialize($user);
                $this->session->set_userdata('s_user', $s_user);
                $this->session->set_userdata('return_url', $return_url);
                redirect('/auth/changePW');


            }
        }
        /* */
        $this->session->set_flashdata('message', '로그인에 실패 했습니다.');
        redirect('/auth/login');


    }

    /**
     *
     */
    function changePW()
    {
        $this->_require_login('/Transaction');

        $this->load->library('form_validation');

        if ($this->input->method() == 'post') {
            $config = [
                [
                    'field' => 'origin_password',
                    'label' => '기존 비밀번호',
                    'rules' => ['required', 'min_length[6]', 'max_length[15]'],
                    'errors' => ['required' => '기존 비밀번호를 입력해야 합니다.', 'min_length[6]' => '6자 이상 16자 미만으로 입력해야 합니다.', 'max_length[15]' => '6자 이상 16자 미만으로 입력해야 합니다.']
                ],
                [
                    'field' => 'password1',
                    'label' => '변경할 비밀번호',
                    'rules' => ['required', 'min_length[6]', 'max_length[15]'],
                    'errors' => ['required' => '변경할 비밀번호를 입력해야 합니다.', 'min_length[6]' => '6자 이상 16자 미만으로 입력해야 합니다.', 'max_length[15]' => '6자 이상 16자 미만으로 입력해야 합니다.']
                ],
                [
                    'field' => 'password2',
                    'label' => '재입력한 비밀번호',
                    'rules' => ['required', 'min_length[6]', 'max_length[15]'],
                    'errors' => ['required' => '변경할 비밀번호를 재입력해야 합니다.', 'min_length[6]' => '6자 이상 16자 미만으로 입력해야 합니다.', 'max_length[15]' => '6자 이상 16자 미만으로 입력해야 합니다.']
                ]
            ];
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == true) {

                $user = $this->User_model->getBy('id', $this->input->post('id'));
                $user->password = $this->User_model->getPassword($user->id);
                $user->old_password = $this->User_model->getOldPassword($user->id);
                if (!function_exists('password_hash')) {
                    $this->load->helper('password');
                }

                if (!password_verify($this->input->post('origin_password'), $user->password) and !password_verify($this->input->post('origin_password'), $user->old_password)) {
                    $this->session->set_flashdata('message', '기존 비밀번호가 맞지 않습니다.');
                } else {
                    $team = $this->session->userdata('user_team');


                    if ($this->input->post('password1') != $this->input->post('password2')) {
                        /* passwords are not same */
                        $this->session->set_flashdata('message', '변경할 비밀번호가 서로 맞지 않습니다.');
                    } else {
                        if ($team == 'Test') {
                            $this->session->set_flashdata('message', '테스트 계정은 비밀번호 변경이 불가능합니다.');
                        } else {
                            $id = $this->input->post('id');
                            $hash = password_hash($this->input->post('password1'), PASSWORD_BCRYPT);
                            $result = $this->User_model->setPassword($id, $hash);
                            if ($result != '1') {
                                $this->session->set_flashdata('message', '알 수 없는 오류');
                            } else {
                                $this->logout();
                                $this->session->set_flashdata('message', '비밀번호 변경 성공!');
                                redirect('/auth/login');
                            }
                        }
                    }

                }
                redirect('/auth/changePW');


            }
        }
        $user = unserialize($this->session->userdata('s_user'));
        $id = $this->session->userdata('user_id');
        $return_url = unserialize($this->session->userdata('return_url'));
        $this->load->view('auth/change_pw', ['user' => $user, 'return_url' => $return_url, 'id' => $id, 'email' => safe_mailto('jooho_lee@outlook.kr', 'admin')]);

        /*
        if (empty($this->input->post('password'))) {
            $user = unserialize($this->session->userdata('s_user'));
            $id = $this->session->userdata('user_id');
            $return_url = unserialize($this->session->userdata('return_url'));
            $this->load->view('auth/change_pw', array('user' => $user, 'return_url' => $return_url, 'id' => $id, 'email' => safe_mailto('jooho_lee@outlook.kr', 'admin')));
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
                redirect('/auth/renew_pw');
            }
        }
        */
    }


    function renewPW()
    {
        $this->load->library('form_validation');

        $config = [
            [
                'field' => 'origin_password',
                'label' => '기존 비밀번호',
                'rules' => ['required', 'min_length[6]', 'max_length[15]'],
                'errors' => ['required' => '기존 비밀번호를 입력해야 합니다.']
            ],
            [
                'field' => 'password1',
                'label' => '변경할 비밀번호',
                'rules' => ['required', 'min_length[6]', 'max_length[15]'],
                'errors' => ['required' => '변경할 비밀번호를 입력해야 합니다.']
            ],
            [
                'field' => 'password2',
                'label' => '재입력한 비밀번호',
                'rules' => ['required', 'min_length[6]', 'max_length[15]'],
                'errors' => ['required' => '변경할 비밀번호를 재입력해야 합니다.']
            ]
        ];
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == false) {
        }

    }


}
