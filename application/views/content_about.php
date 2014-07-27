	<div id="content">
		<!-- <h1>アバウト ページ</h1> -->
		<?php
			// $title="アバウトページ";
			// echo heading($title, 1,"class=about-h1");

			foreach($results as $row){
				$title = $row->title;
				$text1 = $row->text1;
				$text2 = $row->text2;
		}

		echo heading($title, 1, "class=home-h1")

		?>
		<!-- <p>アバウトページへようこそ</p> -->
		<p><?php echo $text1; ?></p>

		<!-- <p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p> -->
		<p><?php echo $text2; ?></p>

	</div>
