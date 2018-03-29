<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');


class Transaction_model extends CI_Model
{
    // TODO: 테이블 수정 생성 삭제 열기 등...
    function __construct()
    {
        parent::__construct();
        $this->db->query('set session character_set_connection = utf8;');
        $this->db->query('set session character_set_results = utf8;');
        $this->db->query('set session character_set_client = utf8;');

        $this->load->helper('korean_helper');
    }

    function getAllSummary($team)
    {
        $this->db->select('m_id As name', false);
        $this->db->select_sum('(d_category * d_ammount)', 'balance');
        $this->db->select_max('d_date', 'processed_date');
        $this->db->where('t_team', $team);
        $this->db->group_by('m_id');
        $query = $this->db->get('deposit_history');
        $rows = $query->result();

        return $rows;
    }

    function getAllDetails($team)
    {

        $this->db->query('SET @balance := 0;');
        $sql = "SELECT
            ql.id,
            ql.date,
            ql.name,
            ql.type,
            ql.ammount * ql.type AS 'ammount',
            ql.rmks,
            (@balance := @balance + (ql.type * ql.ammount)) AS balance,
            ql.`processed_date`
            
            FROM
            (SELECT
            d_id             AS 'id',
            m_id           AS name,
            d_category       AS type,
            d_ammount        AS ammount,
            d_rmks           AS rmks,
            d_date           AS date,
            d_processed_date AS `processed_date`
            FROM deposit_history
            WHERE t_team = '$team'
            
            ORDER BY date, name) AS ql
            
            ORDER BY ql.date, ql.`processed_date` ASC;
            ";
        $rows = $this->db->query($sql)->result();
        return $rows;
    }

    function getPersonalSummary($id)
    {
        $this->load->model('User_model');


        $this->db->select('m_id AS id', false);
        $this->db->select_sum('(d_category * d_ammount)', 'balance');
        $this->db->select_max('d_date', 'processed_date');
        $this->db->where('m_id', $id);
        $query = $this->db->get('deposit_history');
        $rows = $query->result();
        $rows[0]->name = $this->User_model->getBy("id", $id)->name;

        return $rows[0];
    }

    function getPersonalDetails($id)
    {

        $this->db->query('SET @balance := 0;');
        $this->db->where('m_id', $id);
        $this->db->group_by(['d_id', 'd_date']);
        $sql = $this->db->get_compiled_select('deposit_history');
        $sql = "(" . $sql . ") AS ql";

        $this->db->select('ql.d_id AS id', false);
        $this->db->select('ql.d_rmks AS rmks', false);
        $this->db->select('ql.d_category AS type', false);
        $this->db->select('(ql.d_ammount * ql.d_category) AS ammount', false);
        $this->db->select('ql.d_date AS date', false);
        $this->db->select('ql.d_processed_date AS processed_date', false);
        $this->db->select("(@balance := @balance + (ql.d_category * ql.d_ammount)) AS balance", false);
        $this->db->order_by('ql.d_date', 'ASC');
        $this->db->order_by('ql.d_id', 'ASC');
        $sql = $this->db->get_compiled_select($sql);

        $rows = $this->db->query($sql)->result();
        return $rows;
    }

    function getTeamBalance($team)
    {
        $this->db->select_sum('(d_category * d_ammount)', 'balance');
        $this->db->select_max('d_date', 'processed_date');
        $this->db->where('t_team', $team);
        $sql = $this->db->get_compiled_select('deposit_history');

        $this->db->select_sum('(ql.balance)', 'balance');
        $this->db->select_max('(ql.processed_date)', 'processed_date');
        $sql = $this->db->get_compiled_select("($sql)");
        $sql = $sql . " AS ql";

        $row = $this->db->query($sql)->row();
        return $row;
    }

    function addHistory($id, $ammount, $date, $rmks, $team, $writer)
    {
        //TODO: validation
        if (!empty($id) and isset($ammount) and !empty($date) and !empty ($rmks) and !empty($team) and !empty($writer)) {


            if ($ammount > 0) {
                $type = 1;
            } else if ($ammount < 0) {
                $type = -1;
                $ammount = $ammount * -1;
            } else {
                $type = 0;
            }


            date_default_timezone_set("Asia/Seoul");
            $date = strtotime($date);
            $date = date("Y-m-d", $date);


            $now_date = date("Y-m-d H:i:s");

            $this->db->set('m_id', $id);
            $this->db->set('t_team', $team);
            $this->db->set('d_category', $type);
            $this->db->set('d_rmks', $rmks);
            $this->db->set('d_ammount', $ammount);
            $this->db->set('d_date', $date);
            $this->db->set('d_processed_date', $now_date);
            $this->db->set('d_writer', $writer);
            $this->db->set('d_editor', $writer);
            $result = $this->db->insert('deposit_history');

            return $result;

        } else {
            return false;
        }
    }

    /**
     * @param $team
     * @return ArrayObject of 'Dues deposit account information'
     */
    function getDepositMethod($team)
    {

        $this->db->select('di_id AS id');
        $this->db->select('di_owner AS 예금주');
        $this->db->select('di_bank AS 은행');
        $this->db->select('di_number AS 계좌번호');
        $this->db->where('t_team', $team);
        $query = $this->db->get('dues_deposit_information');
        $rows = $query->result();


        return $rows;
    }

    function addDepositMethod($team, $data)
    {
        $this->db->set($data);
        $this->db->set('t_team', $team);
        $result = $this->db->insert('dues_deposit_information');

        return $result;
    }

    function updateDepositMethod($team, $data)
    {
        $this->db->set($data);
        $this->db->set('t_team', $team);
        $this->db->where('di_id', $data['di_id']);
        $result = $this->db->update('dues_deposit_information');

        return $result;
    }

    function deleteDepositMethod($team, $id)
    {
        $result = $this->db->delete('dues_deposit_information', ['di_id' => $id, 't_team' => $team]);

        return $result;
    }


    function getDepositRowCount()
    {
        $this->db->select_max('di_id', 'id');
        $row = $this->db->get('dues_deposit_information')->row();
        $count = $row->id;
        return $count;
    }

    /**
     * @param $team
     * @return string
     */
    function getUpdatedDate($team)
    {
        $this->db->select_max('d_processed_date');
        $this->db->where('t_team', $team);
        $query = $this->db->get('deposit_history');

        $result = $query->row()->d_processed_date;
        $date = compute_time($result);

        return $date;
    }

    function een()
    {
        $args = func_get_args();
        return $args;
    }

//    function sqlToJson($team)
//    {
//        $result = $this->getAllDetails($team);
//        $json = json_encode($result, JSON_UNESCAPED_UNICODE);
//        return $json;
//    }

}