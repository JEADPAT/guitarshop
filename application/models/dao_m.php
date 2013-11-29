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

}

?>
