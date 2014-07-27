<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>会員登録ページ</title>

</head>
<body>

<div id="container">
	<h1>会員登録ページ</h1>

	<?php

	echo form_open("main/signup_validation");

	echo validation_errors();

	echo "<p>Email：";
	echo form_input("email", $this->input->post("email"));		//Emailの入力フィールド
	echo "</p>";

	echo "<p>パスワード：";
	echo form_password("password");	//パスワードの入力フィールド
	echo "</p>";

	echo "<p>パスワードの確認";
	echo form_password("cpassword");	//パスワード入力ミス防止用のフィールド
	echo "</p>";

	echo "<p>";
	echo form_submit("signup_submit", "会員登録する");	//会員登録ボタン
	echo "</p>";

	?>

</div>

</body>
</html>