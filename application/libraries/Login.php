<?php
class Login {
	
	protected $_ci;
	
	private $dataLogin = array();

	function __construct() {
		$this->_ci =&get_instance();
	}
	
	public function setDataLogin($input) {
		$this->dataLogin = $input;
	}
	
	public function getDataLogin() {
		return $this->dataLogin;
	}
	
	public function is_login() {
		if($this->dataLogin == null) {
			redirect("admin/login");
		}
	}
	
}