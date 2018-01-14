<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Article_model');
//		$this->load->model('user_model');
	}

	public function index()
	{
		$this->load->library('pagination');
		$total = $this->Article_model->get_count_article();

		$config['base_url'] = base_url().'welcome/index';
		$config['total_rows'] = $total;
		$config['per_page'] = 2;

		$this->pagination->initialize($config);

		$links=$this->pagination->create_links();
		$results = $this->Article_model->get_article_list($this->uri->segment(3),$config['per_page']);

//		$user = $this->session->userdata('user');
		$types = $this->Article_model->get_article_type();

		$this->load->view('index',array('list'=>$results,'types'=>$types,'links'=>$links));
	}
	public function index_login()
	{
		$this->load->library('pagination');

		$user = $this->session->userdata('user');

		$total = $this->Article_model->get_logined_count_article($user->user_id);


		$config['base_url'] = base_url().'welcome/index_login';//当前控制器方法
		$config['total_rows'] = $total;//总数
		$config['per_page'] = 2;//每页显示条数

		$this->pagination->initialize($config);
		$links=$this->pagination->create_links();

		$results = $this->Article_model->get_article_list_login($this->uri->segment(3),$config['per_page'],$user->user_id);

		$types = $this->Article_model->get_logined_article_type($user->user_id);

		$this->load->view('index_logined',array('list'=>$results,'types'=>$types,'links'=>$links));

	}
	public function new_blog(){

		$user = $this->session->userdata('user');
		$types = $this->Article_model->get_type_by_user_id($user->user_id);

		$this->load->view('newBlog',array('types'=>$types));
	}
}
