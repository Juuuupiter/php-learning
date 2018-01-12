<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
        $this->load->model('user_model');
    }
    public function login()
    {
        $this->load->view('login');
    }
    public function reg(){
        $this->load->view('reg');
    }
    public  function  add_user(){
        $email = $this->input->get('email');
        $name = $this->input->get('name');
        $pwd1 = $this->input->get('pwd');
        $pwd2 = $this->input->get('pwd2');
        $gender = $this->input->get('gender');
        $province = $this->input->get('province');

        if($pwd1 != $pwd2){
            echo 'pwd-error';
            die();
        }
        $row = $this->user_model->add(array(
            'username'=>$name,
            'password'=>$pwd1,
            'email'=>$email,
            'sex'=>$gender,
            'province'=>$province
        ));
        if($row>0){
            echo "success";
        }else{
            echo "fail";
        }
    }
    public function check_email(){
        $email = $this->input->get('email');
        $result = $this->user_model->get_user_by_email($email);
        if(count($result) > 0){
            echo '1';
        }else{
            echo '0';
        }
    }

}
