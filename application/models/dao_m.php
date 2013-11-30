<?php

class Dao_M extends CI_Model {

	/* --------------------------sidebar------------------------------ */
	public function getManufacturerList() {
		$query = "SELECT * FROM manufacturers";
		$result = $this->db->query($query);
		return $result->result_array();
	}

	public function getBridgeList() {
		$query = "SELECT * FROM bridges";
		$result = $this->db->query($query);
		return $result->result_array();
	}

	public function getPickupList() {
		$query = "SELECT * FROM pickups";
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

		$manufacturer = null;
		$bridge = null;
		$pickup = null;

		if (!$this->input->get("manufacturers") == "") {
			$manufacturer = $this->buildManufacturer();
		}

		if (!$this->input->get("pickups") == "") {
			$pickup = $this->buildPickup();
		}

		if (!$this->input->get("bridges") == "") {
			$bridge = $this->buildBridge();
		}

		return $this->masterQuery($manufacturer, $bridge, $pickup);
		// return masterQuery($manufacturer);

	}

	public function buildManufacturer() {
		$manufacturer = explode("|", $this->input->get("manufacturers"));
		$manufacturerJoin = "JOIN manufacturers as mnf ON mnf.manufacturer_id = guitars.manufacturer_id\n";
		$manufacturerWhere = "manufacturer_name = '" . $manufacturer[0] . "'";
		for ($i = 1; $i < sizeof($manufacturer); $i++) {
			$manufacturerWhere = $manufacturerWhere . " OR manufacturer_name = '" . $manufacturer[$i] ."'";
		}
		return array(
			'join' => $manufacturerJoin,
			'where' => $manufacturerWhere
		);
	}

	public function buildBridge() {
		$bridge = explode("|", $this->input->get("bridges"));
		$bridgeJoin = "JOIN bridges as bd ON bd.bridge_id = guitars.bridge_id\n";
		$bridgeWhere = "bridge_name = '" . $bridge[0] . "'";
		for ($i = 1; $i < sizeof($bridge); $i++) {
			$bridgeWhere = $bridgeWhere . " OR bridge_name = '" . $bridge[$i] ."'";
		}
		return array(
			'join' => $bridgeJoin,
			'where' => $bridgeWhere
		);
	}

	public function buildPickup() {
		$pickup = explode("|", $this->input->get("pickups"));
		$pickupJoin = "JOIN pickups as pu ON pu.pickup_id = guitars.pickup_id\n";
		$pickupWhere = "pickup_configuration = '" . $pickup[0] . "'";
		for ($i = 1; $i < sizeof($pickup); $i++) {
			$pickupWhere = $pickupWhere . " OR pickup_configuration = '" . $pickup[$i] ."'";
		}
		return array(
			'join' => $pickupJoin,
			'where' => $pickupWhere
		);
	}

	/* ---------------------------final query------------------------------ */
	public function masterQuery($manufactuerer, $bridge, $pickup) {
		$query = "SELECT * FROM guitars ";
		$join  = "";
		$where = "WHERE ";

		if (!empty($manufactuerer)) {
			$join = $join . $manufactuerer['join'];
			$where = $where . $manufactuerer['where'];
		}

		if (!empty($bridge)) {
			$join = $join . $bridge['join'];
			$where = $where . " AND " . $bridge['where'];
		}

		if (!empty($pickup)) {
			$join = $join . $pickup['join'];
			$where = $where . " AND " . $pickup['where'];
		}

		$query = $query . $join . $where;
		$result = $this->db->query($query);
		return $result->result_array();
	}

}

?>
