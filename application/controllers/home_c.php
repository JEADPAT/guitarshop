<?php

class Home_C extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('dao_m');
	}

	public function index() {

		$data = array(
			'manufacturers' => $this->dao_m->getManufacturerList(),
			'bridges' => $this->dao_m->getBridgeList(),
			'pickups' => $this->dao_m->getPickupList(),
			'guitars' => $this->dao_m->getAllGuitar(),
			'frets' => $this->dao_m->getNumberOfFretList(),
			'madeins' => $this->dao_m->getMadeInList(),
			'strings' => $this->dao_m->getNumberOfString()
		);

		$this->load->view('templates/header');
		$this->load->view('home_v', $data);
		$this->load->view('templates/footer');

	}

	public function about() {
		$this->load->view('templates/header');
		$this->load->view('about_v');
		$this->load->view('templates/footer');
	}

	public function getGuitars() {
		$this->output->set_content_type('application/json');
		return json_encode($this->dao_m->queryGuitar());
	}

}

?>
