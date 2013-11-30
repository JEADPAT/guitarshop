<?php

class Ajax_C extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('dao_m');
	}

	public function findByManufacturers()	{
		echo json_encode($this->dao_m->getGuitarByManufacturer());
	}

	public function findGuitars() {
		echo json_encode($this->dao_m->callBuilder());
		// echo $this->dao_m->callBuilder();
	}
	
}

?>
