<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {
	public function index(){
		// echo "hello world";
		// $this->load->view("view_home");
		$this->home();	//以下で定義した、home functionを読み込む
	}

	public function home(){
		$this->load->model("model_get");	//モデルフォルダ内のmodel_getを読み込む
		$data["results"] = $this->model_get->getData("home");	//pageDataのカラム内にあるpageテーブルから取得したデータ(home)との紐付けをする。その後、$dataに情報を挿入する。

		$this->load->view("site_header");
		$this->load->view("site_nav");
		// $this->load->view("content_home");
		$this->load->view("content_home", $data);
		$this->load->view("site_footer");
	}

	public function about(){
		$this->load->model("model_get");
		$data["results"] = $this->model_get->getData("about");

		$this->load->view("site_header");
		$this->load->view("site_nav");
		// $this->load->view("content_about");
		$this->load->view("content_about", $data);
		$this->load->view("site_footer");
	}

	public function contact(){
		$data["message"] = "";

		$this->load->view("site_header");
		$this->load->view("site_nav");
		// $this->load->view("content_contact");
		$this->load->view("content_contact", $data);
		$this->load->view("site_footer");
	}

	public function send_email(){
		$this->load->library("form_validation");

		// $this->form_validation->set_rules("fullName", "Full Name", "required");
		// $this->form_validation->set_rules("fullName", "Full Name", "required|alpha");
		$this->form_validation->set_rules("fullName", "Full Name", "required|alpha|xss_clean");
		//$this->form_validation->set_rules("email", "Email", "required");
		// $this->form_validation->set_rules("email", "Email", "required|valid_email");
		$this->form_validation->set_rules("email", "Email", "required|valid_email|xss_clean");
		// $this->form_validation->set_rules("message", "Message", "required");
		$this->form_validation->set_rules("message", "Message", "required|xss_clean");

		if($this->form_validation->run() == FALSE){	//バリデーションエラーの場合は、以下の処理を行なう
			$data["message"] = "";

			$this->load->view("site_header");
			$this->load->view("site_nav");
			// $this->load->view("content_contact");
			$this->load->view("content_contact", $data);
			$this->load->view("site_footer");
		}else{							//バリデーションエラーのない場合は、以下の処理を行なう
			$data["message"] = "メッセージが送信されました。";

			$this->load->library("email");

			$this->email->from(set_value("email"), set_value("fullName"));	//メールのFrom設定
			$this->email->to("my_email@gmail.com");				//メールのTo設定
			$this->email->subject("フォームから送られたメッセージです");	//メールの件名
			$this->email->message(set_value("message"));			//メールの内容

			$this->email->send();	//メールを送信する

			echo $this->email->print_debugger();	//

			$this->load->view("site_header");
			$this->load->view("site_nav");
			$this->load->view("content_contact", $data);
			$this->load->view("site_footer");
		}
	}

}
