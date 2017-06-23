<?php

class Mydata_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	public function create_input($data) {
		return $this->db->insert('mydata', $data);
	}
	public function set_input($data) {
		return $this->db->insert('mydata', $data);
	}
	public function up_input($data, $entdate) {
		$this->db->where('entry_date', $entdate);
		return $this->db->update('mydata', $data);
	}
        public function get_data($date) {
		if ($date == "ALL") {
			$sql='select * from mydata';
		}
		else {
			$todate=date("Y-m-d");
			$sql='select * from mydata where \''.$date.' 00:00:00\' <= entry_date and entry_date <= \''.$todate.' 23:59:59\'';
		}
                $query=$this->db->query($sql);
                return $query;
        }
	public function get_data_pos($pos, $counts) {
		//@ $last=$pos+$counts;
		$last=$counts;
		$sql='select * from mydata order by entry_date desc limit '.$pos.', '.$last;
		$query=$this->db->query($sql);
		return $query;
	}
	public function del_data($date) {
		$this->db->where('entry_date', $date);
		return $this->db->delete('mydata');
	}
}
