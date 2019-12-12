<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->lang->load('admin', get_lang() );
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->model('data','','true');
        $this->load->library('upload');
        $this->load->helper(array('form', 'url','text'));
        $this->load->library('lib_pagination');
        $this->load->library('CKEditor');
        $this->load->library('CKFinder');
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../../design/ckfinder/');
		$this->load->library('image_lib');		
    }
    public function gen_random_string()
    {
        $chars ="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";//length:36
        $final_rand='';
        for($i=0;$i<4; $i++) {
            $final_rand .= $chars[ rand(0,strlen($chars)-1)];
        }
        return $final_rand;
    }

    public function index(){
        redirect(base_url().'admin/products/show','refresh');
    }

    public function show(){
        $pg_config['sql'] = $this->data->get_sql('products','','id','DESC');
        $pg_config['per_page'] = 10;
        $data = $this->lib_pagination->create_pagination($pg_config);
        $this->load->view("admin/products/show", $data); 
    }

    public function add(){
        $this->load->view("admin/products/add"); 
    }

    public function add_action(){
        $name_ar=$this->input->post('name_ar');
        $name_en=$this->input->post('name_en');
        $desc_ar=$this->input->post('desc_ar');
        $desc_en=$this->input->post('desc_en');
        $default_price=$this->input->post('default_price');

        $data['name_ar'] = $name_ar;
        $data['name_en'] = $name_en;
        $data['desc_ar'] = $desc_ar;
        $data['desc_en'] = $desc_en;
        $data['default_price'] = $default_price;
        $data['creation_date'] = date("Y-m-d");

        $this->db->insert('products',$data);
		$id = $this->db->insert_id();
		if($_FILES['img']['name']!=""){
            $img_name=$this->gen_random_string(); 
            $imagename = $img_name;
			$config['image_library'] = 'gd2';
            $config['upload_path'] = 'uploads/site_setting/products/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             =100000;
            $config['max_width']            =100000;
            $config['max_height']           =100000;
            $config['file_name'] = $imagename; 
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('img')){
                echo $this->upload->display_errors();
                print_r($config);
                die;
            }
            else {
            $url= $_FILES['img']['name'];
            $ext = explode(".",$url);
            $file_extension = end($ext);
			$config['source_image'] = 'uploads/site_setting/products/'.$imagename.".".$file_extension ;
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['quality'] = '90%';
			$config['width']     = 600;
			$config['height']   = 600;
			$this->image_lib->clear();
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			
            $data = array('img'=>$imagename.".".$file_extension);
            $this->data->edit_table_id('products',array('id'=>$id),$data);
            }
        }
		
		// If file upload form submitted
			if(!empty($_FILES['files']['name'])){
				$filesCount = count($_FILES['files']['name']);
				for($i = 0; $i < $filesCount; $i++){
				$img_name=$this->gen_random_string(); 
				$imagename = $img_name;
				$_FILES['file']['name']     = $_FILES['files']['name'][$i];
				$_FILES['file']['type']     = $_FILES['files']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
				$_FILES['file']['error']     = $_FILES['files']['error'][$i];
				$_FILES['file']['size']     = $_FILES['files']['size'][$i];
						
				// File upload configuration
				$uploadPath = 'uploads/site_setting/products_gallery/';
				$config['image_library'] = 'gd2';
				$config['upload_path'] = $uploadPath;
				$config['max_size']	=600000;
				$config['max_width']	= 600000;
				$config['max_height']	= 600000;
				$config['file_name'] = $imagename; 
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
						
				// Load and initialize upload library
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
						
				// Upload file to server
				if($this->upload->do_upload('file')){
				// Uploaded file data
					$fileData = $this->upload->data();
					$uploadData['img'] = $fileData['file_name'];
					$uploadData['product_id'] = $id;
					$uploadData['creation_date'] = date("Y-m-d");
					
					$config['source_image'] = 'uploads/site_setting/products_gallery/'.$fileData['file_name'];
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = TRUE;
					$config['quality'] = '90%';
					$config['width']     = 600;
					$config['height']   = 600;
					$this->image_lib->clear();
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					
					$insert = $this->db->insert('products_images', $uploadData );
					}
				}
			}
		
        $this->session->set_flashdata('msg', 'تمت الإضافة بنجاح');
        redirect(base_url().'admin/products/show','refresh');
    }
	
	public function json($status,$msg=[]){
		$data['status'] = $status;
		$data['msg'] = $msg;
		echo json_encode($data);
	}
	
	public function del_img(){
		$id = $this->input->post('id');
		$img = get_this('products_images',['id' => $id],'img');
		if ($img != "") {
		  unlink("uploads/site_setting/products_gallery/$img");
		}
		$this->db->delete('products_images', array('id' => $id));
		return $this->json(true,'تم الحذف');
  	}

    public function delete(){
        $id_products = $this->input->get('id_products');
        $check=$this->input->post('check');

        if($id_products!=""){
        $ret_value=$this->data->delete_table_row('products',array('id'=>$id_products)); 
        }
     
        if(isset($check) && $check!=""){  
        $check=$this->input->post('check');
        $length=count($check);
        for($i=0;$i<$length;$i++){
        $ret_value=$this->data->delete_table_row('products',array('id'=>$check[$i]));    
        }
        }

        $this->session->set_flashdata('msg', 'تم الحذف بنجاح');
        redirect(base_url().'admin/products/show','refresh');
    }

    function active(){
        $id = $this->input->post("id");
        $ser = $this->db->get_where("products",array("id"=>$id,"active" => "1"))->num_rows();
        if ($ser == 1) {
            $this->db->update("products",array("active" => "0"),array("id"=>$id));
            echo "0";
        }
        if ($ser == 0) {
            $this->db->update("products",array("active" => "1"),array("id"=>$id));
            echo "1";
        } 
    }

    public function edit(){
        $id=$this->input->get('id');
        $data['data'] = $this->data->get_table_data('products',array('id'=>$id));
        $this->load->view("admin/products/edit",$data); 
    }

    function edit_action(){
        $id=$this->input->post('id');
		$name_ar=$this->input->post('name_ar');
        $name_en=$this->input->post('name_en');
        $desc_ar=$this->input->post('desc_ar');
        $desc_en=$this->input->post('desc_en');
        $default_price=$this->input->post('default_price');

        $data['name_ar'] = $name_ar;
        $data['name_en'] = $name_en;
        $data['desc_ar'] = $desc_ar;
        $data['desc_en'] = $desc_en;
        $data['default_price'] = $default_price;

        $data = array('name_ar'=>$name_ar,'name_en'=>$name_en,'desc_ar'=>$desc_ar,'desc_en'=>$desc_en,'default_price'=>$default_price);
        $re=$this->data->edit_table_id('products',array('id'=>$id),$data);
		
		if($_FILES['img']['name']!=""){
			//Delete Resource Old Image
			$img = get_this('products',['id' => $id],'img');
			if ($img != "") {
			  unlink("uploads/site_setting/products/$img");
			}
			////////////////////////////////////////////////
            $img_name=$this->gen_random_string(); 
            $imagename = $img_name;
			$config['image_library'] = 'gd2';
            $config['upload_path'] = 'uploads/site_setting/products/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             =100000;
            $config['max_width']            =100000;
            $config['max_height']           =100000;
            $config['file_name'] = $imagename; 
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('img')){
                echo $this->upload->display_errors();
                print_r($config);
                die;
            }
            else {
            $url= $_FILES['img']['name'];
            $ext = explode(".",$url);
            $file_extension = end($ext);
			$config['source_image'] = 'uploads/site_setting/products/'.$imagename.".".$file_extension ;
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['quality'] = '90%';
			$config['width']     = 600;
			$config['height']   = 600;
			$this->image_lib->clear();
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			
            $data = array('img'=>$imagename.".".$file_extension);
            $this->data->edit_table_id('products',array('id'=>$id),$data);
            }
        }
		
		// If file upload form submitted
			if(!empty($_FILES['files']['name'])){
				$filesCount = count($_FILES['files']['name']);
				for($i = 0; $i < $filesCount; $i++){
				$img_name=$this->gen_random_string(); 
				$imagename = $img_name;
				$_FILES['file']['name']     = $_FILES['files']['name'][$i];
				$_FILES['file']['type']     = $_FILES['files']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
				$_FILES['file']['error']     = $_FILES['files']['error'][$i];
				$_FILES['file']['size']     = $_FILES['files']['size'][$i];
						
				// File upload configuration
				$uploadPath = 'uploads/site_setting/products_gallery/';
				$config['image_library'] = 'gd2';
				$config['upload_path'] = $uploadPath;
				$config['max_size']	=600000;
				$config['max_width']	= 600000;
				$config['max_height']	= 600000;
				$config['file_name'] = $imagename; 
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
						
				// Load and initialize upload library
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
						
				// Upload file to server
				if($this->upload->do_upload('file')){
				// Uploaded file data
					$fileData = $this->upload->data();
					$uploadData['img'] = $fileData['file_name'];
					$uploadData['product_id'] = $id;
					$uploadData['creation_date'] = date("Y-m-d");
					
					$config['source_image'] = 'uploads/site_setting/products_gallery/'.$fileData['file_name'];
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = TRUE;
					$config['quality'] = '90%';
					$config['width']     = 600;
					$config['height']   = 600;
					$this->image_lib->clear();
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
			
					$insert = $this->db->insert('products_images', $uploadData );
					}
				}
			}

        $this->session->set_flashdata('msg', 'تم التعديل بنجاح');
        redirect(base_url().'admin/products/show','refresh');
    }

}