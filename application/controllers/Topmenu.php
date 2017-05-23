<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topmenu extends CI_Controller {
	public function index() {
		$data['title']="Top Menu";
		$this->load->view('header', $data);
		$this->load->view('topmenu');
		$this->load->view('footer');
	}
}
