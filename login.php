<?php
	require "db.php";

	$data = $_POST;

	if( isset($data['do_login']) )
	{
		$errors = array();
		$user = R::findOne('users', "login = ?", array($data['login']));
		if( $user )
		{
			if( password_verify($data['password'], $user->password) )
			{
				$_SESSION['logged_user'] = $user;
				header('Location: /');
			} else 
			{
				$errors[] = 'Неверный логин или пароль';
			}
		} else 
		{
			$errors[] = 'Неверный логин или пароль';
		}
	}
	if( !empty($errors) )
	{
		echo '<div style="color: red; text-align: center;">'.array_shift($errors).'</div><hr>';
	}
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
	<h2>Авторизация</h2>
	<form action="login.php" method="POST">
		<div>
			<input type="text" name="login" placeholder="Введите логин" value="<?php echo @$data['login']; ?>">
			<input type="password" name="password" placeholder="Введите пароль">
			<input class="button" type="submit" name="do_login" value="Авторизоваться"></input>
		</div>
	</form>
</body>
</html>
