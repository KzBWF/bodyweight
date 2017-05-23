<?php

class Basicdata_model extends CI_Model {
	public function __construct() {
		$this->load->database();// connect to database
	}
	public function set() {
		$data = array(
			'height' => $this->input->post('height'),
			'name'   => $this->input->post('name'),
			'age'    => $this->input->post('age'),
			'gender' => $this->input->post('gender'),
			'entry_date' => date("Y-m-d H:i:s"),
		);
		return $this->db->insert('basicdata', $data);
	}
	public function up() {
		$data = array(
			'height' => $this->input->post('height'),
			'name'   => $this->input->post('name'),
			'age'    => $this->input->post('age'),
			'gender' => $this->input->post('gender'),
			'entry_date' => date("Y-m-d H:i:s"),
		);
		$this->db->where('user_id', $this->input->post('user_id'));
		return $this->db->update('basicdata', $data);
	}
        public function get() {// read to all data 
		$sql='select * from basicdata';
                $query=$this->db->query($sql);
                return $query;
        }
}
