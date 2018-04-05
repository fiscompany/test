<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends MY_Controller {

	function __construct() {
		
       	parent::__construct();
        $this->form_validation->set_error_delimiters('<div class="label label-danger validation-error">', '</div>');
        $this->load->model('Customer_model');
        $this->load->model('Currency_model');
        $this->load->model('Exp_tran_model');
        $this->load->model('Imp_tran_model');
    }

	public function index()
	{

		$this->load->view('layout');
	}
    
    public function Add () {
        
        if ($_POST) {
            $ValidationParameter = array();
            $ValidationParameter[] = ['field' => 'type','label' => 'نوع الحوالة','rules' => 'required'];
            $ValidationParameter[] = ['field' => 'c_name','label' => 'الاسم باللغة العربية','rules' => 'required'];
            $ValidationParameter[] = ['field' => 'c_mobile','label' => 'رقم الجوال','rules' => 'required'];
            $ValidationParameter[] = ['field' => 'c_country','label' => 'الدولة','rules' => 'required'];
            $ValidationParameter[] = ['field' => 'c_value','label' => 'المبلغ','rules' => 'required'];
            $ValidationParameter[] = ['field' => 'c_id','label' => 'زبون','rules' => 'required'];
            
            $this->form_validation->set_rules($ValidationParameter);
			if ($this->form_validation->run() == TRUE)
            {
                if ($this->input->post('type') == '1') {
                    $exp_tran_add['customer_id'] = $this->input->post('c_id');
                    $exp_tran_add['recipient_name_ar'] = $this->input->post('c_name');
                    $exp_tran_add['recipient_mobile'] = $this->input->post('c_mobile');
                    $exp_tran_add['recipient_country'] = $this->input->post('c_country');
                    $exp_tran_add['value'] = $this->input->post('c_value');
                    $exp_tran_add['currency_id'] = $this->input->post('c_curr');
                    $this->Exp_tran_model->Add($exp_tran_add);
                }else if ($this->input->post('type') == '2'){
                    $emp_tran_add['customer_id'] = $this->input->post('c_id');
                    $emp_tran_add['sender_name_ar'] = $this->input->post('c_name');
                    $emp_tran_add['sender_mobile'] = $this->input->post('c_mobile');
                    $emp_tran_add['sender_country'] = $this->input->post('c_country');
                    $emp_tran_add['value'] = $this->input->post('c_value');
                    $emp_tran_add['currency_id'] = $this->input->post('c_curr');
                    $this->Imp_tran_model->Add($emp_tran_add);
                }
                
                $this->session->set_flashdata(array("type"=>"success","msg"=>'تم إضافة حوالة جديدة بنجاح'));
                
            }else {
                $this->session->set_flashdata(array("type"=>"error","msg"=>$this->form_validation->error_string()));
            }
        }else {
            redirect('admin/add');
        }
        $customer=$this->Customer_model->getCustomerByid($this->input->post('c_id'));
        $data['query'] = $customer;
        $data['query1'] = $this->Exp_tran_model->getCustomerExp($this->input->post('c_id'));;
        $data['query2'] = $this->Imp_tran_model->getCustomerImp($this->input->post('c_id'));;
		$data['query3']=$this->Currency_model->getCurrency();
        $data['content']="add_customer";
		$this->parser->parse('layout',$data);
    }
    
    public function ExpSearch () {
        $result = null;
        if ($_GET) {
            $result = $this->Exp_tran_model->Search( $this->input->get('customer_name') , $this->input->get('receipent_name') , $this->input->get('country') , $this->input->get('from_money') , $this->input->get('to_money') ,$this->input->get('from_date') ,$this->input->get('to_date'));
        }
        echo json_encode($result);
    }
    
    public function ImpSearch () {
        $result = null;
        if ($_GET) {
            $result = $this->Imp_tran_model->Search( $this->input->get('customer_name') , $this->input->get('sender_name') , $this->input->get('country') , $this->input->get('from_money') , $this->input->get('to_money') ,$this->input->get('from_date') ,$this->input->get('to_date'));
        }
        echo json_encode($result);
    }

}
