<?php

class Ajax_C extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('dao_m');
	}

	public function findByManufacturers()	{
		// $manufacturers = $this->input->get("manufacturers");
		// $manufacturer = explode("|", $manufacturers);
		// echo json_encode($manufacturer);
		// echo $this->dao_m->getGuitarByManufacturer();
		echo json_encode($this->dao_m->getGuitarByManufacturer());
	}

	public function test() {
		echo $this->dao_m->callBuilder();
	}
	
}

?>
