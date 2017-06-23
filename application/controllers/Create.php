<?php

class Create extends CI_Controller {
        public function __construct() {
                parent::__construct();
                $this->load->model('mydata_model');
                $this->load->helper('form');
                $this->load->library('form_validation');
        }
        public function index() {
                $this->form_validation->set_rules('date_time', 'DateTime', 'required');
                $this->form_validation->set_rules('body_weight', 'BodyWeight', 'required');
                $this->form_validation->set_rules('body_fat_per', 'BodyFatPercentage', 'required');
                if ($this->form_validation->run() === FALSE) {
                        $data['title']="Create Bodydata";
                        $this->load->view('header', $data);
                        $data['nowtime']=date('Y-m-d\TH:i');
                        $this->load->view('create_index', $data);
                        $this->load->view('footer');
                }
                else {
                	$date_time = str_replace("T"," ", $this->input->post('date_time')).":00";
                	$data = array(
                        	'body_weight' => $this->input->post('body_weight'),
                        	'body_fat_per' => $this->input->post('body_fat_per'),
                        	'entry_date' => $date_time,
                	);
                        $data['result']=$this->mydata_model->create_input($data);
                        $data['title']="Create Result";
                        $this->load->view('header', $data);
                        $this->load->view('create_success', $data);
                        $this->load->view('footer');
                }
        }
}
