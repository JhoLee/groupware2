<?php
declare(strict_types=1);


if (!defined('BASEPATH')) exit('No direct script access allowed');

/* TODO:  표의 column 데이타를 json 파일에서 불러오는 방법으로 수정할 것. 18.03.07 */

class Transaction extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->_require_login('/Transaction');
        $this->_category = 'transaction';
        $this->load->model('Transaction_model');
        $this->load->model('User_model');
        $this->load->helper('korean_helper');


    }

    function _head()
    {
        $this->load->config('jho');
        $id = $this->session->userdata('user_id');
        $this->load->view($this->_category . '/head', ['id' => $id]);
    }


    function _navbar($category, $section, $permission)
    {
        $navbar_json = file_get_contents(getcwd() . '/application/res/json/navbar.json');
        $navbar_json = json_decode($navbar_json, true);
        if ($permission >= 2) {
            $navbar = ['navbar' => $navbar_json['transaction-admin'], 'category' => $category, 'section' => $section];
        } else {
            $navbar = ['navbar' => $navbar_json['transaction'], 'category' => $category, 'section' => $section];
        }
        $this->load->view('navbar', $navbar);

    }

    function index()
    {
        $this->personal();

    }

    function personal($section = "summary", $category = "personal")
    {
        $this->_showData($category, $section);
    }

    function all($section = "summary", $category = "all")
    {
        //TODO: mysql로 부터 data를 받아온 후 json으로 저장하는 페이지를 만들고, ajax로 이 데이터를 활용하도록 수정할 것..

        $this->_showData($category, $section);
    }

    function _showData($category, $section)
    {
        $id = $this->session->userdata('user_id');
        $team = $this->session->userdata('user_team');
        $permission = $this->session->userdata('user_permission');

        $this->_head();
        $this->load->view('alert/message', ['type' => 'info', 'message' => $this->_updated_date($team)]);
        $this->_navbar($category, $section, $permission);

        if ($category == "personal") {
            if ($section == "summary") {
                $rows = $this->Transaction_model->getPersonalSummary($id);
            } else {
                $rows = $this->Transaction_model->getPersonalDetails($id);
            }
        } else if ($category == "all") {
            if ($permission >= 2) {
                if ($section == "summary") {
                    $rows = $this->Transaction_model->getAllSummary($team);
                } else {
                    $rows = $this->Transaction_model->getAllDetails($team);
                }
            } else {
                redirect('transaction');
            }

        }
        $teamData = $this->Transaction_model->getTeamBalance($team);

        $this->load->view($this->_category . '/' . $category . '_' . $section, ['rows' => $rows, 'teamData' => $teamData]);


        $this->_footer([]);

        // TODO: mysql 데이타 json으로 변경


    }

    function getRowData($category, $section)
    {
        $this->_require_login('Transaction');

        $id = $this->session->userdata('user_id');
        $team = $this->session->userdata('user_team');
        $permission = $this->session->userdata('user_permission');

        if ($category == "personal") {
            if ($section == "summary") {
                $rows = $this->Transaction_model->getPersonalSummary($id);
            } else {
                $rows = $this->Transaction_model->getPersonalDetails($id);
            }
        } else if ($category == "all") {
            if ($permission >= 2) {
                if ($section == "summary") {
                    $rows = $this->Transaction_model->getAllSummary($team);
                } else {
                    $rows = $this->Transaction_model->getAllDetails($team);
                }
            }

        }
        $json = json_encode($rows, JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);

        if ($permission >= 2) {
            $this->load->view('transaction/rows_json', ['json' => $json]);
        } else {
            redirect('transaction');
        }
    }

    function manage($section = "add")
    {
        $this->load->helper('form');
        $this->_require_login('Transaction');

        $category = "manage";

        $id = $this->session->userdata('user_id');
        $team = $this->session->userdata('user_team');
        $permission = $this->session->userdata('user_permission');

        $_type = $this->session->flashdata('_message')['type'];
        $_message = $this->session->flashdata('_message')['message'];

        if ($permission <= 3 and $section == "test") {
            $section = "add";
        }

        $this->_head();
        $this->load->view('alert/message', ['type' => 'info', 'message' => $this->_updated_date($team)]);
        $this->_navbar($category, $section, $permission);
        $this->load->view('alert/message', ['type' => $_type, 'message' => $_message]);


        $message = $this->session->flashdata('message2');
        $members = $this->User_model->gets($team);
        $_date = $this->session->flashdata('_date');
        $_rmks = $this->session->flashdata('_rmks');

        $id_array = [];
        foreach ($members as $row) {
            $id_array[$row['id']] = $row['name'];
        }


        if ($permission >= 2) {
            $rows = $this->Transaction_model->getAllDetails($team);
            $this->load->view('transaction/' . $section, ['rows' => $rows, 'id_array' => $id_array, 'message' => $message, '_date' => $_date, '_rmks' => $_rmks]);
        } else {
            redirect('transaction');
        }
        $this->_footer([]);
    }

    function insert()
    {
        $id = $this->session->userdata('user_id');
        $team = $this->session->userdata('user_team');
        $permission = $this->session->userdata('user_permission');
        if ($permission >= 2) {
            if ($this->input->post('name') != '0') {
                $_name = $this->input->post('name');
                $row = $this->User_model->getBy('name', $_name);
                $_id = $row->id;
                $_date = $this->input->post('date');
                $_ammount = $this->input->post('ammount');
                $_rmks = $this->input->post('rmks');

                $result = $this->Transaction_model->addHistory($_id, $_ammount, $_date, $_rmks, $team, $id);

                if ($result === true) {
                    $message = "추가 성공!";
                    $this->session->set_flashdata('_date', $_date);
                    $this->session->set_flashdata('_rmks', $_rmks);
                    $type = 'success';

                } else if ($result === false) {
                    $message = "오류 발생. 재시도 ㄱ";
                    $type = 'danger';
                } else {
                    $message = $result;
                    $type = 'danger';

                }
                $this->session->set_flashdata('_message', ['type' => $type, 'message' => $message]);
            }

        }

        redirect('Transaction/manage/add');
    }

    function _footer($_args = [])
    {
        parent::_footer([]);
    }

    function _updated_date($team)
    {
        $last_modified_date = $this->Transaction_model->get_last_updated_date($team);

        return "업데이트: " . $last_modified_date;

    }
}