<?php

class Input extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('mydata_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
	}
	public function index() {

		$this->form_validation->set_rules('body_weight', 'BodyWeight', 'required');
		$this->form_validation->set_rules('body_fat_per', 'BodyFatPercentage', 'required');
		if ($this->form_validation->run() === FALSE) {
			$data['title']="Input Bodydata";
			$this->load->view('header', $data);
			$data['nowtime']=date('Y/m/d H:i:s');
			$this->load->view('input_index', $data);
			$this->load->view('footer');
		}
		else {
                	$data = array(
                        	'body_weight' => $this->input->post('body_weight'),
                        	'body_fat_per' => $this->input->post('body_fat_per'),
                        	'entry_date' => date("Y-m-d H:i:s"),
                	);
			$this->mydata_model->set_input($data);
			$data['title']="Input Result";
			$this->load->view('header', $data);
			$this->load->view('input_success');
			$this->load->view('footer');
		}
	}
}
