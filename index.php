<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include 'functions.php';

?>

<?=template_header('Домашняя')?>

<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link href="regstyle.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
		<div class="login">
			<h1>Авторизация</h1>
			<form action="Authenticate.php" method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Логин" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Пароль" id="password" required>
				<input type="submit" value="Войти">
			</form>
		</div>
	</body>
</html>

<?=template_footer()?>