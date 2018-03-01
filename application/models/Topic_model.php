<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');


class Topic_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function gets()
    {
        return $this->db->query("SELECT * FROM topic")->result();
    }

    function get($topic_id)
    {
        $this->db->select('id');
        $this->db->select('title');
        $this->db->select('description');
        $this->db->select('UNIX_TIMESTAMP(created) As created');
        return $this->db->get_where('topic', array('id' => $topic_id))->row();
    }

    function add($title, $description)
    {
        $this->db->set('created', 'NOW()', false);
        $this->db->set('title', $title, true);
        $this->db->set('description', $description, true);
        $this->db->insert('topic');

        return $this->db->insert_id();
    }
}