<?php

class Modify extends CI_Controller {
	private $pos;
	private $counts;
	private $max;
	public function __construct() {
		parent::__construct();
		$this->load->model('mydata_model');
		$this->load->library('form_validation');
		$this->pos=0;
		$this->counts=5;
		$this->max=$this->db->count_all('mydata');
	}
	public function index() {
		$this->form_validation->set_rules('body_weight', 'BodyWeight', 'required');
		$this->form_validation->set_rules('body_fat_per', 'BodyFatPercentage', 'required');
                if ($this->form_validation->run() === FALSE) {
                	// Title
                	$data['title']="Modify Bodydata";
                	$this->load->view('header', $data);

			if (($next=$this->input->get('next', FALSE))!=NULL) {
				$this->pos=$next+$this->counts;
			}
			else if (($prev=$this->input->get('prev', FALSE))!=NULL) {
				$this->pos=$prev-$this->counts;
			}

			$data['pos']=$this->pos;
			if (($this->pos+$this->counts) < $this->max) {
                        	$this->load->view('modify_sub_left', $data);
			}
			else {
                        	$this->load->view('modify_dum_left');
			}
			if ($this->pos != 0) {
                        	$this->load->view('modify_sub_right', $data);
			}
			else {
                        	$this->load->view('modify_dum_right');
			}

                	// Load all data
                	//$query=$this->mydata_model->get_data("ALL");
			// Load data
                	$query=$this->mydata_model->get_data_pos($this->pos, $this->counts);
                	$objarr=$query->result('object');
			$data['body_data']=$objarr;

                        $this->load->view('modify_index', $data);
                        $this->load->view('footer');
		}
		else {
			// Title
                     	$data['title']="Modify Success";
        		$this->load->view('header', $data);

			// Update Mydata
			$data['result']=$this->mydata_model->up_input();
			$data['body_weight']=$this->input->post('body_weight');
			$data['body_fat_per']=$this->input->post('body_fat_per');
			$data['entry_date']=$this->input->post('entry_date');

                        $this->load->view('modify_success', $data);
                        $this->load->view('footer');
		}
	}
}
