<?php
	require "db.php";
?>	

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Тестовое задание</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link rel="stylesheet" href="main.css">
</head>
<body>
	<?php if( isset($_SESSION['logged_user']) ) : ?>
		<h2>Вы авторизованы!</h2>
		<div class="info">
			<p>
				<strong>Ваш логин:</strong> <?php echo $_SESSION['logged_user']->login; ?>
			</p>
			<p>
				<strong>Ваш email:</strong> <?php echo $_SESSION['logged_user']->email; ?>
			</p>
			<a href="logout.php">Выйти</a>
		</div>
	<?php else : ?>
		<div class="singup">
			<a href="singup.php">Регистрация</a>
		</div>
		<div class="singin">
			<a href="login.php">Авторизация</a>
		</div>
	<?php endif; ?>	
</body>
</html>