<!DOCTYPE html >
<html lang="ja">
<head>
	<meta http-equiv="Content-Type" content="text/html charset=utf-8"/>
	<title>
		<?php
			if(isset($title)): echo $this->escape($title).'-';
			endif; ?>
		fire</title>
	<link rel="stylesheet" href="<?php echo $base_url; ?>/../css/resetstyle.css">
	<link rel="stylesheet" href="<?php echo $base_url; ?>/../css/style.css">
	
</head>
<body>
	<div class="menu_space">
		<ul>
                    <li><a href="<?php echo $base_url; ?>/home">ホーム</a></li><!--
			--><li><a href="<?php echo $base_url; ?>/detail">サイトの説明</a></li><!--
			--><li><a href="<?php echo $base_url; ?>/logins/signin">ログイン</a></li><!--
			--><li><a href="<?php echo $base_url; ?>/logins/signup">新規作成</a></li><!--
			--><li><a href="<?php echo $base_url; ?>/record">製作ログ</a></li>
		</ul>
	</div>
	
	
	<div id="main">
		<?php echo $_content; ?>
	</div>
	<footer>
	使用されている画像は一部を除き、フリー素材が使用されております。
	<small>Copyright (c)2018 Y.I All Rights Reserved.</small>
	</footer>
	<script src="../js/fire.js"></script>

</body>
</html>