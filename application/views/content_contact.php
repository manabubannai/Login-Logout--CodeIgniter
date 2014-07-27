<div id="contact">

	<?php

	$this->load->helper("form");

	echo $message;		//バリデーションエラーのない場合はサクセスメッセージを表示する
	echo validation_errors();	//バリデーションエラーの場合はメッセージを表示する

	//URLヘルパー、HTMLヘルパーは全ページで読み込むが、formヘルパーはformページのみの読み込みでOK
	echo form_open("site/send_email");	//フォームのaction先を指定する

	echo form_label("Name: ", "fullName");	//名前のラベルを作成
	$data=array(
		"name" => "fullName",
		"id" => "fullName",
		// "value" => ""
		"value" => set_value("fullName")
	);
	echo form_input($data);	//名前データのinput

	echo form_label("Email: ", "email");	//Emailラベルを作成
	$data=array(
		"name" => "email",
		"id" => "email",
		// "value" => ""
		"value" => set_value("email")
	);
	echo form_input($data);	//Emailデータのinput

	echo form_label("Message: ", "message");	//テキストエリアを作成
	$data=array(
		"name" => "message",
		"id" => "message",
		// "value" => ""
		"value" => set_value("message")
	);
	echo form_textarea($data);	//テキストエリアデータのinput

	echo form_submit("contactSubmit", "Send");

	echo form_close();

	?>

</div>
