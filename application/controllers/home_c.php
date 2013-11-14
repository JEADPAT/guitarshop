<?php

class Home_C extends CI_Controller {

	public function index() {
		$this->load->view('templates/header');
		$this->load->view('home_v');
		$this->load->view('templates/footer');
	}

}

?>
