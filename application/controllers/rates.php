<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rates extends CI_Controller {

	private $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelContents');
		$this->load->model('ModelRates');
	}

	public function index($service){
		$ci = get_instance();

		$this->data = array(
			'service' => $this->ModelContents->getRow($service),
			'rate' => $this->ModelRates->getRow($service),
			'wp_user' => $this->session->userdata('wp-user'),
			'config' => $ci->config->item('websarrollo')
		);

		$this->load->view('wpanel/ajax/rates_form', $this->data);
	}

	public function sent()
	{
		if (trim($this->input->post('txtRate'))!='' && trim($this->input->post('txtInclude'))!=''){	
			$this->ModelRates->insert(
				array(
					'id_status' => '1',	
					'id_service' => $this->input->post('serv'),
					'included' => $this->input->post('txtInclude'),
					'amount' => $this->input->post('txtRate')
				)
			);
			$data = array(
				'out' => 'ok',
				'url' => base_url().'index.php/content/body/7',
				'title' => 'Success!',
				'message' => 'The rate was updated successfully.'
			);
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