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

        $account_info = $this->Transaction_model->getDepositMethod($team);

        $this->_head();
        $this->load->view('alert/message', ['type' => 'info', 'message' => $this->_updatedDate($team)]);
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


        $this->load->view('transaction/deposit_method', ['rows' => $account_info, 'permission' => $permission]);

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
        $this->load->view('alert/message', ['type' => 'info', 'message' => $this->_updatedDate($team)]);
        $this->_navbar($category, $section, $permission);
        $this->load->view('alert/message', ['type' => $_type, 'message' => $_message]);


//        $message = $this->session->flashdata('message2');
//        $members = $this->User_model->gets($team);
//        $_date = $this->session->flashdata('_date');
//        $_rmks = $this->session->flashdata('_rmks');
//
//        $id_array = [];
//        foreach ($members as $row) {
//            $id_array[$row['id']] = $row['name'];
//        }
//
//
        if ($permission >= 2) {
//            $rows = $this->Transaction_model->getAllDetails($team);
//            $this->load->view('transaction/' . $section, ['rows' => $rows, 'id_array' => $id_array, 'message' => $message, '_date' => $_date, '_rmks' => $_rmks]);
            if ($section === 'add')
                $this->_add($team);
            if ($section === 'test')
                $this->_testing($team);
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

    function _updatedDate($team)
    {
        $last_modified_date = $this->Transaction_model->getUpdatedDate($team);

        return "업데이트: " . $last_modified_date;

    }

    function _add($team)
    {
        $message = $this->session->flashdata('message2');
        $members = $this->User_model->gets($team);
        $_date = $this->session->flashdata('_date');
        $_rmks = $this->session->flashdata('_rmks');

        $id_array = [];
        foreach ($members as $row) {
            $id_array[$row['id']] = $row['name'];
        }


        $rows = $this->Transaction_model->getAllDetails($team);
        $this->load->view('transaction/' . 'add', ['rows' => $rows, 'id_array' => $id_array, 'message' => $message, '_date' => $_date, '_rmks' => $_rmks]);

    }

    function _testing($team)
    {
        $rows = $this->Transaction_model->getDepositMethod($team);
        $this->load->view('transaction/deposit_method', ['rows' => $rows]);
    }

    function _depositInformation($team)
    {
        $rows = $this->Transaction_model->getDepositMethod($team);

    }

    function depositInfoToJson()
    {
        $this->_require_login('/');
        $team = $this->session->userdata('user_team');
        $rows = $this->Transaction_model->getDepositMethod($team);
        $rows_json = json_encode($rows, JSON_UNESCAPED_UNICODE);

        echo $rows_json;

    }

    function configDepositInfo()
    {
        $team = $this->session->userdata('user_team');

        if ($this->input->post('type') == 'delete') {
            $id = $this->input->post('id');
            $result = $this->Transaction_model->deleteDepositmethod($team, $id);

        } else {

            $row = [];
            $row['di_id'] = $this->input->post('id');
            $row['di_owner'] = $this->input->post('owner');
            $row['di_bank'] = $this->input->post('bank');
            $row['di_number'] = $this->input->post('number');


            if (empty($row['di_id'])) {
                $row['di_id'] = (int)$this->Transaction_model->getDepositRowCount() + 1;
                foreach ($row as $value) {
                    if (empty($value)) {
                        echo 'false';
                        return -1;
                    }
                }
                echo "add..";
                $result = $this->Transaction_model->addDepositMethod($team, $row);
            } else {
                foreach ($row as $value) {
                    if (empty($value)) {
                        echo 'false';
                        return -1;
                    }
                }
                echo "update..";
                $result = $this->Transaction_model->updateDepositMethod($team, $row);
            }
        }
        echo $result;

        return 0;
    }
}