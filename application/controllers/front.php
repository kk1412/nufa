<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Front extends CI_Controller {

	public $user_management = "User Management";
	public $education_management = "Education Management";
	public $content_management = "Content Management";
	public $admin = "Administrator";
	public $head_master = "Kepala Sekolah";
	public $teacher = "Guru";
	public $student = "Murid";
	public $school_year = "Tahun Ajaran";
	public $classes = "Kelas";
	

	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->library('template');
		$this->load->library('method');
		$this->load->model('mdl_common','',TRUE);
		$this->load->model('mdl_content','',TRUE);
		$this->load->model('mdl_admin','',TRUE);
		$this->load->model('mdl_head_master','',TRUE);
		$this->load->model('mdl_function','',TRUE);
		$this->load->model('mdl_teacher','',TRUE);
		$this->load->model('mdl_student','',TRUE);
		$this->load->model('mdl_class','',TRUE);
		$this->load->model('mdl_education','',TRUE);
		$this->load->model('mdl_grade','',TRUE);
		$this->load->model('mdl_login','',TRUE);
		$this->load->model('mdl_comment','',TRUE);
		$this->load->model('mdl_picture','',TRUE);
		$this->load->model('mdl_review','',TRUE);
		$this->load->model('mdl_alumnus','',TRUE);
		
	}
	
	public function login() {
		// path directory
		$data['dir'] = $this->get_dir();
		$data['dir_js'] = $this->get_dir_js();
		$data['dir_css'] = $this->get_dir_css();
		$data['dir_images'] = $this->get_dir_images();
		$data['dir_images_thumbs'] = $this->get_dir_images_thumbs();
		$data['dir_uploads_thumbs'] = $this->get_dir_uploads_thumbs();
		$data['dir_uploads'] = $this->get_upload_path();
		// common data
		$data['controller'] = "front";
		$data['url_suffix'] = ".do";
		// data view
		$data['dir_uploads'] = $this->get_upload_path();
		$data['_menu'] = $this->admin;
		$data['_sub_menu'] = $this->content_management;
		$data['_title'] = "Login";
		$data['_org'] = "SMPIT Nurul Fajar";
		$this->session->unset_userdata();
		$this->form_validation->set_rules('email', 'E-mail', 'trim|required|min_length[5]|max_length[50]|xss_clean|valid_email|callback_email_check');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[50]|xss_clean|callback_password_check[email]');
		if(isset($_POST['do']) && $this->form_validation->run() == TRUE) {
			$dataRecord['email'] = $_POST['email'];
			$dataLogins = $this->mdl_login->email_check($dataRecord['email']);
			foreach($dataLogins as $dataLogin) {
				foreach($dataLogins as $dataLogin) {
					$this->session->set_userdata(array(
					'id_user_front' => $dataLogin->id_user,
					'id_class_front' => $dataLogin->id_class,
					'id_city_front' => $dataLogin->id_city,
					'id_ruser_front' => $dataLogin->id_ruser,
					'is_auser_front' => $dataLogin->is_auser,
					'id_picture_front' => $dataLogin->id_picture,
					'password_front' => $dataLogin->password,
					'email_front' => $dataLogin->email,
					'full_name_front' => $dataLogin->full_name,
					'picture_user_front' => $dataLogin->picture_user,
					'parent_name_front' => $dataLogin->parent_name,
					'no_jenjang_front' => $dataLogin->no_jenjang,
					'nis_front' => $dataLogin->nis,
					'nisn_front' => $dataLogin->nisn,
					'nip_front' => $dataLogin->nip,
					'gender_front' => $dataLogin->gender,
					'born_date_front' => $dataLogin->born_date,
					'desc_user_front' => $dataLogin->desc_user,
					'cd_user_front' => $dataLogin->cd_user,
					'is_login_front' => TRUE
					));
					$this->mdl_login->update($dataLogin->id_user);
				}
				redirect("$data[controller]/index");
			}
		}
		$this->template->frontendContentOnly('content/common/login', $data);
	}
	
	public function logout() {
		$data['controller'] = "front";
		$this->session->sess_destroy();
		redirect("$data[controller]/login");
	}
	
	public function email_check($email) {
		$emails = $this->mdl_login->email_check($email);
		foreach($emails as $email) {
			if($email->id_ruser != 4) {
				$this->form_validation->set_message('email_check', "You'r prohibited to login");
				return FALSE;
			}
		}
		if(sizeof($emails) == 0) {
			$this->form_validation->set_message('email_check', "Your %s is not registered");
			return FALSE;
		}
		else {
			return TRUE;
		}
	}
	
	
	public function password_check($passwd, $email) {
		$email = $_POST["$email"];
		$passwords = $this->mdl_login->get_password($email);
		$passwords = $this->encrypt->decode($passwords);
		if($passwords != $passwd) {
			$this->form_validation->set_message('password_check', "Your %s is not match");
			return FALSE;
		}
		else {
			return TRUE;
		}
	}

	public function index() {
		// path directory
		$data['dir'] = $this->get_dir();
		$data['dir_js'] = $this->get_dir_js();
		$data['dir_css'] = $this->get_dir_css();
		$data['dir_images'] = $this->get_dir_images();
		$data['dir_images_thumbs'] = $this->get_dir_images_thumbs();
		$data['dir_uploads_thumbs'] = $this->get_dir_uploads_thumbs();
		$data['dir_uploads'] = $this->get_upload_path();
		// common data
		$data['controller'] = "front";
		$data['url_suffix'] = ".do";
		// data view
		$data['dir_uploads'] = $this->get_upload_path();
		$data['_menu'] = $this->admin;
		$data['_sub_menu'] = $this->content_management;
		$data['_title'] = "Home";
		$data['_title_content'] = "Daftar " . $data['_title'];
		$data['_org'] = "SMPIT Nurul Fajar";
		$display = "index";
		// database
		$this->mdl_review->save($this->method->month_year(), 2);
		$data['our_contacts'] = $this->mdl_comment->rcomment_records(2)->result();
		$data['sliders'] = $this->mdl_picture->zero_true_records()->result();
		$data['historys'] = $this->mdl_content->history_records()->result();
		$data['visionAndMissions'] = $this->mdl_content->visionAndMission_records()->result();
		$data['events'] = $this->mdl_content->limit_event_records(0,4)->result();
		$data['aspirations'] = $this->mdl_comment->aspiration_records(1)->result();
		$data['newses'] = $this->mdl_content->news_records()->result();
		$data['notifications'] = $this->mdl_content->notification_records()->result();
		$data['articles'] = $this->mdl_content->article_records()->result();
		$data['notifications'] = $this->mdl_content->notification_records(0,10)->result();
		$data['all_contents'] = $this->mdl_content->all_records(0,7)->result();
		$data['facilitys'] = $this->mdl_content->facility_records(0,7)->result();
		$data['achievements'] = $this->mdl_content->achievement_records(0,7)->result();
		$data['diamondWords'] = $this->mdl_comment->diamondWord_records(1)->result();
		$this->template->frontendCHF('content/home/'.$display, $data);
	}

	public function history() {
		// path directory
		$data['dir'] = $this->get_dir();
		$data['dir_js'] = $this->get_dir_js();
		$data['dir_css'] = $this->get_dir_css();
		$data['dir_images'] = $this->get_dir_images();
		$data['dir_images_thumbs'] = $this->get_dir_images_thumbs();
		$data['dir_uploads_thumbs'] = $this->get_dir_uploads_thumbs();
		$data['dir_uploads'] = $this->get_upload_path();
		// common data
		$data['controller'] = "front";
		$data['url_suffix'] = ".do";
		// data view
		$data['dir_uploads'] = $this->get_upload_path();
		$data['_menu'] = $this->admin;
		$data['_sub_menu'] = $this->content_management;
		$data['_title'] = "Sejarah";
		$data['_title_content'] = "Daftar " . $data['_title'];
		$data['_org'] = "SMPIT Nurul Fajar";
		$display = "history";
		// database
		$this->mdl_review->save($this->method->month_year(), 2);
		$data['our_contacts'] = $this->mdl_comment->rcomment_records(2)->result();
		$data['sliders'] = $this->mdl_picture->zero_true_records()->result();
		$data['visionAndMissions'] = $this->mdl_content->visionAndMission_records()->result();
		$data['events'] = $this->mdl_content->limit_event_records()->result();
		$data['aspirations'] = $this->mdl_comment->aspiration_records(1)->result();
		$data['diamondWords'] = $this->mdl_comment->diamondWord_records(1)->result();
		$data['historys'] = $this->mdl_content->history_records()->result();
		$data['newses'] = $this->mdl_content->news_records()->result();
		$data['notifications'] = $this->mdl_content->notification_records()->result();
		$data['all_contents'] = $this->mdl_content->all_records(0,7)->result();
		$this->template->frontendCHTRF('content/profile/'.$display, $data);
	}

	public function visionAndMision() {
		// path directory
		$data['dir'] = $this->get_dir();
		$data['dir_js'] = $this->get_dir_js();
		$data['dir_css'] = $this->get_dir_css();
		$data['dir_images'] = $this->get_dir_images();
		$data['dir_images_thumbs'] = $this->get_dir_images_thumbs();
		$data['dir_uploads_thumbs'] = $this->get_dir_uploads_thumbs();
		$data['dir_uploads'] = $this->get_upload_path();
		// common data
		$data['controller'] = "front";
		$data['url_suffix'] = ".do";
		// data view
		$data['dir_uploads'] = $this->get_upload_path();
		$data['_menu'] = $this->admin;
		$data['_sub_menu'] = $this->content_management;
		$data['_title'] = "Visi Dan Misi";
		$data['_title_content'] = "Daftar " . $data['_title'];
		$data['_org'] = "SMPIT Nurul Fajar";
		$display = "visionAndMision";
		// database
		$this->mdl_review->save($this->method->month_year(), 2);
		$data['our_contacts'] = $this->mdl_comment->rcomment_records(2)->result();
		$data['sliders'] = $this->mdl_picture->zero_true_records()->result();
		$data['historys'] = $this->mdl_content->history_records()->result();
		$data['visionAndMissions'] = $this->mdl_content->visionAndMission_records()->result();
		$data['events'] = $this->mdl_content->limit_event_records(0,4)->result();
		$data['aspirations'] = $this->mdl_comment->aspiration_records(1)->result();
		$data['diamondWords'] = $this->mdl_comment->diamondWord_records(1)->result();
		$data['newses'] = $this->mdl_content->news_records()->result();
		$data['notifications'] = $this->mdl_content->notification_records()->result();
		$data['all_contents'] = $this->mdl_content->all_records(0,7)->result();
		$this->template->frontendCHTRF('content/profile/'.$display, $data);
	}

	public function archieves() {
		// path directory
		$data['dir'] = $this->get_dir();
		$data['dir_js'] = $this->get_dir_js();
		$data['dir_css'] = $this->get_dir_css();
		$data['dir_images'] = $this->get_dir_images();
		$data['dir_images_thumbs'] = $this->get_dir_images_thumbs();
		$data['dir_uploads_thumbs'] = $this->get_dir_uploads_thumbs();
		$data['dir_uploads'] = $this->get_upload_path();
		// common data
		$data['dir_uploads'] = $this->get_upload_path();
		$data['controller'] = "front";
		$data['url_suffix'] = ".do";
		$data['filter'] = $this->uri->segment(4);
		$data['thumb_image'] = "$data[dir_uploads]/thumbs/thumb_";
		$data['image'] = "$data[dir_uploads]/";
		// data view
		$data['_menu'] = $this->admin;
		$data['_sub_menu'] = $this->content_management;
		$data['_title'] = "Archieves";
		$data['_title_content'] = "Daftar " . $data['_title'];
		$data['_org'] = "SMPIT Nurul Fajar";
		$display = "archieves";
		// database
		$this->mdl_review->save($this->method->month_year(), 2);
		$data['our_contacts'] = $this->mdl_comment->rcomment_records(2)->result();
		$data['sliders'] = $this->mdl_picture->zero_true_records()->result();
		$data['historys'] = $this->mdl_content->history_records()->result();
		$data['visionAndMissions'] = $this->mdl_content->visionAndMission_records()->result();
		$data['events'] = $this->mdl_content->event_records()->result();
		$data['aspirations'] = $this->mdl_comment->aspiration_records(1)->result();
		$data['diamondWords'] = $this->mdl_comment->diamondWord_records(1)->result();
		$data['newses'] = $this->mdl_content->news_records()->result();
		$data['facilitys'] = $this->mdl_content->facility_records()->result();
		$data['archieve_all_records'] = $this->mdl_content->archieve_all_records()->result();
		$data['right_special_records'] = $this->mdl_content->archieve_all_records()->result();
		$data['notifications'] = $this->mdl_content->notification_records()->result();
		$data['all_contents'] = $this->mdl_content->all_records(0,7)->result();
		$data['archieves'] = $this->mdl_content->archieve_filter_records(null,null,false,"")->result();
		if($this->uri->segment(3) == "date" && $data['filter'] != null) {
			$data['archieves'] = $this->mdl_content->archieve_filter_records(null,null,false,$this->uri->segment(4))->result();
		}
		if(isset($_GET['search'])) {
			$data['archieves'] = $this->mdl_content->filter_all_records($this->uri->segment(2),$_GET['search'])->result();
		}
		$this->template->frontendCHTRF('content/profile/'.$display, $data);
	}

	public function facilitys() {
		// path directory
		$data['dir'] = $this->get_dir();
		$data['dir_js'] = $this->get_dir_js();
		$data['dir_css'] = $this->get_dir_css();
		$data['dir_images'] = $this->get_dir_images();
		$data['dir_images_thumbs'] = $this->get_dir_images_thumbs();
		$data['dir_uploads_thumbs'] = $this->get_dir_uploads_thumbs();
		$data['dir_uploads'] = $this->get_upload_path();
		// common data
		$data['controller'] = "front";
		$data['url_suffix'] = ".do";
		$data['id_content'] = $this->uri->segment(3);
		$data['filter'] = $this->uri->segment(4);
		$data['thumb_image'] = "$data[dir_uploads]/thumbs/thumb_";
		$data['image'] = "$data[dir_uploads]/";
		// data view
		$data['_menu'] = $this->admin;
		$data['_sub_menu'] = $this->content_management;
		$data['_title'] = "Fasilitas";
		$data['_title_content'] = "Daftar " . $data['_title'];
		$data['_org'] = "SMPIT Nurul Fajar";
		$display = "facilitys";
		// get data view
		$dataRecord['id_user'] = $this->input->post("id_user");
		$dataRecord['id_content'] = $this->input->post("id_content");
		$dataRecord['author_comment'] = $this->input->post("author_comment");
		$dataRecord['email_comment'] = $this->input->post("email_comment");
		$dataRecord['desc_comment'] = $this->input->post("desc_comment");
		$dataRecord['parent_comment'] = $this->uri->segment(4);
		if($dataRecord['parent_comment'] == null) $dataRecord['parent_comment'] = "0";
		// database
		$this->mdl_review->save($this->method->month_year(), 2);
		$data['our_contacts'] = $this->mdl_comment->rcomment_records(2)->result();
		$data['sliders'] = $this->mdl_picture->zero_true_records()->result();
		$data['historys'] = $this->mdl_content->history_records()->result();
		$data['visionAndMissions'] = $this->mdl_content->visionAndMission_records()->result();
		$data['events'] = $this->mdl_content->event_records()->result();
		$data['aspirations'] = $this->mdl_comment->aspiration_records(1)->result();
		$data['diamondWords'] = $this->mdl_comment->diamondWord_records(1)->result();
		$data['newses'] = $this->mdl_content->news_records()->result();
		$data['facilitys'] = $this->mdl_content->facility_records()->result();
		$data['archieve_all_records'] = $this->mdl_content->archieve_all_records()->result();
		$data['right_special_records'] = $this->mdl_content->filter_all_records($this->uri->segment(2))->result();
		$data['notifications'] = $this->mdl_content->notification_records()->result();
		$data['all_contents'] = $this->mdl_content->all_records(0,7)->result();
		if($data['id_content'] != null && $data['filter'] != null && strlen($data['filter']) == 7) {
			$data['facilitys'] = $this->mdl_content->filter_all_records($this->uri->segment(2), $this->uri->segment(4))->result();
		}
		else if($data['id_content'] != null) {
			$display = "facilitysRead";
			$data['facilitys_nps'] = $this->mdl_content->facility_records()->result();
			$data['facilitys'] = $this->mdl_content->facility_record($data['id_content'])->result();
			foreach($data['facilitys'] as $title):$data['_title'] = $title->name_content;endforeach;
			$data['comments'] = $this->mdl_comment->id_content_records($data['id_content'])->result();
			$data['count_comments'] = $this->mdl_comment->count_id_content_records($data['id_content']);
		}
		$this->form_validation->set_rules('author_comment', 'Name', 'trim|required|min_length[5]|max_length[50]|xss_clean|');
		$this->form_validation->set_rules('email_comment', 'Email', 'trim|required|min_length[5]|max_length[50]|xss_clean|valid_email');
		$this->form_validation->set_rules('desc_comment', 'Description', 'trim|required|max_length[10000]|xss_clean|');
		if(isset($_POST['do'])) {
			if($this->form_validation->run() == TRUE) {
				$this->mdl_comment->save($dataRecord, 10);
				redirect("$data[controller]/facilitys/$dataRecord[id_content]");
			}
		}
		if(isset($_GET['search'])) {
			$data['facilitys'] = $this->mdl_content->filter_all_records($this->uri->segment(2),$_GET['search'])->result();
		}
		$this->template->frontendCHTRF('content/profile/'.$display, $data);
	}

	public function achievements() {
		// path directory
		$data['dir'] = $this->get_dir();
		$data['dir_js'] = $this->get_dir_js();
		$data['dir_css'] = $this->get_dir_css();
		$data['dir_images'] = $this->get_dir_images();
		$data['dir_images_thumbs'] = $this->get_dir_images_thumbs();
		$data['dir_uploads_thumbs'] = $this->get_dir_uploads_thumbs();
		$data['dir_uploads'] = $this->get_upload_path();
		// common data
		$data['controller'] = "front";
		$data['url_suffix'] = ".do";
		$data['id_content'] = $this->uri->segment(3);
		$data['filter'] = $this->uri->segment(4);
		$data['thumb_image'] = "$data[dir_uploads]/thumbs/thumb_";
		$data['image'] = "$data[dir_uploads]/";
		// data view
		$data['_menu'] = $this->admin;
		$data['_sub_menu'] = $this->content_management;
		$data['_title'] = "Fasilitas";
		$data['_title_content'] = "Daftar " . $data['_title'];
		$data['_org'] = "SMPIT Nurul Fajar";
		$display = "achievements";
		// get data view
		$dataRecord['id_user'] = $this->input->post("id_user");
		$dataRecord['id_content'] = $this->input->post("id_content");
		$dataRecord['author_comment'] = $this->input->post("author_comment");
		$dataRecord['email_comment'] = $this->input->post("email_comment");
		$dataRecord['desc_comment'] = $this->input->post("desc_comment");
		$dataRecord['parent_comment'] = $this->uri->segment(4);
		if($dataRecord['parent_comment'] == null) $dataRecord['parent_comment'] = "0";
		// database
		$this->mdl_review->save($this->method->month_year(), 2);
		$data['our_contacts'] = $this->mdl_comment->rcomment_records(2)->result();
		$data['sliders'] = $this->mdl_picture->zero_true_records()->result();
		$data['historys'] = $this->mdl_content->history_records()->result();
		$data['visionAndMissions'] = $this->mdl_content->visionAndMission_records()->result();
		$data['events'] = $this->mdl_content->event_records()->result();
		$data['aspirations'] = $this->mdl_comment->aspiration_records(1)->result();
		$data['diamondWords'] = $this->mdl_comment->diamondWord_records(1)->result();
		$data['newses'] = $this->mdl_content->news_records()->result();
		$data['achievements'] = $this->mdl_content->achievement_records()->result();
		$data['archieve_all_records'] = $this->mdl_content->archieve_all_records()->result();
		$data['right_special_records'] = $this->mdl_content->filter_all_records($this->uri->segment(2))->result();
		$data['notifications'] = $this->mdl_content->notification_records()->result();
		$data['all_contents'] = $this->mdl_content->all_records(0,7)->result();
		if($data['id_content'] != null && $data['filter'] != null && strlen($data['filter']) == 7) {
			$data['achievements'] = $this->mdl_content->filter_all_records($this->uri->segment(2), $this->uri->segment(4))->result();
		}
		else if($data['id_content'] != null) {
			$display = "achievementsRead";
			$data['achievements_nps'] = $this->mdl_content->achievement_records()->result();
			$data['achievements'] = $this->mdl_content->achievement_record($data['id_content'])->result();
			foreach($data['achievements'] as $title):$data['_title'] = $title->name_content;endforeach;
			$data['comments'] = $this->mdl_comment->id_content_records($data['id_content'])->result();
			$data['count_comments'] = $this->mdl_comment->count_id_content_records($data['id_content']);
		}
		$this->form_validation->set_rules('author_comment', 'Name', 'trim|required|min_length[5]|max_length[50]|xss_clean|');
		$this->form_validation->set_rules('email_comment', 'Email', 'trim|required|min_length[5]|max_length[50]|xss_clean|valid_email');
		$this->form_validation->set_rules('desc_comment', 'Description', 'trim|required|max_length[10000]|xss_clean|');
		if(isset($_POST['do'])) {
			if($this->form_validation->run() == TRUE) {
				$this->mdl_comment->save($dataRecord, 10);
				redirect("$data[controller]/achievements/$dataRecord[id_content]");
			}
		}
		if(isset($_GET['search'])) {
			$data['achievements'] = $this->mdl_content->filter_all_records($this->uri->segment(2),$_GET['search'])->result();
		}
		$this->template->frontendCHTRF('content/profile/'.$display, $data);
	}

	public function notifications() {
		// path directory
		$data['dir'] = $this->get_dir();
		$data['dir_js'] = $this->get_dir_js();
		$data['dir_css'] = $this->get_dir_css();
		$data['dir_images'] = $this->get_dir_images();
		$data['dir_images_thumbs'] = $this->get_dir_images_thumbs();
		$data['dir_uploads_thumbs'] = $this->get_dir_uploads_thumbs();
		$data['dir_uploads'] = $this->get_upload_path();
		// common data
		$data['controller'] = "front";
		$data['url_suffix'] = ".do";
		$data['id_content'] = $this->uri->segment(3);
		$data['filter'] = $this->uri->segment(4);
		$data['thumb_image'] = "$data[dir_uploads]/thumbs/thumb_";
		$data['image'] = "$data[dir_uploads]/";
		// data view
		$data['_menu'] = $this->admin;
		$data['_sub_menu'] = $this->content_management;
		$data['_title'] = "Fasilitas";
		$data['_title_content'] = "Daftar " . $data['_title'];
		$data['_org'] = "SMPIT Nurul Fajar";
		$display = "notifications";
		// get data view
		$dataRecord['id_user'] = $this->input->post("id_user");
		$dataRecord['id_content'] = $this->input->post("id_content");
		$dataRecord['author_comment'] = $this->input->post("author_comment");
		$dataRecord['email_comment'] = $this->input->post("email_comment");
		$dataRecord['desc_comment'] = $this->input->post("desc_comment");
		$dataRecord['parent_comment'] = $this->uri->segment(4);
		if($dataRecord['parent_comment'] == null) $dataRecord['parent_comment'] = "0";
		// database
		$this->mdl_review->save($this->method->month_year(), 2);
		$data['our_contacts'] = $this->mdl_comment->rcomment_records(2)->result();
		$data['sliders'] = $this->mdl_picture->zero_true_records()->result();
		$data['historys'] = $this->mdl_content->history_records()->result();
		$data['visionAndMissions'] = $this->mdl_content->visionAndMission_records()->result();
		$data['events'] = $this->mdl_content->event_records()->result();
		$data['aspirations'] = $this->mdl_comment->aspiration_records(1)->result();
		$data['diamondWords'] = $this->mdl_comment->diamondWord_records(1)->result();
		$data['newses'] = $this->mdl_content->news_records()->result();
		$data['notifications'] = $this->mdl_content->notification_records()->result();
		$data['archieve_all_records'] = $this->mdl_content->archieve_all_records()->result();
		$data['right_special_records'] = $this->mdl_content->filter_all_records($this->uri->segment(2))->result();
		$data['all_contents'] = $this->mdl_content->all_records(0,7)->result();
		if($data['id_content'] != null && $data['filter'] != null && strlen($data['filter']) == 7) {
			$data['notifications'] = $this->mdl_content->filter_all_records($this->uri->segment(2), $this->uri->segment(4))->result();
		}
		else if($data['id_content'] != null) {
			$display = "notificationsRead";
			$data['notifications_nps'] = $this->mdl_content->notification_records()->result();
			$data['notifications'] = $this->mdl_content->notification_record($data['id_content'])->result();
			foreach($data['notifications'] as $title):$data['_title'] = $title->name_content;endforeach;
			$data['comments'] = $this->mdl_comment->id_content_records($data['id_content'])->result();
			$data['count_comments'] = $this->mdl_comment->count_id_content_records($data['id_content']);
		}
		$this->form_validation->set_rules('author_comment', 'Name', 'trim|required|min_length[5]|max_length[50]|xss_clean|');
		$this->form_validation->set_rules('email_comment', 'Email', 'trim|required|min_length[5]|max_length[50]|xss_clean|valid_email');
		$this->form_validation->set_rules('desc_comment', 'Description', 'trim|required|max_length[10000]|xss_clean|');
		if(isset($_POST['do'])) {
			if($this->form_validation->run() == TRUE) {
				$this->mdl_comment->save($dataRecord, 10);
				redirect("$data[controller]/notifications/$dataRecord[id_content]");
			}
		}
		if(isset($_GET['search'])) {
			$data['notifications'] = $this->mdl_content->filter_all_records($this->uri->segment(2),$_GET['search'])->result();
		}
		$this->template->frontendCHTRF('content/profile/'.$display, $data);
	}

	public function newses() {
		// path directory
		$data['dir'] = $this->get_dir();
		$data['dir_js'] = $this->get_dir_js();
		$data['dir_css'] = $this->get_dir_css();
		$data['dir_images'] = $this->get_dir_images();
		$data['dir_images_thumbs'] = $this->get_dir_images_thumbs();
		$data['dir_uploads_thumbs'] = $this->get_dir_uploads_thumbs();
		$data['dir_uploads'] = $this->get_upload_path();
		// common data
		$data['controller'] = "front";
		$data['url_suffix'] = ".do";
		$data['id_content'] = $this->uri->segment(3);
		$data['filter'] = $this->uri->segment(4);
		$data['thumb_image'] = "$data[dir_uploads]/thumbs/thumb_";
		$data['image'] = "$data[dir_uploads]/";
		// data view
		$data['_menu'] = $this->admin;
		$data['_sub_menu'] = $this->content_management;
		$data['_title'] = "Fasilitas";
		$data['_title_content'] = "Daftar " . $data['_title'];
		$data['_org'] = "SMPIT Nurul Fajar";
		$display = "newses";
		// get data view
		$dataRecord['id_user'] = $this->input->post("id_user");
		$dataRecord['id_content'] = $this->input->post("id_content");
		$dataRecord['author_comment'] = $this->input->post("author_comment");
		$dataRecord['email_comment'] = $this->input->post("email_comment");
		$dataRecord['desc_comment'] = $this->input->post("desc_comment");
		$dataRecord['parent_comment'] = $this->uri->segment(4);
		if($dataRecord['parent_comment'] == null) $dataRecord['parent_comment'] = "0";
		// database
		$this->mdl_review->save($this->method->month_year(), 2);
		$data['our_contacts'] = $this->mdl_comment->rcomment_records(2)->result();
		$data['sliders'] = $this->mdl_picture->zero_true_records()->result();
		$data['historys'] = $this->mdl_content->history_records()->result();
		$data['visionAndMissions'] = $this->mdl_content->visionAndMission_records()->result();
		$data['events'] = $this->mdl_content->event_records()->result();
		$data['aspirations'] = $this->mdl_comment->aspiration_records(1)->result();
		$data['diamondWords'] = $this->mdl_comment->diamondWord_records(1)->result();
		$data['newses'] = $this->mdl_content->news_records()->result();
		$data['newses'] = $this->mdl_content->news_records()->result();
		$data['archieve_all_records'] = $this->mdl_content->archieve_all_records()->result();
		$data['right_special_records'] = $this->mdl_content->filter_all_records($this->uri->segment(2))->result();
		$data['notifications'] = $this->mdl_content->notification_records()->result();
		$data['all_contents'] = $this->mdl_content->all_records(0,7)->result();
		if($data['id_content'] != null && $data['filter'] != null && strlen($data['filter']) == 7) {
			$data['newses'] = $this->mdl_content->filter_all_records($this->uri->segment(2), $this->uri->segment(4))->result();
		}
		else if($data['id_content'] != null) {
			$display = "newsesRead";
			$data['newses_nps'] = $this->mdl_content->news_records()->result();
			$data['newses'] = $this->mdl_content->news_record($data['id_content'])->result();
			foreach($data['newses'] as $title):$data['_title'] = $title->name_content;endforeach;
			$data['comments'] = $this->mdl_comment->id_content_records($data['id_content'])->result();
			$data['count_comments'] = $this->mdl_comment->count_id_content_records($data['id_content']);
		}
		$this->form_validation->set_rules('author_comment', 'Name', 'trim|required|min_length[5]|max_length[50]|xss_clean|');
		$this->form_validation->set_rules('email_comment', 'Email', 'trim|required|min_length[5]|max_length[50]|xss_clean|valid_email');
		$this->form_validation->set_rules('desc_comment', 'Description', 'trim|required|max_length[10000]|xss_clean|');
		if(isset($_POST['do'])) {
			if($this->form_validation->run() == TRUE) {
				$this->mdl_comment->save($dataRecord, 10);
				redirect("$data[controller]/newses/$dataRecord[id_content]");
			}
		}
		if(isset($_GET['search'])) {
			$data['newses'] = $this->mdl_content->filter_all_records($this->uri->segment(2),$_GET['search'])->result();
		}
		$this->template->frontendCHTRF('content/profile/'.$display, $data);
	}

	public function events() {
		// path directory
		$data['dir'] = $this->get_dir();
		$data['dir_js'] = $this->get_dir_js();
		$data['dir_css'] = $this->get_dir_css();
		$data['dir_images'] = $this->get_dir_images();
		$data['dir_images_thumbs'] = $this->get_dir_images_thumbs();
		$data['dir_uploads_thumbs'] = $this->get_dir_uploads_thumbs();
		$data['dir_uploads'] = $this->get_upload_path();
		// common data
		$data['controller'] = "front";
		$data['url_suffix'] = ".do";
		$data['id_content'] = $this->uri->segment(3);
		$data['filter'] = $this->uri->segment(4);
		$data['thumb_image'] = "$data[dir_uploads]/thumbs/thumb_";
		$data['image'] = "$data[dir_uploads]/";
		// data view
		$data['_menu'] = $this->admin;
		$data['_sub_menu'] = $this->content_management;
		$data['_title'] = "Fasilitas";
		$data['_title_content'] = "Daftar " . $data['_title'];
		$data['_org'] = "SMPIT Nurul Fajar";
		$display = "events";
		// get data view
		$dataRecord['id_user'] = $this->input->post("id_user");
		$dataRecord['id_content'] = $this->input->post("id_content");
		$dataRecord['author_comment'] = $this->input->post("author_comment");
		$dataRecord['email_comment'] = $this->input->post("email_comment");
		$dataRecord['desc_comment'] = $this->input->post("desc_comment");
		$dataRecord['parent_comment'] = $this->uri->segment(4);
		if($dataRecord['parent_comment'] == null) $dataRecord['parent_comment'] = "0";
		// database
		$this->mdl_review->save($this->method->month_year(), 2);
		$data['our_contacts'] = $this->mdl_comment->rcomment_records(2)->result();
		$data['sliders'] = $this->mdl_picture->zero_true_records()->result();
		$data['historys'] = $this->mdl_content->history_records()->result();
		$data['visionAndMissions'] = $this->mdl_content->visionAndMission_records()->result();
		$data['events'] = $this->mdl_content->event_records()->result();
		$data['aspirations'] = $this->mdl_comment->aspiration_records(1)->result();
		$data['diamondWords'] = $this->mdl_comment->diamondWord_records(1)->result();
		$data['newses'] = $this->mdl_content->news_records()->result();
		$data['events'] = $this->mdl_content->event_records()->result();
		$data['archieve_all_records'] = $this->mdl_content->archieve_all_records()->result();
		$data['right_special_records'] = $this->mdl_content->filter_all_records($this->uri->segment(2))->result();
		$data['all_contents'] = $this->mdl_content->all_records(0,7)->result();
		if($data['id_content'] != null && $data['filter'] != null && strlen($data['filter']) == 7) {
			$data['events'] = $this->mdl_content->filter_all_records($this->uri->segment(2), $this->uri->segment(4))->result();
		}
		else if($data['id_content'] != null) {
			$display = "eventsRead";
			$data['events_nps'] = $this->mdl_content->event_records()->result();
			$data['events'] = $this->mdl_content->event_record($data['id_content'])->result();
			foreach($data['events'] as $title):$data['_title'] = $title->name_content;endforeach;
			$data['comments'] = $this->mdl_comment->id_content_records($data['id_content'])->result();
			$data['count_comments'] = $this->mdl_comment->count_id_content_records($data['id_content']);
		}
		$this->form_validation->set_rules('author_comment', 'Name', 'trim|required|min_length[5]|max_length[50]|xss_clean|');
		$this->form_validation->set_rules('email_comment', 'Email', 'trim|required|min_length[5]|max_length[50]|xss_clean|valid_email');
		$this->form_validation->set_rules('desc_comment', 'Description', 'trim|required|max_length[10000]|xss_clean|');
		if(isset($_POST['do'])) {
			if($this->form_validation->run() == TRUE) {
				$this->mdl_comment->save($dataRecord, 10);
				redirect("$data[controller]/events/$dataRecord[id_content]");
			}
		}
		if(isset($_GET['search'])) {
			$data['events'] = $this->mdl_content->filter_all_records($this->uri->segment(2),$_GET['search'])->result();
		}
		$this->template->frontendCHTRF('content/profile/'.$display, $data);
	}

	public function articles() {
		// path directory
		$data['dir'] = $this->get_dir();
		$data['dir_js'] = $this->get_dir_js();
		$data['dir_css'] = $this->get_dir_css();
		$data['dir_images'] = $this->get_dir_images();
		$data['dir_images_thumbs'] = $this->get_dir_images_thumbs();
		$data['dir_uploads_thumbs'] = $this->get_dir_uploads_thumbs();
		$data['dir_uploads'] = $this->get_upload_path();
		// common data
		$data['controller'] = "front";
		$data['url_suffix'] = ".do";
		$data['id_content'] = $this->uri->segment(3);
		$data['filter'] = $this->uri->segment(4);
		$data['thumb_image'] = "$data[dir_uploads]/thumbs/thumb_";
		$data['image'] = "$data[dir_uploads]/";
		// data view
		$data['_menu'] = $this->admin;
		$data['_sub_menu'] = $this->content_management;
		$data['_title'] = "Fasilitas";
		$data['_title_content'] = "Daftar " . $data['_title'];
		$data['_org'] = "SMPIT Nurul Fajar";
		$display = "articles";
		// get data view
		$dataRecord['id_user'] = $this->input->post("id_user");
		$dataRecord['id_content'] = $this->input->post("id_content");
		$dataRecord['author_comment'] = $this->input->post("author_comment");
		$dataRecord['email_comment'] = $this->input->post("email_comment");
		$dataRecord['desc_comment'] = $this->input->post("desc_comment");
		$dataRecord['parent_comment'] = $this->uri->segment(4);
		if($dataRecord['parent_comment'] == null) $dataRecord['parent_comment'] = "0";
		// database
		$this->mdl_review->save($this->method->month_year(), 2);
		$data['our_contacts'] = $this->mdl_comment->rcomment_records(2)->result();
		$data['sliders'] = $this->mdl_picture->zero_true_records()->result();
		$data['historys'] = $this->mdl_content->history_records()->result();
		$data['visionAndMissions'] = $this->mdl_content->visionAndMission_records()->result();
		$data['events'] = $this->mdl_content->event_records()->result();
		$data['aspirations'] = $this->mdl_comment->aspiration_records(1)->result();
		$data['diamondWords'] = $this->mdl_comment->diamondWord_records(1)->result();
		$data['newses'] = $this->mdl_content->news_records()->result();
		$data['articles'] = $this->mdl_content->article_records()->result();
		$data['archieve_all_records'] = $this->mdl_content->archieve_all_records()->result();
		$data['right_special_records'] = $this->mdl_content->filter_all_records($this->uri->segment(2))->result();
		$data['all_contents'] = $this->mdl_content->all_records(0,7)->result();
		if($data['id_content'] != null && $data['filter'] != null && strlen($data['filter']) == 7) {
			$data['articles'] = $this->mdl_content->filter_all_records($this->uri->segment(2), $this->uri->segment(4))->result();
		}
		else if($data['id_content'] != null) {
			$display = "articlesRead";
			$data['articles_nps'] = $this->mdl_content->article_records()->result();
			$data['articles'] = $this->mdl_content->article_record($data['id_content'])->result();
			foreach($data['articles'] as $title):$data['_title'] = $title->name_content;endforeach;
			$data['comments'] = $this->mdl_comment->id_content_records($data['id_content'])->result();
			$data['count_comments'] = $this->mdl_comment->count_id_content_records($data['id_content']);
		}
		$this->form_validation->set_rules('author_comment', 'Name', 'trim|required|min_length[5]|max_length[50]|xss_clean|');
		$this->form_validation->set_rules('email_comment', 'Email', 'trim|required|min_length[5]|max_length[50]|xss_clean|valid_email');
		$this->form_validation->set_rules('desc_comment', 'Description', 'trim|required|max_length[10000]|xss_clean|');
		if(isset($_POST['do'])) {
			if($this->form_validation->run() == TRUE) {
				$this->mdl_comment->save($dataRecord, 10);
				redirect("$data[controller]/articles/$dataRecord[id_content]");
			}
		}
		if(isset($_GET['search'])) {
			$data['articles'] = $this->mdl_content->filter_all_records($this->uri->segment(2),$_GET['search'])->result();
		}
		$this->template->frontendCHTRF('content/profile/'.$display, $data);
	}

	public function contact() {
		// path directory
		$data['dir'] = $this->get_dir();
		$data['dir_js'] = $this->get_dir_js();
		$data['dir_css'] = $this->get_dir_css();
		$data['dir_images'] = $this->get_dir_images();
		$data['dir_images_thumbs'] = $this->get_dir_images_thumbs();
		$data['dir_uploads_thumbs'] = $this->get_dir_uploads_thumbs();
		$data['dir_uploads'] = $this->get_upload_path();
		// common data
		$data['controller'] = "front";
		$data['url_suffix'] = ".do";
		// data view
		$data['dir_uploads'] = $this->get_upload_path();
		$data['_menu'] = $this->admin;
		$data['_sub_menu'] = $this->content_management;
		$data['_title'] = "Contact";
		$data['_title_content'] = "Daftar " . $data['_title'];
		$data['_org'] = "SMPIT Nurul Fajar";
		$display = "contact";
		// get data view
		$dataRecord['id_user'] = $this->input->post("id_user");
		$dataRecord['id_content'] = $this->input->post("id_content");
		$dataRecord['author_comment'] = $this->input->post("author_comment");
		$dataRecord['phone_comment'] = $this->input->post("phone_comment");
		$dataRecord['email_comment'] = $this->input->post("email_comment");
		$dataRecord['desc_comment'] = $this->input->post("desc_comment");
		$dataRecord['parent_comment'] = $this->uri->segment(4);
		if($dataRecord['parent_comment'] == null) $dataRecord['parent_comment'] = "0";
		// database
		$this->mdl_review->save($this->method->month_year(), 2);
		$data['our_contacts'] = $this->mdl_comment->rcomment_records(2)->result();
		$data['sliders'] = $this->mdl_picture->zero_true_records()->result();
		$data['historys'] = $this->mdl_content->history_records()->result();
		$data['visionAndMissions'] = $this->mdl_content->visionAndMission_records()->result();
		$data['events'] = $this->mdl_content->event_records(1)->result();
		$data['aspirations'] = $this->mdl_comment->aspiration_records(1)->result();
		$data['all_contents'] = $this->mdl_content->all_records(0,7)->result();
		$this->form_validation->set_rules('author_comment', 'Name', 'trim|required|min_length[5]|max_length[50]|xss_clean|');
		$this->form_validation->set_rules('phone_comment', 'Name', 'trim|required|min_length[10]|max_length[20]|xss_clean|');
		$this->form_validation->set_rules('email_comment', 'Email', 'trim|required|min_length[5]|max_length[50]|xss_clean|valid_email');
		$this->form_validation->set_rules('desc_comment', 'Description', 'trim|required|max_length[10000]|xss_clean|');
		if(isset($_POST['do']) && $this->form_validation->run() == TRUE) {
			$this->mdl_comment->contact_save($dataRecord);
			redirect("$data[controller]/contact");
		}
		$this->template->frontendCHF('content/common/'.$display, $data);
	}

	public function updatePassword() {
		// path directory
		$data['dir'] = $this->get_dir();
		$data['dir_js'] = $this->get_dir_js();
		$data['dir_css'] = $this->get_dir_css();
		$data['dir_images'] = $this->get_dir_images();
		$data['dir_images_thumbs'] = $this->get_dir_images_thumbs();
		$data['dir_uploads_thumbs'] = $this->get_dir_uploads_thumbs();
		$data['dir_uploads'] = $this->get_upload_path();
		// common data
		$data['controller'] = "front";
		$data['url_suffix'] = ".do";
		// data view
		$data['dir_uploads'] = $this->get_upload_path();
		$data['_menu'] = $this->admin;
		$data['_sub_menu'] = $this->content_management;
		$data['_title'] = "Update Password";
		$data['_title_content'] = "Daftar " . $data['_title'];
		$data['_org'] = "SMPIT Nurul Fajar";
		$display = "studentUpdatePassword";
		// get data view
		$dataRecord['password'] = $this->encrypt->encode($this->input->post("password"));
		// database
		$this->mdl_review->save($this->method->month_year(), 2);
		$data['classes'] = $this->mdl_class->common_records()->result();
		$data['our_contacts'] = $this->mdl_comment->rcomment_records(2)->result();
		$data['sliders'] = $this->mdl_picture->zero_true_records()->result();
		$data['historys'] = $this->mdl_content->history_records()->result();
		$data['visionAndMissions'] = $this->mdl_content->visionAndMission_records()->result();
		$data['events'] = $this->mdl_content->event_records(1)->result();
		$data['aspirations'] = $this->mdl_comment->aspiration_records(1)->result();
		$data['all_contents'] = $this->mdl_content->all_records(0,7)->result();
		// update student
		$id = $this->session->userdata("id_user_front");
		$data['student_record'] = $this->mdl_student->record($id)->result();
		if(isset($_POST['do'])) {
			$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|min_length[6]|max_length[50]|xss_clean|matches[current_password]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[50]|xss_clean');
			$this->form_validation->set_rules('repeat_password', 'Repeat Password', "trim|required|min_length[6]|max_length[50]|xss_clean|matches[password]");
			if($this->form_validation->run() == TRUE) {
				$this->mdl_student->update_password($id, $dataRecord);
				redirect("$data[controller]/index");
			}
		}
		$this->template->frontendCHF('content/user_profile/'.$display, $data);
	}

	public function updatePicture() {
		// path directory
		$data['dir'] = $this->get_dir();
		$data['dir_js'] = $this->get_dir_js();
		$data['dir_css'] = $this->get_dir_css();
		$data['dir_images'] = $this->get_dir_images();
		$data['dir_images_thumbs'] = $this->get_dir_images_thumbs();
		$data['dir_uploads_thumbs'] = $this->get_dir_uploads_thumbs();
		$data['dir_uploads'] = $this->get_upload_path();
		// common data
		$data['controller'] = "front";
		$data['url_suffix'] = ".do";
		// data view
		$data['dir_uploads'] = $this->get_upload_path();
		$data['_menu'] = $this->admin;
		$data['_sub_menu'] = $this->content_management;
		$data['_title'] = "Update Picture";
		$data['_title_content'] = "Daftar " . $data['_title'];
		$data['_org'] = "SMPIT Nurul Fajar";
		$display = "studentUpdatePicture";
		$data['errorImage'] = null;
		// database
		$this->mdl_review->save($this->method->month_year(), 2);
		$data['classes'] = $this->mdl_class->common_records()->result();
		$data['our_contacts'] = $this->mdl_comment->rcomment_records(2)->result();
		$data['sliders'] = $this->mdl_picture->zero_true_records()->result();
		$data['historys'] = $this->mdl_content->history_records()->result();
		$data['visionAndMissions'] = $this->mdl_content->visionAndMission_records()->result();
		$data['events'] = $this->mdl_content->event_records(1)->result();
		$data['aspirations'] = $this->mdl_comment->aspiration_records(1)->result();
		$data['all_contents'] = $this->mdl_content->all_records(0,7)->result();
		// update student
		$id = $this->session->userdata("id_user_front");
		$data['student_record'] = $this->mdl_student->record($id)->result();
		if(isset($_POST['do'])) {
			$data['errorImage'] = null;
			$dataUploads = $this->mdl_function->do_upload(100, 100);
			$data['errorImage'] = $dataUploads['error'];
			$dataRecord['picture_user'] = $dataUploads['file_name'];
			if($data['errorImage'] == null) {
				$this->mdl_student->update_picture($id, $dataRecord);
				redirect("$data[controller]/index");
			}
		}
		$this->template->frontendCHF('content/user_profile/'.$display, $data);
	}

	public function student() {
		// path directory
		$data['dir'] = $this->get_dir();
		$data['dir_js'] = $this->get_dir_js();
		$data['dir_css'] = $this->get_dir_css();
		$data['dir_images'] = $this->get_dir_images();
		$data['dir_images_thumbs'] = $this->get_dir_images_thumbs();
		$data['dir_uploads_thumbs'] = $this->get_dir_uploads_thumbs();
		$data['dir_uploads'] = $this->get_upload_path();
		// common data
		$data['controller'] = "front";
		$data['url_suffix'] = ".do";
		// data view
		$data['dir_uploads'] = $this->get_upload_path();
		$data['_menu'] = $this->admin;
		$data['_sub_menu'] = $this->content_management;
		$data['_title'] = "Update Picture";
		$data['_title_content'] = "Daftar " . $data['_title'];
		$data['_org'] = "SMPIT Nurul Fajar";
		$display = "studentSemester";
		$data['errorImage'] = null;
		// database
		$this->mdl_review->save($this->method->month_year(), 2);
		$data['classes'] = $this->mdl_class->common_records()->result();
		$data['our_contacts'] = $this->mdl_comment->rcomment_records(2)->result();
		$data['sliders'] = $this->mdl_picture->zero_true_records()->result();
		$data['historys'] = $this->mdl_content->history_records()->result();
		$data['visionAndMissions'] = $this->mdl_content->visionAndMission_records()->result();
		$data['events'] = $this->mdl_content->event_records(1)->result();
		$data['aspirations'] = $this->mdl_comment->aspiration_records(1)->result();
		$data['all_contents'] = $this->mdl_content->all_records(0,7)->result();
		// update student
		$id = $this->session->userdata("id_user_front");
		$data['student_record'] = $this->mdl_student->record($id)->result();
		if($this->uri->segment(3) == "grade" && $this->uri->segment(4) != null) {
			$data['id_user'] = $id;
			$data['id_semester'] = $this->uri->segment(5);
			$data['student_record'] = $this->mdl_student->record($data['id_user'])->result();
			foreach($data['student_record'] as $row) {
				$data['_title'] = "Nilai Semester $data[id_semester] " . $row->full_name;
			}
			$data['education_record'] = $this->mdl_education->user_records($data['id_user'], $data['id_semester'])->result();
			$display = "studentGrade";
		}
		$this->template->frontendCHF('content/user_profile/'.$display, $data);
	}

	public function gallery() {
		// path directory
		$data['dir'] = $this->get_dir();
		$data['dir_js'] = $this->get_dir_js();
		$data['dir_css'] = $this->get_dir_css();
		$data['dir_images'] = $this->get_dir_images();
		$data['dir_images_thumbs'] = $this->get_dir_images_thumbs();
		$data['dir_uploads_thumbs'] = $this->get_dir_uploads_thumbs();
		$data['dir_uploads'] = $this->get_upload_path();
		// common data
		$data['controller'] = "front";
		$data['url_suffix'] = ".do";
		// data view
		$data['dir_uploads'] = $this->get_upload_path();
		$data['thumb_image'] = "$data[dir_uploads]/thumbs/thumb_";
		$data['image'] = "$data[dir_uploads]/";
		$data['_menu'] = $this->admin;
		$data['_sub_menu'] = $this->content_management;
		$data['_title'] = "Gallery";
		$data['_title_content'] = "Daftar " . $data['_title'];
		$data['_org'] = "SMPIT Nurul Fajar";
		$display = "gallery";
		$data['errorImage'] = null;
		// get data view
		$data['id_content'] = $this->uri->segment(4);
		$dataRecord['id_user'] = $this->input->post("id_user");
		$dataRecord['id_content'] = $this->uri->segment(4);
		$dataRecord['author_comment'] = $this->input->post("author_comment");
		$dataRecord['phone_comment'] = $this->input->post("phone_comment");
		$dataRecord['email_comment'] = $this->input->post("email_comment");
		$dataRecord['desc_comment'] = $this->input->post("desc_comment");
		$dataRecord['parent_comment'] = $this->uri->segment(5);
		if($dataRecord['parent_comment'] == null) $dataRecord['parent_comment'] = "0";
		// database
		$data['gallerys'] = $this->mdl_content->gallery_records()->result();
		$this->mdl_review->save($this->method->month_year(), 2);
		$data['classes'] = $this->mdl_class->common_records()->result();
		$data['our_contacts'] = $this->mdl_comment->rcomment_records(2)->result();
		$data['sliders'] = $this->mdl_picture->zero_true_records()->result();
		$data['historys'] = $this->mdl_content->history_records()->result();
		$data['visionAndMissions'] = $this->mdl_content->visionAndMission_records()->result();
		$data['events'] = $this->mdl_content->event_records(1)->result();
		$data['aspirations'] = $this->mdl_comment->aspiration_records(1)->result();
		$data['diamondWords'] = $this->mdl_comment->diamondWord_records(1)->result();
		$data['all_contents'] = $this->mdl_content->all_records(0,7)->result();
		if($this->uri->segment(3) == "picture" && $this->uri->segment(4) != null) {
			$data['_title_content'] = "Gambar";
			$display = "galleryPicture";
			$data['gallerys'] = $this->mdl_content->gallery_record($data['id_content'])->result();
			foreach($data['gallerys'] as $title):$data['_title'] = $title->name_content;endforeach;
			$data['count_comments'] = $this->mdl_comment->count_id_content_records($data['id_content']);
			$data['comments'] = $this->mdl_comment->id_content_records($data['id_content'])->result();
			$data['pictures'] = $this->mdl_picture->id_content_records($data['id_content'])->result();
		}
		$this->form_validation->set_rules('author_comment', 'Name', 'trim|required|min_length[5]|max_length[50]|xss_clean|');
		$this->form_validation->set_rules('email_comment', 'Email', 'trim|required|min_length[5]|max_length[50]|xss_clean|valid_email');
		$this->form_validation->set_rules('desc_comment', 'Description', 'trim|required|max_length[10000]|xss_clean|');
		if(isset($_POST['do'])) {
			if($this->form_validation->run() == TRUE) {
				$this->mdl_comment->save($dataRecord, 8);
				redirect("$data[controller]/gallery/picture/$dataRecord[id_content]");
			}
		}
		$this->template->frontendCHTRF('content/common/'.$display, $data);
	}

	public function organization() {
		// path directory
		$data['dir'] = $this->get_dir();
		$data['dir_js'] = $this->get_dir_js();
		$data['dir_css'] = $this->get_dir_css();
		$data['dir_images'] = $this->get_dir_images();
		$data['dir_images_thumbs'] = $this->get_dir_images_thumbs();
		$data['dir_uploads_thumbs'] = $this->get_dir_uploads_thumbs();
		$data['dir_uploads'] = $this->get_upload_path();
		// common data
		$data['controller'] = "front";
		$data['url_suffix'] = ".do";
		// data view
		$data['dir_uploads'] = $this->get_upload_path();
		$data['_menu'] = $this->admin;
		$data['_sub_menu'] = $this->content_management;
		$data['_title'] = "Organization";
		$data['_title_content'] = "Daftar " . $data['_title'];
		$data['_org'] = "SMPIT Nurul Fajar";
		$display = "organization";
		// database
		$this->mdl_review->save($this->method->month_year(), 2);
		$data['our_contacts'] = $this->mdl_comment->rcomment_records(2)->result();
		$data['id_content'] = $this->uri->segment(3);
		$data['filter'] = $this->uri->segment(4);
		$data['sliders'] = $this->mdl_picture->zero_true_records()->result();
		$data['historys'] = $this->mdl_content->history_records()->result();
		$data['visionAndMissions'] = $this->mdl_content->visionAndMission_records()->result();
		$data['events'] = $this->mdl_content->limit_event_records(0,4)->result();
		$data['aspirations'] = $this->mdl_comment->aspiration_records(1)->result();
		$data['teachers'] = $this->mdl_teacher->records("id_ruser")->result();
		$data['all_contents'] = $this->mdl_content->all_records(0,7)->result();
		$data['diamondWords'] = $this->mdl_comment->diamondWord_records(1)->result();
		if($data['id_content'] != null) {
			$display = "organizationRead";
			$data['teachers'] = $this->mdl_teacher->record($data['id_content'])->result();
			foreach($data['teachers'] as $title):$data['_title'] = $title->full_name;endforeach;
		}
		$this->template->frontendCHTRF('content/common/'.$display, $data);
	}
	// basic directory
	public function get_dir() {
		return "/frontend/";
	}
	// js directory
	public function get_dir_js() {
		return $this->get_dir()."js/";
	}
	// css directory
	public function get_dir_css() {
		return $this->get_dir()."css/";
	}
	// images directory
	public function get_dir_images() {
		return $this->get_dir()."images/";
	}
	// images directory
	public function get_dir_images_thumbs() {
		return $this->get_dir()."images/thumb/thumb_";
	}
	// upload directory
	public function get_upload_path() {
		return "/uploads/";
	}
	// upload directory
	public function get_dir_uploads_thumbs() {
		return "/uploads/thumbs/thumb_";
	}
	
}

/* End of file front.php */
/* Location: ./application/controllers/front.php */
