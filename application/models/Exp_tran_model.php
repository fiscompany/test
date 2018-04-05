<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	

class Exp_tran_model extends CI_Model {
	public $customer_id;
    public $recipient_name_ar;
    public $recipient_country;
    public $recipient_mobile;    
    public $value;
    public $currency_id;

    public function getAll($limit = null)
    {
        if ($limit != null) {
            $this->db->limit($limit);
        }
        $this->db->join("customers", "customers.id = exp_trans.customer_id");
        $this->db->join("c_currencies", "c_currencies.id = exp_trans.currency_id");
        $this->db->select("customers.name_ar as name_ar, recipient_name_ar, recipient_country, exp_trans.created_at as created_at, exp_trans.id as id, value, name");
        $results=$this->db->get("exp_trans");
        return $results->result();
    }

    public function getTrans($id)
    {
        $this->db->join("customers", "customers.id = exp_trans.customer_id");
        $this->db->join("c_currencies", "c_currencies.id = exp_trans.currency_id");
        $this->db->select("customers.name_ar as name_ar, recipient_name_ar as c_name, recipient_country as c_country, exp_trans.recipient_mobile as c_mobile, exp_trans.id as id, value, name, currency_id");
        $this->db->where("exp_trans.id", $id);
        $results=$this->db->get("exp_trans");
        return $results->result();
    }

    public function deleteTrans($id)
    {
        $this->db->where("exp_trans.id", $id);
        $results=$this->db->delete('exp_trans');
        return $results;
    }
    
	public function getCustomerExp($customer_id)
    {
        $this->db->select("`id`, `customer_id`, `recipient_name_ar`, `recipient_country`, `recipient_mobile`, `value`, `currency_id`, `created_at`, `updated_at` , (SELECT name FROM c_currencies WHERE currency_id = c_currencies.id) AS `currency_name`");
		$this->db->where("customer_id",$customer_id);
		$results=$this->db->get("exp_trans", 5);
		return $results->result();
	}

	public function newExp($customer_id, $recipient_name_ar, $recipient_country, $recipient_mobile, $value, $currency_id)
    {
    	$this->customer_id = $customer_id;
    	$this->recipient_name_ar = $recipient_name_ar;
    	$this->recipient_country = $recipient_country;
    	$this->recipient_mobile = $recipient_mobile;
    	$this->value = $value; 
    	$this->currency_id = $currency_id; 
		$results = $this->db->insert('exp_trans', $this);
		return $results;
	}

    public function updateExp($id, $recipient_name_ar, $recipient_country, $recipient_mobile, $value, $currency_id)
    {
        $this->db->where("id", $id);
        $data = array('recipient_name_ar' => $recipient_name_ar, 'recipient_country' => $recipient_country, 'recipient_mobile' => $recipient_mobile, 'value' => $value, 'currency_id' => $currency_id);  
        $results = $this->db->update('exp_trans', $data);
        return $results;
    }
    
    public function Add($data)
	{
		$this->db->insert('exp_trans',$data);
        $lastid = $this->db->insert_id();
		return $lastid;
	}
    
    public function deleteByCustomerID($customer_id)
    {
        $this->db->where("customer_id", $customer_id);
        $this->db->delete('exp_trans');
    }
    
    public function Search($customer_name ,$receipent_name ,$country ,$from_money ,$to_money ,$from_date ,$to_date){
        if ($customer_name != '') {
            $customer_name_new = $this->filter_String($customer_name);
            $this->db->where("(name_ar REGEXP '".$customer_name_new."')");
            $this->db->select('id');
            $results = $this->db->get('customers');
            $customer_id_array = array();
            $customer_id_array = $results->result_array();
            
            $customer_id_array_new = array();
            foreach ($customer_id_array as $item) {
                $customer_id_array_new[] = $item['id'];
            }
            if (sizeof ($customer_id_array_new) > 0) {
                $this->db->where_in("customer_id",$customer_id_array_new);
            }else {
                $this->db->where_in("customer_id",0);
            }
        }
        if ($receipent_name != '') {
            $receipent_name_new = $this->filter_String($receipent_name);
            $this->db->where("(recipient_name_ar REGEXP '".$receipent_name_new."')");
        }
        if ($country != '') {
            $country_new = $this->filter_String($country);
            $this->db->where("(recipient_country REGEXP '".$country_new."')");
        }
        
        if ($from_money != '' && $to_money != '') {
            $this->db->where("value BETWEEN $from_money AND $to_money", NULL, FALSE);
        }else if ($from_money != '') {
            $this->db->where('value' , $from_money);
        }else if ($to_money != '') {
            $this->db->where('value' , $to_money);
        }
        
        if ($from_date != '' && $to_date != '') {
            $this->db->where("created_at BETWEEN '". date('Y-m-d h:i:s', strtotime($from_date)) ."' AND '". date('Y-m-d h:i:s', strtotime($to_date)) ."' ", NULL, FALSE);
        }else if ($from_date != '') {
            $this->db->where('created_at' , date('Y-m-d h:i:s', strtotime($from_date)));
        }else if ($to_date != '') {
            $this->db->where('created_at' , date('Y-m-d h:i:s', strtotime($to_date)));
        }
        
        $this->db->select('`id`, `customer_id`, `recipient_name_ar`, `recipient_country`, `recipient_mobile`, `value`, `currency_id`, DATE(created_at) AS `created_at`, `updated_at`,
        (SELECT name_ar FROM customers WHERE customer_id = customers.id) AS `customer_name`,
        (SELECT name FROM c_currencies WHERE currency_id = c_currencies.id) AS `currency_name`
        ');
		$this->db->order_by('id');
		$results = $this->db->get('exp_trans');
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