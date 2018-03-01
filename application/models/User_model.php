<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_MODEL
{
    //TODO 이전의 기능들 중, core function 외에는 추후 작성 예정.
    // TODO DB를 통하여, 팀원 직급명 수정 가능하도록 설계하자.

    function __construct()
    {
        parent::__construct();
    }

    function getAll()
    {
        // TODO Get all of user info.
        $sql = "SELECT * FROM member";
        return $this->db->query($sql)->result();

    }

    function gets($team)
    {
        // 해당 Team의 user info를 all get.
        // pw는 제외.
        $sql = "SELECT m_id AS 'id', m_name AS 'name', t_team AS 'team', m_mobile AS 'mobile', m_mail AS 'e-mail', m_birthday AS 'birthday' FROM member WHERE t_team = '$team'";
        return $this->db->query($sql)->result();
        // TODO 해당 사용자가  '비공개'설정 가능하도록 만들자.


    }

    function getBy($column, $data)
    {
        /* Select * From ... Where '$column' = $data */
        if ($column == 'id')
            $col = 'm_id';
        else if ($column == 'name')
            $col = 'm_name';
        else if ($column == 'team')
            $col = 't_team';
        else if ($column == 'mobile')
            $col = 'm_mobile';
        else if ($column == 'email')
            $col = 'm_mail';
        else
            $col = '';
        $sql = "SELECT m_id AS 'id', m_name AS 'name', t_team AS 'team', m_mobile AS 'mobile', m_mail AS 'e-mail', m_birthday AS 'birthday' FROM member WHERE $col = '$data'";
        return $this->db->query($sql)->row();
    }

    function getPassword($id)
    {
        $sql = "SELECT m_password AS 'password' FROM member WHERE m_id='$id'";
        return $this->db->query($sql)->row()->password;
    }

    // TODO: 수정, 삭제, 추가, 등등의 기능.... 수정은, 검색해서 가져온 다음에(*를 SElect 하는 함수 사용) 그걸 바탕으로 파라메터를 넣어서, 그 중 수정할 것들을 수정하는 방식으로 함수 작성.


}