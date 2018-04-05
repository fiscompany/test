<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	

class Imp_tran_model extends CI_Model {

    public $customer_id;
    public $sender_name_ar;
    public $sender_country;
    public $sender_mobile;    
    public $value;
    public $currency_id;

    public function getAll($limit = null)
    {
        if ($limit != null) {
            $this->db->limit($limit);
        }
        $this->db->join("customers", "customers.id = imp_trans.customer_id");
        $this->db->join("c_currencies", "c_currencies.id = imp_trans.currency_id");
        $this->db->select("customers.name_ar as name_ar, sender_name_ar, sender_country, imp_trans.created_at as created_at, imp_trans.id as id, value, name");        $results=$this->db->get("imp_trans");
        return $results->result();
    }

    public function getTrans($id)
    {
        $this->db->where("imp_trans.id", $id);
        $this->db->join("customers", "customers.id = imp_trans.customer_id");
        $this->db->join("c_currencies", "c_currencies.id = imp_trans.currency_id");
        $this->db->select("customers.name_ar as name_ar, sender_name_ar as c_name, sender_country as c_country, imp_trans.sender_mobile as c_mobile, imp_trans.id as id, value, name, currency_id");
        $results=$this->db->get("imp_trans");
        return $results->result();
    }

    public function deleteTrans($id)
    {
        $this->db->where("imp_trans.id", $id);
        $results=$this->db->delete('imp_trans');
        return $results;
    }
    
    
	public function getCustomerImp($customer_id)
    {
        $this->db->select("`id`, `customer_id`, `sender_name_ar`, `sender_name_en`, `sender_country`, `sender_mobile`, `value`, `currency_id`, `created_at`, `updated_at` , (SELECT name FROM c_currencies WHERE currency_id = c_currencies.id) AS `currency_name`");
		$this->db->where("customer_id",$customer_id);
		$results=$this->db->get("imp_trans", 5);
		return $results->result();
	}

	public function newImp($customer_id, $sender_name_ar, $sender_country, $sender_mobile, $value, $currency_id)
    {
    	$this->customer_id = $customer_id;
    	$this->sender_name_ar = $sender_name_ar;
    	$this->sender_country = $sender_country;
    	$this->sender_mobile = $sender_mobile;
    	$this->value = $value; 
    	$this->currency_id = $currency_id; 
		$results = $this->db->insert('imp_trans', $this);;
		return $results;
	}

    public function updateExp($id, $sender_name_ar, $sender_country, $recipient_mobile, $value, $currency_id)
    {
        $this->db->where("id", $id);
        $data = array('sender_name_ar' => $sender_name_ar, 'sender_country' => $sender_country, 'sender_mobile' => $sender_mobile, 'value' => $value, 'currency_id' => $currency_id);  
        $results = $this->db->update('imp_trans', $data);
        return $results;
    }
    
    public function Add($data)
	{
		$this->db->insert('imp_trans',$data);
        $lastid = $this->db->insert_id();
		return $lastid;
	}
    
    public function deleteByCustomerID($customer_id)
    {
        $this->db->where("customer_id", $customer_id);
        $this->db->delete('imp_trans');
    }
    
    public function Search($customer_name ,$sender_name ,$country ,$from_money ,$to_money ,$from_date ,$to_date){
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
        if ($sender_name != '') {
            $sender_name_new = $this->filter_String($sender_name);
            $this->db->where("(sender_name_ar REGEXP '".$sender_name_new."')");
        }
        if ($country != '') {
            $country_new = $this->filter_String($country);
            $this->db->where("(sender_country REGEXP '".$country_new."')");
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
        
        $this->db->select('`id`, `customer_id`, `sender_name_ar`, `sender_country`, `sender_mobile`, `value`, `currency_id`, DATE(created_at) AS `created_at`, `updated_at`,
        (SELECT name_ar FROM customers WHERE customer_id = customers.id) AS `customer_name`,
        (SELECT name FROM c_currencies WHERE currency_id = c_currencies.id) AS `currency_name`
        ');
		$this->db->order_by('id');
		$results = $this->db->get('imp_trans');
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