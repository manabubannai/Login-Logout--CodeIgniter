<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>メンバーページ</title>

</head>
<body>

<div id="container">
	<h1>メンバーページ</h1>

	<?php

	echo "<pre>";
	print_r ($this->session->all_userdata());
	echo "</pre>";

	?>

	<a href="<?php echo base_url() . "main/logout" ?>">ログアウト</a>

</div>

</body>
</html>