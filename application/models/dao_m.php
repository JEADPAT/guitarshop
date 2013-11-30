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

	/* --------------------------sidebar------------------------------ */
	public function getAllGuitar() {
		$query = "SELECT * FROM guitars JOIN manufacturers as mnf ON mnf.manufacturer_id = guitars.manufacturer_id";
		$result = $this->db->query($query);
		return $result->result_array();
	}

	/* ---------------------------query builder------------------------------ */
	public function callBuilder() {

		$manufacturer = null;
		$bridge = null;
		$pickup = null;
		$price = null;

		if (!$this->input->get("manufacturers") == "") {
			$manufacturer = $this->buildManufacturer();
		}

		if (!$this->input->get("pickups") == "") {
			$pickup = $this->buildPickup();
		}

		if (!$this->input->get("bridges") == "") {
			$bridge = $this->buildBridge();
		}

		if (!$this->input->get("priceranges") == "") {
			$price = $this->buildPriceRange();
		}

		return $this->masterQuery($manufacturer, $bridge, $pickup, $price);
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
		$bridgeWhere = "bridge_type = '" . $bridge[0] . "'";
		for ($i = 1; $i < sizeof($bridge); $i++) {
			$bridgeWhere = $bridgeWhere . " OR bridge_type = '" . $bridge[$i] ."'";
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

	public function buildPriceRange() {
		$price = explode("|", $this->input->get("priceranges"));
		$range = explode("-", $price[0]);
		$priceJoin = "";
		$priceWhere = "price BETWEEN " . $range[0] . " AND " . $range[1];
		for ($i = 1; $i < sizeof($price); $i++) {
			$range = explode("-", $price[$i]);
			$priceWhere = $priceWhere . " OR price BETWEEN " . $range[0] ." AND " . $range[1];
		}
		return array(
			'join' => $priceJoin,
			'where' => $priceWhere
		);
	}

	/* ---------------------------final query------------------------------ */
	public function masterQuery($manufactuerer, $bridge, $pickup, $price) {
		$query = "SELECT * FROM guitars ";
		$join  = "JOIN manufacturers as mnf ON mnf.manufacturer_id = guitars.manufacturer_id\n";
		$where = "WHERE ";
		$whereChecker = false;

		if (!empty($manufactuerer)) {
			// $join = $join . $manufactuerer['join'];
			$where = $where . $manufactuerer['where'];
			$whereChecker = true;
		}

		if (!empty($bridge)) {
			$join = $join . $bridge['join'];
			if ($whereChecker)
				$where = $where . " AND " . $bridge['where'];
			else
				$where = $where . $bridge['where'];	
			$whereChecker = true;
		}

		if (!empty($pickup)) {
			$join = $join . $pickup['join'];
			if ($whereChecker)
				$where = $where . " AND " . $pickup['where'];
			else
				$where = $where . $pickup['where'];
			$whereChecker = true;
		}

		if (!empty($price)) {
			if ($whereChecker)
				$where = $where . " AND " . $price['where'];
			else
				$where = $where . $price['where'];
			$whereChecker = true;
		}

		if ($whereChecker) {
			$query = $query . $join . $where;
			$result = $this->db->query($query);
			return $result->result_array();
		}
		else
			return null;
	}

}

?>
