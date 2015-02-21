<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Newsletters extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelNewsletters');
	}

	public function sent()
	{
		if (trim($this->input->post('txtNewslettersName'))!='' && trim($this->input->post('txtNewslettersEmail'))!=''){
			if (!$this->ModelNewsletters->exists($this->input->post('txtNewslettersEmail'))){
				$this->ModelNewsletters->insert($this->input->post('txtNewslettersName'), $this->input->post('txtNewslettersEmail'));
				$data = array(
					'title' => 'Thanks for choosing us!',
					'message' => 'We have received your subscription successfully.'
				);
			}else{
				$data = array(
					'title' => 'Error',
					'message' => 'The email that you gave to us is already in our data base, try using another one.'
				);
			}
		}else{
			$data = array(
				'title' => 'Error',
				'message' => 'The informations is not valid, try again.'
			);
		}

		echo json_encode($data);
	}
	
}

?>