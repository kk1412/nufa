<?php

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index() {
		$this->load->view('upload_form', array('error' => ' ' ));
	}

	function upload_array_files() {
     $this->load->helper('form');
     // config for all files in array the same
     $config['upload_path'] = './uploads/';
     $config['allowed_types'] = 'jpg|pdf';
     $config['max_size'] = '1000';
     $this->load->library('upload',$config);
          if ( ! $this->upload->do_upload()) {
               $error = array('error' => $this->upload->display_errors());
               $this->load->view('upload_form',$error);
          } else {
               for($i = 0, $t = count($_Files['files']); $i < $t; $i++) {
                    $id = $this->files->add_files($i);
               }
          }
	}

}