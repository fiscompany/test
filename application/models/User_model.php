<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
	  
  	public $id;
    public $name;
    public $email;
    public $password;

	public function getUserInfo($email,$password)
    {
		$this->db->where("email",$email)
                    ->where("password",$password);
		$results=$this->db->get("users");
		return $results->result();
	}

}