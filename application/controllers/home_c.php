<?php

class Home_C extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('dao_m');
	}

	public function index() {

		$data = array(
			'manufacturers' => $this->dao_m->getManufacturerList()
		);

		$this->load->view('templates/header');
		$this->load->view('home_v', $data);
		$this->load->view('templates/footer');

	}

}

?>
