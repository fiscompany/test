<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {
	  
  	public $id_no;
    public $name_ar;
    public $name_en;
    public $mobile;
    public $file_name;

    public function getCustomers($limit = null)
    {
        if ($limit != null) {
            $this->db->limit($limit);
        }
        $results=$this->db->get("customers");
        return $results->result();
    }

	public function getCustomerInfo($customer_id)
    {
		$this->db->where("id_no",$customer_id);
		$results=$this->db->get("customers");
		return $results->result();
	}

    public function getCustomerByname($customer_name)
    {
        $this->db->where("name_ar",$customer_name);
        $results=$this->db->get("customers");
        return $results->result();
    }

    public function getCustomerByid($id)
    {
        $this->db->select('`id`, `id_no`, `name_ar`, `name_en`, `mobile`, `file_name`, `created_at`, `updated_at`');
        $this->db->where("id",$id);
        $results=$this->db->get("customers");
        return $results->result();
    }

	public function newCustomer($id_no, $name_ar, $name_en, $mobile, $file_name)
    {
    	$this->id_no = $id_no;
    	$this->name_ar = $name_ar;
    	$this->name_en = $name_en;
    	$this->mobile = $mobile;
    	$this->file_name = $file_name; 
		$results = $this->db->insert('customers', $this);;
		return $results;
	}

    public function updateCustomer($id, $id_no, $name_ar, $name_en, $mobile, $file_name)
    {
        $this->db->where("id", $id);
        $data = array('id_no' => $id_no, 'name_ar' => $name_ar, 'name_en' => $name_en, 'mobile' => $mobile, 'file_name' => $file_name);  
        $results = $this->db->update('customers', $data);
        return $results;
    }

    public function deleteCustomer($id)
    {
        $this->db->where("id", $id);
        $results = $this->db->delete('customers');
        return $results;
    }
    
    public function Update($data,$id)
	{
		$this->db->where("id",$id);
		$this->db->update('customers',$data);
	}
    
    public function IsExistsForUpdate($column ,$value , $id)
	{		
		$this->db->where($column,$value);
        $this->db->where('id !=',$id); 
		return $this->db->count_all_results('customers')>0;
	}
    
    public function IsExists($column ,$value)
	{		
		$this->db->where($column,$value);
		return $this->db->count_all_results('customers')>0;
	}
    
    public function Add($data)
	{
		$this->db->insert('customers',$data);
        $lastid = $this->db->insert_id();
		return $lastid;
	}
    
    public function Search($id_no ,$name_ar ,$name_en ,$mobile){
        if ($id_no != '') {
            $this->db->where('id_no like ',"$id_no%");
        }
        if ($name_ar != '') {
            $name_ar_new = $this->filter_String($name_ar);
            $this->db->where("(name_ar REGEXP '".$name_ar_new."')");
        }
        if ($name_en != '') {
            $this->db->where('name_en like ',"%$name_en%");
        }
        if ($mobile != '') {
            $this->db->where('mobile like ',"%$mobile%");
        }
        
        $this->db->select('*');
		$this->db->order_by('id');
		$results = $this->db->get('customers');
		return $results->result();
    }
	
	
	public function filter_String ($text_string = null){
		$filter_replace = array(
			'/^ال/'   =>   '(ال)',
			'/ة|ه|ة|ه$/'    =>   '(ة|ه)',
			'/(ة|ت|ة|ت|ة|ت)$/'     =>   '(ة|ت)',
			'/(و|ؤ|و|ؤ)$/'     =>   '(و|ؤ)',
			'/و|ؤ|و|ؤ$/'     =>   '(و|ؤ)',
			'/ى|ي|ى|ي$/'     =>   '(ى|ي)',
			'/(ى|ي|ى|ي)$/'   =>   '(ى|ي)',
			'/(ا|ى|ا|ى)$/'    =>   '(ا|ى)',
			'/ئ|ىء|ؤ|وء|ء|ئ|ىء|ؤ|وء|ء/'     =>   '(ئ|ىء|ؤ|وء|ء)',
			'/ا|ا|أ|إ|آ|ا|ا|أ|إ|آ/'           =>   '(ا|أ|إ|آ|ى)',
		);
		return preg_replace(array_keys($filter_replace), array_values($filter_replace), $text_string);
	}


}