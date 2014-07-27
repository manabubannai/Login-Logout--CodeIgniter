<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>ログインページ</title>

</head>
<body>

<div id="container">
	<h1>ログインページ</h1>

	<?php

	echo form_open("main/login_validation");	//フォームを開く

	echo validation_errors();		//バリデーションのエラー表示用

	echo "<p>Email：";
	echo form_input("email", $this->input->post("email"));	//Emailの入力フィールドを出力
	echo "</p>";

	echo "<p>パスワード：";
	echo form_password("password");	//パスワードの入力フィールドを出力
	echo "</p>";

	echo "<p>";
	echo form_submit("login_submit", "Login");	//ユーザー登録ボタンを出力
	echo "</p>";

	echo form_close();	//フォームを閉じる

	?>

	<a href="<?php echo base_url() . "main/signup" ?>">会員登録する</a>

</div>

</body>
</html>