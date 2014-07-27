<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		$this->login();
	}

	public function login(){
		$this->load->view('login');
	}

	public function signup(){
		$this->load->view("signup");
	}

	public function members(){
		if($this->session->userdata("is_logged_in")){		//ログインしている場合の処理
			$this->load->view("members");
		}else{								//ログインしていない場合の処理
			redirect ("main/restricted");
		}
	}

	public function restricted(){
		$this->load->view("restricted");
	}

	public function login_validation(){
		$this->load->library("form_validation");	//フォームバリデーションライブラリを読み込む。
		//利用頻度の高いライブラリ（HTMLヘルパー、URLヘルパーなど）はオートロード設定をしますが、
		//フォームバリデーションライブラリはログインバリデーションライブラリ内のみで読み込みます。

		$this->form_validation->set_rules("email", "メール", "required|trim|xss_clean|callback_validate_credentials");	//Email入力欄のバリデーション設定
		$this->form_validation->set_rules("password", "パスワード", "required|md5|trim");	//パスワード入力欄のバリデーション設定

		if($this->form_validation->run()){		//バリデーションエラーがなかった場合の処理
			$data = array(
				"email" => $this->input->post("email"),
				"is_logged_in" => 1
			);
			$this->session->set_userdata($data);

			redirect("main/members");
		}else{						//バリデーションエラーがあった場合の処理
			$this->load->view("login");
		}

		echo $_POST["email"];	//ポストされた情報を受け取ってみるテスト
		echo $this->input->post("email");
	}

	public function signup_validation(){
		$this->load->library("form_validation");	//フォームバリデーションのライブラリを読み込む

		$this->form_validation->set_rules("email", "Email", "required|trim|valid_email|is_unique[users.email]");
		$this->form_validation->set_rules("password", "パスワード", "required|trim");
		$this->form_validation->set_rules("cpassword", "パスワードの確認", "required|trim|maches[password]");

		$this->form_validation->set_message("is_unique", "入力したメールアドレスはすでに登録されています");

		if($this->form_validation->run()){
			// echo "Success!!";

			//ランダムキーを生成する
			$key=md5(uniqid());

			//Emailライブラリを読み込む。メールタイプをHTMLに設定（デフォルトはテキストです）
			$this->load->library("email", array("mailtype"=>"html"));
			$this->load->model("model_users");

			$this->email->from("manabu.bannai@gmail.com", "送信元");		//送信元の情報
			$this->email->to($this->input->post("email"));	//送信先の設定
			$this->email->subject("仮の会員登録が完了しました。");	//タイトルの設定

			//メッセージの本文
			$message = "<p>会員登録ありがとうございます。</p>";

			// 各ユーザーにランダムキーをパーマリンクに含むURLを送信する
			$message .= "<p><a href=' ".base_url(). "main/resister_user/$key'>こちらをクリックして、会員登録を完了してください。</a></p>";

			$this->email->message($message);

			//add_temp_usersファンクションがTrueを返したら、メール送信を実行
			if($this->model_users->add_temp_users($key)){
				if($this->email->send()){
				echo "Message has been sent.";
				}else echo "Coulsn't send the message.";
			}else echo "problem adding to database";

		}else{
			echo "You can't pass,,,";
			$this->load->view("signup");
		}
	}

	public function validate_credentials(){		//Email情報がPOSTされたときに呼び出されるコールバック機能
		$this->load->model("model_users");

		if($this->model_users->can_log_in()){	//ユーザーがログインできたあとに実行する処理
			return true;
		}else{					//ユーザーがログインできなかったときに実行する処理
			$this->form_validation->set_message("validate_credentials", "ユーザー名かパスワードが異なります。");
			return false;
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect ("main/login");
	}

	public function resister_user($key){
		//add_temp_usersモデルが書かれている、model_uses.phpをロードする
		$this->load->model("model_users");

		if($this->model_users->is_valid_key($key)){	//キーが正しい場合は、以下を実行
			// echo "valid key";
			if( $newemail = $this->model_users->add_user($key)){	//add_usersがTrueを返したら以下を実行
				// echo "success";
				$data = array(
					"email" => $newemail,
					"is_logged_in" => 1
				);

				$this->session->set_userdata($data);
				redirect ("main/members");

			}else echo "fail to add user. please try again";

		}else echo "invalid key";
	}


}
