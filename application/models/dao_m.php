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

	public function getNumberOfFretList() {
		$query = "SELECT number_of_fret FROM guitarshop.fretboards GROUP BY number_of_fret";
		$result = $this->db->query($query);
		return $result->result_array();
	}

	public function getMadeInList() {
		$query = "SELECT DISTINCT made_in FROM guitarshop.guitars ORDER BY made_in";
		$result = $this->db->query($query);
		return $result->result_array();
	}

	public function getNumberOfString() {
		$query = "SELECT DISTINCT number_of_string FROM guitarshop.guitars ORDER BY number_of_string";
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

		$bridge = null;
		$madein = null;
		$manufacturer = null;
		$number_of_fret = null;
		$number_of_string = null;
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

		if (!$this->input->get("madeins") == "") {
			$madein = $this->buildMadeIn();
		}

		if (!$this->input->get("frets") == "") {
			$number_of_fret = $this->buildFret();
		}

		if (!$this->input->get("strings") == "") {
			$number_of_string = $this->buildString();
		}

		return $this->masterQuery($manufacturer, $bridge, $pickup, $price, $madein, $number_of_fret, $number_of_string);
		// return masterQuery($manufacturer);

	}

	public function buildManufacturer() {
		$manufacturer = explode("|", $this->input->get("manufacturers"));
		$manufacturerJoin = "JOIN manufacturers as mnf ON mnf.manufacturer_id = guitars.manufacturer_id\n";
		$manufacturerWhere = "(manufacturer_name = '" . $manufacturer[0] . "'";
		for ($i = 1; $i < sizeof($manufacturer); $i++) {
			$manufacturerWhere = $manufacturerWhere . " OR manufacturer_name = '" . $manufacturer[$i] ."'";
		}
		$manufacturerWhere = $manufacturerWhere . ")";
		return array(
			'join' => $manufacturerJoin,
			'where' => $manufacturerWhere
		);
	}

	public function buildBridge() {
		$bridge = explode("|", $this->input->get("bridges"));
		$bridgeJoin = "JOIN bridges as bd ON bd.bridge_id = guitars.bridge_id\n";
		$bridgeWhere = "(bridge_type = '" . $bridge[0] . "'";
		for ($i = 1; $i < sizeof($bridge); $i++) {
			$bridgeWhere = $bridgeWhere . " OR bridge_type = '" . $bridge[$i] ."'";
		}
		$bridgeWhere = $bridgeWhere . ")";
		return array(
			'join' => $bridgeJoin,
			'where' => $bridgeWhere
		);
	}

	public function buildPickup() {
		$pickup = explode("|", $this->input->get("pickups"));
		$pickupJoin = "JOIN pickups as pu ON pu.pickup_id = guitars.pickup_id\n";
		$pickupWhere = "(pickup_configuration = '" . $pickup[0] . "'";
		for ($i = 1; $i < sizeof($pickup); $i++) {
			$pickupWhere = $pickupWhere . " OR pickup_configuration = '" . $pickup[$i] ."'";
		}
		$pickupWhere = $pickupWhere . ")";
		return array(
			'join' => $pickupJoin,
			'where' => $pickupWhere
		);
	}

	public function buildMadeIn() {
		$madein = explode("|", $this->input->get("madeins"));
		$madeinJoin = "";
		$madeinWhere = "(made_in = '" . $madein[0] . "'";
		for ($i = 1; $i < sizeof($madein); $i++) {
			$madeinWhere = $madeinWhere . " OR made_in = '" . $madein[$i] ."'";
		}
		$madeinWhere = $madeinWhere . ")";
		return array(
			'join' => $madeinJoin,
			'where' => $madeinWhere
		);
	}

	public function buildFret() {
		$fret = explode("|", $this->input->get("frets"));
		$fretJoin = "JOIN necks as n ON n.neck_id = guitars.neck_id \nJOIN fretboards as f ON f.fretboard_id = n.fretboard_id\n";
		$fretWhere = "(f.number_of_fret = '" . $fret[0] . "'";
		for ($i = 1; $i < sizeof($fret); $i++) {
			$fretWhere = $fretWhere . " OR f.number_of_fret = '" . $fret[$i] ."'";
		}
		$fretWhere = $fretWhere . ")";
		return array(
			'join' => $fretJoin,
			'where' => $fretWhere
		);
	}

	public function buildString() {
		$string = explode("|", $this->input->get("strings"));
		$stringJoin = "";
		$stringWhere = "(number_of_string = '" . $string[0] . "'";
		for ($i = 1; $i < sizeof($string); $i++) {
			$stringWhere = $stringWhere . " OR number_of_string = '" . $string[$i] ."'";
		}
		$stringWhere = $stringWhere . ")";
		return array(
			'join' => $stringJoin,
			'where' => $stringWhere
		);
	}

	public function buildPriceRange() {
		$price = explode("|", $this->input->get("priceranges"));
		$range = explode("-", $price[0]);
		$priceJoin = "";
		$priceWhere = "(price BETWEEN " . $range[0] . " AND " . $range[1];
		for ($i = 1; $i < sizeof($price); $i++) {
			$range = explode("-", $price[$i]);
			$priceWhere = $priceWhere . " OR price BETWEEN " . $range[0] ." AND " . $range[1];
		}
		$priceWhere = $priceWhere . ")";
		return array(
			'join' => $priceJoin,
			'where' => $priceWhere
		);
	}

	/* ---------------------------final query------------------------------ */
	public function masterQuery($manufactuerer, $bridge, $pickup, $price, $madein, $number_of_fret, $number_of_string) {
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

		if (!empty($madein)) {
			if ($whereChecker)
				$where = $where . " AND " . $madein['where'];
			else
				$where = $where . $madein['where'];
			$whereChecker = true;
		}

		if (!empty($number_of_fret)) {
			$join = $join . $number_of_fret['join'];
			if ($whereChecker)
				$where = $where . " AND " . $number_of_fret['where'];
			else
				$where = $where . $number_of_fret['where'];
			$whereChecker = true;
		}

		if (!empty($number_of_string)) {
			if ($whereChecker)
				$where = $where . " AND " . $number_of_string['where'];
			else
				$where = $where . $number_of_string['where'];
			$whereChecker = true;
		}

		if ($whereChecker) {
			if ($this->input->get("sort_type") == 1) {
				$query = $query . $join . $where . "ORDER BY mnf.manufacturer_name ASC";
				$result = $this->db->query($query);
			}
			else if ($this->input->get("sort_type") == 2) {
				$query = $query . $join . $where . "ORDER BY mnf.manufacturer_name DESC";
				$result = $this->db->query($query);
			}
			else if ($this->input->get("sort_type") == 3) {
				$query = $query . $join . $where . "ORDER BY guitars.price DESC";
				$result = $this->db->query($query);
			}
			else if ($this->input->get("sort_type") == 4) {
				$query = $query . $join . $where . "ORDER BY guitars.price ASC";
				$result = $this->db->query($query);
			}
			return $result->result_array();
			// return array(
			// 	'result' => $result->result_array(),
			// 	'query' => $query
			// );
		}
		else
			return null;
	}

	public function queryGuitar() {
		$id = $this->input->get("id");
		$query = 	"SELECT model_name, number_of_string, made_in, manufacturer_name, price, neck_shape, bridge_type, pickup_configuration, body_shape, bridge_type, number_of_fret, nw.wood_name as neck_wood_name, fw.wood_name as fretboard_wood_name, bw.wood_name as body_wood_name FROM guitars
					 JOIN necks as n ON n.neck_id = guitars.neck_id
					 JOIN bridges as b ON b.bridge_id = guitars.bridge_id
					 JOIN pickups as p ON p.pickup_id = guitars.pickup_id
					 JOIN manufacturers as m on m.manufacturer_id = guitars.manufacturer_id
					 JOIN bodies as bd ON bd.body_id = guitars.body_id
					 JOIN fretboards as f ON f.fretboard_id = n.fretboard_id
					 JOIN woods as nw ON nw.wood_id = n.wood_id
					 JOIN woods as bw ON bw.wood_id = bd.wood_id
					 JOIN woods as fw ON fw.wood_id = f.wood_id
					 WHERE guitar_id = " . $id;
		$result = $this->db->query($query);
		return $result->result_array();
	}


	/* --------------------------realtime query------------------------------ */
	public function getQuery() {
		$bridge = null;
		$madein = null;
		$manufacturer = null;
		$number_of_fret = null;
		$number_of_string = null;
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

		if (!$this->input->get("madeins") == "") {
			$madein = $this->buildMadeIn();
		}

		if (!$this->input->get("frets") == "") {
			$number_of_fret = $this->buildFret();
		}

		if (!$this->input->get("strings") == "") {
			$number_of_string = $this->buildString();
		}

		return $this->makeQuery($manufacturer, $bridge, $pickup, $price, $madein, $number_of_fret, $number_of_string);
	}

	public function makeQuery($manufactuerer, $bridge, $pickup, $price, $madein, $number_of_fret, $number_of_string) {
		$query = "SELECT * FROM guitars ";
		$join  = "<br>JOIN manufacturers as mnf ON mnf.manufacturer_id = guitars.manufacturer_id";
		$where = "<br>WHERE ";
		$whereChecker = false;

		if (!empty($manufactuerer)) {
			// $join = $join . $manufactuerer['join'];
			$where = $where . $manufactuerer['where'];
			$whereChecker = true;
		}

		if (!empty($bridge)) {
			$join = $join . $bridge['join'];
			if ($whereChecker)
				$where = $where . "<br>AND " . $bridge['where'];
			else
				$where = $where . $bridge['where'];	
			$whereChecker = true;
		}

		if (!empty($pickup)) {
			$join = $join . $pickup['join'];
			if ($whereChecker)
				$where = $where . "<br>AND " . $pickup['where'];
			else
				$where = $where . $pickup['where'];
			$whereChecker = true;
		}

		if (!empty($price)) {
			if ($whereChecker)
				$where = $where . "<br>AND " . $price['where'];
			else
				$where = $where . $price['where'];
			$whereChecker = true;
		}

		if (!empty($madein)) {
			if ($whereChecker)
				$where = $where . "<br>AND " . $madein['where'];
			else
				$where = $where . $madein['where'];
			$whereChecker = true;
		}

		if (!empty($number_of_fret)) {
			$join = $join . $number_of_fret['join'];
			if ($whereChecker)
				$where = $where . "<br>AND " . $number_of_fret['where'];
			else
				$where = $where . $number_of_fret['where'];
			$whereChecker = true;
		}

		if (!empty($number_of_string)) {
			if ($whereChecker)
				$where = $where . "<br>AND " . $number_of_string['where'];
			else
				$where = $where . $number_of_string['where'];
			$whereChecker = true;
		}

		if ($whereChecker) {
			if ($this->input->get("sort_type") == 1) {
				$query = $query . $join . $where . "<br>ORDER BY mnf.manufacturer_name ASC";
				// $result = $this->db->query($query);
			}
			else if ($this->input->get("sort_type") == 2) {
				$query = $query . $join . $where . "<br>ORDER BY mnf.manufacturer_name DESC";
				// $result = $this->db->query($query);
			}
			else if ($this->input->get("sort_type") == 3) {
				$query = $query . $join . $where . "<br>ORDER BY guitars.price DESC";
				// $result = $this->db->query($query);
			}
			else if ($this->input->get("sort_type") == 4) {
				$query = $query . $join . $where . "<br>ORDER BY guitars.price ASC";
				// $result = $this->db->query($query);
			}
			str_replace("\n", "<br>", $query);
			return $query;
		}
		else
			return null;
	}

}

?>
