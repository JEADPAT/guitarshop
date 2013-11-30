<?php

class Dao_M extends CI_Model {

	/* --------------------------sidebar------------------------------ */
	public function getManufacturerList() {
		$query = "SELECT * FROM manufacturers";
		$result = $this->db->query($query);
		return $result->result_array();
	}

	/* ---------------------------guitar------------------------------ */
	public function getGuitarByManufacturer() {
		$manufacturers = $this->input->get("manufacturers");
		$manufacturer = explode("|", $manufacturers);
		$condition = "'" . $manufacturer[0] . "'";
		for ($i = 1; $i < sizeof($manufacturer) ; $i++) { 
			$condition = $condition . " OR manufacturer_name = '" . $manufacturer[$i] . "'";
		}
		$query = "SELECT * FROM guitars JOIN manufacturers as m ON m.manufacturer_id = guitars.manufacturer_id WHERE manufacturer_name = " . $condition;
		$result = $this->db->query($query);
		return $result->result_array();
	}

	/* ---------------------------query builder------------------------------ */
	public function callBuilder() {

		$manufacturerWhere = "";

		if (!is_null($this->input->get("manufacturers"))) {
			$manufacturerWhere = $this->buildManufacturer();
		}

		return masterQuery($manufacturerWhere);

	}

	public function buildManufacturer() {
		$manufacturer = explode("|", $this->input->get("manufacturers"));
		$manufacturerWhere = "manufacturer_name = '" . $manufacturer[0] . "'";
		$manufacturerJoin = "JOIN manufacturers as manu ON manu.manufacturer_id = manufacturer_id";
		for ($i = 1; $i < sizeof($manufacturer); $i++) {
			$manufacturerWhere = $manufacturerWhere . " OR manufacturer_name = '" . $manufacturer[$i] ."'";
		}
		return array(
			'join' => $manufacturerJoin,
			'where' => $manufacturerWhere
		);
	}

	/* ---------------------------final query------------------------------ */
	public function masterQuery($manufactuerer) {
		return "FUCK YOU BITCH";
	}

	public function queryGuitar() {
		$query = "SELECT * FROM guitars";
		$result = $this->db->query($query);
		return $result->result_array();
	}

}

?>
