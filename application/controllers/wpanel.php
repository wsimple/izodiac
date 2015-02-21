<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wpanel extends CI_Controller {

	private $data;
	private $main_page;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelContents');
		$this->load->model('WpanelUsers');
		$this->lang->load('login', $this->session->userdata('ws-language'));
		$this->data = array();
		$this->main_page = '7';
	}

	public function index()
	{	
		$this->access();
	}

	public function login($email='',$pass='')
	{ 
		$sign_up = 0;
		if ($email!='' && $pass!=''){
			$user = $this->WpanelUsers->get_user($email, $pass);
			$sign_up = 1;
		}else{
			$user = $this->WpanelUsers->get_user($this->input->post('txtLogin'), $this->input->post('txtPass'));
		}

		if (!is_object($user) &&  $user==0 && $sign_up==0){
			$data = array(
				'title' => $this->lang->line('login_error_dialog_title'),
				'message' => $this->lang->line('login_error_dialog_message'),
				'label_button' =>  $this->lang->line('login_button_label')
			);
		}else{ 
			$this->session->set_userdata('wp-user', array(
				'id' => $user->id,
				'id_status' => $user->id_status,
				'id_profile' => $user->id_profile,
				'name' => $user->name,
				'email' => $user->email,
				'pass' => $user->password
			));

			$data = array(
				'title' => 'ok',
				'message' => 'ok',
				'url' => site_url().'/content/body/'.$this->main_page
			);
		}

		if ($sign_up==0)
			echo json_encode($data);
	}

	public function logout(){
		$this->session->sess_destroy();
		$this->access();
	}

	public function access($ref='')
	{
		if ($this->session->userdata('wp-user')){
			redirect(base_url().'index.php/content/body/'.$this->main_page);
		}else{	
			$body = $this->ModelContents->getRow('my-account-login');
			$this->data = array(
				'content' => $body,
				'language' => $this->lang->load('login', $this->session->userdata('ws-language')),
				'blog_summary' => $this->ModelContents->getRows(" WHERE id_type = '3' AND id_status = '1' " , " LIMIT 3"),
				'ref' => $ref
			);
			$this->load->layout($body->body, $this->data, explode('-',$body->jsLibraries));
		}
	}	
}

?>