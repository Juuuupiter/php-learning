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
    public function captcha(){
        $this->load->helper('captcha');
        $rand = rand(1000,9999);
        $this->session->set_userdata(array(
            "captcha" =>$rand
        ));

        $vals = array(
            'word'      => $rand,
            'img_path'  => './captcha/',
            'img_url'   => base_url().'captcha/',
            'font_path' => './path/to/fonts/texb.ttf',
            'img_width' => '150',
            'img_height'    => 30,
            'expiration'    => 7200,
            'word_length'   => 8,
            'font_size' => 16,
            'img_id'    => 'Imageid',
            'pool'      => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

            // White background and border, black text and red grid
                'colors'    => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
            )
        );

        $cap = create_captcha($vals);
        $img= $cap['image'];
        return $img;
    }

    public function reg(){
//        $this->load->view('reg');
        $img=$this->captcha();
        $this->load->view('reg',array('img'=>$img));
    }

    public  function  add_user(){
        $email = $this->input->get('email');
        $name = $this->input->get('name');
        $pwd1 = $this->input->get('pwd');
        $pwd2 = $this->input->get('pwd2');
        $gender = $this->input->get('gender');
        $province = $this->input->get('province');
        $code = $this->input->get('code');

        if($pwd1 != $pwd2){
            echo 'pwd-error';
            die();
        }

        $captcha = $this->session->userdata('captcha');
        if ($code!=$captcha){
            echo 'code-error';
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
    public function add_article(){
        $title = $this->input->get('title');
        $content = $this->input->get('content');
        $type_id = $this->input->get('type_id');
        $user = $this->session->userdata('user');
        if($title == null){
            echo 'title-error';
            die();
        }
        if($content == null){
            echo 'content_error';
            die();
        }
        $row = $this->user_model->add_article(array(
            'title'=>$title,
            'content'=>$content,
            'type_id'=>$type_id,
            'user_id'=>$user->user_id
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
    public function change_code(){
        $img=$this->captcha();
        echo $img;
    }
    public function check_login(){
        $email = $this->input->get('email');
        $pwd = $this->input->get('pwd');
        $result = $this->user_model->get_user_by_email($email);
        if(count($result)==0){
            echo 'email not exit';
        }else {
            if($result[0]->password==$pwd){
                echo 'success';
            }else{
                echo 'pwd is wrong';
            }
        }
    }
    public function auto_login(){
        $email = $this->input->get('email');
        $result = $this->user_model->get_user_by_email($email);
        $this->session->set_userdata(array(
           'user'=>$result[0]
        ));
        redirect("welcome/index_login");
    }
     public function logout(){
         $this->session->unset_userdata('user');
         redirect("welcome/index");
     }
    public function admin_index(){
        $this->load->view('adminIndex');
    }
}
