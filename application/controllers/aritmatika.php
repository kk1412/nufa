<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aritmatika extends CI_Controller {

	public function index() {
		echo $_POST['mycheck[1]'];
		$data['options'] = array(
                  'kali'	=> 'Kali',
                  'bagi'	=> 'Bagi',
                  'tambah'	=> 'Tambah',
                  'kurang'	=> 'Kurang',
                );
		$this->form_validation->set_rules('v1', 'Variable 1', 'trim|required|min_length[1]|max_length[12]|xss_clean|numeric');
		$this->form_validation->set_rules('v2', 'Variable 2', 'trim|required|min_length[1]|max_length[12]|xss_clean|numeric');
		$data['v1'] = (int)$this->input->post("v1");
		$data['v2'] = (int)$this->input->post("v2");
		$data['op'] = $this->input->post("op");
		$data['hasil'] = 0;
		if($data['op'] == "kali")
		$data['hasil'] = $data['v1'] * $data['v2'];
		if($data['op'] == "bagi") {
			$this->form_validation->set_rules('v2', 'Variable 2', 'trim|required|min_length[1]|max_length[12]|xss_clean|numeric|is_natural_no_zero');
			if($data['op'] != 0) {
				$data['hasil'] = $data['v1'] / $data['v2'];
			}
                }
		if($data['op'] == "tambah")
		$data['hasil'] = $data['v1'] + $data['v2'];
		if($data['op'] == "kurang")
		$data['hasil'] = $data['v1'] - $data['v2'];
                $this->form_validation->run();
		$this->load->view('view_aritmatika', $data);
	}
}

/* End of file aritmatika.php */
/* Location: ./application/controllers/aritmatika.php */

/* 

		
*/