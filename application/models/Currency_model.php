<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Currency_model extends CI_Model {

	public function getCurrency()
    {
		$results=$this->db->get("c_currencies");
		return $results->result();
	}
}