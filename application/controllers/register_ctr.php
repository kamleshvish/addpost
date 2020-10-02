<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 


class Register_ctr extends CI_Controller {

	public function __construct() {
        parent:: __construct();

        $this->load->helper('url');
        $this->load->model('Admin_model');
        $this->load->library("pagination");
    }

	
	public function index()
	{
		$this->load->view('login');
	}
	public function home()
	{
		$this->load->view('home');
	}
	public function user()
	{
		$this->load->view('users');
	}
	public function registerform()
	{
		$this->load->view('register');
	}
	

	public function cat_save()
    {
		$data=$_REQUEST;
		if($this->Admin_model->cat_save($data))
		 {
				echo "cat insert";
				return redirect('register_ctr/user');
			}
			else
			{
				echo "cat not insert"; 
			}
	}

	public function login()
	{
		$_REQUEST;
		$query=$this->db->query("select *from user where email='$_REQUEST[email]' and password='$_REQUEST[password]'");
		$login=$query->result();
		if($login)
		{
			$this->session->set_userdata('login', $login);
			$name = $this->session->userdata('login');
			echo '<script>alert("You Have Successfully Login this Record!")</script>';
			return redirect('register_ctr/home');
		}
		else
		{
			
			echo "notmatch";
			return redirect('register_ctr/index');	;
		}
	}
	public function logout()
	{
		 $this->session->unset_userdata('login');
		 $this->load->view('login');

	}

	public function clientadd()
		{
			$data=$_REQUEST;
			
			// $photo=$_FILES['image'];
		   //  $picname=$photo['name'];
             //$data['image']=$picname;

			 $config['upload_path']   = './upload/'; 
       		 $config['allowed_types'] = 'gif|jpg|png'; 
        	 $config['max_size']      = 10000; 
        	 $config['max_width']     = 102400; 
        	 $config['max_height']    = 76800;  
        	 $this->load->library('upload', $config);
			
         	 $this->upload->do_upload('image');
		

			if($this->Admin_model->cient_save($data))
			{
				echo "insert product";
				return redirect('register_ctr/registerform');
			}
			else
			{
				echo "product ! no insert";
			}
		}
	public function registerlist()
	 {
	 	 

		    $query=$this->db->get('client');
			$data['record']=$query->result();
		    $this->load->view('registerview',$data);
	 }
	 public function deletclient()
		{
			$id=$this->uri->segment(3);
			if($this->Admin_model->delet_client($id))
			{
			 echo "delete data";
			 return redirect('register_ctr/registerlist');
			}
			else
			 {
			 echo "data not delete";
			 }
		}
		public function clientedit()
		{
			$id=$this->uri->segment(3);
			$query=$this->db->query("select *from client where id='$id'");
			$data['record']=$query->result();

			$this->load->view('clientedit',$data);
		}
		public function client_edite()
		{
			$data=$_REQUEST;
			//echo "<pre>";
			if(!empty($_FILES['image'])){
				//print_r($_FILES['image']);
			 	//$photo=$_FILES['image'];
		     	//$picname=$photo['name'];
             	// $data['image']=$picname;
			 	$config['upload_path']   = './upload/'; 
       		 	$config['allowed_types'] = 'gif|jpg|png'; 
        	 	$config['max_size']      = 100000; 
        	 	$config['max_width']     = 10240; 
        	 	$config['max_height']    = 76800;  
        	 	$this->load->library('upload', $config);
         	 	$this->upload->do_upload('image');
         	 	// print_r($this->upload->data('image'));die;
         	 	$data['image'] = $this->upload->data('image')['file_name'];
			}
		
			$id=$_REQUEST['id'];
			if($this->Admin_model->clien_edite($data,$id))
			{
				echo "Edit success";
				return redirect('register_ctr/registerlist');
			}
			else
			{
			echo "not edit";
			}
		}

		public function search_keyword()
		{
 		   $keyword    =   $this->input->post('keyword');
 		   
 		   if(!empty($keyword))
 		   {
 		   $query=$this->db->query("select *from client where category LIKE '%$keyword%' ");

 		  // $query=$this->db->query("select *from client where category LIKE '%$keyword%' OR email LIKE '%$keyword%' OR st_id LIKE '%$keyword%' OR roll_num LIKE '%$keyword%'");
 			}
 			else
 			{
 				$query=$this->db->get('client');
 			}
 		   		//$this->twig->display('ldc_view.php',$this->data);
  		  		//$this->load->view('result_view.php',$data);
               
			$data['record']=$query->result();
			$this->load->view('registerview',$data);
		}
		
}	