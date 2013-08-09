<?php
class Gallery extends CI_Controller {
	
	function index() {
		
		$this->load->model('mdl_function');
		
		if ($this->input->post('upload')) {
			$this->mdl_function->do_upload();
		}
		else {
			echo "gagal";
		}
		
		$data['images'] = $this->mdl_function->get_images();
		
		$this->load->view('gallery', $data);
		
	}
	
}
