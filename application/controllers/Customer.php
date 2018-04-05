<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MY_Controller {

	function __construct() {
		
       	parent::__construct();
        $this->form_validation->set_error_delimiters('<div class="label label-danger validation-error">', '</div>');
        $this->load->model('Customer_model');
        $this->load->model('Currency_model');
    }

	public function index()
	{

		$this->load->view('layout');
	}
    
    public function Add () {
        
        if ($_POST) {
            $ValidationParameter = array();
            $ValidationParameter[] = ['field' => 'id_no','label' => 'رقم الهوية','rules' => 'required'];
            $ValidationParameter[] = ['field' => 'name_ar','label' => 'الاسم باللغة العربية','rules' => 'required'];
            $ValidationParameter[] = ['field' => 'name_en','label' => 'الاسم باللغة الإنجليزية','rules' => 'required'];
            $ValidationParameter[] = ['field' => 'mobile','label' => 'رقم الجوال','rules' => 'required'];
            
            $this->form_validation->set_rules($ValidationParameter);
			if ($this->form_validation->run() == TRUE)
            {
                if (!$this->Customer_model->IsExists('id_no' ,$this->input->post('id_no'))) {
                    
                    $customer_add['id_no'] = $this->input->post('id_no');
                    $customer_add['name_ar'] = $this->input->post('name_ar');
                    $customer_add['name_en'] = $this->input->post('name_en');
                    $customer_add['mobile'] = $this->input->post('mobile');
                    
                    $has_error_file = false;
                    if ( $_FILES['file_name']['size'] > 0 ) {
                        $result = $this->UploadFile( 'file_name' , './uploads/' , 'png|jepeg|jpg' );
                        if ($result['success']) {
                            $customer_add['file_name'] = $result['file_name'];
                        }else {
                            $has_error_file = true;
                            $this->session->set_flashdata(array("type"=>"error","msg"=>$result['error_message']));
                        }
                    }
                    if (!$has_error_file) {
                        $id = $this->Customer_model->Add($customer_add);
                        $customer=$this->Customer_model->getCustomerByid($id);
                        $data['query'] = $customer;
                        $this->session->set_flashdata(array("type"=>"success","msg"=>'تم إضافة زبون جديد بنجاح'));
                    }
                    
                }else {
                    $this->session->set_flashdata(array("type"=>"error","msg"=>'رقم الهوية موجود مسبقاً'));
                }
            }else {
                $this->session->set_flashdata(array("type"=>"error","msg"=>$this->form_validation->error_string()));
            }
        }else {
            redirect('admin/add');
        }
        
		$data['query3']=$this->Currency_model->getCurrency();
        $data['content']="add_customer";
		$this->parser->parse('layout',$data);
    }
    
    public function Edit ($id = null) {
        $customer=$this->Customer_model->getCustomerByid($id);
        if ($id == null || $customer == null) {
            show_404();
        }
        
        if ($_POST) {
            $ValidationParameter = array();
            $ValidationParameter[] = ['field' => 'id_no','label' => 'رقم الهوية','rules' => 'required'];
            $ValidationParameter[] = ['field' => 'name_ar','label' => 'الاسم باللغة العربية','rules' => 'required'];
            $ValidationParameter[] = ['field' => 'name_en','label' => 'الاسم باللغة الإنجليزية','rules' => 'required'];
            $ValidationParameter[] = ['field' => 'mobile','label' => 'رقم الجوال','rules' => 'required'];
            
            $this->form_validation->set_rules($ValidationParameter);
			if ($this->form_validation->run() == TRUE)
            {
                if (!$this->Customer_model->IsExistsForUpdate('id_no' ,$this->input->post('id_no') ,$id)) {
                    
                    $customer_update['id_no'] = $this->input->post('id_no');
                    $customer_update['name_ar'] = $this->input->post('name_ar');
                    $customer_update['name_en'] = $this->input->post('name_en');
                    $customer_update['mobile'] = $this->input->post('mobile');
                    
                    if ( $_FILES['file']['size'] > 0 ) {
                        $result = $this->UploadFile( 'file' , './uploads/' , 'png|jepeg|jpg' );
                        if ($result['success']) {
                            if ($customer[0]->file_name != null) {
                                $this->DeleteCustomerDocument( $customer[0]->file_name );
                            }
                            $customer_update['file_name'] = $result['file_name'];
                        }else {
                            $this->session->set_flashdata(array("type"=>"error","msg"=>$result['error_message']));
                            redirect('Customer/Edit/'.$id);
                        }
                    }
                    
                    $this->Customer_model->Update($customer_update , $id);
                    
                    $this->session->set_flashdata(array("type"=>"success","msg"=>'تم التعديل بنجاح'));
                    
                }else {
                    $this->session->set_flashdata(array("type"=>"error","msg"=>'رقم الهوية موجود مسبقاً'));
                }
            }else {
                $this->session->set_flashdata(array("type"=>"error","msg"=>$this->form_validation->error_string()));
            }
            redirect('Customer/Edit/'.$id);
        }
        
        $data['customer'] = $customer;
        $data['content']="customer/edit";
		$this->parser->parse('ifram',$data);
    }
    
    
    public function GetCustomer () {
        $result = null;
        if ($_POST) {
            $result=$this->Customer_model->getCustomerByid( $this->input->post('id') );
        }
        echo json_encode($result);
    }
    
    public function UploadFile($filename , $path, $type=null)
	{
        $result = array();
		$randomName="";
		$config['upload_path'] = $path;
        if ($type == null) {
            $config['allowed_types'] = 'pdf|doc|docx|png|jepeg|jpg';
        }else {
            $config['allowed_types'] = $type;
        }
		//$config['overwrite'] = TRUE;
        $config['max_size'] = '500';

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload($filename))
		{
            $result = ([
                "success" => false,
                "name_of_file" => '',
                "error_message" => $this->upload->display_errors('<span>', '</span>')
            ]);
			return $result;
		}
		else
		{
			$uploadedFileData=$this->upload->data();
			$randomName=time().rand().$uploadedFileData['file_ext'];
			rename($uploadedFileData['full_path'],$uploadedFileData['file_path'].$randomName);
			$uploadedFileData["file_name"]=$randomName;
            $result = ([
                "success" => true,
                "file_name" => $randomName,
                "path" => $path
            ]);
			return $result;
		}
    }
    
    public function DeleteCustomerDocument( $file_name )
    {
        unlink('uploads/'.$file_name);
	}
    
    public function Delete ($id = null) 
    {
        $customer=$this->Customer_model->getCustomerByid($id);
        if ($id == null || $customer == null) {
            show_404();
        }
        if ($customer[0]->file_name != null) {
            $this->DeleteCustomerDocument( $customer[0]->file_name );
        }
        
        $this->load->model('Exp_tran_model');
        $this->load->model('Imp_tran_model');
        $this->Exp_tran_model->deleteByCustomerID($id);
        $this->Imp_tran_model->deleteByCustomerID($id);
        
        $this->Customer_model->deleteCustomer($id);
        
        $this->session->set_flashdata(array("type"=>"success","msg"=>'تمت عملية الحذف بنجاح'));
        
		if(isset($_SERVER['HTTP_REFERER']))
			redirect($_SERVER['HTTP_REFERER']);
		else
			redirect("Admin");
    }
    
    public function Search () {
        $result = null;
        if ($_GET) {
            $result = $this->Customer_model->Search( $this->input->get('id_no') , $this->input->get('name_ar') , $this->input->get('name_en') , $this->input->get('mobile') );
        }
        echo json_encode($result);
    }

}
