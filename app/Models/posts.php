<?php 

namespace Models;

use Models\DB;

class posts extends DB {
	public $table;
	function __construct(){
		parent::__construct();
		$this->table = $this->db_connect();
	}

	protected $campos = ['userId', 'title', 'body'];
	
	public $valores = [];
}