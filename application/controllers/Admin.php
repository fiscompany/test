<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct() {
		
       	parent::__construct();
        $this->form_validation->set_error_delimiters('<div class="label label-danger validation-error">', '</div>');
        $this->load->model('Customer_model');
    }

	public function index()
	{

		$this->load->view('layout');
	}


/*****************************/
	public function get_custumers(){
		if (!$this->input->is_ajax_request()) {
           exit('No direct script access allowed');
        }
		$text = $this->input->get("text_string");
		$new_text = $this->filter_String($text);
		if ($text != "") {
			$data = $this->db->query("SELECT * FROM customers WHERE (name_ar REGEXP '".$new_text."')");
			if ($data->num_rows() > 0) {
				$data = $data->result();
				echo json_encode($data);
			}else{
				echo json_encode(" ");
			}
		}else{
			echo json_encode(" ");
		}
    }
	
	
	public function filter_String ($text_string = null){
		
		$text_string = $this->input->get("text_string");
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
	

/**************************/



	public function getCustomerView()
	{
        $this->load->model('Currency_model');
        
		$data['content']="add_customer";
		$data['query3']=$this->Currency_model->getCurrency();

		$this->parser->parse('layout',$data);
	}

	public function getExpTransView()
	{
		$data['content']="edit_exp_trans";
		$this->load->model('Exp_tran_model');
		$data['query']=$this->Exp_tran_model->getAll(100);
		$this->parser->parse('layout',$data);
	}

	public function getExpTransEdit($id)
	{
		//print_r($id);
		$data['content']="edit_tran_info";
		$this->load->model('Exp_tran_model');
		$data['query']=$this->Exp_tran_model->getTrans($id);
		$data['type']='حوالة صادرة';
		$data['typeid']=1;
		$this->load->model('Currency_model');
		$data['query1']=$this->Currency_model->getCurrency();
		$this->parser->parse('layout',$data);
	}

	public function updateExpTrans()
	{
		$id = $this->input->post('id');
		$c_name = $this->input->post('c_name');
		$c_mobile = $this->input->post('c_mobile');
		$c_value = $this->input->post('c_value');
		$c_country = $this->input->post('c_country');
		$c_curr = $this->input->post('c_curr');
		$type= $this->input->post('type');
		if($type==1){
			$this->load->model('Exp_tran_model');
			if($this->Exp_tran_model->updateExp($id, $c_name, $c_country, $c_mobile, $c_value, $c_curr)){
				$this->session->set_flashdata("message","تم الحفظ بنجاح");
				return redirect("admin/editexp");
			}
			else{
				$this->session->set_flashdata("error","لم يتم الحفظ بنجاح");
			  	return redirect("admin/editexp");
			}	
		}
		elseif($type==2){
			$this->load->model('Imp_tran_model');
			if($this->Imp_tran_model->updateExp($id, $c_name, $c_country, $c_mobile, $c_value, $c_curr)){
				$this->session->set_flashdata("message","تم الحفظ بنجاح");
				return redirect("admin/editexp");
			}
			else{
				$this->session->set_flashdata("error","لم يتم الحفظ بنجاح");
			  	return redirect("admin/editexp");
			}	
		}
	}

	public function getImpTransView()
	{
		$data['content']="edit_imp_trans";
		$this->load->model('Imp_tran_model');
		$data['query']=$this->Imp_tran_model->getAll(100);
		$this->parser->parse('layout',$data);
	}

	public function getImpTransEdit($id)
	{
		$data['content']="edit_tran_info";
		$this->load->model('Imp_tran_model');
		$data['query']=$this->Imp_tran_model->getTrans($id);
		$data['type']='حوالة واردة';
		$data['typeid']=2;
		$this->load->model('Currency_model');
		$data['query1']=$this->Currency_model->getCurrency();
		$this->parser->parse('layout',$data);
	}

	public function deleteImpTrans($id)
	{
		$this->load->model('Imp_tran_model');
		if($this->Imp_tran_model->deleteTrans($id)){
			$this->session->set_flashdata("message","تم الحذف بنجاح");
			return redirect("admin/editimp");
		}else{
			$this->session->set_flashdata("error","لم يتم الحذف بنجاح");
		  	return redirect("admin/editimp");
		}
		
	}

	public function deleteExpTrans($id)
	{
		$this->load->model('Exp_tran_model');
		if($this->Exp_tran_model->deleteTrans($id)){
			$this->session->set_flashdata("message","تم الحذف بنجاح");
			return redirect("admin/editexp");
		}else{
			$this->session->set_flashdata("error","لم يتم الحذف بنجاح");
		  	return redirect("admin/editexp");
		}
		
	}

	public function getCustomerInfo()
	{
		$id = $this->input->post("id_no");
		$type= $this->input->post("type");
		$this->load->model('Customer_model');
		$this->load->model('Currency_model');
		if($type==1){
			$data['query']=$this->Customer_model->getCustomerInfo($id);
		}
		elseif($type==2){
			$data['query']=$this->Customer_model->getCustomerByname($id);
		}
		$data['query3']=$this->Currency_model->getCurrency();

		if(empty($data['query'])) {
			$data['query'] = null;
			$data['ssn']=$id;

			return $this->output
		    ->set_content_type('application/json')
		    ->set_output(json_encode(array('status' => false,'message' => "لم يتم العثور على نتائج")));
		}
		else {
			$this->load->model('Exp_tran_model');
			$this->load->model('Imp_tran_model');
			$this->load->model('Currency_model');
			$id = (int) $data['query'][0]->id ;
			$data['query1']=$this->Exp_tran_model->getCustomerExp($id);
			$data['query2']=$this->Imp_tran_model->getCustomerImp($id);
			//$data['query3']=$this->Currency_model->getCurrency();

			return $this->output
		    ->set_content_type('application/json')
		    ->set_output(json_encode(array('status' => true,'result' => $data)));
		}
	}

	public function postNewCustomer()
	{
		$id_no= $this->input->post('id_no');
		$this->load->model('Customer_model');
		$data['query']=$this->Customer_model->getCustomerInfo($id_no);
		if(empty($data['query']))
		{
			$name_ar = $this->input->post('name_ar');
			$name_en = $this->input->post('name_en');
			$mobile = $this->input->post('mobile');

			$this->load->library('upload');
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '5000';
			$config['file_name']	= $id_no;
			$config['overwrite']	= true;

			

			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload("file_name"))
			{
				$this->session->set_flashdata("error",$this->upload->display_errors());
			  	return redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				$upload_data = $this->upload->data();
			}

			$this->load->model('Customer_model');
			if($this->Customer_model->newCustomer($id_no, $name_ar, $name_en, $mobile, $upload_data['file_name'])){
				$this->load->model('Customer_model');
				$data['query']=$this->Customer_model->getCustomerInfo($id_no);
				$data['content']="add_customer";
				$this->load->model('Currency_model');
				$data['query3']=$this->Currency_model->getCurrency();
				$this->session->set_flashdata("message","تم الحفظ بنجاح");
				$this->parser->parse('layout',$data);
			}
			else{
				$this->session->set_flashdata("error","لم يتم الحفظ بنجاح");
				$data['content']="add_customer";
				$this->load->model('Currency_model');
				$data['query3']=$this->Currency_model->getCurrency();
				return $this->parser->parse('layout',$data);
			}
		}
		else{
			$this->session->set_flashdata("error","رقم الهوية موجود مسبقاَ");
		  	$data['content']="add_customer";
			$this->load->model('Currency_model');
			$data['query3']=$this->Currency_model->getCurrency();
			return $this->parser->parse('layout',$data);
		}
	}

	public function postNewTrans()
	{
		$c_id = $this->input->post('c_id');
		$c_name = $this->input->post('c_name');
		$c_mobile = $this->input->post('c_mobile');
		$c_value = $this->input->post('c_value');
		$c_country = $this->input->post('c_country');
		$c_curr = $this->input->post('c_curr');
		if($this->input->post('type') == 1){
			$this->load->model('Exp_tran_model');
			if($this->Exp_tran_model->newExp($c_id, $c_name, $c_country, $c_mobile, $c_value, $c_curr)){
				$this->session->set_flashdata("message","تم الحفظ بنجاح");
				$data['content']="add_customer";
				$this->load->model('Currency_model');
				$data['query3']=$this->Currency_model->getCurrency();
				$this->parser->parse('layout',$data);
			}
			else{
				$this->session->set_flashdata("error","لم يتم يتم الحفظ بنجاح");
			  	$data['content']="add_customer";
				$this->load->model('Currency_model');
				$data['query3']=$this->Currency_model->getCurrency();
				return $this->parser->parse('layout',$data);
			}
		}
		else {
			$this->load->model('Imp_tran_model');
			if($this->Imp_tran_model->newImp($c_id, $c_name, $c_country, $c_mobile, $c_value, $c_curr)){
				$this->session->set_flashdata("message","تم الحفظ بنجاح");
				$data['content']="add_customer";
				$this->load->model('Currency_model');
				$data['query3']=$this->Currency_model->getCurrency();
				$this->parser->parse('layout',$data);
			}
			else{
			  	$this->session->set_flashdata("error","لم يتم يتم الحفظ بنجاح");
			  	$data['content']="add_customer";
				$this->load->model('Currency_model');
				$data['query3']=$this->Currency_model->getCurrency();
				return $this->parser->parse('layout',$data);
			}
		}
	}

	public function editCustomer($id)
	{
		$this->load->model('Customer_model');
		$data['query']=$this->Customer_model->getCustomerByid($id);
		$data['content']="edit_customer";
		$this->parser->parse('layout',$data);
	}

	public function updateCustomer()
	{
		$id= $this->input->post('id');
		$id_no = $this->input->post('id_no');
		$this->load->model('Customer_model');
		$data['query']=$this->Customer_model->getCustomerByid($id_no);
		if(empty($data['query']) || $data['query'][0]->id_no == $id_no)
		{
			$name_ar = $this->input->post('name_ar');
			$name_en = $this->input->post('name_en');
			$mobile = $this->input->post('mobile');

		$this->load->library('upload');
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '5000';
		$config['file_name']	= $id_no;
		$config['overwrite']	= true;

		

		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload("file_name"))
		{
			$this->session->set_flashdata("error",$this->upload->display_errors());
		  	return redirect($_SERVER['HTTP_REFERER']);
		}
		else
		{
			$upload_data = $this->upload->data();
		}	

			

			$this->load->model('Customer_model');
			if($this->Customer_model->updateCustomer($id, $id_no, $name_ar, $name_en, $mobile, $upload_data["file_name"])){
				$this->session->set_flashdata("message","تم الحفظ بنجاح");
		  		return redirect($_SERVER['HTTP_REFERER']);
			}
			else{
				$this->session->set_flashdata("error","لم يتم الحفظ بنجاح");
		  		return redirect($_SERVER['HTTP_REFERER']);
			}
		}
		else{
			$this->session->set_flashdata("error","رقم الهوية موجود مسبقاَ");
	  		return redirect($_SERVER['HTTP_REFERER']);

		}
	}

	public function getCustomers()
	{
		$this->load->model('Customer_model');
		$data['query']=$this->Customer_model->getCustomers(100);
		$data['content']="customers";
		$this->parser->parse('layout',$data);
	}

	public function deleteCustomer($id)
	{
		$this->load->model('Customer_model');
		if($this->Customer_model->deleteCustomer($id)){
			$this->session->set_flashdata("message","تم الحذف بنجاح");
			return redirect("admin/customers");
		}else{
			$this->session->set_flashdata("error","لم يتم الحذف بنجاح");
		  	return redirect("admin/customers");
		}
	}


}
