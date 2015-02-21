<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include(APPPATH.'libraries/twitter/twitter.class.php');

class Content extends CI_Controller {

	private $data;

	public function __construct()
	{
		parent::__construct();
		$this->data = array();
		$this->load->model('ModelContents');
	}

	//home page
	public function index()
	{
		$this->data = array(
			'blog_summary' => $this->ModelContents->getRows(" WHERE id_type = '3' AND id_status = '1' " , " LIMIT 3", " ORDER BY id DESC"),
			'more_blog' => $this->ModelContents->getRows(" WHERE id_type = '3' AND id_status = '1' " , " LIMIT 10", " ORDER BY id DESC"),
			'index' => '1'
		);

		//wpanel session	
		if ($this->session->userdata('wp-user'))
			$this->data['wp_user'] = $this->session->userdata('wp-user');

		$this->load->layout('home_summary',$this->data);
	}

	//control all view in the system
	public function body($content)
	{
		$this->load->model('ModelContents');
		$this->data = array(
			'content' => $this->ModelContents->getRow($content),
			'is_post' => false,
			'blog_summary' => $this->ModelContents->getRows(" WHERE id_type = '3' AND id_status = '1' " , " LIMIT 3", " ORDER BY id DESC")
		);

		switch ($this->data['content']->id) {
			case '3': //blog
				$this->data['is_post'] = true;
				$this->data['more_posts'] = $this->ModelContents->getRows(" WHERE id_type = '3' AND id_status = '1' ", " LIMIT 5");
			break;

			case '4': //contact
				$this->data['language'] = $this->lang->load('support', $this->session->userdata('ws-language'));
			break;

			case '7': //content list
				$this->data['contents_list'] = $this->ModelContents->getRows(" WHERE is_view = '0' AND id_content = 0 AND id NOT IN (SELECT id_content FROM contents)");
				$this->data['list_type'] = $this->ModelContents->get_types(" WHERE id != '5' ");
				$this->data['wp_user'] = $this->session->userdata('wp-user');
			break;
		}

		//wpanel session
		if ($this->session->userdata('wp-user'))
			$this->data['wp_user'] = $this->session->userdata('wp-user');

		if ($this->data['content']->is_view==1){
			if (isset($this->data['wadmin'])&&$this->data['wadmin']!=''){
				redirect($this->data['wadmin']);
			}else{
				$this->load->layout($this->data['content']->body, $this->data, explode('-',$this->data['content']->jsLibraries));
			}

		}else{
			$this->load->layout('content', $this->data, explode('-',$this->data['content']->jsLibraries));
		}
	}

	//manage form to edit a exists content
	public function manage($content)
	{
		$body = $this->ModelContents->getRow('contents');
		$this->data = array(
			'id_content' => $content,
			'content' => $body,
			'wp_user' => $this->session->userdata('wp-user'),
			'type_list' => $this->ModelContents->get_types()
		);

		if ($content!="")
			$this->data['info'] = $this->ModelContents->getRow($content);

		$this->load->layout($body->body, $this->data, explode('-',$body->jsLibraries));
	}

	//manage form to add new content
	public function add($id_type)
	{
		$this->data = array(
			'new' => 1,
			'id_type' => $id_type,
			'content' => $this->ModelContents->getRow('contents'),
			'wp_user' => $this->session->userdata('wp-user'),
			'type_list' => $this->ModelContents->get_types(" WHERE id != '5' ")
		);

		$this->load->layout('wpanel/contents', $this->data, array('ckeditor/ckeditor.js','wpanel/contents.js'));
	}

	//update content in DB
	public function update()
	{
		$path = 'img/contents/';
		$tmp_error = '';
		$error = '';

		new_directory($path);

		if ($_FILES['image']['error']==0){ //image validation
			if (!upload_file($path, 'image', $tmp_error, $photo)){
				$error .= trim($tmp_error)!='' ? ',  Error upload image: '.$tmp_error : 'Error upload image: '.$tmp_error;
				$tmp_error = '';
			}else{
				@unlink($this->input->post('old_image'));
				$update['image'] = $path.$photo['file_name'];
				resize_image($update['image'], 450);
			}
		}

		if ($error!=''){ // if the image didn't upload
			echo json_encode(array(
				'out' => 'notOk',
				'title' => 'Error',
				'message' => 'There was a error trying to upload the content image. Error --> : '.$error
			));
		}else{ // if everything is ok
			
			if ($this->input->post('cboLanguage')=='1'){ //english
				$update['title_english'] = $this->input->post('txtTitulo');
				$update['summary_english'] = $this->input->post('summary');
				$update['body_english'] = $this->input->post('body');
			}else{
				$update['title'] = $this->input->post('txtTitulo');
				$update['summary'] = $this->input->post('summary');
				$update['body'] = $this->input->post('body');
			}	

			$update['id_type'] = $this->input->post('id_type');
			$update['id_content'] = $this->get_father($update['id_type']);
			$update['id_status'] = $this->input->post('cboStatus');
			$update['author'] = $this->input->post('txtAuthor');;
			$update['date'] = date('Y-m-d h:m:s');

			$this->ModelContents->update($update, $this->input->post('id')); //query update

			echo json_encode(array(
				'out' => 'ok',
				'title' => 'Success!',
				'message' => 'The content was updated successfully.',
				'url' => site_url().'/content/body/7'
			));
		}
	}

	public function get_father($id_type){
		switch ($id_type) {
			case '2': // services
				return 2;	
			break;

			case '4': // training
				return 3;	
			break;
			
			default:
				return 0;
			break;
		}
	}

	//insert new content in DB
	public function insert()
	{
		$titleTweet = '';
		if ($this->input->post('cboLanguage')=='1'){ //english
			$insert['title_english'] = $this->input->post('txtTitulo');
			$insert['summary_english'] = $this->input->post('summary');
			$insert['body_english'] = $this->input->post('body');
		}else{
			$insert['title'] = $titleTweet = $this->input->post('txtTitulo');
			$insert['summary'] = $this->input->post('summary');
			$insert['body'] = $this->input->post('body');
		}	

		$insert['id_type'] = $this->input->post('id_type');
		$insert['id_content'] = $this->get_father($insert['id_type']);
		$insert['id_status'] = $this->input->post('cboStatus');
		$insert['author'] = $this->input->post('txtAuthor');;
		$insert['date'] = date('Y-m-d h:m:s');

		if ($this->ModelContents->insert($insert)){

			$path = 'img/contents/';
			$tmp_error = '';
			$error = '';
			$id = $this->db->insert_id();

			if ($_FILES['image']['error']==0){ //image validation
				if (!upload_file($path, 'image', $tmp_error, $photo)){
					$error .= '* Image: '.$tmp_error.'<br><br>';
					$tmp_error = '';
				}else{
					$update['image'] = $path.$photo['file_name'];
					resize_image($update['image'], 450);
				}
			}

			$this->ModelContents->update($update, $id); //query update

			//posting in twitter
			$consumerKey = 'T3JcfusWig6yugZjzNdT3Oq2N'; 
			$consumerSecret = 'gqr6ThMJbFMkkMQjKZZYMEdCG64dlhjj9P2RJuR1fNDu6ERwmn'; 
			$accessToken = '3023098453-zJVtUupUO6pc0Fw8VkY35ug9ibo9uX2rWsu5nRL'; 
			$accessTokenSecret = 'TbK0eENUtEQ3TVXY5oEs3fBvG62lgZ1ZshQBt1pMz3DdD';
			$this->dara['errorTwitter'] = '';
			$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
			try {
				$tweet = $twitter->send($this->input->post('txtTitulo').' :: #izodiac :: '.site_url().'/content/body/'.$id); // you can add $imagePath as second argument

			} catch (TwitterException $e) {
				$this->dara['errorTwitter'] = 'Error: ' . $e->getMessage();
			}
			////////////////////
			
			if ($error!=''){
				$this->data = array(
					'out' => 'notOk',
					'title' => 'There was a error trying to upload the image',
					'message' => $error.'<br>You can solve this error in edit.'
				);
			}else{
				$this->data = array(
					'out' => 'ok',
					'title' => 'Success!',
					'message' => 'The content was created successfully.',
					'url' => site_url().'/content/body/7'
				);
			}//error

		}else{

			$this->data = array(
				'out' => 'notOk',
				'title' => 'Error',
				'message' => 'There was a error trying to create the content. Please, try again.<br><br>If the error still hapening, plase call the adminitratior'
			);

		} //query insert

		echo json_encode($this->data);
	}

	//delete contents from content list view
	public function delete($id)
	{
		$content = $this->ModelContents->getRow($id);

		unlink($content->image);

		$this->ModelContents->delete($id);

		echo json_encode(array(
			'out' => 'ok'
		));
	}

	//this method is called when the combo box is changed
	public function ajax_grid($id_type="")
	{
		$ci = get_instance();

		$where = "";
		if ($id_type!=''){
			if ($id_type=='1'){
				$where .= " WHERE id_type = '".$id_type."' AND is_view = '0' AND id_content = 0 AND id NOT IN (SELECT id_content FROM contents) ";
			}else{
				$where .= " WHERE id_type = '".$id_type."' AND is_view = '0' ";	
			}		
		}

		$this->data = array(
			'contents_list' => $this->ModelContents->getRows($where, ' LIMIT 50'),
			'wp_user' => $this->session->userdata('wp-user'),
			'config' => $ci->config->item('websarrollo')
		);

		$this->load->view("wpanel/ajax/contents_list", $this->data);
	}

}
?>
