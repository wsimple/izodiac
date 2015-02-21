<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelContents');
	}

	public function sent()
	{
		$this->load->library('email');

		$body = '
			<table align="center" cellpadding="0" cellspacing="0" border="0" style="width: 600px; font-size: 12px; font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;font-weight: normal;border: 1px solid #f4f4f4; ">
			<tr>
			<td style="border: 1px solid #f4f4f4;border-bottom: none;"><img src="'.base_url().'img/top_mail.png" alt=""></td>
			</tr>
			<tr>
			<td style="padding:10px;border: 1px solid #f4f4f4;border-bottom: none; border-top: none;"><h4>Customer Info</h4></td>
			</tr>
			<tr>
			<td style="padding:10px;border: 1px solid #f4f4f4;border-bottom: none;"><strong>Name:</strong>&nbsp;'.formatString($this->input->post('txtContactName').' '.$this->input->post('txtContactLastName')).'</td>
			</tr>
			<tr>
			<td style="padding:10px;border: 1px solid #f4f4f4;border-bottom: none;"><strong>Email:</strong>&nbsp;'.$this->input->post('txtContactEmail').'</td>
			</tr>
			<tr>
			<td style="padding:10px;border: 1px solid #f4f4f4;border-bottom: none;"><strong>Phone Number:</strong>&nbsp;'.formatString($this->input->post('txtContactTlf')).'</td>
			</tr>
			<tr>
			<td style="padding:10px;border: 1px solid #f4f4f4;border-bottom: none;"><h4>Support Info</h4></td>
			</tr>
			<tr>
			<td style="padding:10px;border: 1px solid #f4f4f4;border-bottom: none;"><strong>Subject:</strong>&nbsp;'.formatString($this->input->post('txtContactSubject')).'</td>
			</tr>
			<tr>
			<td style="padding:10px;border: 1px solid #f4f4f4;border-bottom: none;"><strong>Message</strong>&nbsp;</td>
			</tr>
			<tr>
			<td style="padding:10px;border: 1px solid #f4f4f4;">'.formatString($this->input->post('txtContactMsg'),2).'</td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			</tr>
			</table>
		';

		$this->email->initialize(emailSetting());
		$this->email->from('no-reply@izodiac.me', formatString($this->input->post('txtContactName').' '.$this->input->post('txtContactLastName')));
		$this->email->to('contact@izodiac.me');
		$this->email->subject(formatString($this->input->post('txtContactSubject')));
		$this->email->message($body);

		if (!$this->email->send()){
    		$data = array(
    			'title' => 'Error',
    			'message' => 'there was an error when we tried to send the email, try again.',
    			'debugger' => $this->email->print_debugger()
    		);
		}else{
			$data = array(
    			'title' => 'Thanks for your request!',
    			'message' => 'We have received your message. You will receive a message from us in 24 hours.',
    			'out' => 'ok',
    			'url' => base_url().'index.php/content/body/4',
    			'debugger' => '' //$this->email->print_debugger()
    		);
		}

		echo json_encode($data);
	}

}

?>
