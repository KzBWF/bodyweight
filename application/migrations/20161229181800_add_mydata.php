<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_mydata extends CI_Migration {
	public function up() {
		$this->dbforge->add_field(array(
			'entry_date' 	=> array(
				'type'		=>	'TIMESTAMP',
			),
			'body_weight'	=>	array(
				'type'		=>	'FLOAT',
//				'constraint'	=>	'',
//				'unsigned'	=>	TRUE,
			),
			'body_fat_per'		=>	array(
				'type'		=>	'FLOAT',
//				'constraint'	=>	'',
//				'unsigned'	=>	TRUE,
			),
			'height'		=>	array(
				'type'		=>	'FLOAT',
//				'constraint'	=>	'',
//				'unsigned'	=>	TRUE,
			),
		));
		$this->dbforge->add_key('entry_date', TRUE);
		$this->dbforge->create_table('mydata');
	}
	public function down() {
		$this->dbforge->drop_table('mydata');
	}
}
