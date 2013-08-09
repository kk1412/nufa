<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TimeLine extends CI_Controller {
	
	private $limit = 10;
	
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->load->view('timeline/app_user/login');
	}
	
	public function login() {
		// set common object
		$data['statusLogin'] = "";
		$this->form_validation->set_rules('username','username', 'required');
		$this->form_validation->set_rules('password','password', 'required');
		if($this->form_validation->run()) {
			$recordLogin = $this->AppUserModel->getLogin($this->input->post('username'), $this->input->post('password'));
			if($recordLogin != FALSE) {
				foreach($recordLogin as $record) {
					$userdata = array(
					   'username'  => $record->username,
					   'password'     => $record->password,
					   'full_name'     => $record->full_name,
					   'email'     => $record->email,
					   'name_category'     => $record->name_category,
					   'id_role'     => $record->id_role,
					   'name_role'     => $record->name_role,
					   'is_active'     => $record->is_active,
					   'logged_in' => TRUE
					);
					$this->session->set_userdata($userdata);
					redirect('TimeLine/appUserList/');
				}
			}
			else {
				$data['statusLogin'] = "username atau password salah";
			}
		}
		else {
			$this->form_validation->set_message('username', 'Error Message');
		}
		$this->load->view('timeline/appUser/login', $data);
	}
	
	public function appUserList($offset=0,$order_column='id_user', $order_type='asc') {
	
		if (empty($offset)) $offset=0;
		if (empty($order_column)) $order_column='id';
		if (empty($order_type)) $order_type='asc';
		//TODO: check for valid column
		$data['create_user'] = anchor('TimeLine/appUserCreate/','Create User',array('class'=>'back'));
		// load data app_user
		$appUserLoads=$this->AppUserModel->getLoad($this->limit, $offset,$order_column,$order_type)->result();
		// generate pagination
		$this->load->library('pagination');
		$config['base_url']= site_url('TimeLine/appUserList/');
		$config['total_rows']=$this->AppUserModel->countAll();
		$config['per_page']=$this->limit;
		$config['uri_segment']=3;
		$this->pagination->initialize($config);
		$data['pagination']=$this->pagination->create_links();
		// generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$new_order=($order_type=='asc'?'desc':'asc');
		$this->table->set_heading('No',
			anchor('TimeLine/appUserList/'.$offset.'/username/'.$new_order,'Username'),
			anchor('TimeLine/appUserList/'.$offset.'/full_name/'.$new_order,'Full Name'),
			anchor('TimeLine/appUserList/'.$offset.'/email/'.$new_order,'E-mail'),
			anchor('TimeLine/appUserList/'.$offset.'/name_category/'.$new_order,'Division'),
			anchor('TimeLine/appUserList/'.$offset.'/name_role/'.$new_order,'Role'),
			anchor('TimeLine/appUserList/'.$offset.'/is_active/'.$new_order,'Is Active')
		);
		$i=0+$offset;
		foreach ($appUserLoads as $appUserLoad){
			$this->table->add_row(++$i,
			$appUserLoad->username,
			$appUserLoad->full_name,
			$appUserLoad->email,
			$appUserLoad->name_category,
			$appUserLoad->name_role,
			$appUserLoad->is_active,
			anchor('TimeLine/appUserUpdate/'.$appUserLoad->id_user,
			'update',array('class'=>'update')).' '.
			anchor('TimeLine/appUserDelete/'.$appUserLoad->id_user,
			'delete',array('class'=>'delete',
			'onClick'=>"return confirm(
			'Apakah Anda yakin ingin menghapus
			data user?')"))
			);
		}
		$data['table']=$this->table->generate();
		if ($this->uri->segment(3)=='delete_success')
		$data['message']='Data berhasil dihapus';
		else if ($this->uri->segment(3)=='add_success')
		$data['message']='Data berhasil ditambah';
		else
		$data['message']='';
		// load view
		$this->load->view('timeline/appUser/appUserList',$data);
	}

	
	function appUserCreate(){
		// set common properties
		$data['title'] = 'Add new user';
		$data['action'] = site_url('TimeLine/appUserCreate/');
		$data['link_back'] = anchor('TimeLine/appUserList/','Back To User List',array('class'=>'back'));

		$this->_set_rules();

		// run validation
		if ($this->form_validation->run() === FALSE){
			$data['message'] = '';
					// set common properties
			$data['message'] = '';
			$data['user']['id']='';
			$data['user']['username']='';
			$data['user']['password']='';
			$data['user']['full_name']='';
			$data['user']['email']='';
			$data['user']['id_category']='';
			$data['user']['id_role']='';
			$data['user']['is_active']='';
			
			$data['categories'] = $this->AppCategoryModel->getLoadAll()->result();

			$data['link_back'] = anchor('TimeLine/appUserList/','Back To User List',array('class'=>'back'));
			$this->load->view('timeline/appUser/appUserCreate', $data);
		
		}else{
			// save data
			$user = array(
							'username' => $this->input->post('username'),
							'password' => $this->input->post('password'),
							'full_name' => $this->input->post('full_name'),
							'email' => $this->input->post('email'),
							'id_category' => $this->input->post('id_category'),
							'is_active' => $this->input->post('is_active'),
							'id_role' => $this->input->post('id_role')
						);
			$id = $this->AppUserModel->save($user);

			// set form input nama="id"
			$this->validation->id = $id;

			redirect('TimeLine/appUserList/');
			
		}
		
	}

	
	function appUserUpdate($id){
		// set common properties
		$data['title'] = 'Add new user';
		$data['action'] = site_url('TimeLine/appUserUpdate/'.$id.'/');
		$data['link_back'] = anchor('TimeLine/appUserList/','Back To User List',array('class'=>'back'));

		$this->_set_rules();

		// run validation
		if ($this->form_validation->run() === FALSE){
			$data['message'] = '';
			// set common properties
			$data['message'] = '';
			$data['user'] = (array)$this->AppUserModel->getById($id)->row();
			
			$data['categories'] = $this->AppCategoryModel->getLoadAll()->result();

			$data['link_back'] = anchor('TimeLine/appUserList/','Back To User List',array('class'=>'back'));
			$this->load->view('timeline/appUser/appUserUpdate', $data);
		
		}else{
			// update data
			$user = array(
							'username' => $this->input->post('username'),
							'password' => $this->input->post('password'),
							'full_name' => $this->input->post('full_name'),
							'email' => $this->input->post('email'),
							'id_category' => $this->input->post('id_category'),
							'is_active' => $this->input->post('is_active'),
							'id_role' => $this->input->post('id_role')
						);
			$id = $this->AppUserModel->update($id,$user);

			// set form input nama="id"
			$this->validation->id = $id;

			redirect('TimeLine/appUserList/');
			
		}
		
	}
	
	// validation rules
	function _set_rules(){
			
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		$this->form_validation->set_rules('full_name', 'Full Name', 'required|trim');
		$this->form_validation->set_rules('email', 'E-mail', 'required');
		$this->form_validation->set_rules('id_category', 'Category Division', 'required');
		$this->form_validation->set_rules('id_role', 'Role', 'required');
		$this->form_validation->set_rules('is_active', 'Is Active', 'required');

	}

	function appUserDelete($id){
		// delete user
		$this->AppUserModel->delete($id);
		// redirect to user list page
		redirect('TimeLine/appUserList/');
	}
	
}

/* End of file TimeLine.php */
/* Location: ./application/controllers/TimeLine.php */