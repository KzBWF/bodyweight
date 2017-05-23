<?php

class Basic extends CI_Controller {
	private $result;
	public function __construct() {
		parent::__construct();
		$this->load->model('basicdata_model');// connect database
		$this->load->helper('form');
		$this->load->library('form_validation');
		$query=$this->basicdata_model->get();
		$this->result=$query->result('object');
	}
	public function index() {
		// validation rules
		$this->form_validation->set_rules('height', 'Height', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('age', 'Age', 'required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		if ($this->form_validation->run() === FALSE) {
			$data['title']="Basic Info";
			$this->load->view('header', $data);
			//
			if ($this->result == NULL ) {
				$data['name']='';
				$data['age']='';
				$data['gender']='';
				$data['height']='';
				$data['user_id']='';
				$data['btntext']='Entry';
			}
			else {
				foreach ($this->result as $r) {
					$data['name']=$r->name;
					$data['age']=$r->age;
					$data['gender']=$r->gender;
					$data['height']=$r->height;
					$data['user_id']=$r->user_id;
				}
				$data['btntext']='Update';
			}
			$this->load->view('basic_index', $data);
			$this->load->view('footer');
		}
		else {
			if ($this->result == NULL) {
				$this->basicdata_model->set();
			}
			else {
				$this->basicdata_model->up();
			}
			$data['title']="Basic Info Result";
			$this->load->view('header', $data);
			$this->load->view('basic_success');
			$this->load->view('footer');
		}
	}
}
