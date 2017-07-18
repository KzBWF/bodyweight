<?php
// pChart
require 'vendor/autoload.php';

class Display extends CI_Controller {
	private $year;	
	private $month;	
	private $day;	
	
	public function __construct() {
		parent::__construct();
		$this->load->model('mydata_model');
		$this->load->helper('date'); //for mdate()
	}
	
	public function index() {
		$data['title']="Display Bodydata";
		$this->load->view('header', $data);

		$offset=$this->input->get('offset', FALSE);
		if ($offset == NULL) {
			$offset=0;
		}
		$data['prev']=$offset+1;
		$data['offset']=$offset;
		$disp_time=strtotime("-".$offset." day", time());
		$this->year=mdate("%Y", $disp_time);
		$this->month=mdate("%m", $disp_time);
		$this->day=mdate("%d", $disp_time);
		$data['set_date']=sprintf("%d-%02d-%02d", $this->year, $this->month, $this->day);
		$this->load->view('disp_sub_left',$data);
		$this->load->view('disp_sub_date',$data);
		if($offset!=0) {
			$data['next']=$offset-1;
			$this->load->view('disp_sub_right',$data);
		}

		// Load Body Data
		$query=$this->mydata_model->get_data($data['set_date']);	
		if( ($data['body_data']=$query->result('object')) == NULL ) {
			$obj=new stdClass();
			$obj->body_weight = 0;
			$obj->body_fat_per = 0;
			$obj->entry_date = date("Y-m-d H:i:s");
			$arr=array($obj);
			$data['body_data']=$arr;
		}
		$datas=$data['body_data'];

		// @pChart
                $myData=new pData();
		$wei=array();
		$fat=array();
		$day=array();
		$dat_cnt=0;
		foreach( $datas as $da ) {
			array_push($wei,$da->body_weight);
			array_push($fat,$da->body_fat_per);
			$tmp=date("m/d", strtotime($da->entry_date));
			array_push($day,$tmp);
			$dat_cnt++;
		}
                $myData->addPoints($wei, "weight", "Body Weight");
                $myData->addPoints($fat, "fat_per", "Body Fat Percent");
                $myData->addPoints($day, "ent_day", "Registraion date");
		$myData->setAbscissa("ent_day");
		$myData->setSerieOnAxis("weight",0);
		$myData->setSerieOnAxis("fat_per",1);
		$myData->setAxisPosition(1,AXIS_POSITION_RIGHT);

		$myCache=new pCache();
		$ChartHash=$myCache->getHash($myData);

		if($myCache->isInCache($ChartHash)) {
			$myCache->saveFromCache($ChartHash, "basic.png");
		}
		else {
			$adwidth=0;
			if ($dat_cnt > 10) {
				$adwidth = 46*($dat_cnt-10);
			}

                	$myPicture=new pImage(500+$adwidth,300,$myData);
                	$myPicture->setFontProperties(array("FontName"=>"/var/www/html/codeig/vendor/dmelo/pchart/library/fonts/Forgotte.ttf","FontSize"=>11));
                	$myPicture->setGraphArea(40,10,460+$adwidth,280);
                	$myPicture->drawScale();
                	$myPicture->drawLineChart(array("DisplayValues"=>TRUE,"DisplayColor"=>DISPLAY_AUTO));

			$myCache->writeToCache($ChartHash, $myPicture);

                	$myPicture->Render("basic.png");
                	//$myPicture->Stroke();
		}

		$this->load->view('display_index',$data);
		$this->load->view('footer');
	}
}
