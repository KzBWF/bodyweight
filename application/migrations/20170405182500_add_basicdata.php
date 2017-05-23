<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_basicdata extends CI_Migration {
	public function up() {
		$this->dbforge->add_field(array(
			'user_id'	=>	array(
				'type'			=>	'INT',
				'unsigned'		=>	TRUE,
				'auto_increment'	=>	TRUE,
			),
			'height'	=>	array(
				'type'			=>	'FLOAT',
			),
			'name'		=>	array(
				'type'			=>	'VARCHAR',
				'constraint'		=>	'255',	
			),
			'age'	=>	array(
				'type'			=>	'INT',
				'unsigned'		=>	TRUE,
			),
			'gender'	=>	array(
				'type'			=>	'TINYINT',
				'unsigned'		=>	TRUE,
			),
			'entry_date'	=> 	array(
				'type'			=>	'TIMESTAMP',
			),
		));
		$this->dbforge->add_key('user_id', TRUE);
		$this->dbforge->create_table('basicdata');
	}
	public function down() {
		$this->dbforge->drop_table('basicdata');
	}
}
