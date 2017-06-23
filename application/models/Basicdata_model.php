<?php

class Basicdata_model extends CI_Model {
	public function __construct() {
		$this->load->database();// connect to database
	}
	public function set($data) {
		return $this->db->insert('basicdata', $data);
	}
	public function up($data, $id) {
		$this->db->where('user_id', $id);
		return $this->db->update('basicdata', $data);
	}
        public function get() {// read to all data 
		$sql='select * from basicdata';
                $query=$this->db->query($sql);
                return $query;
        }
}
