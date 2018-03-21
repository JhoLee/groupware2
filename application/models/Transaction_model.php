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
        $sql = "SELECT 
                m_id AS 'name', 
                SUM(d_category * d_ammount) AS 'balance', 
                MAX(d_date) AS 'processed_date' 
                FROM `deposit_history` 
                WHERE `t_team` = '$team' 
                GROUP BY m_id
            ";
        $rows = $this->db->query($sql)->result();
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
        //$data = array();
        //$data["rows"] = $rows;

        // return $data;
        return $rows;
    }

    function getPersonalSummary($id)
    {
        // TODO: CI 방식의 SQL문으로 수정할 것.
        $this->load->model('User_model');

        $sql = "SELECT m_id AS 'id',  SUM(d_category * d_ammount) AS 'balance', MAX(d_date) AS 'processed_date'
                    FROM deposit_history WHERE  m_id='$id'";
        $row = $this->db->query($sql)->row_array();
        $row["name"] = $this->User_model->getBy("id", $id)->name;
        return $row;
    }

    function getPersonalDetails($id)
    {

        $this->db->query('SET @balance := 0;');
        $sql = "
            SELECT
              ql.d_id,
              ql.rmks AS 'rmks',
              ql.type AS 'type',
              ql.ammount * ql.type AS 'ammount',
              ql.date AS 'date',
              ql.processed_date AS 'processed_date',
            
              (@balance := @balance + (ql.type * ql.ammount)) AS 'balance'
            
            FROM
              (SELECT
                 d_id,
                 d_category       AS type,
                 d_ammount        AS ammount,
                 d_rmks           AS rmks,
                 d_date           AS date,
                 d_processed_date AS processed_date
               FROM deposit_history
               WHERE m_id = '$id'
               GROUP BY d_id, d_date
               ORDER BY d_date, d_id) AS ql
            ORDER BY ql.date, ql.d_id ASC;
            ";
        $rows = $this->db->query($sql)->result();
        return $rows;
    }

    function getTeamBalance($team)
    {
        $sql = "SELECT
              SUM(ql.balance) AS 'balance',
              MAX(ql.processed_date) AS 'processed_date'
            FROM
            (SELECT 
                SUM(d_category * d_ammount) AS 'balance', 
                MAX(d_date) AS 'processed_date' 
                FROM `deposit_history` 
                WHERE `t_team` = '$team') AS ql";
        $row = $this->db->query($sql)->row();
        return $row;
    }

    function addHistory($id, $ammount, $date, $rmks, $team, $writer)
    {
        //TODO: validation and insertion.
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

            /*
            $data = ['m_id' => $id, 't_team' => $team, 'd_category' => $type, 'd_rmks' => $rmks, 'd_ammount' => $ammount, 'd_date' => $date, 'd_processed_date' => time(), 'd_writer' => $writer];
            $result = $this->db->insert('deposit_history', $data);
            */

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

    function get_last_updated_date($team)
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

    function sqlToJson($team)
    {
        $result = $this->getAllDetails($team);
        $json = json_encode($result, JSON_UNESCAPED_UNICODE);
        return $json;
    }

}